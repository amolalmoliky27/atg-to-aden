<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cafe;

class CafeGallery extends Component
{
    public $cafes;
    public $showGalleryModal = false;
    public $currentCafe = null;
    public $currentIndex = 0;

    public function mount()
    {
        $this->cafes = Cafe::where('type', 'independent')->get();
    }

    public function openGallery($cafeId)
    {
        $this->currentCafe = Cafe::with('images')->findOrFail($cafeId);
        $this->currentIndex = 0;
        $this->showGalleryModal = true;
    }

    public function closeGallery()
    {
        $this->showGalleryModal = false;
    }

    public function nextImage()
    {
        if (!$this->currentCafe || $this->currentCafe->images->isEmpty()) return;

        $this->currentIndex = ($this->currentIndex + 1) % $this->currentCafe->images->count();
    }

    public function prevImage()
    {
        if (!$this->currentCafe || $this->currentCafe->images->isEmpty()) return;

        $this->currentIndex = ($this->currentIndex - 1 + $this->currentCafe->images->count()) % $this->currentCafe->images->count();
    }

    public function render()
    {
        return view('livewire.cafe-gallery');
    }
}