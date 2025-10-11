@extends('layout.master')

@section('content')
<title>أبرز الفنادق في عدن</title>



<link rel="stylesheet" href="assets/css/main7.css">
<section class="hotel-banner">
  <div class="banner-overlay">
    <h1>مرحباً بك في عالم الفنادق الفاخرة في عدن</h1>
    <p>استمتع بإقامة لا تُنسى مع أفضل الخدمات والمرافق.</p>
    <button class="banner-btn">استكشف الفنادق الآن</button>
  </div>
</section>    
<section>
  <h1 class="main-title" style="text-align:center; margin: 20px 0;">أبرز الفنادق في عدن</h1>

  <div class="hotel-container">
    @foreach($hotels as $hotel)
      <div class="hotel-card" style="background-image: url('{{ asset('images/' . $hotel->image) }}')">
        <div   class=" position-absolute top-0 start-2 end-0 d-flex justify-content-between ">
           @auth
          @if(auth()->user()->is_Admin())
          <div class="position-absolute top-0 start-0 end-0 d-flex justify-content-between">
            <form action="{{ route('hotel.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');" >
              @csrf
              @method('DELETE')
              
              <button type="submit" class="btn-sm btn-danger">حذف</button>
            </form>
            <a href="{{ route('hotel.edit', $hotel->id) }}" class="btn-sm btn-warning">تعديل</a>
          </div>
          @endif
        @endauth
        </div>
        <div class="hotel-rating" title="عدد النجوم">
          <i class="fas fa-star"></i>
          <span>{{ $hotel->stars }}</span>
          
        </div>

        <h2>{{ $hotel->name }}</h2>
        @if($hotel->link)
        <a href="{{ $hotel->link}}" target="_blank"> <i class="fas fa-map-marker-alt"></i></a>
        @endif
     
        
        <p>{{ \Illuminate\Support\Str::limit($hotel->des, 120) }}</p>


        <button class="details-btn" onclick="openModal('{{ $hotel->id }}')">عرض التفاصيل</button>

     
      </div>
    @endforeach
  </div>
</section>

{{-- مودال لكل فندق --}}
@foreach($hotels as $hotel)
  <div id="hotelModal{{ $hotel->id }}" class="modal">
    <span class="close" onclick="closeModal('hotelModal{{ $hotel->id }}')">&times;</span>
    <div class="modal-content">
      {{-- صور السلايدر --}}
      @foreach(json_decode($hotel->images) as $index => $image)
        <div class="mySlides" data-modal-id="hotelModal{{ $hotel->id }}">
          <img class="modal-image" src="{{ asset('images/' . $image) }}" alt="صورة {{ $hotel->name }} {{$index+1}}">
        </div>
      @endforeach

      <div class="modal-info">
        <h2>{{ $hotel->name }}</h2>
        <p>{{ $hotel->des }}</p>
        <p>موقع الفندق: {{ $hotel->loc }}</p>
      </div>

      
      

      <a class="prev" onclick="plusSlides(-1, 'hotelModal{{ $hotel->id }}')">&#10094;</a>
      <a class="next" onclick="plusSlides(1, 'hotelModal{{ $hotel->id }}')">&#10095;</a>
    </div>
  </div>
@endforeach

<script>
  // تخزين حالة الشرائح لكل مودال
  const slideIndices = {};

  function openModal(hotelId) {
    const modalId = 'hotelModal' + hotelId;
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.style.display = "block";

    // بدء عرض الشريحة الأولى للمودال المحدد
    slideIndices[modalId] = 1;
    showSlides(1, modalId);
  }

  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.style.display = "none";
  }

  function plusSlides(n, modalId) {
    if (!slideIndices[modalId]) slideIndices[modalId] = 1;
    showSlides(slideIndices[modalId] += n, modalId);
  }

  function currentSlide(n, modalId) {
    slideIndices[modalId] = n;
    showSlides(n, modalId);
  }

  function showSlides(n, modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    const slides = modal.querySelectorAll(".mySlides");
    const thumbnails = modal.querySelectorAll(".modal-thumbnail");

    if (n > slides.length) slideIndices[modalId] = 1;
    if (n < 1) slideIndices[modalId] = slides.length;

    // إخفاء كل الشرائح
    slides.forEach(slide => slide.style.display = "none");

    // إزالة التمييز من كل الصور المصغرة
    thumbnails.forEach(thumb => thumb.classList.remove("active"));

    // إظهار الشريحة الحالية وتفعيل الصورة المصغرة المرتبطة
    slides[slideIndices[modalId] - 1].style.display = "block";
    thumbnails[slideIndices[modalId] - 1].classList.add("active");
  }

  // إغلاق المودال عند الضغط خارجه
  window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
      if(event.target === modal) {
        modal.style.display = "none";
      }
    });
  };
</script>

@endsection