@extends('layouts.master')

@section('content')	
<div class="container">
    <div class="backgroundlogin">
        <div class="wrap_login">
                <form action="{{ route('postInputEmail') }}" method="post">
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
                            <h1>RESET PASSWORD</h1>
                        </div>
                        <div class="login-item passwordlogin">
                        <input name="txtEmail" type="text" placeholder="Nhập địa chỉ email của bạn để nhận mật khẩu mới" value="{{ isset($request->txtEmail)?$request->txtEmail:'' }}">
                        </div>
                        <div style='' class="login-item btn-resetpassword">
                            <button style='padding: 5px; cursor: pointer; font-weight: bold;' type="submit" >Nhận mật khẩu</button>
                        </div>
                        <div class="login-item login_option">
                            <a href="{{route('getLogin')}}">Quay lại đăng nhập</a>
                        </div>
                </form>
            </div>
    </div>
</div>
@endsection

                           