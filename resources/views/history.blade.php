@extends('layout.master') 
@section('content') 

<title>الأماكن التاريخية في عدن - اليمن</title> 

<link rel="stylesheet" href="assets/css/main1.css"> 



<section id="home" class="hero-banner">
    <div class="overlay"></div>
    <div class="hero-content" style=" background: url('../img/old-aden.jpg') center/cover no-repeat;">
        <h1>الأماكن التاريخية في عدن</h1>
        <p>اكتشف عبق الماضي وروعة الحاضر في مدينة عدن العريقة</p>
        <a href="#beaches" class="btn">ابدأ جولتك الآن</a>
    </div>
</section>

{{-- ✅ قسم نبذة عن تاريخ عدن --}}
<section class="aden-history" style="background-color: #f8f3e9; padding: 3rem 1rem; text-align: center;">
    <div class="container">
        <h2 style="color: #8B6B4A; font-family: 'Amiri', serif; font-size: 2.2rem; margin-bottom: 1rem;">نبذة عن تاريخ عدن</h2>
        <p style="max-width: 900px; margin: auto; font-size: 1.1rem; line-height: 2; color: #444;">
            عدن، جوهرة البحر العربي، مدينة عريقة يعود تاريخها لآلاف السنين. اشتهرت بمينائها الحيوي الذي كان محطة
            رئيسية للتجارة بين الشرق والغرب، وموطناً للحضارات والثقافات المختلفة التي تركت بصماتها في عمارتها
            وأسواقها القديمة. تتميز عدن بتنوع معالمها التاريخية مثل القلاع، المساجد، والأسواق التقليدية التي تحكي
            قصة المدينة على مر العصور.
        </p>
    </div>
</section>

<section id="beaches" class="beaches-section">
    <div class="container">
        <h2 class="section-title">أشهر الأماكن التاريخية في عدن</h2>
        <div class="beaches-container">
            @foreach($histories as $history)
            <div class="beach-card">
                <img src="{{ asset('images/' . $history->image) }}" alt="{{ $history->name }}">
                  @auth
                @if(auth()->user()->is_Admin())
                <div  class=" position-absolute top-0 start-0 end-0 d-flex justify-content-between mb-2">
                <a href="{{ route('history.edit', $history->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                <form action="{{ route('history.destroy', $history->id) }}" method="POST"
                    onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                </form></div>
                @endif
                @endauth
                <h3>{{ $history->name }}</h3>
                <p>{{ $history->des }}</p>

              
            </div>
            @endforeach
        </div>
    </div> 
</section>

<section id="gallery" class="gallery-section">
    <div class="container">
        <h2 class="section-title">معرض الصور</h2>
        <div class="gallery-container">
          
            <div class="gallery-item" style="background-image: url(img/ww.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/mg.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/fec.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/oo.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/q.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/ff.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/dd.jpg);"></div>
            <div class="gallery-item" style="background-image: url(img/saha.jpg);"></div>
        </div>
    </div>
</section>

{{-- ✅ قسم حقائق عن عدن --}}
<section class="aden-facts" style="padding: 3rem 1rem; background-color: #fff7e6;">
    <div class="container">
        <h2 style="color: #b37a2d; font-family: 'Amiri', serif; text-align:center; margin-bottom: 2rem;">
            حقائق عن عدن
        </h2>
        <ul style="max-width: 700px; margin: auto; list-style: none; padding: 0; font-size: 1.1rem; line-height: 2; color: #444;">
            <li>🏰 قلعة صيرة من أقدم المعالم، تعود إلى العصور الوسطى.</li>
            <li>⚓ ميناء عدن كان من أهم الموانئ في طريق التجارة البحرية.</li>
            <li>🕌 منارة عدن بُنيت قبل أكثر من 700 عام.</li>
            <li>🌊 المدينة محاطة ببحر العرب من الجنوب وخليج عدن من الشمال.</li>
        </ul>
    </div>
</section>



    <script>
        // التنقل المتحرك
        const burger = document.querySelector('.burger');
        const navLinks = document.querySelector('.nav-links');

        burger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            burger.classList.toggle('toggle');
        });

        // إغلاق القائمة عند النقر على رابط
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                burger.classList.remove('toggle');
            });
        });

        // التمرير السلس
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            });
        });

        // تأثير التمرير للعناصر
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.beach-card, .gallery-item');
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // استدعاء تأثير التمرير عند التمرير
        window.addEventListener('scroll', animateOnScroll);

        // تفعيل تأثيرات التمرير عند تحميل الصفحة
        window.addEventListener('DOMContentLoaded', () => {
            animateOnScroll();
        });
    </script>



@endsection