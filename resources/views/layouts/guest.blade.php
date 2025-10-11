<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'موقع عدن السياحي') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   

    {{-- تنسيقات إضافية إن لم تستخدم Tailwind --}}
    <style>
        body {
            background-color:rgb(123, 146, 194); /* رمادي فاتح */
            font-family: 'Tajawal', sans-serif;
        }

        .auth-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: block;
            margin: 0 auto 1rem;
            width: 80px;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #374151;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        {{-- شعار الموقع --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

        {{-- محتوى الصفحة (login/register) --}}
        @yield('content')
    </div>

</body>
</html>