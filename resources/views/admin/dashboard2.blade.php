@extends('layouts.app')

@section('content')

<style>
    body { direction: rtl; font-family: 'Cairo', sans-serif; }
    .sidebar a:hover { background-color: #374151; }
    .stats { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .card { background: white; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; }
    .card h3 { color: #666; font-size: 16px; }
    .card p { font-size: 28px; font-weight: bold; margin-top: 10px; }
    table { width: 100%; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-collapse: collapse; }
    th, td { padding: 15px; text-align: right; border-bottom: 1px solid #eee; }
    th { background-color: #f9fafb; }
    .status { font-weight: bold; }
    .status.published { color: green; }
    .status.hidden { color: red; }
    .actions a { margin-left: 10px; color: #2563eb; text-decoration: none; }
    .actions a:hover { text-decoration: underline; }
</style>

<div class="px-6 py-6">
    <h1 class="text-2xl font-bold mb-6">لوحة التحكم السياحية لعدن 🌴</h1>

    <div class="stats">
        <div class="card"><h3>عدد المنشورات</h3><p>{{ $postsCount }}</p></div>
        <div class="card"><h3>عدد المستخدمين</h3><p>{{ $usersCount }}</p></div>
        <div class="card"><h3>عدد التعليقات</h3><p>{{ $commentsCount }}</p></div>
        <div class="card"><h3>عدد التفاعلات</h3><p>{{ $reactionsCount }}</p></div>
        <div class="card"><h3>عدد الوسائط</h3><p>{{ $mediaCount }}</p></div>
    </div>

    <h2 class="text-xl font-semibold mb-4">أحدث المنشورات</h2>
    <table>
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الكاتب</th>
                <th>عدد التعليقات</th>
                <th>تاريخ النشر</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name ?? 'غير معروف' }}</td>
                <td>{{ $post->comments_count }}</td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td class="status {{ $post->is_published ? 'published' : 'hidden' }}">
                    {{ $post->is_published ? 'منشور' : 'مخفي' }}
                </td>
                <td class="actions">
                    <a href="{{ route('posts.index', $post->id) }}">عرض</a>
                    <a href="{{ route('posts.show', $post->id) }}">عرض التعليقات</a>
                    <a href="{{ route('posts.edit', $post->id) }}">تعديل</a>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection