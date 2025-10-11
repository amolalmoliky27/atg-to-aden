@extends('layout.master')

@section('content')

@php
    $userFavorites = auth()->check() ? auth()->user()->favorites->pluck('tran_id')->toArray() : [];
@endphp


<link rel="stylesheet" href="assets/css/main5.css">

<!-- بانر ترويجي فخم وجذاب -->
<div class="promo-banner" style="  background-image: url('../images/car.jpg')">
  <div class="promo-overlay"></div>
  <div class="promo-content"style="  background-image: url('../images/car.jpg')" >
    <h1>اكتشف رحلتك مع شركة بساط  وشركة روتانا VIPللمواصلات</h1>
    <p>نقدم لك أفضل وأفخم وسائل النقل بأمان وراحة لا تضاهى، لنجعل زيارتك ذكرى لا تُنسى.</p>
    <a href="#services">تعرف على خدماتنا</a>
  </div>
</div>



<section class="services-container" >
  @foreach($trans as $tran)
    <div class="service-card">
      <div class="image-wrapper">
        <img src="{{ asset('images/' . $tran->image) }}" alt="{{ $tran->name }}">

        <div class="card-actions">
            @auth
        @if(auth()->user()->is_Admin())
          {{-- زر التعديل --}}
          <a href="{{ route('tran.edit', $tran->id) }}" class="btn-edit">تعديل</a>
@endif
@endauth
          {{-- زر القلب المفضل --}}
          @auth
            <form action="{{ route('toggle.favorite', $tran->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn-favorite" title="إضافة/إزالة من المفضلة">
                <i class="{{ in_array($tran->id, $userFavorites) ? 'fas' : 'far' }} fa-heart"></i>
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" title="سجل دخول لإضافة للمفضلة" class="btn-favorite disabled">
              <i class="far fa-heart"></i>
            </a>
          @endauth
  @auth
        @if(auth()->user()->is_Admin())
          {{-- زر الحذف --}}
          <form action="{{ route('tran.destroy', $tran->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">حذف</button>
          </form>
          @endif
          @endauth 

        </div>
      </div>

      <div class="content">
        <h3>{{ $tran->name }}</h3>
        <p>{{ $tran->des }}</p>
      </div>
    </div>
  @endforeach
</section>

<!-- قسم تعريفي عن الشركة -->

<section class="about-company" style="  background-image: url('../images/back.jpg')">
  
  <h2>عن شركة بساط للمواصلات</h2>
  <p>
    شركة بساط هي شركة رائدة في مجال خدمات المواصلات في مدينتنا، تقدم أفضل الحلول للنقل داخل المدينة وخارجها بخدمات مميزة وأسعار تنافسية.
    <p> هدفنا هو توفير راحة وسلامة ركابنا من خلال أسطول متنوع وحديث من وسائل المواصلات.</p>
  </p>
  <p>
    نسعى دائماً لتطوير خدماتنا بناءً على متطلبات العملاء واحتياجاتهم، مع التركيز على الجودة والسرعة والأمان في التنقل. يمكنكم الاعتماد علينا في كل رحلة لضمان تجربة مريحة وممتعة.
  </p>
</section>

@endsection