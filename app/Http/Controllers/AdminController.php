<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use App\Services\ScoreService;
use App\Services\UserService;
use App\Services\AdminScoreService;
use App\Http\Requests\AddUserRequest;

use App\Models\UserModel;
use App\Models\categoriesModel;
use App\Models\UserQuestionScore;
use App\Models\UserScore;
use App\Models\departmentsModel;

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
        $data['js_files'] = [
            '/js/admin/admin.js',
        ];
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

    public function addUsers()
    {
        $data['departments'] = departmentsModel::all();
        $data['content'] =  'admin.content.addUsers';
        $data['title'] =  'Quản lý nhân viên > Thêm nhân viên';
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [
            '/js/admin/users.js',
        ];
        // dd($data);

        return view('admin/index', $data);
    }

    public function storeUsers(AddUserRequest $request)
    {
        $data = request()->all('first_name', 'last_name', 'user_name', 'department_id', 'is_admin');
        if (request('start_date')) {
            $data['start_date'] = date('Y-m-d', strtotime(request('start_date')));
        }
        $data['password'] = Hash::make(request('password'));
        if (UserModel::create($data)) {
            return redirect()->route('admin.users')->with('success', 'Thêm nhân viên thành công.');
        } else {
            return redirect()->route('admin.addUsers')->with('error', 'Thêm nhân viên thất bại');
        }
    }
}
