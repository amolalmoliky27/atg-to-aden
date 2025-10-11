<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أخبار مدينة عدن الساحلية - لوحة التحكم</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap');

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f3f4f6;
            color: #1f2937;
        }

        * {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background: #5D5CDE;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #4c4bc7;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: #ecc94b;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: #d69e2e;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e53e3e;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #c53030;
            transform: translateY(-2px);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #5D5CDE;
            box-shadow: 0 0 0 3px rgba(93, 92, 222, 0.1);
        }

        .admin-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(93, 92, 222, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            z-index: 10;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateX(150%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .toast.error {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
        }

        .toast.warning {
            background: linear-gradient(135deg, #ecc94b 0%, #d69e2e 100%);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .no-image-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            border-radius: 8px;
        }

        .optional-label {
            color: #718096;
            font-size: 0.875rem;
            margin-right: 0.5rem;
        }

        .section-transition {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .news-card {
            border-left: 4px solid #5D5CDE;
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateX(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-action {
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: scale(1.05);
        }

        .image-upload-container {
            border: 2px dashed #cbd5e0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .image-upload-container:hover {
            border-color: #5D5CDE;
            background-color: rgba(93, 92, 222, 0.05);
        }

        .loading-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .no-results-container {
            text-align: center;
            padding: 40px 20px;
            background-color: #f8fafc;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .no-results-icon {
            font-size: 64px;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .no-results-title {
            font-size: 24px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
        }

        .no-results-text {
            font-size: 16px;
            color: #64748b;
            max-width: 500px;
            margin: 0 auto;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .current-image-container {
            position: relative;
            display: inline-block;
            margin-top: 15px;
        }

        .current-image {
            max-width: 300px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
        }

        .remove-current-image {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(229, 62, 62, 0.9);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .remove-current-image:hover {
            transform: scale(1.1);
            background: rgba(229, 62, 62, 1);
        }

        .custom-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
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

        .news-item-ticker {
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

        /* تحسين للشاشات الصغيرة */
        @media (max-width: 768px) {
            .news-ticker-content {
                font-size: 1rem;
            }
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">
    <div id="toastContainer"></div>
    <div class="admin-badge"><i class="fas fa-user-shield mr-2"></i>مسؤول النظام</div>

    <header class="gradient-bg text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">لوحة تحكم أخبار مدينة عدن الساحلية</h1>
            <div class="w-20 h-1 bg-white mx-auto mb-6"></div>

            <!-- News Ticker المحسن -->
            <div class="bg-white bg-opacity-20 text-white py-3 news-ticker-container rounded-xl shadow-lg max-w-4xl mx-auto">
                <div class="news-ticker">
                    <div class="news-ticker-content">
                        <div class="news-item-ticker">ملاحظة: يُرجى الاتصال بالإنترنت لضمان عرض المحتوى بشكل صحيح</div>
                        <div class="news-item-ticker">ملاحظة: يُرجى الاتصال بالإنترنت لضمان عرض المحتوى بشكل صحيح</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-gray-800 py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-center space-x-6">
                <button id="addNewsTab" class="text-white px-4 py-2 rounded-lg bg-primary">
                    <i class="fas fa-plus-circle mr-2"></i>إضافة خبر جديد
                </button>
                <button id="manageNewsTab" class="text-white px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600">
                    <i class="fas fa-list mr-2"></i>إدارة الأخبار
                </button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-12">
        <div id="addNewsSection" class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 section-transition">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">إضافة خبر جديد</h2>
                <p class="text-gray-600">املأ النموذج أدناه لإضافة خبر جديد</p>
            </div>

            <form id="newsForm" enctype="multipart/form-data">
                <input type="hidden" id="newsId" name="id" value="">
                <input type="hidden" id="deleteImageFlag" name="delete_image" value="0">
                <input type="hidden" id="currentImagePath" name="current_image" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="newsTitle" class="block text-sm font-medium text-gray-700 mb-3">
                            <span class="flex items-center gap-2">📝 عنوان الخبر<span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" id="newsTitle" name="title" class="form-input w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none bg-white text-gray-900 text-base" placeholder="أدخل عنوان الخبر" required>
                    </div>
                    <div>
                        <label for="newsCategory" class="block text-sm font-medium text-gray-700 mb-3">
                            <span class="flex items-center gap-2">🏷️ التصنيف<span class="text-red-500">*</span></span>
                        </label>
                        <select id="newsCategory" name="category" class="form-input w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none bg-white text-gray-900 text-base" required>
                            <option value="">اختر التصنيف</option>
                            <option value="سياحة">🏖️ سياحة</option>
                            <option value="فعاليات">🎭 فعاليات</option>
                            <option value="ثقافة">🎨 ثقافة</option>
                            <option value="تراث">🏛️ تراث</option>
                            <option value="تطوير">🏗️ تطوير</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="newsContent" class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="flex items-center gap-2">📄 محتوى الخبر<span class="text-red-500">*</span></span>
                    </label>
                    <textarea id="newsContent" name="content" rows="8" class="form-input w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none bg-white text-gray-900 text-base resize-y" placeholder="أدخل تفاصيل الخبر بشكل مفصل..." required></textarea>
                </div>

                <div>
                    <label for="newsImage" class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="flex items-center gap-2">🖼️ صورة الخبر<span class="optional-label">(اختياري)</span></span>
                    </label>
                    <div class="image-upload-container">
                        <input type="file" id="newsImage" name="image" accept="image/*" class="form-input w-full px-4 py-4 border-0 rounded-xl focus:outline-none bg-transparent text-gray-900 text-base file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary/90">

                        <div class="mt-4">
                            <div id="imagePreview" class="hidden relative">
                                <img id="previewImg" src="" alt="معاينة الصورة" class="w-full max-w-md mx-auto rounded-lg shadow-md">
                                <button type="button" id="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors btn-action">✕</button>
                            </div>
                        </div>

                        <div id="currentImagePreview" class="mt-4 text-center"></div>
                    </div>
                </div>

                <div>
                    <label for="newsLocation" class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="flex items-center gap-2">📍 الموقع<span class="text-red-500">*</span></span>
                    </label>
                    <input type="text" id="newsLocation" name="location" class="form-input w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none bg-white text-gray-900 text-base" placeholder="مثل: شاطئ الذهبي، قلعة صيرة..." required>
                </div>

                <div>
                    <label for="newsAuthor" class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="flex items-center gap-2">✍️ اسم الكاتب<span class="optional-label">(اختياري)</span></span>
                    </label>
                    <input type="text" id="newsAuthor" name="author" class="form-input w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none bg-white text-gray-900 text-base" placeholder="أدخل اسم كاتب الخبر">
                </div>

                <div class="flex justify-center gap-4 pt-6">
                    <button type="submit" id="submitBtn" class="btn-primary text-white px-12 py-4 rounded-xl font-medium text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                        <span class="flex items-center gap-2"><i class="fas fa-paper-plane"></i> نشر الخبر</span>
                    </button>
                    <button type="submit" id="updateBtn" class="hidden btn-warning text-white px-12 py-4 rounded-xl font-medium text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                        <span class="flex items-center gap-2"><i class="fas fa-save"></i> تحديث الخبر</span>
                    </button>
                    <button type="button" id="cancelBtn" class="hidden bg-gray-500 text-white px-12 py-4 rounded-xl font-medium text-lg shadow-lg hover:bg-gray-600 transition-all duration-300">
                        <span class="flex items-center gap-2"><i class="fas fa-times"></i> إلغاء</span>
                    </button>
                </div>
            </form>
        </div>

        <div id="manageNewsSection" class="hidden max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-8 section-transition">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">إدارة الأخبار</h2>
                <p class="text-gray-600">إدارة الأخبار المنشورة وتعديلها أو حذفها</p>
            </div>

            <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-64">
                    <input type="text" id="searchNews" placeholder="ابحث عن خبر..." class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary text-base">
                    <i class="fas fa-search absolute right-3 top-3.5 text-gray-400"></i>
                </div>
                <div class="w-full md:w-auto">
                    <select id="filterCategory" class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary text-base">
                        <option value="all">جميع التصنيفات</option>
                        <option value="سياحة">🏖️ سياحة</option>
                        <option value="فعاليات">🎭 فعاليات</option>
                        <option value="ثقافة">🎨 ثقافة</option>
                        <option value="تراث">🏛️ تراث</option>
                        <option value="تطوير">🏗️ تطوير</option>
                    </select>
                </div>
            </div>

            <div class="py-6" id="newsListContainer">
                <div class="text-center py-12">
                    <i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i>
                    <p class="mt-4 text-gray-600">جاري تحميل الأخبار...</p>
                </div>
            </div>

            <div id="noResultsMessage" class="hidden no-results-container">
                <div class="no-results-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="no-results-title">لا توجد نتائج</h3>
                <p class="no-results-text">لم يتم العثور على أي أخبار تطابق بحثك. حاول تغيير كلمات البحث أو التصنيف.</p>
            </div>
        </div>
    </main>

    <footer class="text-white py-8 mt-16" style="background: #705bb3; background: linear-gradient(90deg, rgba(95, 53, 233, 1) 0%, rgba(21, 22, 22, 1) 100%);">
        <div class="container mx-auto px-4 text-center">
            <p class="text-white flex flex-col md:flex-row justify-center items-center gap-2 md:gap-4">
                <span>أخبار مدينة عدن الساحلية</span>
                <span><i>BY MANAL FROM WEB PIONEER 2025</i>©</span>
            </p>
        </div>
    </footer>

    <script>
        // ==========================================
        // الإعدادات العامة
        // ==========================================
        const API_BASE_URL = window.location.origin;
        const DEFAULT_IMAGE = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%235d5cde' opacity='0.1'/%3E%3Ccircle cx='200' cy='150' r='80' fill='%235d5cde' opacity='0.2'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Cairo' font-size='20' fill='%235d5cde'%3Eأخبار عدن%3C/text%3E%3C/svg%3E";
        let currentFormMode = 'add';
        let currentImage = '';

        // ==========================================
        // تهيئة التطبيق عند تحميل الصفحة
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            try {
                setupEventListeners();
                loadNewsItems();
            } catch (error) {
                console.error('Initialization failed:', error);
                showToast('حدث خطأ في تهيئة التطبيق', 'error');
            }
        });

        // ==========================================
        // إعداد المستمعين للأحداث
        // ==========================================
        function setupEventListeners() {
            // التحويل بين تبويبات الإضافة والإدارة
            document.getElementById('addNewsTab').addEventListener('click', function() {
                showAddNewsSection();
                resetForm();
            });
            document.getElementById('manageNewsTab').addEventListener('click', function() {
                showManageNewsSection();
                loadNewsItems();
            });

            // معالجة تحميل الصورة
            document.getElementById('newsImage').addEventListener('change', handleImageUpload);
            document.getElementById('removeImage').addEventListener('click', removeImagePreview);

            // معالجة النموذج
            document.getElementById('newsForm').addEventListener('submit', function(e) {
                e.preventDefault();
                if (currentFormMode === 'add') addNews();
                else updateNews();
            });

            // معالجة الإلغاء
            document.getElementById('cancelBtn').addEventListener('click', function() {
                resetForm();
                showAddNewsSection();
            });

            // البحث والتصفية
            document.getElementById('searchNews').addEventListener('input', filterNewsItems);
            document.getElementById('filterCategory').addEventListener('change', filterNewsItems);
        }

        // ==========================================
        // وظائف التحكم بالواجهة
        // ==========================================
        function showAddNewsSection() {
            document.getElementById('addNewsSection').classList.remove('hidden');
            document.getElementById('manageNewsSection').classList.add('hidden');
            document.getElementById('addNewsTab').classList.add('bg-primary');
            document.getElementById('manageNewsTab').classList.remove('bg-primary');
            document.getElementById('manageNewsTab').classList.add('bg-gray-700');
        }

        function showManageNewsSection() {
            document.getElementById('manageNewsSection').classList.remove('hidden');
            document.getElementById('addNewsSection').classList.add('hidden');
            document.getElementById('manageNewsTab').classList.add('bg-primary');
            document.getElementById('addNewsTab').classList.remove('bg-primary');
            document.getElementById('addNewsTab').classList.add('bg-gray-700');
        }

        // ==========================================
        // معالجة الصور
        // ==========================================
        function handleImageUpload(e) {
            const file = e.target.files[0];
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                showToast('حجم الصورة يجب أن يكون أقل من 5 ميجا بايت', 'error');
                e.target.value = '';
                return;
            }

            if (!file.type.match('image.*')) {
                showToast('يرجى اختيار صورة صالحة', 'error');
                e.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('deleteImageFlag').value = '0';
            };
            reader.readAsDataURL(file);
        }

        function removeImagePreview() {
            document.getElementById('newsImage').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('previewImg').src = '';
            showToast('تم إزالة معاينة الصورة الجديدة', 'warning');
        }

        // ==========================================
        // إدارة الأخبار
        // ==========================================
        function loadNewsItems() {
            const container = document.getElementById('newsListContainer');
            container.innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i><p class="mt-4 text-gray-600">جاري تحميل الأخبار...</p></div>';

            fetch(`${API_BASE_URL}/admin/news/data`)

                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    const newsItems = Array.isArray(data) ? data : (data.data || data.news || []);
                    renderNewsItems(newsItems);
                })
                .catch(error => {
                    console.error('Error loading news:', error);
                    container.innerHTML = `
                        <div class="no-results-container">
                            <div class="no-results-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h3 class="no-results-title">خطأ في جلب البيانات</h3>
                            <p class="no-results-text">حدث خطأ أثناء محاولة جلب الأخبار. يرجى المحاولة مرة أخرى.</p>
                        </div>
                    `;
                    showToast('حدث خطأ أثناء جلب الأخبار', 'error');
                });
        }

        function renderNewsItems(newsItems) {
            const container = document.getElementById('newsListContainer');
            const noResultsMessage = document.getElementById('noResultsMessage');

            if (!newsItems || newsItems.length === 0) {
                container.innerHTML = `
                    <div class="no-results-container">
                        <div class="no-results-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3 class="no-results-title">لا توجد أخبار</h3>
                        <p class="no-results-text">قم بإضافة خبر جديد من لوحة التحكم</p>
                    </div>
                `;
                noResultsMessage.classList.add('hidden');
                return;
            }

            let newsHTML = '';
            newsItems.forEach(item => {
                const date = new Date(item.created_at);
                const formattedDateTime = date.toLocaleString('ar-EG', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });

                const categoryColor = getCategoryColorClass(item.category);

                // حل مشكلة الصورة
                const imageUrl = item.image ? `/storage/${item.image}` : DEFAULT_IMAGE;

                newsHTML += `
                <div class="news-item bg-white rounded-xl shadow-md mb-6 p-6 fade-in news-card" data-category="${item.category}">
                    <div class="flex flex-col md:flex-row items-start gap-6">
                        <div class="md:w-1/4 flex items-center justify-center">
                            <img src="${imageUrl}" alt="${item.title}" class="w-full h-48 object-cover rounded-lg">
                        </div>
                        <div class="md:w-3/4">
                            <div class="flex flex-col md:flex-row justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 md:mb-0">${item.title}</h3>
                                <span class="px-3 py-1 rounded-full text-xs font-medium ${categoryColor} text-white">${item.category}</span>
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-2">${item.content}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="flex items-center text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-1"></i> ${item.location}</span>
                                <span class="flex items-center text-sm text-gray-500"><i class="fas fa-user mr-1"></i> ${item.author || 'مجهول'}</span>
                                <span class="flex items-center text-sm text-gray-500"><i class="fas fa-clock mr-1"></i> ${formattedDateTime}</span>
                            </div>
                            <div class="flex gap-3">
                                <button onclick="editNewsItem(${item.id})" class="btn-primary text-white px-4 py-2 rounded-lg text-sm btn-action"><i class="fas fa-edit mr-1"></i> تعديل</button>
                                <button onclick="deleteNewsItem(${item.id})" class="btn-danger text-white px-4 py-2 rounded-lg text-sm btn-action"><i class="fas fa-trash mr-1"></i> حذف</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            container.innerHTML = newsHTML;
            noResultsMessage.classList.add('hidden');
        }

        function getCategoryColorClass(category) {
            switch (category) {
                case 'سياحة':
                    return 'bg-blue-600';
                case 'تراث':
                    return 'bg-amber-600';
                case 'فعاليات':
                    return 'bg-green-600';
                case 'ثقافة':
                    return 'bg-purple-600';
                case 'تطوير':
                    return 'bg-indigo-600';
                default:
                    return 'bg-gray-600';
            }
        }

        function filterNewsItems() {
            const searchTerm = document.getElementById('searchNews').value.toLowerCase();
            const filterValue = document.getElementById('filterCategory').value;
            const newsItems = document.querySelectorAll('.news-item');
            const noResultsMessage = document.getElementById('noResultsMessage');

            let visibleCount = 0;

            newsItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const content = item.querySelector('p').textContent.toLowerCase();
                const category = item.getAttribute('data-category');
                const matchesSearch = title.includes(searchTerm) || content.includes(searchTerm);
                const matchesCategory = filterValue === 'all' || category === filterValue;
                const isVisible = (matchesSearch && matchesCategory);

                item.style.display = isVisible ? 'block' : 'none';
                if (isVisible) visibleCount++;
            });

            noResultsMessage.classList.toggle('hidden', visibleCount > 0);
        }

        // ==========================================
        // وظائف التعديل على الأخبار
        // ==========================================
        function editNewsItem(id) {
            fetch(`${API_BASE_URL}/api/news/${id}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(item => {
                    currentImage = item.image || '';
                    document.getElementById('currentImagePath').value = currentImage;
                    document.getElementById('newsId').value = item.id;
                    document.getElementById('newsTitle').value = item.title;
                    document.getElementById('newsCategory').value = item.category;
                    document.getElementById('newsContent').value = item.content;
                    document.getElementById('newsLocation').value = item.location;
                    document.getElementById('newsAuthor').value = item.author || '';

                    const currentImagePreview = document.getElementById('currentImagePreview');
                    if (item.image) {
                        currentImagePreview.innerHTML = `
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">الصورة الحالية:</p>
                                <div class="current-image-container">
                                    <img src="/storage/${item.image}" class="current-image">
                                    <div class="remove-current-image" onclick="removeCurrentImage()">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else {
                        currentImagePreview.innerHTML = '<p class="text-gray-500">لا توجد صورة حالية</p>';
                    }

                    document.getElementById('imagePreview').classList.add('hidden');
                    document.getElementById('submitBtn').classList.add('hidden');
                    document.getElementById('updateBtn').classList.remove('hidden');
                    document.getElementById('cancelBtn').classList.remove('hidden');
                    currentFormMode = 'edit';
                    document.getElementById('deleteImageFlag').value = '0';

                    showAddNewsSection();
                })
                .catch(error => {
                    showToast('حدث خطأ أثناء جلب تفاصيل الخبر', 'error');
                });
        }

        function removeCurrentImage() {
            document.getElementById('deleteImageFlag').value = '1';
            document.getElementById('currentImagePreview').innerHTML = '<p class="text-gray-500">تم حذف الصورة الحالية</p>';
            showToast('سيتم حذف الصورة عند التحديث', 'warning');
        }

        // ==========================================
        // وظائف الإضافة والتحديث
        // ==========================================
        function addNews() {
            const submitBtn = document.getElementById('submitBtn');
            const originalBtnContent = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading-indicator"></span> جاري النشر...';

            const formData = new FormData(document.getElementById('newsForm'));
            formData.append('_method', 'POST');

            fetch(`${API_BASE_URL}/api/news`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    showToast('تم إضافة الخبر بنجاح', 'success');
                    resetForm();
                    loadNewsItems();
                    showManageNewsSection();
                })
                .catch(error => {
                    showToast('حدث خطأ أثناء إضافة الخبر: ' + error.message, 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                });
        }

        function updateNews() {
            const updateBtn = document.getElementById('updateBtn');
            const originalBtnContent = updateBtn.innerHTML;
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<span class="loading-indicator"></span> جاري التحديث...';

            const id = document.getElementById('newsId').value;
            const formData = new FormData(document.getElementById('newsForm'));
            formData.append('_method', 'PUT');

            fetch(`${API_BASE_URL}/api/news/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    showToast('تم تحديث الخبر بنجاح', 'success');
                    resetForm();
                    loadNewsItems();
                    showManageNewsSection();
                })
                .catch(error => {
                    showToast('حدث خطأ أثناء تحديث الخبر: ' + error.message, 'error');
                })
                .finally(() => {
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = originalBtnContent;
                });
        }

        // ==========================================
        // وظائف الحذف
        // ==========================================
        function deleteNewsItem(id) {
            const confirmed = confirm('هل أنت متأكد من حذف هذا الخبر؟');
            if (!confirmed) return;

            const deleteBtn = document.querySelector(`button[onclick="deleteNewsItem(${id})"]`);
            const originalBtnContent = deleteBtn ? deleteBtn.innerHTML : '';
            if (deleteBtn) {
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<span class="loading-indicator"></span> جاري الحذف...';
            }

            fetch(`${API_BASE_URL}/api/news/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    showToast('تم حذف الخبر بنجاح', 'success');
                    loadNewsItems();
                })
                .catch(error => {
                    showToast('حدث خطأ أثناء حذف الخبر: ' + error.message, 'error');
                })
                .finally(() => {
                    if (deleteBtn) {
                        deleteBtn.disabled = false;
                        deleteBtn.innerHTML = originalBtnContent;
                    }
                });
        }

        // ==========================================
        // وظائف المساعدة
        // ==========================================
        function resetForm() {
            document.getElementById('newsForm').reset();
            document.getElementById('newsId').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('currentImagePreview').innerHTML = '';
            document.getElementById('previewImg').src = '';
            document.getElementById('deleteImageFlag').value = '0';
            document.getElementById('currentImagePath').value = '';
            document.getElementById('submitBtn').classList.remove('hidden');
            document.getElementById('updateBtn').classList.add('hidden');
            document.getElementById('cancelBtn').classList.add('hidden');
            currentFormMode = 'add';
            currentImage = '';
        }

        function showToast(message, type) {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i><span>${message}</span>`;
            toastContainer.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 10);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    </script>
</body>

</html>