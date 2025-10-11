<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مرحباً بك - منصة عدن السياحية</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to right, #d4fc79, #96e6a1);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .logo {
            font-size: 50px;
            font-weight: bold;
            color: #1e3c72;
            margin-bottom: 10px;
        }

        .tagline {
            font-size: 20px;
            color: #333;
            margin-bottom: 40px;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 280px;
        }

        .buttons a {
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-visit {
            background-color: #007bff;
            color: white;
        }

        .btn-login {
            background-color: #17a2b8;
            color: white;
        }

        .btn-register {
            background-color: #28a745;
            color: white;
        }

        .btn-guest {
            background-color: #6c757d;
            color: white;

        }

        .buttons a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    {{-- شعار الموقع --}}
    <div class="logo">🌴 عدن السياحية</div>
    <div class="tagline">اكتشف أجمل المواقع السياحية في عدن</div>

    {{-- الأزرار --}}
    <div class="buttons">
        <a href="{{ route('login') }}" class="btn-login">🔐 تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="btn-register">📝 إنشاء حساب</a>
        <form action="{{route('guest.enter')}}" method="POST" style="margin: 0;">
            @csrf
            <button style="width: 100%;height:40px " type="submit" class="btn-guest">👤 دخول كزائر</button>
        </form>
      
    </div>

</body>
</html>