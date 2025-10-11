@extends('layout.master') 
@section('content')     


<!-- شريط التنقل -->      
<div class="banner" >   
    <title>حدائق ومنتزهات عدن | اليمن السعيد</title>        

<!-- الترويسة -->        
<link rel="stylesheet" href="assets/css/main4.css">    
     
  <div class="banner-content">            
    <h1>اكتشف جمال حدائق عدن</h1>            
    <p style="color: black;">رحلتك إلى عالم من السكينة والجمال في أحضان الطبيعة الخلابة بمدينة عدن الساحرة</p>            
    <a href="#parks-section" class="btn-action">استكشف الآن</a>        
  </div>
</div>    

<nav>        
  <div class="navbar-wrapper">            
    <a href="#" class="brand-logo"> حدائق <span>عدن</span></a>            
    <ul class="menu-links">                
      <li><a href="#" class="current">الرئيسية</a></li>                
      <li><a href="#parks-section">الحدائق</a></li>                
      <li><a href="#advantages-section">المميزات</a></li>                
      <li><a href="#photos-section">المعرض</a></li>                
      <li><a href="#contact-section">تواصل معنا</a></li>            
    </ul>        
  </div>    
</nav>         

<!-- المحتوى الرئيسي -->    
<main>        

  <!-- قسم الحدائق -->        
  <section id="parks-section" class="parks-area">            
    <div class="wrapper">                
      <div class="section-header">                    
        <h2>أشهر حدائق ومنتزهات عدن</h2>                    
        <p>اكتشف أجمل الأماكن الطبيعية للترفيه والاسترخاء في مدينة عدن الساحلية</p>                
      </div>                                 

      <div class="parks-grid">                    
        @foreach($parks as $park)                    
        <div class="park-card">                        
          <div class="park-image">                            
            <img src="{{ asset('images/' . $park->image) }}" alt="{{ $park->name }}">                        
          </div>                        

          <div class="park-actions"> 
            @auth                 
              @if(auth()->user()->is_Admin())                            
                <a href="{{ route('park.edit', $park->id) }}" class="btn-small btn-primary">تعديل</a>                            
                <form action="{{ route('park.destroy', $park->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');">                                
                  @csrf                                
                  @method('DELETE')                                
                  <button type="submit" class="btn-small btn-danger">حذف</button>                            
                </form>                            
              @endif                            
            @endauth
          </div>                        

          <div class="park-info">                            
            <h3>{{ $park->name }}</h3>                            
            <p>{{ $park->des }}</p>                            
            <div class="park-meta">                                
              <span><i class="fas fa-map-marker-alt"></i> {{ $park->loc }}</span>                                
              <span><i class="fas fa-expand"></i> {{ $park->space }} م²</span>                            
            </div>                                                     
          </div>                    
        </div>                    
        @endforeach                
      </div>            
    </div>        
  </section>                 

  <!-- قسم المميزات -->        
  <section id="advantages-section" class="advantages-area">            
    <div class="wrapper">                
      <div class="section-header">                    
        <h2>لماذا حدائق عدن؟</h2>                    
        <p>اكتشف المميزات التي تجعل حدائق عدن وجهة مثالية للعائلات والأفراد</p>                
      </div>                                 

      <div class="advantages-grid">                    
        <div class="advantage-card">                        
          <div class="advantage-icon">                            
            <i class="fas fa-tree"></i>                        
          </div>                        
          <h3>مساحات خضراء واسعة</h3>                        
          <p>تنفس الهواء النقي في أحضان الطبيعة الخلابة والمساحات الخضراء الواسعة</p>                    
        </div>                                         

        <div class="advantage-card">                        
          <div class="advantage-icon">                            
            <i class="fas fa-umbrella-beach"></i>                        
          </div>                        
          <h3>إطلالات ساحرة</h3>                        
          <p>استمتع بإطلالات بانورامية على البحر والجبال من عدة مواقع مميزة</p>                    
        </div>                                         

        <div class="advantage-card">                        
          <div class="advantage-icon">                            
            <i class="fas fa-child"></i>                        
          </div>                        
          <h3>ألعاب للأطفال</h3>                        
          <p>مناطق لعب آمنة ومجهزة بأحدث الألعاب الترفيهية للأطفال</p>                    
        </div>                                         

        <div class="advantage-card">                        
          <div class="advantage-icon">                            
            <i class="fas fa-coffee"></i>                        
          </div>                        
          <h3>مقاهي ومطاعم</h3>                        
          <p>استمتع بأجواء مميزة في المقاهي والمطاعم المنتشرة في الحدائق</p>                    
        </div>                
      </div>            
    </div>        
  </section>                 

  <!-- قسم معرض الصور -->        
  <section id="photos-section" class="photos-area">            
    <div class="wrapper">                
      <div class="section-header">                    
        <h2>معرض الصور</h2>                    
        <p>جولة مصورة لأجمل اللحظات في حدائق ومنتزهات عدن</p>                
      </div>                                 

      <div class="photos-grid">                    
        <div class="photo-item">                        
          <img src="imgggg/11.jpeg" alt="حديقة عدن">                        
          <div class="photo-caption">العاب في حديقة عدن نيو</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/13.jpeg" alt="منتزه عدن">                        
          <div class="photo-caption">مساحات خضراء في المنتزه الترفيهي</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/دكة1.jpeg" alt="حدائق عدن">                        
          <div class="photo-caption">أزهار في منتزة الدكة</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/نيو4.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">إطلالة من حديقة عدن نيو</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/19.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">اطلالة من صيرة</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/18.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">جلسة جميلة من حديقة عدن نيو</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/فن4.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">لعبة الصحن في فن سيتي</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/فن3.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">لعبة السلاسل في فن سيتي</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/فن6.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">لعبة الاحصنة للاطفال في فن سيتي</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/9.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">لعبة السلاسل للاطفال في حديقة عدن نيو</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/13.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">اطلالة عدن نيو من الاعلى</div>                    
        </div>                    
        <div class="photo-item">                        
          <img src="imgggg/نيو6.jpeg" alt="منتزهات عدن">                        
          <div class="photo-caption">إجلسة جميلة من حديقة عدن نيو</div>                    
        </div>                
      </div>            
    </div>        
  </section>    
</main>         

<!-- روابط لأيقونات Font Awesome -->    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">         

<script>        
// كود JavaScript لجعل شريط التنقل لزج        
window.addEventListener('scroll', function() {            
  const nav = document.querySelector('nav');            
  if (window.scrollY > 100) {                
    nav.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';            
  } else {                
    nav.style.boxShadow = 'none';            
  }        
});                 

// كود للتمرير السلس عند النقر على الروابط        
document.querySelectorAll('a[href^="#"]').forEach(anchor => {            
  anchor.addEventListener('click', function (e) {                
    e.preventDefault();                                 
    document.querySelector(this.getAttribute('href')).scrollIntoView({                    
      behavior: 'smooth'                
    });            
  });        
});    
</script>

</body>
</html> 

@endsection