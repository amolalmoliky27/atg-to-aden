<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Aden tourism guide</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/main6.css">


  @livewireStyles
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
            {{-- شعار الموقع --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <h4 style="color: black;">دليل عدن السياحي</h4>
      </a>
      <nav>
  <div class="container">
    <!-- باقي عناصر النافبار -->
   <a href="{{ route('weather') }}" class="ms-auto fs-6">🌤️</a>
   <a href="https://maps.google.com/?q=12.8275,45.0386" class="ms-auto fs-6">
    🗺️ 
</a>

  </div>
</nav>
    
 



@auth
@if(Auth::user()->is_admin)
           <a href="{{route('categories.create')}}" class="animated-button">add new </a><style>.animated-button 
    {  display: inline-block; margin-right:40px; padding: 8px 16px;  background-color:rgb(133, 118, 160);  color: white; 
       text-decoration: none;  font-size: 14px;  border-radius: 10px;  font-weight: bold;  
       transition: all 0.3s ease;  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);}.animated-button:hover 
       {  background-color:rgb(97, 139, 177);  transform: translateY(-3px) scale(1.05); 
       box-shadow: 0 6px 10px rgba(0, 0, 0, 0.25);}</style>
@endif
@endauth

     @auth
    <a href="{{ route('favorites.index') }}" style="margin-right: 20px; font-size: 22px;">
        @if(auth()->user()->favorites->count() > 0)
            <i class="fas fa-heart" style="color: red;"></i>
        @else
            <i class="far fa-heart" style="color: grey;"></i>
        @endif
    </a>
@else
    <a href="{{ route('login') }}" style="margin-right: 20px; font-size: 22px;">
        <i class="far fa-heart" style="color: grey;" title="سجل دخول لرؤية المفضلة"></i>
    </a>
@endauth
<a href="{{ route('projectB') }}" >🌍</a>
      <nav id="navmenu" class="navmenu">
        <ul>
         
          <li><a href="#home" class="active">الرئيسية<br></a></li>
          <li><a href="#about">عن الموقع</a></li>
         
          
          <li><a href="#gallery">تصفح</a></li>
          <li class="dropdown"><a href="#"><span>زيارة</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              
            
              <li class="dropdown"><a href="#"><span>الصفحات الفرعية</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                     <li><a href="posts">مدونه شخصيه</a></li>
                  <li><a href="categories">مطاعم</a></li>
                  <li><a href="cafe">كافيهات</a></li>
                  <li><a href="hotel">فنادق</a></li>
                  <li><a href="mall">مولات</a></li>
                  <li><a href="sea">شواطئ</a></li>
                  <li><a href="park">حدائق</a></li>
                  <li><a href="history">أماكن تاريخية</a></li>
                  <li><a href="tran">مواصلات</a></li>
                 
     
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#contact">تواصل معنا</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>










  @yield('content')














  <footer id="footer" class="footer dark-background">

      <div class="container">

    
          <div class="col-lg-3 col-md-6 d-flex">
              <p>
                <strong>البريد الالكتروني:</strong> <span>team25webpioneers@gmail.com</span><br>
              </p>
          </div>
  
         
  
      <div class="container copyright text-center mt-4">
        <p> <span> نسخة محفوظة لدى</span>©<strong class="px-1 sitename"></strong> دليل عدن <span >السياحي</span></p>
        
      </div>
  
    </footer>
  
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    <!-- Preloader -->
    <div id="preloader"></div>
  
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
  @livewireScripts
  </body>
  
  </html>