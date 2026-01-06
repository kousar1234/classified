@extends('frontend.layouts.master')
@section('meta')
    <title>Register -{{ get_setting('site_name') }}</title>
@endsection
@section('content')
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 p-0  order-lg-1 order-1 loginLeft-img">
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
                <div class="col-xl-7 col-lg-7 order-lg-1 order-0 login-Wrapper">

                    <script src='https://www.google.com/recaptcha/api.js'></script>

                    <form action="user-register.html" method="post">
                        <input type="hidden" name="_token" value="4qMgoof0CGXn76Y2Ovd5AWGkX891VOaiaqMZeUxn"
                            autocomplete="off">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">First Name</label>
                                <div class="input-form input-form2">
                                    <input type="text" class="ps-3" name="first_name" value="" id="first_name"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">Last Name</label>
                                <div class="input-form input-form2">
                                    <input type="text" class="ps-3" name="last_name" value="" id="last_name"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">Username</label>
                                <div class="input-form input-form2">
                                    <input type="text" class="ps-3" name="username" value="" id="username"
                                        placeholder="Type Username">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">Email</label>
                                <div class="input-form input-form2">
                                    <input type="email" name="email" value="" placeholder="Type Email">
                                    <div class="icon">
                                        <i class="lar la-envelope icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">Phone Number</label>
                                <div class="input-form input-form2">
                                    <input type="hidden" id="country-code" name="country_code">
                                    <input type="tel" name="phone" value="" id="phone"
                                        placeholder="Type Phone">
                                    <span id="phone_availability"></span>

                                    <div class="d-none">
                                        <span id="error-msg" class="hide"></span>
                                        <p id="result" class="d-none"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">Password</label>
                                <div class="input-form">
                                    <input type="password" name="password" id="password" placeholder="Type Password">
                                    <div class="icon"> <i class="las la-lock icon"></i></div>
                                    <div class="icon toggle-password">
                                        <i class="las la-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-3">
                                <label class="infoTitle">Confirm Password</label>
                                <div class="input-form">
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        placeholder="Confirm Password">
                                    <div class="icon"> <i class="las la-lock icon"></i></div>
                                    <div class="icon toggle-password">
                                        <i class="las la-eye"></i>
                                    </div>
                                </div>
                            </div>

                            <span id="check_password_match" class="mb-2 mt-2"></span>

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
