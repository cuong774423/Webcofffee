<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <div class="backgroundlogin adminlogin">
        <div class="wrap_login">
            <form action="{{ route('admin.postLogin') }}" method="post" >
            @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif  
                        <div class="signup-item logintitle">
                            <h1>ĐĂNG NHẬP</h1>
                        </div>
                        <div class="signup-item namelogin">
                            <input type="email"  id="email"  placeholder="Email" name="email" >
                        </div>
                        <div class="signup-item passwordlogin">
                            <input type="password"  id="password" placeholder="Mật khẩu" name="password" >
                        </div>
                        <div class="signup-item login_checkbox">
                            <input type="checkbox" class="checkmark" name="remember">
                            <span>Lưu đăng nhập</span>
                        </div>
                        <div class="signup-item login_btn">
                            <button id="submitButton" type="submit" name="signin" disabled><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <div class="signup-item login_option">
                            <a href="{{route('getInputEmail')}}">Quên mật khẩu?</a>
                        </div>  
                </form>
    </div>
</div>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
