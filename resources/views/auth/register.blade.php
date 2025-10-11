@extends('layouts.guest')

@section('content')
<style>
    .register-box {
        max-width: 450px;
        margin: 60px auto;
        padding: 30px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .register-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .register-box label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .register-box input[type="text"],
    .register-box input[type="email"],
    .register-box input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
    }

    .register-box button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
    }

    .register-box button:hover {
        background-color: #218838;
    }

    .register-box .bottom-link {
        text-align: center;
        margin-top: 15px;
    }

    .register-box .bottom-link a {
        color: #007bff;
        text-decoration: none;
    }

    .register-box .bottom-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-box">
    <h2>تسجيل جديد</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">الاسم الكامل</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">البريد الإلكتروني</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">كلمة المرور</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">تأكيد كلمة المرور</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <button type="submit">إنشاء حساب</button>

        <div class="bottom-link">
            <a href="{{ route('login') }}">هل لديك حساب؟ تسجيل الدخول</a>
        </div>
    </form>
</div>
@endsection