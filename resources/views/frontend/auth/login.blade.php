@extends('frontend.layouts.master')
@section('meta')
    <title>Sign In - {{ get_setting('site_name') }}</title>
@endsection
@section('content')
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 p-0 order-lg-1 order-1 loginLeft-img">
                    <div class="loginLeft-img">
                        <div class="login-cap">
                            <h3 class="tittle">Buy &amp; sell anything</h3>
                            <p class="pera">Buy &amp; sell anything with ease. Enjoy a seamless experience and connect with
                                buyers and sellers in just a few clicks.</p>
                        </div>
                        <div class="login-img">
                            <img src="/public/uploads/media-uploader/login1708750583.png" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 order-lg-1 order-0 login-Wrapper">
                    <div class="header mb-3 text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="row">
                        <form method="post" action="{{ route('member.login.attempt') }}">
                            @if ($errors->has('login_error'))
                                <p class="alert alert-danger text-center">{{ $errors->first('login_error') }}</p>
                            @endif
                            @csrf
                            <div class="form-group mb-20">
                                <label class="label_title">Email Or Phone</label>
                                <input type="text" name="username" class="form-control" placeholder="Email Or Phone"
                                    value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <p class="d-block invalid-feedback text-danger">{{ $errors->first('username') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-20">
                                <label class="label_title"> Password </label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <p class="d-block invalid-feedback text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-20">
                                <div class="passRemember mt-20">
                                    <label class="checkWrap2">Remember Me
                                        <input class="effectBorder" name="remember" type="checkbox" id="check15">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!-- forgetPassword -->
                                    <div class="forgetPassword mb-25">
                                        <a href="{{ route('member.forgot.password') }}" class="forgetPass">Forgot
                                            Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-20">
                                <div class="btn-wrapper text-center">
                                    <button type="submit" class="cmn-btn4 w-100">Login</button>
                                    {{-- <p class="font-weight-bold text-center mt-2 mb-2">or</p>
                                <a href="../../login/otp.html" class="cmn-btn-outline4 w-100 mb-20">Login In with OTP</a> --}}
                                    <!--social login -->

                                    <p class="sinUp"><span>Don’t have an account?</span>
                                        <a href="{{ route('member.register') }}" class="singApp">Sign Up</a>
                                    </p>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
