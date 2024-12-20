<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use App\Services\ScoreService;
use App\Services\UserService;

use App\Models\UserModel;
use App\Models\categoriesModel;
use App\Models\UserQuestionScore;
use App\Models\UserScore;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $QuestionsService;
    protected $ScoreService;
    protected $UserService;

    public function __construct(QuestionsService $QuestionsService, ScoreService $ScoreService, UserService $UserService)
    {
        $this->QuestionsService = $QuestionsService;
        $this->ScoreService = $ScoreService;
        $this->UserService = $UserService;
    }

    public function index()
    {
        $users = UserModel::getAllUsers();

        $data['users'] = $users;
        $data['content'] =  'home.content.home';
        $data['css_files'] = [
            '/css/home/home.css',
        ];
        $data['js_files'] = [
            '/js/home/slider.js',
        ];
        return view('home/index', $data);
    }

    public function answer()
    {
        // $questions = $this->QuestionsService->getQuestionsByCategory(2);
        // dd($questions);
        $data['category_list'] = categoriesModel::all();
        $data['content'] =  'home.content.answer';
        $data['css_files'] = [
            '/css/home/form.css',
        ];
        $data['js_files'] = [
            '/js/home/questions.js',
        ];

        return view('home/index', $data);
    }

    public function loadView(Request $request)
    {
        $viewType = $request->input('viewType');

        $category_list = categoriesModel::all();

        $categoriesArray = $category_list->mapWithKeys(function ($category) {
            return [
                $category->id => [
                    'name' => $category->category_name,
                    'category_id' => $category->id,
                ]
            ];
        })->toArray();

        if (!array_key_exists($viewType, $categoriesArray)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid view type',
                'viewType' => $viewType
            ]);
        }

        $category = $categoriesArray[$viewType];
        $data['questions'] = $this->QuestionsService->getQuestionsByCategory($category['category_id']);
        $data['category_name'] = $category['name'];
        $data['viewType'] = $viewType;
        $data['nextViewType'] = $viewType + 1;
        if ($viewType > 1) {
            $data['prevViewType'] = $viewType - 1;
        }

        $html = view('home.content.questions', $data)->render();  // Đảm bảo render view thành HTML

        return response()->json([
            'html' => $html,
            'status' => true,
            'message' => 'render view successfully'
        ]);
    }

    public function saveTempScore(Request $request)
    {
        $viewType = $request->input('viewType');
        $scores = $request->input('scores'); // Mảng điểm số từ client

        $tempScores = session()->get('tempScores', []);
        $tempScores[$viewType] = $scores;

        session()->put('tempScores', $tempScores);

        return response()->json([
            'status' => true,
            'message' => 'Scores saved temporarily'
        ]);
    }

    public function storeScore(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::user()->id; // ID người dùng (hoặc sử dụng `auth()->id()` nếu có hệ thống xác thực)
        }

        $scores = $request->input('scores');

        try {
            foreach ($scores as $categoryId => $categoryScores) {
                $questionCount = count($categoryScores);
                $categoryScoreSum = 0;

                foreach ($categoryScores as $questionId => $score) {
                    // Sử dụng Model UserQuestionScore để cập nhật hoặc thêm mới
                    UserQuestionScore::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'question_id' => $questionId,
                        ],
                        [
                            'score' => $score,
                        ]
                    );

                    $categoryScoreSum += $score;
                }

                // Tính điểm trung bình cho danh mục
                $averageScore = $questionCount > 0 ? $categoryScoreSum / $questionCount : 0;

                // Sử dụng Model UserScore để cập nhật hoặc thêm mới
                UserScore::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'category_id' => $categoryId,
                    ],
                    [
                        'average_score' => $averageScore,
                    ]
                );
            }

            return response()->json([
                'status' => true,
                'message' => 'Scores saved successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error saving scores: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function showResults()
    {
        if(Auth::check()){
            $userId = Auth::user()->id; 
        }
        
        $scores = $this->ScoreService->getScoresWithCategories($userId);
        $user = $this->UserService->getUserFullInfo($userId);

        $scoresWithEvaluation = $scores->map(function ($score) {
            return [
                'category_name' => $score->category_name,
                'average_score' => $score->average_score,
                'evaluation' => $this->evaluateScore($score->average_score),
            ];
        });
        $averageOfAllCategories = $scores->avg('average_score');
        $overallEvaluation = $this->evaluateScore($averageOfAllCategories);
        $data = [
            'scores' => $scoresWithEvaluation,
            'overallAverage' => $averageOfAllCategories,
            'overallEvaluation' => $overallEvaluation,
            'user' => $user,
        ];

        $data['content'] =  'home.content.results';
        $data['css_files'] = [];
        $data['js_files'] = [];
        return view('home/index', $data);
    }

    private function evaluateScore($score)
    {
        if ($score >= 91 && $score <= 100) {
            return 'Xuất sắc';
        } elseif ($score >= 81 && $score <= 90) {
            return 'Giỏi';
        } elseif ($score >= 66 && $score <= 80) {
            return 'Khá';
        } elseif ($score >= 51 && $score <= 65) {
            return 'Trung bình';
        } else {
            return 'Kém';
        }
    }
}
