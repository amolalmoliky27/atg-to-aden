@extends('layout.master')

@section('content')





<!-- Hero Section -->
<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>




<main class="main">
    <h1 style="color:green; text-align: center;">Aden-resturant</h1>
    <section id="hero" class="hero section light-background">

        <div class="container">
            <div class="row gy-4 justify-content-center justify-content-lg-between">
                <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up" style="color: orange;">اهلا بكم في مطاعم وكافيهات <h1 style="color: green;">
                            عدن
                            المتنوعه</h1>
                    </h1>
                    <p data-aos="fade-up" data-aos-delay="100">نتمنى لكم تجربة ممتعة مع الذ الأصناف من المأكولات الشعبيه
                        والسريعه وغيرها</p>

                </div>
                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="assets/img/menu/1743907445817.png" class="img-fluid animated" alt=""
                        style="border-radius: 400px;">
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us<br></h2>
            <p><span>Learn More</span> <span class="description-title">About Us</span></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/about-2.jpg" class="img-fluid mb-4" alt="">
                    <img src="assets/img/about.jpg" class="img-fluid mb-4" alt="">

                </div>
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            موقع Aden-resturant موقع متكامل للحصول على تجربة تذوق فريدة
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <span>موقع Aden_restaurant، وجهة مثالية لعشاق
                                    الطعام في عدن! هذا الموقع هو دليلك الشامل لأفضل المطاعم في المدينة، حيث يمكنك العثور
                                    على مجموعة واسعة من الأطباق اللذيذة والمتقنة.</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>من المطاعم التقليدية التي تقدم الأطباق
                                    اليمنية الأصيلة، إلى المطاعم الحديثة التي تقدم أطباقًا عالمية مبتكرة، موقع
                                    Aden_restaurant يقدم لك كل ما تحتاجه لاكتشاف أفضل المطاعم في عدن.</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>بفضل تصميمه الحديث وسهولة استخدامه، يمكنك
                                    بسهولة العثور على المطعم المثالي لاحتياجاتك. كما يمكنك قراءة تقييمات العملاء وتصفح
                                    الصور لتعرف أكثر عن كل مطعم.
                                </span></li>
                        </ul <p>
                        سواء كنت تبحث عن مطعم لتجربة طعام جديد أو تريد إعادة زيارة مطعمك المفضل، موقع Aden_restaurant هو
                        المكان المثالي. لا تفوت فرصة استكشاف أفضل المطاعم في عدن مع هذا الموقع الرائع!
                        مميزات موقع Aden_restaurant
                        دليل شامل لأفضل المطاعم في عدن
                        مجموعة واسعة من الأطباق اللذيذة والمتقنة
                        تصميم حديث وسهل الاستخدام
                        تقييمات العملاء وتصفح الصور
                        سهولة العثور على المطعم المثالي
                        جرب موقع Aden_restaurant اليوم واكتشف أفضل المطاعم في عدن
                        </p>

                        <div class="position-relative mt-4">
                            <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="glightbox pulsating-play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->





    <!-- End tab nav item -->


    <!-- Menu Section -->
    <section id="menu" class="menu section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our restaurants </h2>
            <p><span>Check Our</span> <span class="description-title">Aden-resturants </span></p>
        </div><!-- End Section Title -->

        </div>

        </div>
</main>
</section><!-- /Testimonials Section -->


<section id="chefs" class="chefs section">
    <div class="container section-title" data-aos="fade-up">

    </div>

    <div class="container">
        <div class="row gy-4">

            <!--مطاعم عادية -->
            <div class="col-12 text-center">
                <h1>مطاعم عامة </h1>
            </div>
            <style>
            /* تصغير حجم الأزرار */
            .btn-sm {
                padding: 2px 2px !important;
                font-size: 15px !important;

            }

            /* إزالة أي تأثيرات على الصورة + إظهارها كاملة */
            .member-img img {
                filter: none !important;
                box-shadow: none !important;
                border: none !important;
                outline: none !important;

                width: 100%;
                height: 400px !important;
                /* ارتفاع طبيعي */
                object-fit: cover !important;
                /* لا تقص الصورة */
                display: block;
            }

            /* تنسيق الكارد */
            .team-member {
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 5px;
                position: relative;
                max-width: 400px;
                margin: 2px;
                text-align: center;
            }


            /* ترتيب أزرار التعديل والحذف في صف */
            .btn-container {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
                gap: 10px;


            }



            /* لجعل زر التعديل في جهة اليمين وزر الحذف في جهة اليسار */
            .btn-container form {
                order: 1;
                /* الحذف - يسار */
            }

            .btn-container a {
                order: 2;
                /* التعديل - يمين */
            }
            </style>

            <!-- داخل الloop -->
            @foreach($categories as $category)
            @if($category->type == 'public')
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="team-member">

                    <a href="{{ route('categories.show', $category->id) }}"
                        style="text-decoration: none; color: inherit;">
                        <div class="member-img mb-3" style="overflow: hidden; border-radius: 10px;">
                            <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}">
                        </div>
                        <div class="member-info">
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>

                    @auth
                    @if(auth()->user()->is_Admin())
                    <div class="btn-container">
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا العنصر؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ">حذف</button>
                        </form>
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="btn btn-warning btn-sm  d-flex justify-content-center align-items-center">
                            تعديل
                        </a>
                    </div>
                    @endif
                    @endauth

                    @if($category->facebook)
                    <div class="social mt-3">
                        <a href="{{ $category->facebook }}" target="_blank"><i class="bi bi-facebook fs-4"></i></a>
                    </div>
                    @endif

                </div>
            </div>
            @endif
            @endforeach
            </secsion>
            <!-- مطاعم هندية -->
            <section>
                <div class="col-12 text-center">
                    <h3 class="mt-5 mb-3">مطاعم هندية</h3>
                </div>
                @foreach($categories as $category)
                @if($category->type == 'indian' )
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="team-member w-100 text-center">
                        <a href="{{ route('categories.show', $category->id) }}"
                            style="text-decoration: none; color: inherit;">
                            <div class="member-img mb-3">
                                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover;">
                            </div>
                            <div class="member-info">
                                <h4>{{ $category->name }}</h4>
                            </div>
                        </a>
                        @auth
                        @if(auth()->user()->is_Admin())
                        <div class="btn-container">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                onsubmit="return confirm('هل أنت متأكد من حذف هذا العنصر؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ">حذف</button>
                            </form>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm  d-flex justify-content-center align-items-center">
                                تعديل
                            </a>
                        </div>
                        @endif
                        @endauth
                        @if($category->facebook)
                        <div class="social mt-3">
                            <a href="{{ $category->facebook }}" target="_blank"><i class="bi bi-facebook fs-4"></i></a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </section>
            <!-- مطاعم شعبية -->
            <div class="col-12 text-center">
                <h3 class="mt-5 mb-3">مطاعم شعبية</h3>
            </div>
            @foreach($categories as $category)
            @if($category->type == 'popular' )
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="team-member w-100 text-center">
                    <a href="{{ route('categories.show', $category->id) }}"
                        style="text-decoration: none; color: inherit;">
                        <div class="member-img mb-3">
                            <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}"
                                class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="member-info">
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                    @auth
                    @if(auth()->user()->is_Admin())
                    <div class="btn-container">
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا العنصر؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ">حذف</button>
                        </form>
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="btn btn-warning btn-sm  d-flex justify-content-center align-items-center">
                            تعديل
                        </a>
                    </div>
                    @endif
                    @endauth



                    @if($category->facebook)
                    <div class="social mt-3">
                        <a href="{{ $category->facebook }}" target="_blank"><i class="bi bi-facebook fs-4"></i></a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </div>
</section>








<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Best Delivery Services in Aden</h2>
        <p style="color: black; size: 28px;">thare is most famous Drlivery</p>
    </div ><!-- End Section Title -->

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
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                }
            }
            </script>

            <div class="swiper-wrapper">
    @foreach($apps as $app)
        <div class="swiper-slide">
            <div class="testimonial-item">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-6">
                        <div class="testimonial-content">
                            <p>
                              
                          
                               
                            </p>
                            <div class="stars">
                                @for ($i = 1; $i <= $app->rating; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor
                                @for ($i = $app->rating + 1; $i <= 5; $i++)
                                    <i class="bi bi-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <a href="{{ $app->link }}" target="_blank">
                            <img src="{{ asset('images/' . $app->image) }}" class="img-fluid testimonial-img" alt="تطبيق توصيل" 
                            style="width: 300px;height:200px;border-radius:80%; object-fit:cover;display:block; margin: 0 auto;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>



        </div></div></section>




            @endsection