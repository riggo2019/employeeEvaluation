<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use App\Services\ScoreService;
use App\Services\UserService;
use App\Services\AdminScoreService;
use App\Http\Requests\AddUserRequest;
use App\Services\DepartmentsService;
use App\Services\CategoriesService;

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
    protected $DepartmentsService;
    protected $CategoriesService;

    public function __construct(
        QuestionsService $QuestionsService,
        ScoreService $ScoreService,
        AdminScoreService $AdminScoreService,
        UserService $UserService,
        CategoriesService $CategoriesService,
        DepartmentsService $DepartmentsService
    ) {
        $this->QuestionsService = $QuestionsService;
        $this->ScoreService = $ScoreService;
        $this->AdminScoreService = $AdminScoreService;
        $this->UserService = $UserService;
        $this->DepartmentsService = $DepartmentsService;
        $this->CategoriesService = $CategoriesService;
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
        $users = DB::table('users')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->select(
                'users.*',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'department_translations.department_name',
                DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
            )
            ->get();

        $data['users'] = $users;
        $data['content'] =  'admin.content.users';
        $data['title'] =  __('admin.employee_manager');
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
        $data['departments'] = DB::table('departments')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->select('departments.id', 'department_translations.department_name')
            ->get();
        $data['content'] =  'admin.content.addUsers';
        $data['title'] =  __('admin.employee_manager') . ' > ' . __('admin.add_employee');
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
            return redirect()->route('admin.users')->with([
                'message' => __('toast.add_user_success'),
                'type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.addUsers')->with([
                'message' => __('toast.add_user_failed'),
                'type' => 'error'
            ]);
        }
    }

    public function editUsers($id)
    {
        $user = DB::table('users')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->where('users.id', $id)
            ->select(
                'users.*',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'department_translations.department_name',
                DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
            )
            ->first();
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Nhân viên không tồn tại.');
        }

        $data['departments'] = DB::table('departments')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->select('departments.id', 'department_translations.department_name')
            ->get();
        $data['user'] = $user;
        $data['content'] =  'admin.content.editUsers';
        $data['title'] =  __('admin.employee_manager') . ' > ' . __('admin.edit_employee');
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [
            '/js/admin/users.js',
        ];
        // dd($data);

        return view('admin/index', $data);
    }

    public function saveUsers(AddUserRequest $request)
    {
        $id = request('id');
        $data = request()->only('first_name', 'last_name', 'user_name', 'department_id', 'is_admin');
        if (request('start_date')) {
            $data['start_date'] = date('Y-m-d', strtotime(request('start_date')));
        }
        if (request('isChangePassword')) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $data['password'] = Hash::make(request('password'));
        }
        $user = UserModel::find($id);

        if ($user) {
            $user->update($data);
            return redirect()->route('admin.users')->with([
                'message' => __('toast.edit_user_success'),
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('toast.cant_find_user'),
                'type' => 'error'
            ]);
        }
    }

    public function deleteUser($id)
    {
        // Tìm user theo ID
        $user = UserModel::find($id);
        $logged_id = Auth::user()->id;

        // Kiểm tra nếu user tồn tại
        if ($user) {
            if ($user->id != $logged_id) {
                // Xóa user
                $user->delete();


                // Thông báo thành công
                return redirect()->route('admin.users')->with([
                    'message' => __('toast.delete_user_success'),
                    'type' => 'success'
                ]);
            } else {
                // Nếu xóa user đang đang đăng nhập, thông báo l��i
                return redirect()->route('admin.users')->with([
                    'message' => __('toast.cant_delete_yourself'),
                    'type' => 'error'
                ]);
            }
        } else {
            // Nếu không tìm thấy user, thông báo lỗi
            return redirect()->route('admin.users')->with([
                'message' => __('toast.cant_find_user'),
                'type' => 'error'
            ]);
        }
    }

    private function evaluateScore($score)
    {
        if ($score >= 91 && $score <= 100) {
            return __('toast.outstanding');
        } elseif ($score >= 81 && $score <= 90) {
            return __('toast.very_good');
        } elseif ($score >= 66 && $score <= 80) {
            return __('toast.good');
        } elseif ($score >= 51 && $score <= 65) {
            return __('toast.average');
        } else {
            return __('toast.poor');
        }
    }

    public function scoreListbyCategory(Request $request)
    {
        $departmentId = $request->get('department_id');

        $departments = $data['departments'] = DB::table('departments')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->where('departments.id', '!=', '5')
            ->select('departments.id', 'department_translations.department_name')
            ->get();
        $employees = DB::table('users')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->select(
                'users.*',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'department_translations.department_name',
                DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
            )->get();
        $category_list = DB::table('categories')
            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where('category_translations.locale', app()->getLocale())
            ->select('categories.id', 'category_translations.category_name')
            ->get();

        $selectedDepartment = $departments->firstWhere('id', $departmentId);


        foreach ($category_list as &$category) {
            $category->questions = DB::table('questions')
                ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
                ->where('questions.category_id', '=', $category->id)
                ->where('question_translations.locale', app()->getLocale())
                ->select('questions.id', 'question_translations.question_content')
                ->get();
        }

        if ($departmentId) {
            $employees = $employees->filter(function ($employee) use ($departmentId) {
                return $employee->department_id == $departmentId;
            });
        }



        foreach ($employees as $employee) {
            $employee->categories = $this->ScoreService->getScoresWithCategories($employee->id);
            foreach ($employee->categories as $category) {
                $category->average_score = $this->evaluateScore($category->average_score);
                $category->question_scores = $this->ScoreService->getListOfScore($category->category_id, $category->user_id);
            }
        }

        $user_scores = DB::table('user_scores')
            ->select('user_scores.*')
            ->get();

        $admin_scores = DB::table('admin_scores')
            ->select('admin_scores.*')
            ->get();

        $avg = [];

        foreach ($user_scores as $user_score) {
            foreach ($admin_scores as $admin_score) {
                if ($user_score->user_id == $admin_score->user_id && $user_score->category_id == $admin_score->category_id) {
                    $key = $user_score->user_id . '-' . $user_score->category_id;
                    // Khởi tạo nếu chưa tồn tại
                    if (!isset($avg[$key])) {
                        $avg[$key] = [
                            'user_id' => $user_score->user_id,
                            'category_id' => $user_score->category_id,
                            'total_score' => 0,
                            'count' => 0,
                        ];
                    }
                    // Cộng điểm của user
                    $avg[$key]['total_score'] += $user_score->average_score ?? 0;
                    $avg[$key]['count'] += $user_score->average_score ? 1 : 0;

                    // Cộng điểm của admin
                    $avg[$key]['total_score'] += $admin_score->average_score ?? 0;
                    $avg[$key]['count'] += $admin_score->average_score ? 1 : 0;
                }
            }
        }

        foreach ($avg as $key => &$value) {
            if ($value['count'] > 0) {
                $value['average_score'] = $value['total_score'] / $value['count'];
            } else {
                $value['average_score'] = 0;
            }
        }

        $avgScores = [];
        foreach ($avg as $item) {
            $user_id = $item['user_id'];
            if (!isset($avgScores[$user_id])) {
                $avgScores[$user_id] = [];
            }
            $avgScores[$user_id][] = [
                'category_id' => $item['category_id'],
                'average_score' => $item['average_score'],
            ];
        }

        // Tạo mảng kết quả
        $usersWithScores = [];

        foreach ($avgScores as $user_id => $categories) {
            // Tính tổng điểm cho user
            $totalScore = 0;
            $categoryCount = count($categories);

            foreach ($categories as $category) {
                $totalScore += $category['average_score'];
            }

            // Tính điểm trung bình
            $totalAvgScore = round($categoryCount > 0 ? $totalScore / $categoryCount : 0, 2);

            // Đánh giá loại điểm
            $grade = $this->evaluateScore($totalAvgScore);

            // Thêm thông tin user vào mảng
            $usersWithScores[] = [
                'user_id' => $user_id,
                'totalAvgScore' => $totalAvgScore,
                'grade' => $grade
            ];
        }

        // Sắp xếp người dùng theo totalAvgScore từ cao xuống thấp để tính xếp hạng
        usort($usersWithScores, function ($a, $b) {
            return $b['totalAvgScore'] <=> $a['totalAvgScore']; // Sắp xếp theo điểm trung bình
        });

        // Tính xếp hạng
        foreach ($usersWithScores as $index => &$user) {
            $user['ranking'] = $index + 1; // Xếp hạng bắt đầu từ 1
        }

        $employees = $employees->sort(function ($a, $b) use ($usersWithScores) {
            $rankA = null;
            $rankB = null;

            foreach ($usersWithScores as $score) {
                if ($score['user_id'] === $a->id) {
                    $rankA = $score['ranking'];
                }
                if ($score['user_id'] === $b->id) {
                    $rankB = $score['ranking'];
                }
            }

            // Sắp xếp theo thứ hạng tăng dần (ranking)
            if ($rankA === null) return 1; // User không có rank sẽ nằm cuối
            if ($rankB === null) return -1;
            return $rankA - $rankB;
        });

        $data['category_list'] = $category_list;
        $data['selectedDepartment'] = $selectedDepartment;
        $data['selectedDepartmentId'] = $departmentId;
        $data['usersWithScores'] = $usersWithScores;
        $data['avgScores'] = $avgScores;
        $data['user_scores'] = $user_scores;
        $data['admin_scores'] = $admin_scores;
        $data['departments'] = $departments;
        $data['employees'] = $employees;
        $data['content'] =  'admin.content.scoreListbyCategory';
        $data['title'] =  __('admin.scoreListbyCategory') . ' > ' . $selectedDepartment->department_name;
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [
            '/js/admin/scoresList.js',
        ];
        // print_r(json_encode($usersWithScores));
        // exit();
        return view('admin/index', $data);
    }

    public function scoreListByEmployee(Request $request, $department_id)
    {
        $user_id = $request->get('user_id');
        $departments = $data['departments'] = DB::table('departments')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->where('departments.id', '!=', '5')
            ->select('departments.id', 'department_translations.department_name')
            ->get();
        $employees = DB::table('users')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
            ->where('department_translations.locale', app()->getLocale())
            ->select(
                'users.*',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
                'department_translations.department_name',
                DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
            )
            ->get();
        $category_list = DB::table('categories')
            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where('category_translations.locale', app()->getLocale())
            ->select('categories.id', 'category_translations.category_name')
            ->get();

        $selectedDepartment = $departments->firstWhere('id', $department_id);

        foreach ($category_list as &$category) {
            $category->questions = DB::table('questions')
                ->join('question_translations', 'questions.id', '=', 'question_translations.question_id')
                ->where('questions.category_id', '=', $category->id)
                ->where('question_translations.locale', app()->getLocale())
                ->select('questions.id', 'questions.category_id', 'question_translations.question_content')
                ->get();
        }


        if ($department_id) {
            $employees = $employees->filter(function ($employee) use ($department_id) {
                return $employee->department_id == $department_id;
            });
        }
        // Lặp qua tất cả nhân viên và tính điểm trung bình cho từng người
        foreach ($employees as $selectedEmployee) {
            // Lấy dữ liệu từ bảng admin_scores và user_scores
            $selectedEmployee->admin_scores = DB::table('admin_scores')
                ->where('admin_scores.user_id', '=', $selectedEmployee->id)
                ->select('admin_scores.id', 'admin_scores.category_id', 'admin_scores.average_score')
                ->get();

            $selectedEmployee->user_scores = DB::table('user_scores')
                ->where('user_scores.user_id', '=', $selectedEmployee->id)
                ->select('user_scores.id', 'user_scores.category_id', 'user_scores.average_score')
                ->get();

            $selectedEmployee->admin_question_scores = DB::table('admin_question_scores')
                ->where('admin_question_scores.user_id', '=', $selectedEmployee->id)
                ->select('admin_question_scores.id', 'admin_question_scores.question_id', 'admin_question_scores.score')
                ->get();

            $selectedEmployee->user_question_scores = DB::table('user_question_scores')
                ->where('user_question_scores.user_id', '=', $selectedEmployee->id)
                ->select('user_question_scores.id', 'user_question_scores.question_id', 'user_question_scores.score')
                ->get();

            // Tính điểm trung bình
            $adminScore = $selectedEmployee->admin_scores->pluck('average_score')->average(); // Tính trung bình từ admin_scores
            $userScore = $selectedEmployee->user_scores->pluck('average_score')->average(); // Tính trung bình từ user_scores

            if ($adminScore !== null && $userScore !== null) {
                $selectedEmployee->final_average_score = ($adminScore + $userScore) / 2; // Trung bình cộng của 2 điểm
            } elseif ($adminScore !== null) {
                $selectedEmployee->final_average_score = $adminScore; // Chỉ có adminScore
            } elseif ($userScore !== null) {
                $selectedEmployee->final_average_score = $userScore; // Chỉ có userScore
            } else {
                $selectedEmployee->final_average_score = 0; // Không có cả 2
            }

            // Tính điểm trung bình cho mỗi category_id
            $finalScores = [];

            // Lặp qua tất cả category_id trong admin_scores
            foreach ($selectedEmployee->admin_scores as $adminScore) {
                $categoryId = $adminScore->category_id;

                // Lấy admin score và user score cho category_id tương ứng
                $adminCategoryScore = $adminScore->average_score;
                $userCategoryScore = $selectedEmployee->user_scores->firstWhere('category_id', $categoryId)->average_score ?? null;

                // Tính điểm trung bình cho từng category_id
                if ($adminCategoryScore !== null && $userCategoryScore !== null) {
                    $finalScores[$categoryId] = ($adminCategoryScore + $userCategoryScore) / 2;
                } elseif ($adminCategoryScore !== null) {
                    $finalScores[$categoryId] = $adminCategoryScore;
                } elseif ($userCategoryScore !== null) {
                    $finalScores[$categoryId] = $userCategoryScore;
                } else {
                    $finalScores[$categoryId] = 0;
                }
            }

            // Gán điểm trung bình vào đối tượng
            $selectedEmployee->final_average_scores = $finalScores;
            $selectedEmployee->grade = $this->evaluateScore($selectedEmployee->final_average_score);

            // Sắp xếp nhân viên theo final_average_score giảm dần
            $employees = $employees->sortByDesc('final_average_score');

            // Xếp hạng cho từng nhân viên
            $rank = 1;
            foreach ($employees as $selectedEmployee) {
                $selectedEmployee->rank = $rank++; // Gán thứ hạng cho nhân viên
            }
        }


        if ($user_id) {
            $selectedEmployee = $employees->filter(function ($employee) use ($user_id) {
                return $employee->id == $user_id;
            })->first(); // Lấy đối tượng đầu tiên
        }



        $data['selectedEmployee'] = $selectedEmployee ?? [];
        $data['employees'] = $employees;
        $data['departments'] = $departments;
        $data['category_list'] = $category_list;
        // print_r(json_encode($data['selectedEmployee']['admin_scores']));
        // exit;

        $data['selectedDepartment'] = $selectedDepartment;
        $data['selectedDepartmentId'] = $department_id;
        $data['selectedUserId'] = $user_id ?? null;
        $data['content'] =  'admin.content.scoreListByEmployee';
        $data['title'] =  __('admin.scoreListByEmployee') . ' > ' . $selectedDepartment->department_name;
        $data['css_files'] = [
            '/css/admin/admin.css',
        ];
        $data['js_files'] = [
            '/js/admin/scoresList.js',
        ];
        // print_r(json_encode($usersWithScores));
        // exit();
        // dd($data);
        return view('admin/index', $data);
    }
}
