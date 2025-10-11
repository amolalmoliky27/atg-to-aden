<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أخبار عدن</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    {{-- Navbar --}}

        <nav class="bg-blue-900 text-white p-4">
           <ul class="flex space-x-6"></ul>
                        <a class="nav-link" href="{{ url('/home') }}">🏠 الصفحة الرئيسية</a>
                        <a class="nav-link" href="{{ route('news.rating-system') }}">⭐ التقييمات</a>
                        <a class="nav-link" href="{{ route('admin2.rating-system-dash') }}"> ⭐ لوحة تحكم التقييمات</a>
                        <a class="nav-link" href="{{ route('admin2.news-dash') }}">📰 لوحة تحكم الأخبار</a>
            </ul>     
        </nav>    
      </div>

      <main class="flex-grow p-4">
        @yield('content')
      </main>
      <footer class="text-white py-8 mt-auto footer-gradient">
        <div class="container mx-auto px-4 text-center">
            <p class="text-white flex flex-col sm:flex-row justify-center items-center gap-4">
                <span>أخبار مدينة عدن الساحلية</span>
                <span><i>BY MANAL FROM WEB PIONEER 2025</i>© </span>
            </p>
        </div>
    </footer>
</body>
</html>