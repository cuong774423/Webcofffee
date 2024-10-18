@extends('layouts.master')
@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
@section('content')	

<div class="container">
    <div class="backgroundlogin">
        <div class="wrap_login">
                <form action="{{ route('postLogin') }}" method="post">
                @csrf
                        <div class="login-item notification">
                            @if (session('message'))
                                <div class="alert alert-{{ session('flag') }}">
                                    <p>{{ session('message') }}</p>
                                </div>
                            @endif
                            
                            <!-- Hiển thị lỗi từ validate -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>       
                                </div>
                            @endif
                        </div>
                        <div class="login-item logintitle">
                            <h1>ĐĂNG NHẬP</h1>
                        </div>
                        <div class="login-item namelogin">
                            <input type="email"  id="email"  placeholder="Email" name="email" >
                        </div>
                        <div class="login-item passwordlogin">
                            <input type="password"  id="password" placeholder="Mật khẩu" name="password" >
                        </div>
                        <div class="login-item login-box-item">
                            <div class="icon loginfb">
                                <a href="https:/facebook.com"><i class="fa-brands fa-facebook"></i></a>
                            </div>
                            <div class="icon">
                                <a href=""><i class="fa-brands fa-google"></i></i></a>
                            </div>
                            <div class="icon">
                                <a href=""><i class="fa-brands fa-apple"></i></a>
                            </div>
                            <div class="icon">
                                <a href=""><i class="fa-brands fa-xbox"></i></a>
                            </div>
                            <div class="icon">
                                <a href=""><i class="fa-brands fa-playstation"></i></a>
                            </div>
                        </div>
                        <div class="login-item login_checkbox">
                            <input type="checkbox" class="checkmark" name="remember">
                            <span>Lưu đăng nhập</span>
                        </div>
                        <div class="login-item login_btn">
                            <button id="submitButton" type="submit" name="signin" disabled><i id="arrow" class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <div class="login-item login_option">
                            <a href="{{route('getSignup')}}">Đăng ký</a>
                        </div>
                        <div class="login-item login_option">
                            <a href="{{route('getInputEmail')}}">Quên mật khẩu?</a>
                        </div>  
                </form>
    </div>
</div>
@endsection
