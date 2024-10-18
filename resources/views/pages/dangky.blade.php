@extends('layouts.master')
@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
@section('content')	

<div class="container">
    <div class="backgroundsignup">
        <div class="wrap_signup">
                <form action="{{ route('postSignup') }}" method="post">
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
                        <div class="signup-item logintitle">
                            <h1>ĐĂNG KÝ</h1>
                        </div>
                        <div class="signup-item  namesignup">
                            <input type="text" id="username" name="name" placeholder="Username" required >
                        </div>
                        <div class="signup-item namesignup">
                            <input type="email"  id="email"  placeholder="Email" name="email" required >
                        </div>
                        <div class="signup-item passwordsingup">
                            <input type="password"  id="password" placeholder="Mật khẩu" name="password" >
                        </div>
                        <div class="signup-item passwordsingup">
                            <input type="password"  id="repassword" placeholder="Mật khẩu" name="repassword" >
                        </div>
                        <div class="signup-item ">
                            <input type="number"  id="phone" placeholder="Phone" name="phone" >
                        </div>
                        <div class="signup-item ">
                            <input type="text"  id="address" placeholder="Address" name="address" >
                        </div>
                        <div class="signup-item login_btn">
                            <button id="submitButton" type="submit" name="signin" disabled><i id="arrow" class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <div class="signup-item login_option">
                            <a href="{{route('getLogin')}}">Đăng nhập</a>
                        </div>
                        <div class="signup-item login_option">
                            <a href="{{route('pages.index')}}">Quay về trang chủ</a>
                        </div>  
                </form>
    </div>
</div>
@endsection
