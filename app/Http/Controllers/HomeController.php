<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserModel;

class HomeController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $users = UserModel::getAllUsers();

        $data['users'] = $users; 
        $data['content'] =  'home.content.home';
        $data['css_files'] = [
            '/css/bootstrap/bootstrap.min.css',
            '/css/home/home.css',
        ];
        $data['js_files'] = [
            '/js/bootstrap/bootstrap.min.js',
            '/js/home/slider.js',
        ];
        return view('home/index', $data);
    }
}
