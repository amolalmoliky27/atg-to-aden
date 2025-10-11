<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostReactionComponent extends Component
{
    public Post $post;
    public $reactionType = null;
    public $showReactionMenu = false;

    public $reactionLabels = [
        'like'  => 'أعجبني',
        'love'  => 'أحببته',
        'angry' => 'أغضبني',
        'haha'  => 'أضحكني',
        'sad'   => 'أحزنني',
    ];

    public $reactionIcons = [
        'like'  => '👍',
        'love'  => '❤️',
        'angry' => '😡',
        'haha'  => '😂',
        'sad'   => '😢',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;

        // تحديد المستخدم أو الزائر
        if (Auth::check()) {
            $userId = Auth::id();
            $guestId = null;
        } else {
            $userId = null;
            if (!session()->has('guest_user_id')) {
                session(['guest_user_id' => uniqid('guest_')]);
            }
            $guestId = session()->get('guest_user_id');
        }

        
        $reaction = $post->reactions()
            ->where(function ($q) use ($userId, $guestId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->whereNull('user_id')->where('guest_id', $guestId);
                }
            })
            ->first();

        $this->reactionType = $reaction ? $reaction->type : null;
    }

    public function toggleReactionMenu()
    {
        $this->showReactionMenu = !$this->showReactionMenu;
    }

    public function react($type)
    {
        if (!Auth::check()) {
            return
           $this-> redirectRoute('login');}
            $userId = Auth::id();
            $guestId = null;
        
   

        $existing = $this->post->reactions()
            ->where(function ($q) use ($userId, $guestId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->whereNull('user_id')->where('guest_id', $guestId);
                }
            })
            ->first();

        if ($existing) {
            if ($existing->type === $type) {
                $existing->delete();
                $this->reactionType = null;
            } else {
                $existing->update(['type' => $type]);
                $this->reactionType = $type;
            }
        } else {
            $this->post->reactions()->create([
                'user_id'  => $userId,
                'guest_id' => $guestId,
                'type'     => $type,
            ]);
            $this->reactionType = $type;
        }

        $this->showReactionMenu = false;

        
        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.post-reaction', [
            'reactionLabels' => $this->reactionLabels,
            'reactionIcons'  => $this->reactionIcons,
        ]);
    }
}