<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حالة الطقس في عدن - تحديث مباشر</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      :root {
    --primary-color: #1e88e5;
    --secondary-color: #0d47a1;
    --accent-color: #ff9800;
    --light-color: #f5f5f5;
    --dark-color: #212121;
    --sun-color: #FFD700;       /* أصفر ذهبي للشمس */
    --moon-color: #D3D3D3;      /* رمادي فاتح للقمر */
    --cloud-color: #FFFFFF;     /* أبيض للسحب */
    --rain-color: #4682B4;      /* أزرق ممطر */
    --snow-color: #B0E0E6;      /* أزرق ثلجي */
    --lightning-color: #FFD700;  /* أصفر للبرق */
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
                background: linear-gradient(135deg,rgb(196, 222, 235) 0%, #2a5298 100%);
    color: #333;
    min-height: 100vh;
    padding: 20px;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
}

header {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #2c3e50;
}

.last-update {
    color:rgb(240, 243, 243);
    font-size: 0.9rem;
}

.weather-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.current-weather {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.weather-main {
    display: flex;
    align-items: center;
}

.temp {
    font-size: 4rem;
    font-weight: 300;
    margin-right: 20px;
    color: #2c3e50;
}

.weather-icon {
    font-size: 5rem;
    margin-left: 20px;
    color: #B0E0E6;
}

.weather-details {
    flex: 1;
    min-width: 250px;
}

.weather-description {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #34495e;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    color: #2c3e50;
}

.detail-item:last-child {
    border-bottom: none;
}

.forecast-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.forecast-day {
    background: rgba(255, 255, 255, 0.6);
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    backdrop-filter: blur(5px);
}

.forecast-day-name {
    font-weight: bold;
    margin-bottom: 10px;
    color: #2c3e50;
}

.forecast-icon {
    font-size: 2rem;
    margin: 10px 0;
}

.forecast-description {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.forecast-temp {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.max-temp {
    font-weight: bold;
    color: #e74c3c;
}

.min-temp {
    color: #3498db;
}

.refresh-btn {
    background: var(--accent-color);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 1rem;
    cursor: pointer;
    display: block;
    margin: 30px auto;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
}

.refresh-btn:hover {
    background: #f57c00;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
}

/* ألوان أيقونات الطقس */
.fa-sun {
    color: var(--sun-color) !important;
    filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.7));
    animation: sunGlow 2s infinite alternate;
}

.fa-moon {
    color: var(--moon-color) !important;
}

.fa-cloud {
    color: var(--cloud-color) !important;
}

.fa-cloud-sun {
    color: var(--sun-color) !important;
}

.fa-cloud-moon {
    color: var(--moon-color) !important;
}

.fa-cloud-rain, .fa-cloud-showers-heavy {
    color: var(--rain-color) !important;
}

.fa-bolt {
    color: var(--lightning-color) !important;
}

.fa-snowflake {
    color: var(--snow-color) !important;
}

.fa-smog {
    color: #A9A9A9 !important;
}

@keyframes sunGlow {
    0% { transform: scale(1); opacity: 0.9; }
    100% { transform: scale(1.05); opacity: 1; }
}

@media (max-width: 768px) {
    .current-weather {
        flex-direction: column;
        text-align: center;
    }
   
    .weather-main {
        margin-bottom: 20px;
        justify-content: center;
    }
   
    .temp {
        margin-right: 0;
        margin-bottom: 10px;
    }
   
    .weather-icon {
        margin-left: 0;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-cloud-sun"></i> حالة الطقس في عدن</h1>
            <p class="last-update">آخر تحديث: <span id="update-time">--/--/---- --:--:--</span></p>
        </header>
        
        <main>
            <div class="weather-card">
                <div class="current-weather">
                    <div class="weather-main">
                        <div class="temp" id="current-temp">--°C</div>
                        <div class="weather-icon" id="current-icon">
                            <i class="fas fa-question"></i>
                        </div>
                    </div>
                    
                    <div class="weather-details">
                        <div class="weather-description" id="weather-desc">--</div>
                        
                        <div class="detail-item">
                            <span>الرطوبة:</span>
                            <span id="humidity">--%</span>
                        </div>
                        
                        <div class="detail-item">
                            <span>سرعة الرياح:</span>
                            <span id="wind-speed">-- كم/ساعة</span>
                        </div>
                        
                        <div class="detail-item">
                            <span>ضغط الجو:</span>
                            <span id="pressure">-- hPa</span>
                        </div>
                        
                        <div class="detail-item">
                            <span>الشعور الحقيقي:</span>
                            <span id="feels-like">--°C</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="weather-card">
                <h2><i class="fas fa-calendar-alt"></i> توقعات الطقس لخمسة أيام</h2>
                
                <div class="forecast-container" id="forecast-container">
                    <!-- سيتم إضافة توقعات الطقس هنا عبر الجافاسكريبت -->
                </div>
            </div>
            
            <button class="refresh-btn" id="refresh-btn">
                <i class="fas fa-sync-alt"></i> تحديث البيانات
            </button>
        </main>
    </div>

    <script>
        // متغيرات التطبيق
        const API_KEY = 'ad3a94af2d24fab4dbe80d2fd2a0c503'; // استبدل بمفتاح API الخاص بك
        const CITY = 'Aden,YE';
        const UNITS = 'metric';
        const LANG = 'ar';
        
        // عناصر DOM
        const currentTempEl = document.getElementById('current-temp');
        const currentIconEl = document.getElementById('current-icon');
        const weatherDescEl = document.getElementById('weather-desc');
        const humidityEl = document.getElementById('humidity');
        const windSpeedEl = document.getElementById('wind-speed');
        const pressureEl = document.getElementById('pressure');
        const feelsLikeEl = document.getElementById('feels-like');
        const updateTimeEl = document.getElementById('update-time');
        const forecastContainerEl = document.getElementById('forecast-container');
        const refreshBtnEl = document.getElementById('refresh-btn');
        
        // دالة لجلب بيانات الطقس
        async function fetchWeatherData() {
            try {
                // جلب بيانات الطقس الحالية
                const currentResponse = await fetch(
                    `https://api.openweathermap.org/data/2.5/weather?q=${CITY}&units=${UNITS}&lang=${LANG}&appid=${API_KEY}`
                );
                
                if (!currentResponse.ok) {
                    throw new Error('فشل في جلب بيانات الطقس الحالية');
                }
                
                const currentData = await currentResponse.json();
                
                // جلب بيانات توقعات الطقس
                const forecastResponse = await fetch(
                    `https://api.openweathermap.org/data/2.5/forecast?q=${CITY}&units=${UNITS}&lang=${LANG}&appid=${API_KEY}`
                );
                
                if (!forecastResponse.ok) {
                    throw new Error('فشل في جلب بيانات توقعات الطقس');
                }
                
                const forecastData = await forecastResponse.json();
                
                // عرض البيانات
                displayCurrentWeather(currentData);
                displayForecast(forecastData);
                updateLastUpdateTime();
                
            } catch (error) {
                console.error('حدث خطأ:', error);
                alert('حدث خطأ أثناء جلب بيانات الطقس. يرجى المحاولة لاحقًا.');
            }
        }
        
        // دالة لعرض الطقس الحالي
        function displayCurrentWeather(data) {
            currentTempEl.textContent = `${Math.round(data.main.temp)}°C`;
            weatherDescEl.textContent = data.weather[0].description;
            humidityEl.textContent = `${data.main.humidity}%`;
            windSpeedEl.textContent = `${(data.wind.speed * 3.6).toFixed(1)} كم/ساعة`;
            pressureEl.textContent = `${data.main.pressure} hPa`;
            feelsLikeEl.textContent = `${Math.round(data.main.feels_like)}°C`;
            
            // تحديد الأيقونة المناسبة
            const iconCode = data.weather[0].icon;
            const iconClass = getWeatherIconClass(iconCode);
            currentIconEl.innerHTML = `<i class="fas ${iconClass}"></i>`;
        }
        
        // دالة لعرض توقعات الطقس
        function displayForecast(data) {
            // تصفية البيانات للحصول على توقعات يومية (واحدة لكل يوم)
            const dailyForecasts = [];
            const daysAdded = new Set();
            
            data.list.forEach(item => {
                const date = new Date(item.dt * 1000);
                const day = date.toLocaleDateString('ar-AR', { weekday: 'long' });
                
                if (!daysAdded.has(day) && date.getHours() === 12) {
                    daysAdded.add(day);
                    dailyForecasts.push({
                        day,
                        icon: item.weather[0].icon,
                        temp_max: Math.round(item.main.temp_max),
                        temp_min: Math.round(item.main.temp_min),
                        description: item.weather[0].description
                    });
                }
            });
            
            // عرض توقعات الطقس
            forecastContainerEl.innerHTML = dailyForecasts.map(forecast => `
                <div class="forecast-day">
                    <div class="forecast-day-name">${forecast.day}</div>
                    <div class="forecast-icon">
                        <i class="fas ${getWeatherIconClass(forecast.icon)}"></i>
                    </div>
                    <div class="forecast-description">${forecast.description}</div>
                    <div class="forecast-temp">
                        <span class="max-temp">${forecast.temp_max}°</span>
                        <span class="min-temp">${forecast.temp_min}°</span>
                    </div>
                </div>
            `).join('');
        }
        
        // دالة لتحديث وقت آخر تحديث
        function updateLastUpdateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            
            updateTimeEl.textContent = now.toLocaleDateString('ar-AR', options);
        }
        
        // دالة للحصول على أيقونة الطقس المناسبة
        function getWeatherIconClass(iconCode) {
            const iconMap = {
                '01d': 'fa-sun',
                '01n': 'fa-moon',
                '02d': 'fa-cloud-sun',
                '02n': 'fa-cloud-moon',
                '03d': 'fa-cloud',
                '03n': 'fa-cloud',
                '04d': 'fa-cloud-meatball',
                '04n': 'fa-cloud-meatball',
                '09d': 'fa-cloud-rain',
                '09n': 'fa-cloud-rain',
                '10d': 'fa-cloud-sun-rain',
                '10n': 'fa-cloud-moon-rain',
                '11d': 'fa-bolt',
                '11n': 'fa-bolt',
                '13d': 'fa-snowflake',
                '13n': 'fa-snowflake',
                '50d': 'fa-smog',
                '50n': 'fa-smog'
            };
            
            return iconMap[iconCode] || 'fa-question';
        }
        
        // حدث النقر على زر التحديث
        refreshBtnEl.addEventListener('click', fetchWeatherData);
        
        // جلب البيانات عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', fetchWeatherData);
        
        // تحديث البيانات كل 30 دقيقة تلقائيًا
        setInterval(fetchWeatherData, 30 * 60 * 1000);
    </script>
</body>
</html>
