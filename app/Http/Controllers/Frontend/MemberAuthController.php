<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

    public function memberRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users,email|max:200',
            'password' => 'required|min:6|confirmed|max:200',
            'phone' => 'phone:BD|unique:users,phone|max:20',
        ]);

        try {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->type = config('settings.user_type.member');
            $user->status = config('settings.general_status.active');
            $user->password = Hash::make($request['password']);
            $user->save();
            toastNotification('success', 'Registration Completed', 'Success');
            return to_route('member.login');
        } catch (\Exception $e) {
            toastNotification('error', 'Registration failed', 'Error');
            return redirect()->back();
        }
    }

    public function forgotPasswordPage()
    {
        return view('frontend.auth.forgot-password');
    }
}
