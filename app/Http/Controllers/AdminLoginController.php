<?php

namespace App\Http\Controllers;

class AdminLoginController extends Controller {
    public function index() {
        return view('login.login');
    }
}
