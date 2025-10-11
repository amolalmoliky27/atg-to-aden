
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Restaurant & Cafe</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container {
            width: 90%;
            max-width: 550px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="file"],
        select {
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            width: 100%;
        }

        button {
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        label {
            font-weight: bold;
        }

.hotel {
  background: linear-gradient(135deg, #f0f8ff, #dbefff); /* أزرق فاتح أنيق */
}
.hotel h1 {
  color: #003366; /* كحلي راقٍ */
}
.hotel button {
  background-color: #003366;
  color: white;
}
.hotel button:hover {
  background-color: #001f4d;
}
.mall {
  background: linear-gradient(135deg, #fffacd, #ffeaa7); /* أصفر فاتح ومشرق */
}
.mall h1 {
  color: #b8860b; /* ذهبي غامق */
}
.mall button {
  background-color: #b8860b;
  color: white;
}
.mall button:hover {
  background-color: #8b6508;
}

/* ===== Style 1: Restaurant ===== */
.restaurant {
            background: linear-gradient(135deg, #fff0f5, #ffe4e1);
        }

        .restaurant h1 {
            color: #b22222;
        }

        .restaurant button {
            background-color: #b22222;
            color: white;
        }

        .restaurant button:hover {
            background-color: #8b1a1a;
        }



        /* ===== Style 3: Cafe ===== */
        .cafe {
            background: linear-gradient(135deg, #f5f5dc, #fff8dc);
        }

        .cafe h1 {
            color: #8b4513;
        }

        .cafe button {
            background-color: #8b4513;
            color: white;
        }

        .cafe button:hover {
            background-color: #5c3317;
        }



        
/* 3. البحار */
.sea {
  background: linear-gradient(135deg, #e0f7fa, #b2ebf2); /* درجات من الأزرق البحري الفاتح */
}
.sea h1 {
  color: #007c91; /* أزرق بحري داكن */
}
.sea button {
  background-color: #007c91;
  color: white;
}
.sea button:hover {
  background-color: #005f6b;
}


/* 4. الحدائق */
.garden {
  background: linear-gradient(135deg, #e6ffe6, #ccffcc); /* أخضر طبيعي هادئ */
}
.garden h1 {
  color: #2e8b57; /* أخضر غامق */
}
.garden button {
  background-color: #2e8b57;
  color: white;
}
.garden button:hover {
  background-color: #1f5e3d;
}

/* 5. الأماكن التاريخية */
.historic {
  background: linear-gradient(135deg, #f5f5f5, #e0d7c6); /* بيج وتدرجات ترابية */
}
.historic h1 {
  color: #6b4226; /* بني أثري */
}
.historic button {
  background-color: #6b4226;
  color: white;
}
.historic button:hover {
  background-color: #4a2e1a;
}

/* 6. المواصلات */
.transport {
  background: linear-gradient(135deg, #f0f8ff, #e6f0ff); /* أزرق رمادي عصري */
}
.transport h1 {
  color: #1e3a5f; /* أزرق داكن */
}
.transport button {
  background-color: #1e3a5f;
  color: white;
}
.transport button:hover {
  background-color: #152d4a;
}

</style>
</head>
<body>




@php
    $hotel = $hotel ?? $item ?? null;
    $mall = $mall ?? $item ?? null;

    $restaurant = $restaurant ?? $item ?? null;
    $cafe = $cafe ?? $item ?? null;

@endphp

@if ($hotel)
<div class="form-container hotel">
    <h1>تعديل بيانات الفندق</h1>
    <form action="{{ route('hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $hotel->name }}" placeholder="Enter hotel name">
        <input type="text" name="des" value="{{ $hotel->des }}" placeholder="Enter description">
        <input type="text" name="loc" value="{{ $hotel->loc }}" placeholder="Enter location">
        <input type="number" name="stars" value="{{ $hotel->stars }}" step="0.1" min="0" max="5" placeholder="Enter stars">

        <label>الصورة الرئيسية (اختياري):</label>
        <input type="file" name="image">

        <label>الصور الإضافية (اختياري):</label>
        <input type="file" name="images[]" multiple accept="image/*">

        <button type="submit">تحديث</button>
    </form>
</div>
@endif


@if ($mall)
<div class="form-container mall"> 
    <h1>تعديل بيانات المول</h1> 
    <form action="{{ route('mall.update', $mall->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        @method('PUT') 

        <input type="text" name="name" value="{{ $mall->name }}" placeholder="اسم المول"> 
        <input type="text" name="des" value="{{ $mall->des }}" placeholder="وصف المول"> 

        <label>الصورة الحالية:</label><br> 
        <img src="{{ asset('images/' . $mall->image) }}" width="150"><br><br> 
        <input type="file" name="image"> 

        <label>الصور الإضافية (اختياري):</label> 
        <input type="file" name="images[]" multiple accept="image/*"> 

        <button type="submit">تحديث</button> 
    </form> 
</div>
@endif





{{-- تعديل المطاعم --}}
    @if(isset($category))
    <div class="form-container restaurant">
        <h1>تعديل بيانات المطعم</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>اسم المطعم</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required>

            <label>رابط الفيسبوك</label>
            <input type="text" name="facebook" value="{{ old('facebook', $category->facebook) }}">

            <label>نوع المطعم</label>
            <select name="type" required>
                <option value="public" {{ $category->type == 'public' ? 'selected' : '' }}>public</option>
                <option value="indian" {{ $category->type == 'indian' ? 'selected' : '' }}>indian</option>
                <option value="popular" {{ $category->type == 'popular' ? 'selected' : '' }}>popular</option>
            </select>

            <label>الصورة الحالية</label><br>
            <img src="{{ asset('images/' . $category->image) }}" class="preview-img"><br>

            <label>تغيير الصورة (اختياري)</label>
            <input type="file" name="image">

            <button type="submit">تحديث بيانات المطعم</button>
        </form>

        {{-- تعديل صور المطعم المرتبطة (places) --}}
        @foreach($category->places as $place)
  
<div class="mb-4 p-3 border">

<h5>تعديل صور المطعم: {{ $place->name }}</h5>

{{-- عرض الصور الحالية --}}
<div class="d-flex gap-2 flex-wrap mb-3">
    @if($place->images)
        @foreach(json_decode($place->images, true) as $img)
            <img src="{{ asset('images/' . $img) }}" width="100" height="100" style="object-fit: cover;">
        @endforeach
    @endif
</div>

{{-- نموذج رفع صور جديدة --}}
<form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ضروري تمرير الاسم و category_id حتى لا يحدث خطأ --}}
    <input type="hidden" name="name" value="{{ $place->name }}">
    <input type="hidden" name="category_id" value="{{ $place->category_id }}">

    <label>إضافة صور جديدة:</label>
    <input type="file" name="images[]" multiple class="form-control mb-2">

    <button type="submit" class="btn btn-primary btn-sm">تحديث الصور</button>
</form>
</div>

@endforeach






    </div>
    @endif

    {{-- تعديل الكافيهات --}}
    @if(isset($cafe))
    <div class="form-container cafe">
        <h1>تعديل بيانات الكافيه</h1>
        
           
        <form action="{{ route('cafe.update', $cafe->id) }}" method="POST" enctype="multipart/form-data">
          
            @csrf
            @method('PUT')

            <label>اسم الكافيه</label>
            <input type="text" name="name" value="{{ old('name', $cafe->name) }}" required>

            <label>الوصف</label>
            <textarea name="des" rows="4">{{ old('des', $cafe->des) }}</textarea>

            <label>الصورة الحالية</label><br>
            <img src="{{ asset('images/' . $cafe->image) }}" class="preview-img"><br>

            <label>تغيير الصورة (اختياري)</label>
            <input type="file" name="image">

            <button type="submit">تحديث بيانات الكافيه</button>
        </form>
    </div>
    @endif






    @if(isset($sea))
    <div class="form-container sea">
    <h1>تعديل معلومات البحر</h1>
    <form action="{{ route('sea.update', $sea->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $sea->name }}" placeholder="اسم البحر">
        <input type="text" name="des" value="{{ $sea->des }}" placeholder="الوصف">
        <input type="text" name="adress" value="{{ $sea->adress }}" placeholder="العنوان">
        <input type="text" name="stars" value="{{ $sea->stars }}" placeholder="عدد النجوم">
        <label>صورة حالية:</label><br>
        <img src="{{ asset('images/' . $sea->image) }}" width="100"><br><br>
        <input type="file" name="image">

        <button type="submit">تحديث</button>
    </form>
</div>

@endif


@if(isset($park))
<div class="form-container garden">
    <h1>تعديل معلومات الحديقة</h1>

    <form action="{{ route('park.update', $park->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $park->name }}" placeholder="اسم الحديقة">
        <input type="text" name="des" value="{{ $park->des }}" placeholder="الوصف">
        <input type="text" name="loc" value="{{ $park->loc }}" placeholder="الموقع">
        <input type="text" name="space" value="{{ $park->space }}" placeholder="المساحة بالمتر المربع">

        <label>الصورة الحالية:</label><br>
        <img src="{{ asset('images/' . $park->image) }}" width="120"><br><br>
        <input type="file" name="image">

        <button type="submit">تحديث</button>
    </form>
</div>
@endif

@if(isset($history))

<div class="form-container historic">
    <h1>تعديل المكان التاريخي</h1>

    <form action="{{ route('history.update', $history->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $history->name }}" placeholder="اسم المكان">
        <input type="text" name="des" value="{{ $history->des }}" placeholder="الوصف">
        
        <label>الصورة الحالية:</label><br>
        <img src="{{ asset('images/' . $history->image) }}" width="120"><br><br>

        <input type="file" name="image">
        
        <button type="submit">تحديث</button>
    </form>
</div>
@endif


@if(isset($tran))

<div class="form-container transport">


<h1>تعديل الخدمة</h1>

<form action="{{ route('tran.update', $tran->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $tran->name }}" placeholder="الاسم">
    <input type="text" name="des" value="{{ $tran->des }}" placeholder="الوصف">
    
    <img src="{{ asset('images/' . $tran->image) }}" width="100" alt="الصورة الحالية"><br>
    <input type="file" name="image">  {{-- اختيار صورة جديدة (اختياري) --}}

    <button type="submit">تحديث</button>
</form>

</div>
@endif



</body>
</html>
