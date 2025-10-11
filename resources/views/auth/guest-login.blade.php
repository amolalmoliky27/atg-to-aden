
@extends('layouts.app')
@section('content')
<div class="text-center py-5">
    <h2>مرحبًا!</h2>
    <div class="mt-4">
        <a href="/login" class="btn btn-primary mx-2">تسجيل الدخول</a>
        <form action="/guest-enter" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn btn-secondary">الدخول كزائر</button>
        </form>
    </div>
</div>
@endsection