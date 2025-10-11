@extends('layouts.guest')

@section('content')
<style>
    .login-box {
        max-width: 400px;
        margin: 60px auto;
        padding: 30px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .login-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .login-box label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .login-box input[type="email"],
    .login-box input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
    }

    .login-box button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
    }

    .login-box button:hover {
        background-color: #0056b3;
    }

    .login-box .bottom-link {
        text-align: center;
        margin-top: 15px;
    }

    .login-box .bottom-link a {
        color: #007bff;
        text-decoration: none;
    }

    .login-box .bottom-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-box">
    <h2>تسجيل الدخول</h2>

    @if(session('error'))
        <div style="color: red; margin-bottom: 15px;">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">البريد الإلكتروني</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

        <label for="password">كلمة المرور</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">دخول</button>

        <div class="bottom-link">
            <a href="{{ route('register') }}">لا تملك حساباً؟ سجل الآن</a>
        </div>
    </form>
</div>
@endsection






