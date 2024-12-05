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

        $categories = [
            1 => ['name' => 'Dịch vụ', 'category_id' => 1],
            2 => ['name' => 'Giao tiếp', 'category_id' => 2],
            3 => ['name' => 'Lãnh đạo và người quản lý', 'category_id' => 3],
            4 => ['name' => 'Trách nhiệm', 'category_id' => 4],
            5 => ['name' => 'Hỗ trợ', 'category_id' => 5]
        ];

        $category_list = categoriesModel::all();

        // Chuyển đổi thành mảng với key là id và giá trị là name, category_id
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

        $html = view('home.content.questions', $data)->render();  // Đảm bảo render view thành HTML

        return response()->json([
            'html' => $html,
            'status' => true,
            'message' => 'render view successfully'
        ]);
    }
}
