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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

    /* ===== Style 2: Restaurant Images ===== */
    .restaurant-images {
        background: linear-gradient(135deg, #e0ffff, #f0fff0);
    }

    .restaurant-images h1 {
        color: #008080;
    }

    .restaurant-images button {
        background-color: #008080;
        color: white;
    }

    .restaurant-images button:hover {
        background-color: #005959;
    }

    /* ===== Style 3: Cafe ===== */


    body {
        background-color: #f4eee3;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
        background-color: #fff7f0;
        width: 90%;
        max-width: 700px;
        margin: 40px auto;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        color: #5c3d2e;
        text-align: center;
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-top: 15px;
        color: #4a3222;
        font-weight: bold;
    }

    input[type="text"],
    input[type="url"],
    select,
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
    }

    textarea {
        resize: vertical;
    }

    .submit-btn {
        margin-top: 25px;
        width: 100%;
        padding: 12px;
        background-color: #8b5e3c;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #6e432a;
    }

    .error-box {
        background-color: #ffe3e3;
        color: #a94442;
        border: 1px solid #f5c2c2;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    /* 1. الفنادق */
    .hotel {
        background: linear-gradient(135deg, #f0f8ff, #dbefff);
        /* أزرق فاتح أنيق */
    }

    .hotel h1 {
        color: #003366;
        /* كحلي راقٍ */
    }

    .hotel button {
        background-color: #003366;
        color: white;
    }

    .hotel button:hover {
        background-color: #001f4d;
    }

    /* 2. المولات */
    .mall {
        background: linear-gradient(135deg, #fffacd, #ffeaa7);
        /* أصفر فاتح ومشرق */
    }

    .mall h1 {
        color: #b8860b;
        /* ذهبي غامق */
    }

    .mall button {
        background-color: #b8860b;
        color: white;
    }

    .mall button:hover {
        background-color: #8b6508;
    }

    /* 3. البحار */
    .sea {
        background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
        /* درجات من الأزرق البحري الفاتح */
    }

    .sea h1 {
        color: #007c91;
        /* أزرق بحري داكن */
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
        background: linear-gradient(135deg, #e6ffe6, #ccffcc);
        /* أخضر طبيعي هادئ */
    }

    .garden h1 {
        color: #2e8b57;
        /* أخضر غامق */
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
        background: linear-gradient(135deg, #f5f5f5, #e0d7c6);
        /* بيج وتدرجات ترابية */
    }

    .historic h1 {
        color: #6b4226;
        /* بني أثري */
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
        background: linear-gradient(135deg, #f0f8ff, #e6f0ff);
        /* أزرق رمادي عصري */
    }

    .transport h1 {
        color: #1e3a5f;
        /* أزرق داكن */
    }

    .transport button {
        background-color: #1e3a5f;
        color: white;
    }

    .transport button:hover {
        background-color: #152d4a;
    }

    
  .form-container {
    max-width: 500px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    background: linear-gradient(135deg, #f6aa1c, #4caf50);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .form-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
  }

  .form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
  }

  .form-control {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: none;
    margin-bottom: 18px;
    font-size: 16px;
    box-sizing: border-box;
    transition: box-shadow 0.3s ease;
  }

  .form-control:focus {
    outline: none;
    box-shadow: 0 0 8px 2px #f6aa1ccc;
  }

  input[type="file"] {
    padding: 5px;
    background: #ffffffcc;
    color: #333;
  }

  button.btn-primary {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 700;
    background: #3a9d23; /* أخضر داكن */
    color: white;
    cursor: pointer;
    box-shadow: 0 5px 12px rgba(58,157,35,0.6);
    transition: background 0.3s ease;
  }

  button.btn-primary:hover {
    background: #f6aa1c; /* برتقالي */
    box-shadow: 0 5px 15px rgba(246,170,28,0.8);
    color: #222;
  }

    </style>

</head>

<body>

    <div class="form-container">
        <h2>إضافة كافيه جديد</h2>

        @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('cafe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">اسم الكافيه</label>
            <input type="text" name="name" id="name" required>

            <label for="des">الوصف</label>
            <textarea name="des" id="des" rows="4"></textarea>

            <label for="type">نوع الكافيه</label>
            <select name="type" id="type" required>
                <option value="independent">مستقل</option>
                <option value="mall">داخل مول</option>
            </select>

            <label for="link">رابط الموقع الرسمي (اختياري)</label>
            <input type="url" name="link" id="link" placeholder="https://...">

            <label for="image">الصورة الرئيسية</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="gallery">صور المعرض (يمكن اختيار عدة صور)</label>
            <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>

            <button type="submit" class="submit-btn">حفظ الكافيه</button>
        </form>
    </div>





    <!-- Restaurant Form -->
    <div class="form-container restaurant">
        <h1>Create Restaurant</h1>
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter restaurant name">
            <input type="text" name="facebook" placeholder="Enter Facebook link">
            <input type="file" name="image">
            <div class="mb-3">
                <label for="type" class="form-label"> typeee</label>
                <select class="form-select" name="type" id="type" required>
                    <option value="public">public</option>
                    <option value="indian">indian</option>
                    <option value="popular">popular</option>
                </select>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>

    <!-- Restaurant Images Form -->
    <div class="form-container restaurant-images">
        <h1>Choose Restaurant's Pictures</h1>
        <form action="{{ route('places.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">

            <label for="category_id">Category</label>
            <select name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <label for="images">Select up to 4 images</label>
            <input type="file" name="images[]" multiple accept="image/*" required>

            <button type="submit">Save</button>
        </form>
    </div>
<!-- applicaion food-->>

 <div class="form-container">
    <h2>إضافة تطبيق توصيل جديد</h2>
    <form action="{{ route('foodapps.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="form-label" for="image">صورة التطبيق</label>
        <input type="file" name="image" id="image" class="form-control" required>

        <label class="form-label" for="link">رابط التطبيق</label>
        <input type="url" name="link" id="link" placeholder="https://..." class="form-control" required>

        <label class="form-label" for="rating">التقييم (1 - 5)</label>
        <input type="number" name="rating" id="rating" min="1" max="5" class="form-control" required>

        <button type="submit" class="btn btn-primary">إضافة</button>
    </form>
</div>


    <!-- hotel Images Form -->
    <div class="form-container hotel">
        <h1>Create hotels here </h1>
        <form action="{{ route('hotel.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">
            <input type="file" name="image">
            <input type="url" name="link" id="link"  placeholder=" https::">
            <label for="images">Stars</label>
            <input type="number" name="stars" step="0/1" min="0" max="5" placeholder="Enter place stars">
            <label for="images">Select up to 4 images</label>
            <input type="file" name="images[]" multiple accept="image/*" required>

            <button type="submit">Save</button>
        </form>
    </div>

    <!-- Restaurant Images Form -->
    <div class="form-container mall">
        <h1>Create malls here </h1>
        <form action="{{ route('mall.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">
            <input type="file" name="image">

            <label for="images">Select up to 4 images</label>
            <input type="file" name="images[]" multiple accept="image/*" required>

            <button type="submit">Save</button>
        </form>
    </div>






    <!-- Restaurant Images Form -->
    <div class="form-container sea">
        <h1>Create sea here </h1>
        <form action="{{ route('sea.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">
            <input type="text" name="adress" placeholder="Enter adress">
            <input type="text" name="stars" placeholder="Enter stars">
            <input type="file" name="image">



            <button type="submit">Save</button>
        </form>
    </div>






    <!-- Restaurant Images Form -->
    <div class="form-container garden">
        <h1>Create park here </h1>
        <form action="{{ route('park.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">
            <input type="text" name="loc" placeholder="Enter loc">
            <input type="text" name="space" placeholder="Enter space">
            <input type="file" name="image">



            <button type="submit">Save</button>
        </form>
    </div>




    <!-- Restaurant Images Form -->
    <div class="form-container historic">
        <h1>Create hiss here </h1>
        <form action="{{ route('history.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">

            <input type="file" name="image">



            <button type="submit">Save</button>
        </form>
    </div>




    <!-- Restaurant Images Form -->
    <div class="form-container transport">
        <h1>Create tran here </h1>
        <form action="{{ route('tran.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Enter place name">
            <input type="text" name="des" placeholder="Enter place des">

            <input type="file" name="image">



            <button type="submit">Save</button>
        </form>
    </div>
</body>

</html>