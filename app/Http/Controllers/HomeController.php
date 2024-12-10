<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionsService;

use App\Models\UserModel;
use App\Models\categoriesModel;

class HomeController extends Controller
{
    protected $QuestionsService;

    public function __construct(QuestionsService $QuestionsService)
    {
        $this->QuestionsService = $QuestionsService;
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

    public function translate()
    {
        // $questions = $this->QuestionsService->getQuestionsByCategory(2);
        // dd($questions);
        $data['content'] =  'home.content.translate';
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
        if($viewType > 1) {
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

//     public function saveFinalScore()
// {
//     $tempScores = session()->get('tempScores', []);

//     if (empty($tempScores)) {
//         return response()->json([
//             'status' => false,
//             'message' => 'No scores to save'
//         ]);
//     }

//     foreach ($tempScores as $categoryId => $scores) {
//         foreach ($scores as $questionId => $score) {
//             SurveyResult::create([
//                 'category_id' => $categoryId,
//                 'question_id' => $questionId,
//                 'score' => $score,
//                 'user_id' => auth()->id(), // Giả sử lưu theo user
//             ]);
//         }
//     }

//     session()->forget('tempScores');

//     return response()->json([
//         'status' => true,
//         'message' => 'Scores saved successfully'
//     ]);
// }
}
