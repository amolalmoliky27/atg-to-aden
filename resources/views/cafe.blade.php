@extends('layout.master')

@section('content')

<!-- ✅ بانر ترحيبي -->
<section class="section bg-dark text-white text-center py-5" style="background: url('/images/gallery-3.jpg') center/cover no-repeat;
 width:100%;    ">
  <div class="container">
    <h1 class="display-5 " style=" color:goldenrod;">☕ استكشف كافيهات عدن الرائعة</h1>
    <p class="lead" >تصفح أجمل الكافيهات بصور حقيقية، واستمتع بأجواء مميزة من قلب المدينة</p>
  </div>
</section>



<!-- القسم الثاني: كافيهات المولات مع Livewire -->
 @livewire('cafe-gallery')
 @livewire('mall-cafe-gallery')
 




@endsection

