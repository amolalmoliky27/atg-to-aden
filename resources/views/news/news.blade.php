@extends('layouts.navbar')

@section('content')
<style>
    @font-face {
        font-family: 'Cairo';
        src: url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
    }

    * {
        font-family: 'Cairo', sans-serif;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f9fafb;
    }

    main {
        flex: 1;
    }

    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .category-tab {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .category-tab:hover {
        transform: scale(1.05);
    }

    .active-tab {
        background-color: #1E40AF !important;
        color: white !important;
    }

    .news-image-container {
        height: 220px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #1e40af0d 0%, #0f766e0d 100%);
    }

    .news-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease, opacity 0.5s ease;
        opacity: 0;
    }

    .news-image.loaded {
        opacity: 1;
    }

    .news-card:hover .news-image {
        transform: scale(1.05);
    }

    .news-content {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .footer-gradient {
        background: linear-gradient(90deg, rgba(33, 4, 164, 1) 0%, rgba(24, 14, 130, 0.8) 100%);
    }

    /* شريط الأخبار المتحرك المحسن */
    .news-ticker-container {
        position: relative;
        overflow: hidden;
    }

    .news-ticker {
        display: flex;
        animation: scroll-ticker 15s linear infinite;
        white-space: nowrap;
    }

    .news-ticker-content {
        white-space: nowrap;
        font-weight: 500;
        font-size: 1.1rem;
        line-height: 1.6;
        display: flex;
        align-items: center;
    }

    .news-item {
        display: inline-block;
        margin-left: 50vw;
    }

    @keyframes scroll-ticker {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* إضافة إيقاف مؤقت عند التحويم */
    .news-ticker-container:hover .news-ticker {
        animation-play-state: paused;
    }

    @media (max-width: 768px) {
        .news-card {
            flex-direction: column;
        }

        .filter-container {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 8px 0;
        }

        .filter-btn {
            flex-shrink: 0;
            padding: 8px 16px;
            font-size: 0.875rem;
        }

        .news-image-container {
            height: 180px;
        }

        /* تحسين للشاشات الصغيرة */
        .news-ticker-content {
            font-size: 1rem;
        }
    }

    .loader {
        width: 48px;
        height: 48px;
        border: 5px solid #1E40AF;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .error-container {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        padding: 20px;
        border-radius: 10px;
        color: white;
        text-align: center;
        margin: 20px 0;
        display: none;
    }

    .image-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1e40af0d 0%, #0f766e0d 100%);
        color: #1E40AF;
        padding: 20px;
        text-align: center;
        z-index: 5;
    }

    .image-placeholder i {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .image-placeholder p {
        font-size: 14px;
        font-weight: 600;
    }

    .image-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.7);
        z-index: 10;
    }

    .category-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 20;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .skeleton-loader {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 8px;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .skeleton-image {
        height: 100%;
        width: 100%;
        background-color: #e0e0e0;
    }
</style>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'arabic': ['Cairo', 'sans-serif'],
                },
                colors: {
                    primary: '#1E40AF',
                    accent: '#0F766E'
                }
            }
        }
    }
</script>

<body class="min-h-screen flex flex-col">
    <main class="max-w-7xl mx-auto px-4 py-8 flex-grow">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                <i class="fas fa-newspaper text-primary mr-2"></i>
                اكتشف آخر الأخبار والمستجدات في مدينة عدن الساحلية
            </h1>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
        </div>

        <!-- News Ticker المحسن -->
        <div class="bg-primary text-white py-4 news-ticker-container rounded-xl mb-6 shadow-lg">
            <div class="news-ticker">
                <div class="news-ticker-content">
                    <div class="news-item">ملاحظة: يُرجى الاتصال بالإنترنت لضمان عرض المحتوى بشكل صحيح</div>
                    <div class="news-item">ملاحظة: يُرجى الاتصال بالإنترنت لضمان عرض المحتوى بشكل صحيح</div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-full p-2 shadow-lg filter-container">
                <div class="flex flex-wrap justify-center gap-2">
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium bg-primary text-white active-tab"
                        data-filter="all">الكل</button>
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-100"
                        data-filter="سياحة">سياحة</button>
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-100"
                        data-filter="فعاليات">فعاليات</button>
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-100"
                        data-filter="ثقافة">ثقافة</button>
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-100"
                        data-filter="تراث">تراث</button>
                    <button class="category-tab filter-btn px-6 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-100"
                        data-filter="تطوير">تطوير</button>
                </div>
            </div>
        </div>

        <!-- رسالة التحميل -->
        <div id="loadingMessage" class="text-center py-12">
            <div class="loader mx-auto"></div>
            <p class="mt-4 text-gray-600">جاري تحميل الأخبار من قاعدة البيانات...</p>
        </div>

        <!-- رسالة عدم وجود أخبار -->
        <div id="noNewsMessage" class="text-center py-12 hidden">
            <div class="bg-gray-100 p-8 rounded-xl max-w-md mx-auto">
                <i class="fas fa-newspaper text-5xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">لا توجد أخبار متاحة</h3>
                <p class="text-gray-500 mt-2">
                    لم يتم إضافة أي أخبار في هذه الفئة بعد
                </p>
            </div>
        </div>

        <!-- رسالة الخطأ -->
        <div id="errorMessage" class="text-center py-12 hidden">
            <div class="bg-red-50 p-8 rounded-xl max-w-md mx-auto">
                <i class="fas fa-exclamation-triangle text-5xl text-red-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">حدث خطأ أثناء جلب البيانات</h3>
                <p class="text-gray-500 mt-2" id="errorText">
                    تعذر جلب الأخبار من قاعدة البيانات. يرجى المحاولة لاحقاً
                </p>
                <button id="retryButton" class="mt-4 bg-primary hover:bg-blue-800 text-white px-6 py-2 rounded-full font-medium transition-colors">
                    إعادة المحاولة
                </button>
            </div>
        </div>

        <!-- عرض الأخبار -->
        <div class="max-w-4xl mx-auto space-y-6" id="newsContainer">
            <!-- سيتم تعبئتها بواسطة الجافاسكريبت -->
        </div>

        <div class="text-center mt-12 hidden" id="loadMoreContainer">
            <button id="loadMoreBtn" class="load-more-btn bg-primary hover:bg-blue-800 text-white px-8 py-3 rounded-full font-semibold transition-colors duration-300 shadow-lg hover:shadow-xl">
                عرض المزيد من الأخبار
            </button>
        </div>
    </main>


    <script>
        // متغيرات التطبيق
        let currentFilter = 'all';
        let currentPage = 1;
        const newsPerPage = 5;
        const DEFAULT_IMAGE = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%231E40AF' opacity='0.1'/%3E%3Ccircle cx='200' cy='150' r='80' fill='%231E40AF' opacity='0.2'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Cairo' font-size='24' fill='%231E40AF'%3Eأخبار عدن%3C/text%3E%3C/svg%3E";

        // عناصر DOM
        const newsContainer = document.getElementById('newsContainer');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const noNewsMessage = document.getElementById('noNewsMessage');
        const loadingMessage = document.getElementById('loadingMessage');
        const errorMessage = document.getElementById('errorMessage');
        const errorText = document.getElementById('errorText');
        const retryButton = document.getElementById('retryButton');

        // دالة لمعالجة مسار الصورة - الإصدار المحسن
        function getImageUrl(imagePath) {
            // إذا لم يكن هناك مسار للصورة، نعيد الصورة الافتراضية
            if (!imagePath || imagePath.trim() === "") {
                return DEFAULT_IMAGE;
            }

            // إذا كان الرابط يبدأ بـ http أو https أو //
            if (/^(https?:)?\/\//i.test(imagePath)) {
                return imagePath;
            }

            // في الحالات الأخرى، نعتبر أن الصورة في مجلد التخزين (storage)
            return '/storage/' + imagePath;
        }

        // دالة لجلب الأخبار من قاعدة البيانات
        function fetchNews(category, page) {
            showLoading();

            // إعداد رأس الطلب مع CSRF Token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // إرسال الطلب إلى API
            return fetch(`/api/news?category=${encodeURIComponent(category)}&page=${page}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('فشل جلب البيانات: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (Array.isArray(data)) {
                        return data; // هذا يتعامل مع المصفوفة المباشرة من API
                    } else if (data && Array.isArray(data.data)) {
                        return data.data;
                    } else if (data && Array.isArray(data.news)) {
                        return data.news;
                    } else {
                        throw new Error('هيكل البيانات غير متوقع');
                    }
                })

                .catch(error => {
                    console.error('حدث خطأ:', error);
                    showError('حدث خطأ أثناء جلب الأخبار: ' + error.message);
                    return [];
                })
                .finally(() => {
                    hideLoading();
                });
        }

        // دالة لتحميل الصورة بشكل متدرج
        function loadImageWithTransition(imgElement) {
            const container = imgElement.parentElement;
            const loadingIndicator = container.querySelector('.image-loading');

            // إظهار مؤشر التحميل
            if (loadingIndicator) {
                loadingIndicator.style.display = 'flex';
            }

            // إنشاء نسخة من الصورة لاختبار تحميلها
            const testImage = new Image();
            testImage.src = imgElement.src;

            testImage.onload = function() {
                // إخفاء مؤشر التحميل
                if (loadingIndicator) {
                    loadingIndicator.style.display = 'none';
                }

                // إظهار الصورة بتأثير متدرج
                imgElement.classList.add('loaded');
            };

            testImage.onerror = function() {
                // إخفاء مؤشر التحميل
                if (loadingIndicator) {
                    loadingIndicator.style.display = 'none';
                }

                // إظهار الصورة الافتراضية
                imgElement.src = DEFAULT_IMAGE;
                imgElement.classList.add('loaded');
            };
        }

        // دالة لعرض الأخبار
        function renderNews(newsArray) {
            hideMessages();

            if (currentPage === 1) {
                newsContainer.innerHTML = '';
            }

            if (!newsArray || newsArray.length === 0) {
                if (currentPage === 1) {
                    noNewsMessage.classList.remove('hidden');
                }
                loadMoreContainer.classList.add('hidden');
                return;
            }

            // عرض الأخبار
            newsArray.forEach(item => {
                let categoryColor = '';
                switch (item.category) {
                    case 'سياحة':
                        categoryColor = 'bg-blue-600';
                        break;
                    case 'تراث':
                        categoryColor = 'bg-amber-600';
                        break;
                    case 'فعاليات':
                        categoryColor = 'bg-green-600';
                        break;
                    case 'ثقافة':
                        categoryColor = 'bg-purple-600';
                        break;
                    case 'تطوير':
                        categoryColor = 'bg-indigo-600';
                        break;
                    default:
                        categoryColor = 'bg-gray-600';
                }

                // تنسيق التاريخ
                let dateTime = 'غير محدد';
                if (item.created_at) {
                    try {
                        const newsDate = new Date(item.created_at);
                        dateTime = newsDate.toLocaleDateString('ar-EG', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        console.error('خطأ في تنسيق التاريخ:', e);
                    }
                }

                // الحصول على مسار الصورة باستخدام الدالة المساعدة
                const imageSrc = getImageUrl(item.image);

                // إنشاء بطاقة الخبر
                const newsCard = document.createElement('article');
                newsCard.className = 'news-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6';
                newsCard.dataset.category = item.category || '';

                newsCard.innerHTML = `
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 news-image-container">
                            <div class="image-loading">
                                <div class="loader" style="width: 32px; height: 32px;"></div>
                            </div>
                            <img src="${imageSrc}" alt="${item.title || 'خبر عدن'}" 
                                class="w-full h-full news-image">
                            <div class="category-badge ${categoryColor}">
                                ${item.category || 'عام'}
                            </div>
                        </div>
                        <div class="md:w-2/3 p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">
                                ${item.title || 'عنوان الخبر'}
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed news-content">
                                ${item.content || 'محتوى الخبر غير متوفر'}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-gray-500 text-sm">
                                    <span class="ml-1">📍</span>
                                    <span>${item.location || 'عدن'}</span>
                                </div>
                                <span class="text-primary font-semibold text-sm">${dateTime}</span>
                            </div>
                        </div>
                    </div>
                `;

                newsContainer.appendChild(newsCard);

                // معالجة تحميل الصورة بعد إضافة البطاقة
                const imgElement = newsCard.querySelector('img');
                if (imgElement) {
                    // إضافة حدث خطأ مباشر على الصورة
                    imgElement.onerror = function() {
                        this.src = DEFAULT_IMAGE;
                        this.onerror = null; // لمنع التكرار في حالة فشل الصورة الافتراضية
                    };

                    // تحميل الصورة مع تأثير الانتقال
                    loadImageWithTransition(imgElement);
                }
            });

            if (newsArray.length >= newsPerPage) {
                loadMoreContainer.classList.remove('hidden');
            } else {
                loadMoreContainer.classList.add('hidden');
            }
        }

        // دالة لتحديد التبويب النشط
        function updateActiveTab(filter) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white', 'active-tab');
                btn.classList.add('text-gray-600', 'hover:bg-gray-100');

                if (btn.dataset.filter === filter) {
                    btn.classList.add('bg-primary', 'text-white', 'active-tab');
                    btn.classList.remove('text-gray-600', 'hover:bg-gray-100');
                }
            });
        }

        // دالة لتحميل المزيد من الأخبار
        function loadMoreNews() {
            loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> جاري التحميل...';
            loadMoreBtn.disabled = true;

            currentPage++;
            fetchNews(currentFilter, currentPage)
                .then(news => renderNews(news))
                .finally(() => {
                    loadMoreBtn.innerHTML = 'عرض المزيد من الأخبار';
                    loadMoreBtn.disabled = false;
                });
        }

        // دالة لتغيير الفئة
        function changeCategory(filter) {
            currentFilter = filter;
            currentPage = 1;
            updateActiveTab(filter);
            fetchNews(filter, currentPage)
                .then(news => renderNews(news));
        }

        // دالة لإظهار رسالة التحميل
        function showLoading() {
            loadingMessage.classList.remove('hidden');
            noNewsMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            newsContainer.classList.add('hidden');
            loadMoreContainer.classList.add('hidden');
        }

        // دالة لإخفاء رسالة التحميل
        function hideLoading() {
            loadingMessage.classList.add('hidden');
            newsContainer.classList.remove('hidden');
        }

        // دالة لإظهار رسالة الخطأ
        function showError(message) {
            errorText.textContent = message || 'حدث خطأ غير متوقع';
            errorMessage.classList.remove('hidden');
            noNewsMessage.classList.add('hidden');
            loadingMessage.classList.add('hidden');
            newsContainer.classList.add('hidden');
        }

        // دالة لإخفاء جميع الرسائل
        function hideMessages() {
            noNewsMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
        }

        // تهيئة التطبيق عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // أحداث أزرار التبويب
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    changeCategory(this.dataset.filter);
                });
            });

            // حدث زر إعادة المحاولة
            retryButton.addEventListener('click', function() {
                changeCategory(currentFilter);
            });

            // حدث زر تحميل المزيد
            loadMoreBtn.addEventListener('click', loadMoreNews);

            // جلب الأخبار الأولية
            fetchNews(currentFilter, currentPage)
                .then(news => renderNews(news))
                .then(() => updateActiveTab(currentFilter));
        });
    </script>
</body>
@endsection