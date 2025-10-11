

@foreach($news as $item)
<!-- News Card -->
<article class="news-card bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" data-type="{{ $item->category }}">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/3 relative">
            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://picsum.photos/400/300?random=' . $item->id }}" alt="{{ $item->title }}" class="w-full h-64 md:h-full object-cover">
            <div class="absolute top-4 right-4 
                    @if($item->category == 'سياحة') bg-blue-600 @endif
                    @if($item->category == 'تراث') bg-amber-600 @endif
                    @if($item->category == 'فعاليات') bg-green-600 @endif
                    @if($item->category == 'ثقافة') bg-purple-600 @endif
                    @if($item->category == 'تطوير') bg-indigo-600 @endif
                    text-white px-3 py-1 rounded-full text-xs font-medium">
                {{ $item->category }}
            </div>
        </div>
        <div class="md:w-2/3 p-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">
                {{ $item->title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                {{ $item->content }}
            </p>
            <div class="flex items-center justify-between">
                <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                    <span class="ml-1">📍</span>
                    <span>{{ $item->location }}</span>
                </div>
                <span class="text-primary font-semibold text-sm">منذ {{ $item->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</article>
@endforeach
<!-- line-clamp: 2;-->

