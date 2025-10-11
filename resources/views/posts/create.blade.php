@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">

    <h1 style="font-size: 24px; color: #007bff; margin-bottom: 20px;">📝 إنشاء منشور جديد</h1>

    {{-- عرض الأخطاء إن وجدت --}}
    @if($errors->any())
        <div style="background: #ffe3e3; padding: 10px 15px; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding: 0; list-style: none;">
                @foreach($errors->all() as $error)
                    <li style="color: #a33;">⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- نموذج الإدخال --}}
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf

        {{-- العنوان --}}
        <input type="text" name="title" placeholder="العنوان (اختياري)" value="{{ old('title') }}"
               style="padding: 10px; border-radius: 6px; border: 1px solid #ccc;">

        {{-- المحتوى --}}
        <textarea name="content" rows="5" required placeholder="المحتوى"
                  style="padding: 10px; border-radius: 6px; border: 1px solid #ccc;">{{ old('content') }}</textarea>

        {{-- اختيار صورة --}}
        <div>
            <label>📷 صورة (اختياري):</label>
            <input type="file" name="image" accept="image/*" style="margin-top: 5px;">
        </div>

        {{-- اختيار فيديو --}}
        <div>
            <label>🎥 فيديو (اختياري):</label>
            <input type="file" name="video" accept="video/*" style="margin-top: 5px;">
        </div>

        {{-- زر إرسال --}}
        <button type="submit" style="background-color: #28a745; color: white; padding: 12px; border-radius: 6px; border: none; font-size: 16px; cursor: pointer;">
            🚀 نشر المنشور
        </button>
    </form>
</div>
@endsection