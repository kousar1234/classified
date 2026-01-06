<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberAuthController extends Controller
{
    //
    public function memberLoginPage()
    {
        return view('frontend.auth.login');
    }


    public function memberRegisterPage()
    {
        return view('frontend.auth.register');
    }

    public function forgotPasswordPage()
    {
        return view('frontend.auth.forgot-password');
    }
}
