<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostQuery;


class HomeController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $data['name'] =  'Riggo';
        return view('home/home', $data);
    }
}
