<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionsService;

use App\Models\UserModel;

class HomeController extends Controller
{
    protected $QuestionsService;

    public function __construct(QuestionsService $QuestionsService) {
        $this->QuestionsService = $QuestionsService;
    }

    public function index() {
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

    public function translate() {
        $questions = $this->QuestionsService->getQuestionsByCategory();
        // dd($questions);
        $data['content'] =  'home.content.translate';
        $data['css_files'] = [
            '/css/home/form.css',
        ];
        $data['js_files'] = [
            '',
        ];
        return view('home/index', $data);
    }
}
