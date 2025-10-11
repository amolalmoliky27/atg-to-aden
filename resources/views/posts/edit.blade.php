@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-xl font-bold mb-4">✏️ تعديل المنشور</h2>

    <form action="{{ auth()->user()->is_admin ? route('admin.posts.update', $post->id) : 
        route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700">العنوان</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $post->title) }}"
                   class="w-full border-gray-300 rounded mt-1" required>
        </div>

        <div class="mb-4">
            <label for="body" class="block text-gray-700">المحتوى</label>
            <textarea name="content" id="content" rows="5"
                      class="w-full border-gray-300 rounded mt-1" 
                      required>{{ old('content', $post->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">صورة جديدة (اختياري)</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded mt-1">

            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="صورة سابقة" class="w-40 mt-2">
            @endif
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            💾 حفظ التعديلات
        </button>
    </form>
</div>
@endsection
