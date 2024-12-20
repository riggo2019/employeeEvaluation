<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use App\Services\ScoreService;
use App\Services\UserService;
use App\Services\AdminScoreService;

use App\Models\UserModel;
use App\Models\categoriesModel;
use App\Models\UserQuestionScore;
use App\Models\UserScore;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $QuestionsService;
    protected $ScoreService;
    protected $AdminScoreService;
    protected $UserService;

    public function __construct(
        QuestionsService $QuestionsService,
        ScoreService $ScoreService,
        AdminScoreService $AdminScoreService,
        UserService $UserService,
    ) {
        $this->QuestionsService = $QuestionsService;
        $this->ScoreService = $ScoreService;
        $this->AdminScoreService = $AdminScoreService;
        $this->UserService = $UserService;
    }

    public function index()
    {
        $users = UserModel::getAllUsers();

        $data['users'] = $users;
        $data['content'] =  'admin.content.dashboard';
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [];
        return view('admin/index', $data);
    }

    public function users()
    {
        $users = $this->UserService->getUserFullInfo();

        $data['users'] = $users;
        $data['content'] =  'admin.content.users';
        $data['title'] =  'Quản lý nhân viên';
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [
            '/js/admin/users.js',
        ];
        // dd($data);

        return view('admin/index', $data);
    }
}
