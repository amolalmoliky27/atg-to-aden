@extends('layout.master') 
@section('content')      

<section class="malls-banner">
  <div class="malls-banner-overlay">
    <h1>مرحبا بك في عالم المولات الفاخرة في عدن</h1>
    <p>استمتع بأفضل تجربة تسوق وترفيه مع أحدث الماركات وأفضل الخدمات</p>
    <button class="malls-banner-btn">استكشف المولات الآن</button>
  </div>
</section>
<section>  
    <h1 class="section-main-titel">أبرز المولات</h1>   

    <div class="shops-wrapper">    
        @foreach($malls as $mall)    
        <div class="shop-card">      
            <img src="{{ asset('images/' . $mall->image) }}" alt="{{ $mall->name }}" class="shop-thumb">                
           
            @auth                 
            @if(auth()->user()->is_Admin())         
            <form action="{{ route('mall.destroy', $mall->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');">        
                @csrf        
                @method('DELETE')                
                <button type="submit" class="btn btn-sm btn-danger-action">حذف</button>      
            </form>      
            <a href="{{ route('mall.edit', $mall->id) }}" class="btn btn-sm btn-warning-action">تعديل</a>      
            @endif      
            @endauth      
           
            <h2 class="shop-title">{{ $mall->name }}</h2>      
            <p class="shop-description">{{ $mall->des }}</p>      
            <a href="#" class="btn details-button" onclick="openModal('{{ $mall->id }}')">عرض التفاصيل</a>         
        </div>    
        @endforeach  
    </div>
</section> 

<!-- Dynamic Modals -->
@foreach($malls as $mall)
<div id="{{ $mall->id }}Modal" class="modal-window">  
    <span class="modal-close" onclick="closeModal('{{ $mall->id }}Modal')">&times;</span>  
    <div class="modal-inner-content">    
        @foreach(json_decode($mall->images) as $image)    
        <div class="slide-item">      
            <img class="modal-slide-image" src="{{ asset('images/' . $image) }}">    
        </div>    
        @endforeach    
        <div class="modal-text-content">      
            <h2>{{ $mall->name }}</h2>      
            <p>{{ $mall->des }}</p>         
        </div>  
    </div>  
    <a class="slide-prev" onclick="plusSlides(-1, '{{ $mall->id }}Modal')">&#10094;</a>  
    <a class="slide-next" onclick="plusSlides(1, '{{ $mall->id }}Modal')">&#10095;</a>
</div>
@endforeach 

<script>
// متغيرات للتحكم في الشرائح لكل نافذة
const slideIndices = {}; 

// فتح النافذة المنبثقة
function openModal(mallId) {    
    const modalId = mallId + 'Modal';    
    document.getElementById(modalId).style.display = "block";    
    showSlides(1, modalId);
} 

// إغلاق النافذة المنبثقة
function closeModal(modalId) {    
    document.getElementById(modalId).style.display = "none";
} 

// تغيير الشرائح
function plusSlides(n, modalId) {    
    showSlides(slideIndices[modalId] += n, modalId);
} 

// عرض شريحة محددة
function currentSlide(n, modalId) {    
    showSlides(slideIndices[modalId] = n, modalId);
} 

// عرض الشرائح
function showSlides(n, modalId) {    
    let i;    
    const modal = document.getElementById(modalId);    
    const slides = modal.getElementsByClassName("slide-item");     

    if (!slideIndices[modalId]) {        
        slideIndices[modalId] = 1;    
    }     

    if (n > slides.length) {slideIndices[modalId] = 1}    
    if (n < 1) {slideIndices[modalId] = slides.length}     

    // إخفاء جميع الشرائح    
    for (i = 0; i < slides.length; i++) {        
        slides[i].style.display = "none";    
    }     

    // عرض الشريحة الحالية    
    slides[slideIndices[modalId] - 1].style.display = "block";
} 

// إغلاق النافذة عند النقر خارج المحتوى
window.onclick = function(event) {    
    const modals = document.getElementsByClassName('modal-window');    
    for (let i = 0; i < modals.length; i++) {        
        if (event.target == modals[i]) {            
            modals[i].style.display = "none";        
        }    
    }
}
</script> 

@endsection