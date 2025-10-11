@extends('layouts.app')

@section('content')
<style>
    /* أنماط CSS تبقى كما هي */
    .reaction-btn { position: relative; display: inline-block; }
    .reaction-menu { display: none; position: absolute; bottom: 40px; left: 0; background: #fff; border: 1px solid #ccc; padding: 6px 10px; border-radius: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); z-index: 10; gap: 10px; white-space: nowrap; }
    .reaction-btn:hover .reaction-menu { display: flex; }
    .reaction-icon { background: none; border: none; cursor: pointer; font-size: 22px; padding: 3px; transition: transform 0.2s; }
    .reaction-icon:hover { transform: scale(1.3); }
    .main-reaction { background: none; border: none; font-size: 15px; font-weight: 100; color: #65676B; cursor: pointer; padding: 5px 10px; border-radius: 20px; transition: background-color 0.2s; }
    .main-reaction:hover { background-color: #edf4ed; }
    .main-reaction.reaction-active { color: wheat; }
    .like-counter { text-align: right; flex: 1; }
    .comment-counter { text-align: left; flex: 1; }
    .reaction-count { display: flex; justify-content: space-between; margin-top: 10px; }
    .card { height: 100%; display: flex; flex-direction: column; border: 1px solid #ccc; border-radius: 10px; padding: 15px; background-color: #fff; box-shadow: 0 2px 4px rgba(48, 42, 42, 0.67); margin-bottom: 20px; }
    .actions-container { display: flex; justify-content: space-between; margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee; }
    .action-buttons { display: flex; align-items: center; gap: 5px; }
    .action-button { display: flex; align-items: center; gap: 5px; color: #65676B; text-decoration: none; background: none; border: none; cursor: pointer; font-size: 14px; padding: 5px 10px; border-radius: 5px; transition: background-color 0.2s; }
    .action-button:hover { background-color: #f0f2f5; }
    .media-container { margin-bottom: 15px; text-align: center; }
    .media-container img, .media-container video { width: 600px; max-height: 400px; border-radius: 12px; margin-top: 10px; }
    .post-content { flex-grow: 1; }
    .share-btn button { background-color:rgb(47, 122, 235); border: none; padding: 6px 12px; border-radius: 20px; cursor: pointer; transition: background 0.3s; }
    .share-btn button:hover { background-color:rgb(108, 144, 238); }
</style>

<div class="container">
    {{-- Search Form --}}
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4 flex items-center gap-2">
        <input type="text" name="search" placeholder="ابحث عن منشور..." value="{{ request('search') }}" class="border rounded p-2 w-full md:w-1/2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">🔍 بحث</button>
    </form>

    {{-- Header --}}
    <div class="navbar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="font-size: 24px;">📚 كل المنشورات</h1>
        <div>
            <a href="{{ route('posts.create') }}" class="btn">➕ منشور جديد</a>
        </div>
       
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
    </div>

    {{-- Posts Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="card">
                {{-- Post Media --}}
                @if($post->image)
                    <div class="media-container">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="صورة المنشور">
                    </div>
                @endif
               
                @if($post->video_path)
                    <div class="media-container">
                        <video controls class="w-full">
                            <source src="{{ asset('storage/' . $post->video_path) }}" type="video/mp4">
                            المتصفح لا يدعم تشغيل الفيديو.
                        </video>
                    </div>
                @endif

                {{-- Post Content --}}
                <div class="post-content">
                    <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-gray-500 text-xs">{{ $post->created_at->format('Y-m-d') }}</p>
                </div>

                {{-- Reaction Count and Comments Link --}}
                <div class="reaction-count">
                    <div class="like-counter">
                        @if($post->reactions->count() > 0)
                            <span>اعجاب {{ $post->reactions->count() }}</span>
                        @endif
                    </div>
                    <div class="comment-counter">
                        @if($post->comments->count() > 0)
                            💬 {{ $post->comments->count() }} تعليق
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="actions-container">
                    {{-- التفاعل --}}
                    @livewire('post-reaction-component', ['post' => $post], key($post->id))
                   
                    {{-- التعليقات --}}
                    <a href="{{ route('posts.show', $post) }}" class="action-button">💬 تعليق</a>
                   
                    {{-- المشاركة --}}
                    <div class="share-btn">
                        <button onclick="sharePost('{{ $post->id }}')" class="btn btn-sm btn-light">🔗 مشاركة</button>
                    </div>
                   
                    {{-- تعديل وحذف --}}
                    @php
                        $currentUserId = auth()->check() ? auth()->id() : null;
                        $currentVisitorId = session('visitor_id');
                        $isOwner = ($currentUserId && $currentUserId === $post->user_id) ||
                                   ($currentVisitorId && $currentVisitorId === $post->visitor_id);
                        $isAdmin = auth()->check() && auth()->user()->is_admin;
                    @endphp
                   
                    @if($isOwner || $isAdmin)
                        <a href="{{ route('posts.edit', $post->id) }}" class="action-button">✏️ تعديل</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل تريد الحذف؟')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button">🗑️ حذف</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <p class="text-center p-4 bg-gray-100 rounded">لا توجد منشورات حالياً.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>

<script>
    function sharePost(postId) {
        const shareUrl = "{{ url('/posts') }}/" + postId;
        if (navigator.share) {
            navigator.share({
                title: 'منشور جديد',
                text: 'أنصحك بمشاهدة هذا المنشور!',
                url: shareUrl
            }).then(() => {
                console.log('تمت المشاركة');
            }).catch((err) => {
                console.error('فشل المشاركة', err);
            });
        } else {
            navigator.clipboard.writeText(shareUrl).then(() => {
                alert("تم نسخ رابط المشاركة 📋");
            });
        }
    }
</script>
@endsection