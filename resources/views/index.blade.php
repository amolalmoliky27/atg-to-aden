@extends('layout.master')

@section('content')
 


<!-- Home Section -->
<section id="home" class="hero section light-background" >

  <div class="container">
    <div class="row gy-4 justify-content-center justify-content-lg-between">
      <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">اهلا بك بالسياحة في عدن<br>استمتع بالسياحة في عدن جنة اليمن</h1>


       <!-- <p data-aos="fade-up" data-aos-delay="100">We are team of talented designers making websites with Bootstrap</p>-->
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
        
      <!--    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>-->
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="img/face.jpg" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>

</section><!-- /Home Section -->
<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>عن الموقع<br></h2>
    <p><span>تعرف أكثر </span> <span class="description-title">علينا</span></p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
        <img src="img/t8.jpg" class="img-fluid mb-4" alt="">
      <!--  <div class="book-a-table">
          <h3>Book a Table</h3>
          <p>+1 5589 55488 55</p>
        </div>-->
      </div>
      <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
        <div class="content ps-0 ps-lg-5">
         <!-- <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p> <ul>
            <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
          </ul>-->
          <h4 class="text-muted mb-3">عدن .. جوهرة الجنوب وعروس البحر</h4>

          <p>
            عدن، المدينة الساحرة التي تحتضنها أمواج البحر العربي، وتروي حكايات التاريخ بين أزقتها العريقة وشواطئها الذهبية. تمتزج في عدن روح الماضي الأصيل مع نبض الحاضر المتجدد، فهي مدينة تتنفس عبق الحضارات التي تعاقبت عليها، بدءًا من موانئها التي كانت ملتقى للتجار والمستكشفين، وصولًا إلى مبانيها التي تحكي قصص الأزمنة الغابرة.  

          </p>

          <div class="position-relative mt-4">
            <img src="imgggg/معلا.jpeg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
      <div class="content ps-0 ps-lg-5">
        <p>  أحياؤها القديمة مثل كريتر والتواهي لا تزال تنبض بالحياة، وشوارعها تعكس التنوع الثقافي لأهلها الطيبين الذين يرحبون بزوارها بكرم يروي حكايات الأصالة. من شواطئها الفاتنة مثل ساحل أبين والذهبية، إلى معالمها التاريخية كصهاريج عدن وقلعة صيرة، تأخذك عدن في رحلة لا تُنسى بين الجمال والتاريخ. إنها ليست مجرد مدينة، بل قصة عشق أبدية لكل من زارها وعاش بين أحضانها. </p>
  </div>

</section><!-- /About Section -->
<!-- Why Us Section -->
 
<section id="why-us" class="why-us section light-background">

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
          <h3>لماذا تستخدم موقعنا</h3>
          <p>
            نحن هنا لنكون دليلك السياحي الأول في عدن. نوفر لك معلومات دقيقة ومحدثة عن أهم الأماكن التي تستحق الزيارة، من مطاعم ومقاهي، إلى فنادق وشواطئ ومعالم تاريخية. هدفنا أن نجعل رحلتك أسهل وأجمل.

          </p>
          <div class="text-center">
            <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
          </div>
        </div>
      </div>  <!-- End Why Box -->
       
      <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>سهولة الوصول للمعلومات</h4>
              <p>نوفر لك كل ما تحتاج معرفته عن عدن من أماكن سياحية، مطاعم، وفنادق في مكان واحد بسهولة.
              </p>
            </div>
          </div> <!-- End Icon Box -->
           
          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-gem"></i>
              <h4>دليل موثوق ومحدث</h4>
              <p>نحرص على تحديث البيانات باستمرار لتكون المعلومات دقيقة وحديثة وموثوقة بنسبة 100%.
              </p>
            </div>
          </div>  <!-- End Icon Box -->
          
          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-inboxes"></i>
              <h4>تجربة مستخدم مميزة</h4>
              <p> صممنا الموقع بطريقة بسيطة وسلسة ليكون تصفحك ممتع وسريع بدون تعقيدات.</p>
            </div>
          </div> <!-- End Icon Box -->

        </div>
      </div>

    </div>

  </div>

</section><!-- /Why Us Section -->
<!-- Gallery Section -->
<section id="gallery" class="gallery section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>تصفح</h2>
   <p><span>قم بزيارة المدينة </span> <span class="description-title">واستمتع</span></p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "centeredSlides": true,
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 0
            },
            "768": {
              "slidesPerView": 3,
              "spaceBetween": 20
            },
            "1200": {
              "slidesPerView": 5,
              "spaceBetween": 20
            }
          }
        }
      </script>
      <div class="swiper-wrapper align-items-center">
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="resturent.html"><img src="imgggg/مطعم2.jpeg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="hotel.html"><img src="imgggg/صفحة فندق.jpeg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="sea.html"><img src="imgggg/بحر1.jpeg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="mol.html"><img src="imgggg/مول.jpeg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="history.html"><img src="img/1744813279073.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="trans.html"><img src="img/IMG-20250406-WA0031.jpg" class="img-fluid" alt=""></a></div>
       
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="park.html"><img src="imgggg/واجهة 1.jpeg" class="img-fluid" alt=""></a></div>
      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>

</section><!-- /Gallery Section --></main>
@endsection