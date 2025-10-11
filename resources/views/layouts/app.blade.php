<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'مدونة عدن') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   @livewireStyles
   
</head>
<body>

    {{-- ✅ شريط التنقل --}}
    <div class="navbar">
        <div>
            <a href="{{ url('/home') }}"><strong>🏠 الصفحة الرئيسية</strong></a>
            <a href="{{ route('posts.index') }}">📋 المنشورات</a>
            @auth
                <a href="{{ route('admin.dashboard2') }}">🛠️ لوحة التحكم</a>
            @endauth
        </div>

        <div>
            @auth
                <span style="margin-left: 10px;">👤 {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="background: transparent; color: white;">🚪 خروج</button>
                </form>
            @else
                <a href="{{ route('login') }}">🔐 تسجيل الدخول</a>
                <a href="{{ route('register') }}">📝 إنشاء حساب</a>
            @endauth
        </div>
    </div>

    {{-- ✅ محتوى الصفحة --}}
    <main class="container" style="margin-top: 30px;">
        @yield('content')
    </main>
@livewireScripts
</body>
</html>