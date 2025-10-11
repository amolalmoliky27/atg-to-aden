<div>

    <title>كافيهات مستقلة</title>
    <style>
        /* العنوان */
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #5c4033;
        }

        /* الكارد الأساسي */
        .cafe-card {
            position: relative;
            background-size: cover;
            background-position: center center;
            height: 450px;
            width: 400px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        /* طبقة التعتيم البنية */
        .cafe-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(92, 64, 51, 0.0); /* شفافية أقل لإظهار الصورة بوضوح */
            z-index: 1;
            transition: background 0.3s ease;
        }

        /* معلومات الكافيه (اسم، وصف، زر) فوق الطبقة */
        .cafe-info {
            position: relative;
            z-index: 2;
            color: #fff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
        }

        /* عنوان الكافيه */
        .cafe-info h4 {
            margin: 0 0 8px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        /* وصف الكافيه */
        .cafe-info p {
            margin: 0 0 12px;
            font-size: 1rem;
            line-height: 1.3;
        }

        /* زر زيارة الصفحة الرسمية */
        .cafe-info a.btn-sm {
            background-color: #8B4513; /* بني قهوة */
            color: white !important;
            padding: 6px 12px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.25s ease;
            display: inline-block;
        }

        .cafe-info a.btn-sm:hover {
            background-color: #a3673c;
        }

        /* أزرار التعديل والحذف */
        .btn-warning {
            position: absolute !important;
            top: 10px !important;
            right: 10px !important;
            padding: 4px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 5px !important;
            z-index: 10 !important;
            opacity: 0.85;
            transition: opacity 0.3s ease;
        }

        .btn-warning:hover {
            opacity: 1;
        }

        .btn-danger {
            position: absolute !important;
            top: 10px !important;
            left: 10px !important;
            padding: 4px 10px !important;
            font-size: 0.85rem !important;
            border-radius: 5px !important;
            z-index: 10 !important;
            opacity: 0.85;
            transition: opacity 0.3s ease;
        }

        .btn-danger:hover {
            opacity: 1;
        }

        /* تأثير عند تمرير الماوس على الكارد */
        .cafe-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.35);
            background-position: center top;
        }

        /* المودال */
        .cafe-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgb(44, 23, 5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .cafe-modal {
            position: relative;
            background: rgba(148, 102, 4, 0.85);
            border-radius: 12px;
            max-width: 90vw;
            max-height: 90vh;
            padding: 15px;
            overflow: hidden;
        }

        .modal-image {
            width: 80vw;
            max-height: 70vh;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            border-radius: 12px;
        }

        /* أزرار المودال */
        .modal-close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            border: none;
            background: #6d4c41;
            color: white;
            cursor: pointer;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            line-height: 28px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(236, 202, 6, 0.91);
        }

        .modal-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 30px;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
        }

        .modal-nav-btn.left {
            left: 10px;
        }

        .modal-nav-btn.right {
            right: 10px;
        }

        .thumbnail {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail.active {
            border: 2px solid #a67b5b;
        }
    </style>

    <!-- ✅ قسم الكافيهات -->
    <section id="cafes" class="section">
        <div class="container">
            <h2 class="section-title text-center mb-4">كافيهات مستقلة</h2>
            <div class="row">
                
                @foreach($cafes as $cafe)
                <div class="col-md-4 mb-4">
                    <div class="card cafe-card" style="background-image: url('{{ asset('images/' . $cafe->image) }}');"
                        wire:click="openGallery({{ $cafe->id }})">

                        <!-- أدوات الإدارة -->
                        @auth
                        @if(auth()->user()->is_Admin())
                        <a href="{{ route('cafe.edit', $cafe->id) }}" class="btn btn-sm btn-warning admin-btn edit-btn">تعديل</a>

                        <form action="{{ route('cafe.destroy', $cafe->id) }}" method="POST"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الكافيه؟');"
                            class="admin-btn delete-btn">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                        @endif
                        @endauth
             
       
                        <!-- معلومات الكافيه -->
                        <div class="cafe-info">
                                       @if($cafe->link)
    <a href="{{ $cafe->link }}" target="_blank" style="display: inline-block; width: 28px; height: 28px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1877F2" width="28px" height="28px">
    <path d="M22.675 0h-21.35C.596 0 0 .597 0 1.333v21.333C0 23.403.596 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.41c0-3.1 1.894-4.788 4.66-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.597 1.324-1.334V1.333C24 .597 23.405 0 22.675 0z"/>
  </svg>
</a>@endif
                            <h4>{{ $cafe->name }}</h4>
                            <p>{{ $cafe->des }}</p>

        
                        </div>
                    </div>
                </div>
                                         @endforeach
            </div>
        </div>
    </section>

    <!-- ✅ المعرض (مودال) -->
    @if($showGalleryModal && $currentCafe && $currentCafe->images->isNotEmpty())
    @php
    $images = $currentCafe->images->pluck('image')->toArray();
    $currentImage = $images[$currentIndex] ?? null;
    @endphp

    <div tabindex="0" wire:keydown.escape="closeGallery" class="cafe-modal-backdrop">

        <div class="cafe-modal">
            <button wire:click="closeGallery" class="modal-close-btn">×</button>

            @if($currentImage)
            <img src="{{ asset('images/cafes/' . $currentImage) }}" alt="صورة الكافيه" class="modal-image">
            @else
            <p class="text-center p-4">لا توجد صور متاحة حالياً.</p>
            @endif

            <button wire:click="prevImage" class="modal-nav-btn left">‹</button>
            <button wire:click="nextImage" class="modal-nav-btn right">›</button>

        </div>
    </div>
    @endif

</div>