@extends('frontend.layouts.master')
@section('meta')
    <title>Register -{{ get_setting('site_name') }}</title>
@endsection
@section('content')
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-5 p-0  order-lg-1 order-1 loginLeft-img">
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
                <div class="col-xl-5 col-lg-7 order-lg-1 order-0 login-Wrapper">
                    <div class="header mb-3 text-center">
                        <h2>Registration</h2>
                    </div>
                    <form action="{{ route('member.register.submit') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-20">
                                <label class="label_title">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                @if ($errors->has('name'))
                                    <p class="invalid-input">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group mb-20">
                                <label class="label_title">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                    <p class="invalid-input">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="form-group mb-20">
                                <label class="label_title">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                                @if ($errors->has('phone'))
                                    <p class="invalid-input">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>

                            <div class="form-group mb-20">
                                <label class="label_title">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <p class="invalid-input">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="form-group mb-20">
                                <label class="label_title">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm Password">

                            </div>

                            <!-- Terms and Conditions -->
                            <div class="col-lg-12 col-md-12">
                                <label class="checkWrap2 terms-conditions"> I agree with the
                                    <a href="terms-and-conditions.html" target="_blank" class="text-primary"> Terms and
                                        Conditions </a>
                                    <input class="effectBorder check-input" type="checkbox" name="terms_conditions"
                                        id="terms_conditions" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <div class="btn-wrapper text-center">
                                    <button type="submit"
                                        class="cmn-btn4 w-100 user-register-form sign_up_now_button">Register
                                        <span id="user_register_load_spinner"></span>
                                    </button>
                                    <!--social login -->

                                    <p class="sinUp my-2">
                                        <span>Already have an account? </span>
                                        <a href="{{ route('member.login') }}" class="singApp">Login</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
