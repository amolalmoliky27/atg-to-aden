<div>
    <style>
        /* العنوان */
        h2.mall-section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #5c4033;
            margin-bottom: 1.5rem;
        }

        /* كارد الكافيه */
        .mall-cafe-card {
             position: relative;
            background-size: cover;
            background-position: center center;
            height: 450px;
            width: 500px;
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

        /* طبقة التعتيم البنية 
        .mall-cafe-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(92, 64, 51, 0.0);
            z-index: 1;
            transition: background 0.3s ease;
            border-radius: 12px;
        }

        /* معلومات الكافيه (اسم، وصف، زر) فوق الطبقة */
        .mall-cafe-info {
            position: relative;
            z-index: 2;
            color: #fff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
        }

        /* عنوان الكافيه */
        .mall-cafe-info h5 {
            margin: 0 0 8px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        /* وصف الكافيه */
        .mall-cafe-info p {
            margin: 0 0 12px;
            font-size: 1rem;
            line-height: 1.3;
        }

 
        

        .mall-btn-outline-primary:hover {
            background-color: #8B4513;
            color: white;
            text-decoration: none;
        }

   

        .mall-btn-warning {
            right: 10px !important;
        }

        .mall-btn-danger {
            left: 10px !important;
        }

        .mall-btn-warning:hover, .mall-btn-danger:hover {
            opacity: 1;
        }

        /* تأثير تمرير الفأرة */
        .mall-cafe-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.35);
            background-position: center top;
        }

        /* المودال الخلفية */
        .mall-cafe-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgb(44, 23, 5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* المودال */
        .mall-cafe-modal {
            position: relative;
            background: rgba(148, 102, 4, 0.85);
            border-radius: 12px;
            max-width: 90vw;
            max-height: 90vh;
            padding: 15px;
            overflow: hidden;
        }

        /* الصورة الكبيرة في المودال */
        .mall-modal-image {
            width: 80vw;
            max-height: 70vh;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            border-radius: 12px;
        }

        /* زر إغلاق المودال */
        .mall-modal-close-btn {
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
            z-index: 1000;
        }

        /* أزرار التنقل في المودال */
        .mall-modal-nav-btn {
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
            z-index: 1000;
        }

        .mall-modal-nav-btn.left {
            left: 10px;
        }

        .mall-modal-nav-btn.right {
            right: 10px;
        }

        .mall-thumbnail.active {
            border: 2px solid #a67b5b;
        }
    </style>
   <section id="cafes" class="section">
        <div class="container">
            <h2 class="section-title text-center mb-4">كافيهات داخل المولات</h2>
            <div class="row">
  
        @foreach($mallCafes as $cafe)
            <div class="col-md-4 mb-4 d-flex align-items-stretch"> <!-- أضفت d-flex align-items-stretch لجعل الكارد بنفس الارتفاع ولعرض مرتب -->
                <div class="card mall-cafe-card"
                     style="background-image: url('{{ asset('images/' . $cafe->image) }}');"
                     wire:click="openGallery({{ $cafe->id }})">

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

                    <div class="mall-cafe-info">
                        @if($cafe->link)
                            <a href="{{ $cafe->link }}" target="_blank" style="display: inline-block; width: 28px; height: 28px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1877F2" width="28px" height="28px">
    <path d="M22.675 0h-21.35C.596 0 0 .597 0 1.333v21.333C0 23.403.596 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.41c0-3.1 1.894-4.788 4.66-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.597 1.324-1.334V1.333C24 .597 23.405 0 22.675 0z"/>
  </svg>
</a>
                        @endif
                        <h5>{{ $cafe->name }}</h5>
                        <p>{{ Str::limit($cafe->des, 100) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        </div></section>
    <!-- معرض الصور - المودال -->
    @if($showGalleryModal && $currentCafe && $currentCafe->images->isNotEmpty())
        @php
            $images = $currentCafe->images->pluck('image')->toArray();
            $currentImage = $images[$currentIndex] ?? null;
        @endphp

        <div tabindex="0" wire:keydown.escape="closeGallery" class="mall-cafe-modal-backdrop">
            <div class="mall-cafe-modal">
                <button wire:click="closeGallery" class="mall-modal-close-btn">×</button>

                @if($currentImage)
                    <img src="{{ asset('images/cafes/' . $currentImage) }}" alt="صورة الكافيه" class="mall-modal-image">
                @else
                    <p class="text-center p-4">لا توجد صور لعرضها.</p>
                @endif

                <button wire:click="prevImage" class="mall-modal-nav-btn left">‹</button>
                <button wire:click="nextImage" class="mall-modal-nav-btn right">›</button>
            </div>
        </div>
    @endif
</div>