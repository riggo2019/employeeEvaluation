<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use App\Services\ScoreService;
use App\Services\UserService;
use App\Services\DepartmentsService;
use App\Services\CategoriesService;

use App\Models\UserModel;
use App\Models\categoriesModel;
use App\Models\UserQuestionScore;
use App\Models\UserScore;
use App\Models\AdminQuestionScore;
use App\Models\AdminScore;




use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $QuestionsService;
    protected $ScoreService;
    protected $UserService;
    protected $DepartmentsService;
    protected $CategoriesService;

    public function __construct(QuestionsService $QuestionsService, 
                                ScoreService $ScoreService, 
                                UserService $UserService,
                                CategoriesService $CategoriesService,
                                DepartmentsService $DepartmentsService)
    {
        $this->QuestionsService = $QuestionsService;
        $this->ScoreService = $ScoreService;
        $this->UserService = $UserService;
        $this->DepartmentsService = $DepartmentsService;
        $this->CategoriesService = $CategoriesService;
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
        $userModel = new UserModel();
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
            $is_update = UserModel::where('id', $userId)->update(['answered' => 1]);
            
            if($is_update){
                return response()->json([
                    'status' => true,
                    'message' => 'Scores saved successfully!',
                ]);
            }

            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'id' => $userId,
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

    public function evaluation_management(Request $request) {
        $departmentId = $request->get('department_id');

        $departments = $this->DepartmentsService->getDepartmentNotAdminList();
        $employees = $this->UserService->getEmployeeFullInfo();
        $category_list = $this->CategoriesService->getCategoriesList();

        $selectedDepartment = $departments->firstWhere('id', $departmentId);
        $data['selectedDepartment'] = $selectedDepartment;
        $data['selectedDepartmentId'] = $departmentId;

        foreach ($category_list as &$category) {
            $category->questions = $this->QuestionsService->getQuestions($category->id);
        }

        if ($departmentId) {
            $employees = $employees->filter(function ($employee) use ($departmentId) {
                return $employee->department_id == $departmentId;
            });
        }

        $data['category_list'] = $category_list;

        foreach ($employees as $employee) {
            $employee->categories = $this->ScoreService->getScoresWithCategories($employee->id);
            foreach ($employee->categories as $category) {
                $category->average_score = $this->evaluateScore($category->average_score);
                $category->question_scores = $this->ScoreService->getListOfScore($category->category_id, $category->user_id);
            }
        }

        $data['admin_question_scores'] = DB::table('admin_question_scores')
        ->select('admin_question_scores.*')
        ->get();

        $data['admin_scores'] = DB::table('admin_scores')
        ->select('admin_scores.*')
        ->get();


        $data['departments'] = $departments;
        $data['employees'] = $employees;
        $data['content'] =  'home.content.evaluation_management';
        $data['css_files'] = [
            'css/home/reponsive.css',
            'css/home/adminScores.css'
        ];
        $data['js_files'] = [];

        // dd($data['admin_scores']);
        
        return view('home/index', $data);
    }

    public function storeAdminScores(Request $request){
    $adminId = Auth::user()->id; 
    $scores = $request->input('questionScores'); 
    // dd($scores);
    foreach ($scores as $userId => $employeeScores) {
        foreach ($employeeScores as $questionId => $score) {
            $existingRecord = AdminQuestionScore::where('admin_id', $adminId)
                ->where('user_id', $userId)
                ->where('question_id', $questionId)
                ->first();

            if ($existingRecord) {
                $existingRecord->update(['score' => $score]);
            } else {
                AdminQuestionScore::create([
                    'admin_id' => $adminId,
                    'user_id' => $userId,
                    'question_id' => $questionId,
                    'score' => $score,
                ]);
            }
        }
    }

    $categoryScores = $request->input('categoryScores'); // Lấy điểm trung bình từ request

    foreach ($categoryScores as $userId => $categories) {
        foreach ($categories as $categoryId => $averageScore) {
            // Kiểm tra xem bản ghi đã tồn tại hay chưa
            $existingRecord = AdminScore::where('admin_id', $adminId)
                ->where('user_id', $userId)
                ->where('category_id', $categoryId)
                ->first();

            if ($existingRecord) {
                // Update nếu tồn tại
                $existingRecord->update(['average_score' => $averageScore]);
            } else {
                // Tạo mới nếu chưa tồn tại
                AdminScore::create([
                    'admin_id' => $adminId,
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                    'average_score' => $averageScore,
                ]);
            }
        }
    }

    
        return redirect()->back()->with('success', 'Dữ liệu đã được lưu thành công!');
    }
}
