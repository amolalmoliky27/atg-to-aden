@extends('layout.master')
@section('content')

<link rel="stylesheet" href="assets/css/main3.css">

<body>

  <!-- شريط التنقل -->
  <section class="sea-banner">
    <div class="sea-containers">
      <h1 class="sea-display-5" style="color:goldenrod;">اكتشف جمال شواطئ عدن</h1>
      <p class="sea-lead">سواحل عدن.. السياحة والمتعة والجمال</p>
    </div>
  </section>

  <nav>
    <div class="sea-nav-container">
      <a href="#" class="sea-logo">
        <i class="fas fa-umbrella-beach"></i>
        <span>شواطئ عدن</span>
      </a>

      <ul class="sea-nav-links">
        <li><a href="#home" class="sea-active">الرئيسية</a></li>
        <li><a href="#beaches">الشواطئ</a></li>
        <li><a href="#gallery">المعرض</a></li>
        <li><a href="#contact">اتصل بنا</a></li>
      </ul>

      <div class="sea-burger">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

  <!-- قسم الشواطئ -->
  <div class="sea-section-title">
    <h2>أشهر شواطئ عدن</h2>
    <p>اكتشف أجمل الشواطئ التي تجعل من عدن جوهرة البحر الأحمر</p>
  </div>

  <div class="sea-gardens-grid">
    @foreach($seas as $sea)
    <div class="sea-sea-card">
      <div class="sea-sea-img">
        <img src="{{ asset('images/' . $sea->image) }}" alt="{{ $sea->name }}">
      </div>
      <div class="sea-sea-info">
        <h3>{{ $sea->name }}</h3>
        <p>{{ $sea->des}}</p>
        <div class="sea-sea-meta">
          <span><i class="fas fa-map-marker-alt"></i> {{ $sea->adress }}</span>
          <span><i class="fas fa-star"></i> {{ $sea->stars }}</span>
        </div>
        @auth
        @if(auth()->user()->is_Admin())
        <div class="sea-sea-card-actions">
          <a href="{{ route('sea.edit', $sea->id) }}" class="sea-sea-edit-btn btn btn-sm btn-primary">تعديل</a>
          <form action="{{ route('sea.destroy', $sea->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');" class="sea-delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="sea-sea-delete-btn btn btn-sm btn-danger">حذف</button>
          </form>
        </div>
        @endif
        @endauth
      </div>
    </div>
    @endforeach
  </div>

  <!-- قسم المميزات -->
  <section class="sea-features">
    <div class="sea-container">
      <div class="sea-section-title">
        <h2>لماذا تزور شواطئ عدن؟</h2>
        <p>اكتشف ما يجعل شواطئ عدن وجهة مميزة للسياح</p>
      </div>
      <div class="sea-features-grid">
        <div class="sea-feature-card">
          <div class="sea-feature-icon">
            <i class="fas fa-sun"></i>
          </div>
          <h3>طقس رائع</h3>
          <p>تمتع بأجواء معتدلة على مدار العام مع نسيم البحر المنعش</p>
        </div>
        <div class="sea-feature-card">
          <div class="sea-feature-icon">
            <i class="fas fa-water"></i>
          </div>
          <h3>مياه صافية</h3>
          <p>مياه زرقاء صافية مثالية للسباحة والغوص والاستجمام</p>
        </div>
        <div class="sea-feature-card">
          <div class="sea-feature-icon">
            <i class="fas fa-umbrella-beach"></i>
          </div>
          <h3>رمال ذهبية</h3>
          <p>شواطئ ذات رمال ناعمة ذهبية اللون تريح الأعصاب</p>
        </div>
        <div class="sea-feature-card">
          <div class="sea-feature-icon">
            <i class="fas fa-fish"></i>
          </div>
          <h3>حياة بحرية</h3>
          <p>تنوع بحري فريد يجذب محبي الغوص والتصوير تحت الماء</p>
        </div>
      </div>
    </div>
  </section>

  <!-- معرض الصور -->
  <section id="gallery" class="sea-section">
    <div class="sea-container">
      <div class="sea-section-title">
        <h2>معرض الصور</h2>
        <p>لقطات ساحرة من جمال شواطئ عدن</p>
      </div>
      <div class="sea-gallery">
        <div class="sea-gallery-item">
          <img src="imgggg/بحر1.jpeg" alt="شاطئ عدن">
          <div class="sea-gallery-caption">منظر خلاب</div>
        </div>
        <div class="sea-gallery-item">
          <img src="img/غرق.jpg" alt="شاطئ عدن">
          <div class="sea-gallery-caption">الاستجمام على الشاطئ</div>
        </div>
        <div class="sea-gallery-item">
          <img src="imgggg/صورة عدن.jpeg" alt="شاطئ عدن">
          <div class="sea-gallery-caption">ساحل العشاق</div>
        </div>
        <div class="sea-gallery-item">
          <img src="img/FB_IMG_1583417204524.jpg" alt="شاطئ عدن">
          <div class="sea-gallery-caption">الغروب الساحر</div>
        </div>
        <div class="sea-gallery-item">
          <img src="img/800px-Red_sea_coast,_Makadi_bay.jpg" alt="شاطئ عدن">
          <div class="sea-gallery-caption">المنتجعات السياحية</div>
        </div>
        <div class="sea-gallery-item">
          <img src="img/ad4.png" alt="شاطئ عدن">
          <div class="sea-gallery-caption">الأنشطة البحرية</div>
        </div>
      </div>
    </div>
  </section>

  <script>
    // التنقل المتحرك
    const seaBurger = document.querySelector('.sea-burger');
    const seaNavLinks = document.querySelector('.sea-nav-links');

    seaBurger.addEventListener('click', () => {
      seaNavLinks.classList.toggle('sea-active');
      seaBurger.classList.toggle('sea-toggle');
    });

    // إغلاق القائمة عند النقر على رابط
    document.querySelectorAll('.sea-nav-links a').forEach(link => {
      link.addEventListener('click', () => {
        seaNavLinks.classList.remove('sea-active');
        seaBurger.classList.remove('sea-toggle');
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
      const elements = document.querySelectorAll('.sea-sea-card, .sea-gallery-item, .sea-feature-card');

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

    // معرض الصور (Lightbox)
    document.querySelectorAll('.sea-gallery-item').forEach(item => {
      item.addEventListener('click', function() {
        const img = this.querySelector('img');
        const imgUrl = img.src;

        const lightbox = document.createElement('div');
        lightbox.id = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <img src="${imgUrl}" alt="صورة الشاطئ">
                <span class="close">&times;</span>
            </div>
        `;

        document.body.appendChild(lightbox);

        lightbox.style.position = 'fixed';
        lightbox.style.top = '0';
        lightbox.style.left = '0';
        lightbox.style.width = '100%';
        lightbox.style.height = '100%';
        lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        lightbox.style.display = 'flex';
        lightbox.style.alignItems = 'center';
        lightbox.style.justifyContent = 'center';
        lightbox.style.zIndex = '1000';

        const closeBtn = lightbox.querySelector('.close');
        closeBtn.style.position = 'absolute';
        closeBtn.style.top = '20px';
        closeBtn.style.left = '20px';
        closeBtn.style.color = 'white';
        closeBtn.style.fontSize = '30px';
        closeBtn.style.cursor = 'pointer';

        closeBtn.addEventListener('click', () => {
          lightbox.remove();
        });

        lightbox.addEventListener('click', (e) => {
          if (e.target === lightbox) {
            lightbox.remove();
          }
        });
      });
    });

    // تفعيل تأثيرات التمرير عند تحميل الصفحة
    window.addEventListener('DOMContentLoaded', () => {
      animateOnScroll();
    });
  </script>

</body>
</html>

@endsection