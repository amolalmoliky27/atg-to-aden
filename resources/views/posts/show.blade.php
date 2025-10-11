@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 800px; margin: auto; background:gray; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
       {{-- 💬 عدد التفاعلات والتعليقات --}}
   <div class="header-counts">
    <div class="reactions-count">❤️ {{ $post->reactions()->count() }} تفاعل</div>
    <div class="comments-count">💬 {{ $post->comments()->count() }} تعليق</div>
    
</div>



   

    {{-- 📅 تاريخ النشر --}}
    <p class="text-muted" style="font-size: 13px;"> {{ $post->created_at->diffForHumans() }}</p>

  

    

    {{-- 🧵 التعليقات --}}
    <h5 class="mb-3 mt-4"></h5>

    @foreach ($post->comments->where('parent_id', null) as $comment)
        @livewire('comment-item', ['comment' => $comment], key($comment->id))
    @endforeach


<hr>

    {{-- ✅ نموذج إضافة تعليق جديد --}}
    @auth
        <form method="POST" action="{{ route('comments.store', $post->id) }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <textarea name="content" rows="3" required class="form-control" placeholder="اكتب تعليقك هنا..."></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2">إضافة تعليق</button>
        </form>
   
    @endauth

    <hr>

</div>
<style>

    .header-counts {
    display: flex;
    justify-content: space-between;
    align-items: center;
 
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.header-counts .comments-count {
    text-align: left;
    color: #374151; /* رمادي داكن */
    font-weight: bold;
    
}

.header-counts .reactions-count {
    text-align: right;
    color: #374151;
    font-weight: bold;
}
</style>
@endsection