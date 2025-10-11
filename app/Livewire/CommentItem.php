<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\CommentReaction;
use Illuminate\Support\Facades\Auth;

class CommentItem extends Component
{
    public $comment;

    public $showReactionMenu = false;
    public $isEditing = false;
    public $editContent = '';

    public $reactionTypes = ['like', 'love', 'funny', 'angry', 'sad'];
    public $emojiMap = [
        'like'  => '👍',
        'love'  => '❤️',
        'funny' => '😂',
        'angry' => '😡',
        'sad'   => '😢',
    ];

    public $showReplies = false;
    public $replies = [];

    public $isReplying = false;
    public $replyContent = '';

    public function mount()
    {
        $this->editContent = $this->comment->content;

      
        if (!Auth::check() && !session()->has('guest_user_id')) {
            session(['guest_user_id' => uniqid('guest_')]);
        }
    }

    public function toggleReactionMenu()
    {
        $this->showReactionMenu = !$this->showReactionMenu;
    }

    public function react($type)
    {
        if (!in_array($type, $this->reactionTypes)) return;

        $userId = Auth::id();
        $guestId = null;

        if (!$userId) {
            $guestId = session('guest_user_id');
        }

        // تحقق من وجود التفاعل
        $reaction = CommentReaction::where('comment_id', $this->comment->id)
            ->where(function($q) use ($userId, $guestId) {
                $q->where('user_id', $userId)->orWhere('guest_id', $guestId);
            })
            ->first();

        if ($reaction) {
            if ($reaction->type === $type) {
                $reaction->delete();
            } else {
                $reaction->type = $type;
                $reaction->save();
            }
        } else {
            CommentReaction::create([
                'comment_id' => $this->comment->id,
                'user_id'    => $userId,
                'guest_id'   => $guestId,
                'type'       => $type,
            ]);
        }

        $this->showReactionMenu = false;
        $this->comment->refresh();
    }

    public function startEdit()
    {
        if (Auth::check() && $this->comment->user_id === Auth::id()) {
            $this->isEditing = true;
            $this->editContent = $this->comment->content;
        }
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editContent = $this->comment->content;
    }

    public function updateComment()
    {
        $this->validate([
            'editContent' => 'required|string|max:500',
        ]);

        if (Auth::check() && $this->comment->user_id === Auth::id()) {
            $this->comment->update([
                'content' => $this->editContent,
            ]);
        }

        $this->isEditing = false;
        $this->comment->refresh();
    }

    public function deleteComment()
    {
        if (Auth::check() && $this->comment->user_id === Auth::id()) {
            $this->comment->delete();
        }
    }

    public function toggleReplies()
    {
        if (!$this->showReplies) {
            $this->replies = $this->comment->replies()->with('user', 'reactions')->latest()->get();
        } else {
            $this->replies = [];
        }

        $this->showReplies = !$this->showReplies;
    }

    public function saveReply()
    {
        $this->validate([
            'replyContent' => 'required|string|max:500',
        ]);

        $userId = Auth::id();
        $guestId = null;
        if (!$userId) $guestId = session('guest_user_id');

        $this->comment->replies()->create([
            'user_id'   => $userId,
            'guest_id'  => $guestId,
            'content'   => $this->replyContent,
            'parent_id' => $this->comment->id,
            'post_id'   => $this->comment->post_id,
        ]);

        $this->replyContent = '';
        $this->isReplying = false;

        $this->toggleReplies();
        $this->comment->refresh();
    }

  public function getUserReactionProperty()
{
    $userId = Auth::id();
    $guestId = session('guest_user_id');

    // إنشاء guest_id إذا لم يكن موجودًا
    if (!$userId && !$guestId) {
        $guestId = uniqid('guest_');
        session(['guest_user_id' => $guestId]);
    }

    return $this->comment->reactions
        ->first(function ($reaction) use ($userId, $guestId) {
            return $reaction->user_id === $userId || $reaction->guest_id === $guestId;
        });
}

    public function render()
    {
        $reactionCounts = [];

        foreach ($this->reactionTypes as $type) {
            $reactionCounts[$type] = $this->comment->reactions->where('type', $type)->count();
        }

        return view('livewire.comment-item', [
            'reactionCounts' => $reactionCounts,
            'emojiMap'       => $this->emojiMap,
            'userReaction'   => $this->getUserReactionProperty(),
        ]);
    }
}