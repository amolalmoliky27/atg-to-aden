@extends('layout.master')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">المواصلات المفضلة</h2>

    @if($favorites->count() > 0)
        <div class="services-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            @foreach($favorites as $favorite)
                <div class="service-card" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background: #fff;">
                    <img src="{{ asset('images/' . $favorite->tran->image) }}" 
                         alt="{{ $favorite->tran->name }}" 
                         style="width: 100%; height: 250px; object-fit: cover;">
                    <div class="content" style="padding: 15px; text-align: center;">
                        <h3 style="margin-bottom: 10px;">{{ $favorite->tran->name }}</h3>
                        <p style="margin-bottom: 15px;">{{ $favorite->tran->des }}</p>

                        {{-- زر إزالة من المفضلة --}}
                        <form action="{{ route('toggle.favorite', $favorite->tran->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class="fas fa-heart" style="color: blue; font-size: 20px;" title="إزالة من المفضلة"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center mt-5" style="font-size: 18px;">لم يتم اختيار أي وسيلة مواصلات كمفضلة بعد.</p>
    @endif
</div>

@endsection

