<div>
    <div class="comment-box">
        <div class="flex items-center gap-2 text-sm text-gray-700 font-semibold mb-1">
            {{-- أفاتار حسب الجنس --}}
            @php
                $gender = $comment->user->gender ?? 'unknown';
                $avatar = match($gender) {
                    'male' => asset('images/avatar-male.png'),
                    'female' => asset('images/avatar-female.png'),
                    default => asset('images/avatar-neutral.png'),
                };
            @endphp
            <img src="{{ $avatar }}" alt="avatar" style="width:27px; height:27px; border-radius:50%; object-fit:cover; margin-inline-end:7px; vertical-align:middle;">
            {{ $comment->user->name ?? $comment->user_name ?? 'مجهول' }}
        </div>

        {{-- محتوى التعليق أو التعديل --}}
        @if($isEditing)
            <textarea wire:model.defer="editContent" class="w-full p-2 border rounded" rows="2"></textarea>
            <div class="mt-2 flex gap-2">
                <button wire:click="updateComment" class="cursor-pointer">حفظ</button>
                <button wire:click="cancelEdit" class="cursor-pointer">إلغاء</button>
            </div>
        @else
            <p class="mb-2">{{ $comment->content }}</p>
        @endif

        {{-- أزرار التفاعل والرد والتعديل والحذف --}}
        <div class="flex items-center gap-4 mt-1 comment-actions">

            {{-- زر التفاعل --}}
            <div class="relative inline-block">
                <button wire:click="toggleReactionMenu" class="cursor-pointer select-none px-2 py-1 border rounded">
                    {{ $userReaction ? $emojiMap[$userReaction->type] : ' 👍أعجبني' }}
                </button>

                @if($showReactionMenu)
                    <div class="reaction-menu absolute bottom-full mb-1 z-50 bg-white border border-gray-300 rounded-full px-2 py-1 shadow flex space-x-1">
                        @foreach($emojiMap as $type => $icon)
                            <button wire:click="react('{{ $type }}')"
                                    class="text-2xl hover:scale-125 transition-transform duration-150 cursor-pointer select-none p-0">
                                {{ $icon }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- زر الرد --}}
            <button wire:click="$toggle('isReplying')" class="cursor-pointer select-none">رد</button>

            {{-- أزرار تعديل وحذف لصاحب التعليق أو الأدمن --}}
     @if(
    (Auth::check() && Auth::id() === $comment->user_id) || // المستخدم المسجّل صاحب التعليق
    (!Auth::check() && session('guest_user_id') === $comment->guest_id) || // الزائر صاحب التعليق
    (Auth::check() && Auth::user()->is_admin) // الأدمن
)
                <button wire:click="startEdit" class="cursor-pointer select-none">تعديل</button>
                <button wire:click="deleteComment" class="cursor-pointer select-none">حذف</button>
            @endif

        </div>

        {{-- مربع كتابة الرد --}}
        @if($isReplying)
            <div class="mt-2">
                <textarea wire:model.defer="replyContent" class="w-full p-2 border rounded" rows="2" placeholder="اكتب ردك هنا..."></textarea>
                <div class="mt-1">
                    <button wire:click="saveReply" class="cursor-pointer">إرسال الرد</button>
                </div>
            </div>
        @endif

        {{-- زر عرض أو إخفاء الردود --}}
        @if($comment->replies()->count() > 0)
            <button wire:click="toggleReplies" class="mt-3 text-blue-600 cursor-pointer select-none text-sm">
                {{ $showReplies ? 'إخفاء الردود ('. $comment->replies()->count() .')' : 'عرض الردود ('. $comment->replies()->count() .')' }}
            </button>
        @endif

        {{-- عرض الردود --}}
        @if($showReplies)
            <div class="reply-box mt-4 pl-4 border-l border-gray-300 space-y-3">
                @foreach($replies as $reply)
                    @livewire('comment-item', ['comment' => $reply], key('reply-'.$reply->id))
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .comment-box {
            background-color: #f9fafb;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            transition: box-shadow 0.2s ease-in-out;
            color: #111;
            font-size: 14px;
        }
        .comment-box:hover {
            box-shadow: 0 4px 10px rgba(26, 3, 3, 0.64);
        }
        .reaction-menu {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 9999px;
            padding: 4px 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 4px;
            align-items: center;
            max-width: max-content;
        }
        .reaction-menu button {
            font-size: 22px;
            transition: transform 0.15s ease-in-out;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            line-height: 1;
        }
        .reaction-menu button:hover {
            transform: scale(1.3);
        }
        .reply-box {
            margin-left: 20px;
            border-left: 2px solid #eee;
            padding-left: 12px;
            margin-top: 10px;
        }
        button {
            background: none;
            color: black;
        }
        .comment-actions button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            margin-right: 10px;
            padding: 4px 6px;
            font-size: 14px;
        }
        .comment-actions button:hover {
            text-decoration: underline;
        }
        textarea {
            font-size: 14px;
            resize: vertical;
        }
        button:focus {
            outline: none;
        }
    </style>
</div>