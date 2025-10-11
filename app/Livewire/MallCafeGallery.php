<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cafe;

class MallCafeGallery extends Component
{
    public $mallCafes;
    public $showGalleryModal = false;
    public $currentCafe = null;
    public $randomCafeImages = [];

    public $currentIndex = 0;

    public function mount()
    {
        $this->mallCafes = Cafe::where('type', 'mall')->get();
        $this->randomCafeImages = \App\Models\CafeImage::inRandomOrder()->limit(30)->get();
    }

    public function openGallery($cafeId)
    {
        $this->currentCafe = Cafe::with('images')->find($cafeId);
        $this->currentIndex = 0; // بداية العرض من أول صورة
        $this->showGalleryModal = true;
    }

    public function closeGallery()
    {
        $this->showGalleryModal = false;
        $this->currentCafe = null;
        $this->currentIndex = 0;
    }

    public function nextImage()
    {
        if (!$this->currentCafe || $this->currentCafe->images->isEmpty()) {
            return;
        }

        $this->currentIndex = ($this->currentIndex + 1) % $this->currentCafe->images->count();
    }

    public function prevImage()
    {
        if (!$this->currentCafe || $this->currentCafe->images->isEmpty()) {
            return;
        }

        $this->currentIndex = ($this->currentIndex - 1 + $this->currentCafe->images->count()) % $this->currentCafe->images->count();
    }

    public function render()
    {
        return view('livewire.mall-cafe-gallery');
    }
}