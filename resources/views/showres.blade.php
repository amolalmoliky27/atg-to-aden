<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>معرض {{$category->name}}</title>

  <!-- خطوط Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      background: linear-gradient(135deg,rgb(184, 229, 170),rgb(241, 196, 98));
      font-family: 'Cairo', sans-serif;
      color: #333;
      padding: 40px 15px;
      min-height: 100vh;
    }

    h2 {
      text-align: center;
      font-size: 3rem;
      margin-bottom: 50px;
      font-weight: 700;
      color: #1a1a1a;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.1);
    }

    .place-card {
      background: linear-gradient(135deg,rgb(170, 243, 147),rgb(252, 205, 103));
      width: 1200px;
      margin: 0 auto 60px;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(80, 74, 74, 0.12);
      padding: 30px 35px 40px;
      transition: transform 0.3s ease;
    }

    .place-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.2);
    }

    .place-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      flex-wrap: wrap;
      gap: 15px;
    }

    .place-header h3 {
      font-size: 2rem;
      font-weight: 700;
      color: #222;
      flex: 1 1 auto;
      margin: 0;
      text-shadow: 0 0 3px #aaa;
    }

    .btn-delete {
      background: #e74c3c;
      border: none;
      padding: 10px 22px;
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      border-radius: 30px;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(231, 76, 60, 0.5);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      flex: 0 0 auto;
    }

    .btn-delete:hover {
      background: #c0392b;
      box-shadow: 0 8px 25px rgba(192, 57, 43, 0.6);
    }

    .image-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
    }

    .image-gallery img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }

    .image-gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 35px rgba(0,0,0,0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
      h2 {
        font-size: 2.4rem;
        margin-bottom: 40px;
      }

      .place-card {
        padding: 25px 20px 30px;
      }

      .image-gallery {
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 18px;
      }

      .image-gallery img {
        height: 140px;
      }

      .btn-delete {
        padding: 8px 18px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <h2>معرض {{$category->name}}</h2>

  @foreach($places as $place)
    <div class="place-card">
      <div class="place-header">
        <h3>{{$place->name}}</h3>

        <form action="{{ route('places.destroy', $place->id) }}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المكان؟');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-delete">حذف</button>
        </form>
      </div>

      <div class="image-gallery">
        @foreach(json_decode($place->images) as $image)
          <img src="{{ asset('images/'.$image) }}" alt="{{$place->name}}" />
        @endforeach
      </div>
    </div>
  @endforeach

</body>
</html>