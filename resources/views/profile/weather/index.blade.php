<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الطقس المتكامل</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Tajawal', sans-serif;
        }
        .weather-card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .weather-card:hover {
            transform: translateY(-5px);
        }
        .weather-icon {
            width: 100px;
            height: 100px;
            filter: drop-shadow(0 5px 5px rgba(0,0,0,0.1));
        }
        .city-selector {
            position: relative;
        }
        .city-list {
            position: absolute;
            width: 100%;
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
        }
        .forecast-day {
            border-radius: 10px;
            padding: 15px;
            margin: 5px;
            background: rgba(255,255,255,0.6);
            transition: all 0.3s ease;
        }
        .forecast-day:hover {
            background: rgba(255,255,255,0.9);
            transform: scale(1.03);
        }
        .map-container {
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        @media (max-width: 768px) {
            .weather-icon {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>
<body class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="weather-card">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h4 mb-0"><i class="fas fa-cloud-sun me-2"></i>نظام الطقس المتكامل</h1>
                            <div id="current-time" class="small"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="weatherForm" method="POST" action="{{ route('weather.submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6 city-selector">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                        <input type="text" id="cityInput" name="city" class="form-control" 
                                               placeholder="ابحث عن مدينة..." autocomplete="off" required
                                               aria-label="اسم المدينة">
                                        <button class="btn btn-primary" type="submit" aria-label="بحث">
                                            <i class="fas fa-search me-1"></i> بحث
                                        </button>
                                    </div>
                                    <div id="cityList" class="city-list list-group mt-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                        <input type="text" id="datePicker" class="form-control" 
                                               placeholder="حدد تاريخ للتوقعات" aria-label="تاريخ التوقعات">
                                        <button id="forecastBtn" class="btn btn-outline-primary" type="button"
                                                aria-label="عرض التوقعات">
                                            <i class="fas fa-calendar-week me-1"></i> توقعات
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-4">
                            <!-- بطاقة الطقس الحالي -->
                            <div class="col-lg-6">
                                <div id="currentWeather" class="p-4 rounded-3 bg-light mb-4">
                                    @if(isset($weatherData))
                                    <div class="text-center">
                                        <h2 class="mb-3">{{ $weatherData['name'] }}</h2>
                                        <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@4x.png" 
                                             class="weather-icon mb-3" alt="حالة الطقس">
                                        <h3 class="text-capitalize">{{ $weatherData['weather'][0]['description'] }}</h3>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-white rounded-2 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-temperature-high fs-3 text-danger me-2"></i>
                                                    <div>
                                                        <small>الحرارة</small>
                                                        <h4 class="mb-0">{{ round($weatherData['main']['temp']) }}°C</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-white rounded-2 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-tint fs-3 text-primary me-2"></i>
                                                    <div>
                                                        <small>الرطوبة</small>
                                                        <h4 class="mb-0">{{ $weatherData['main']['humidity'] }}%</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-white rounded-2 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-wind fs-3 text-success me-2"></i>
                                                    <div>
                                                        <small>الرياح</small>
                                                        <h4 class="mb-0">{{ $weatherData['wind']['speed'] }} m/s</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-white rounded-2 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-tachometer-alt fs-3 text-warning me-2"></i>
                                                    <div>
                                                        <small>الضغط</small>
                                                        <h4 class="mb-0">{{ $weatherData['main']['pressure'] }} hPa</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-cloud fa-4x text-muted mb-3" aria-hidden="true"></i>
                                        <h4 class="text-muted">اختر مدينة لمعرفة حالة الطقس</h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- القسم الجانبي -->
                            <div class="col-lg-6">
                                <div class="row">
                                    <!-- خريطة الطقس -->
                                    <div class="col-12 mb-4">
                                        <div class="map-container bg-light p-3">
                                            <div id="weatherMap" style="height:100%;" class="rounded-2 overflow-hidden">
                                                <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                                                    <div class="text-center text-muted">
                                                        <i class="fas fa-map-marked-alt fa-3x mb-2" aria-hidden="true"></i>
                                                        <p>خريطة الطقس ستظهر هنا</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- توقعات الطقس -->
                                    <div class="col-12">
                                        <h5 class="mb-3"><i class="fas fa-calendar-week me-2"></i>توقعات 5 أيام</h5>
                                        <div id="weatherForecast" class="row g-2">
                                            @for($i = 1; $i <= 5; $i++)
                                            <div class="col">
                                                <div class="forecast-day text-center">
                                                    <div class="fw-bold mb-2">اليوم {{ $i }}</div>
                                                    <i class="fas fa-cloud-sun fa-2x text-warning mb-2" aria-hidden="true"></i>
                                                    <div class="small">--° / --°</div>
                                                </div>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- تذييل الصفحة -->
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                آخر تحديث: {{ now()->format('Y-m-d H:i') }}
                            </small>
                            <div>
                                <button id="refreshBtn" class="btn btn-sm btn-outline-primary me-2" aria-label="تحديث البيانات">
                                    <i class="fas fa-sync-alt me-1"></i> تحديث
                                </button>
                                <button id="shareBtn" class="btn btn-sm btn-outline-success" aria-label="مشاركة النتائج">
                                    <i class="fas fa-share-alt me-1"></i> مشاركة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عرض التاريخ والوقت الحالي
            function updateTime() {
                const now = new Date();
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                document.getElementById('current-time').textContent = 
                    now.toLocaleDateString('ar-EG', options);
            }
            setInterval(updateTime, 1000);
            updateTime();

            // تهيئة منتقي التاريخ
            flatpickr("#datePicker", {
                locale: "ar",
                minDate: "today",
                maxDate: new Date().fp_incr(14),
                dateFormat: "Y-m-d",
                disable: [
                    function(date) {
                        return (date.getDay() === 0);
                    }
                ]
            });

            // البحث التلقائي عن المدن
            const cityInput = document.getElementById('cityInput');
            const cityList = document.getElementById('cityList');
            
            cityInput.addEventListener('input', function() {
                if (this.value.length > 2) {
                    fetchCities(this.value);
                } else {
                    cityList.style.display = 'none';
                }
            });

            function fetchCities(query) {
                // هنا يمكنك إضافة اتصال API للبحث عن المدن
                // هذه مجرد بيانات تجريبية
                const mockCities = [
                    { name: "الرياض", country: "السعودية" },
                    { name: "جدة", country: "السعودية" },
                    { name: "دبي", country: "الإمارات" },
                    { name: "القاهرة", country: "مصر" },
                    { name: "عمّان", country: "الأردن" }
                ];
                
                const filteredCities = mockCities.filter(city => 
                    city.name.includes(query) || city.country.includes(query)
                );
                
                displayCities(filteredCities);
            }

            function displayCities(cities) {
                cityList.innerHTML = '';
                if (cities.length > 0) {
                    cities.forEach(city => {
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.className = 'list-group-item list-group-item-action';
                        item.textContent = `${city.name}, ${city.country}`;
                        item.addEventListener('click', function() {
                            cityInput.value = city.name;
                            cityList.style.display = 'none';
                        });
                        cityList.appendChild(item);
                    });
                    cityList.style.display = 'block';
                } else {
                    cityList.style.display = 'none';
                }
            }

            // إغلاق قائمة المدن عند النقر خارجها
            document.addEventListener('click', function(e) {
                if (!cityInput.contains(e.target) && !cityList.contains(e.target)) {
                    cityList.style.display = 'none';
                }
            });

            // زر التحديث
            document.getElementById('refreshBtn').addEventListener('click', function() {
                window.location.reload();
            });

            // زر المشاركة
            document.getElementById('shareBtn').addEventListener('click', function() {
                if (navigator.share) {
                    navigator.share({
                        title: 'حالة الطقس',
                        text: 'اطلع على أحدث بيانات الطقس',
                        url: window.location.href
                    }).catch(err => {
                        console.log('Error sharing:', err);
                    });
                } else {
                    alert('ميزة المشاركة غير متاحة في متصفحك. يمكنك نسخ الرابط يدوياً.');
                }
            });
        });
    </script>
</body>
</html>