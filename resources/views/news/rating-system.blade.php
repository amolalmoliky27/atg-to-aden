<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام التقييمات والتعليقات</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        secondary: '#4F46E5',
                        dark: {
                            800: '#1F2937',
                            900: '#111827'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Cairo', sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .star-animation {
            transition: all 0.2s ease;
        }

        .star-animation:hover {
            transform: scale(1.2);
        }

        .star-fill {
            animation: starFill 0.3s ease;
        }

        @keyframes starFill {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .reaction-bounce {
            animation: reactionBounce 0.4s ease;
        }

        @keyframes reactionBounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .rating {
            display: flex;
            width: 100%;
            justify-content: center;
            overflow: hidden;
            flex-direction: row-reverse;
            height: 150px;
            position: relative;
        }

        .rating-0 {
            filter: grayscale(100%);
        }

        .rating>input {
            display: none;
        }

        .rating>label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            margin-top: auto;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 76%;
            transition: .3s;
        }

        .rating>input:checked~label,
        .rating>input:checked~label~label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }

        .rating>input:not(:checked)~label:hover,
        .rating>input:not(:checked)~label:hover~label {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
        }

        .emoji-wrapper {
            width: 100%;
            text-align: center;
            height: 100px;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        .emoji-wrapper:before,
        .emoji-wrapper:after {
            content: "";
            height: 15px;
            width: 100%;
            position: absolute;
            left: 0;
            z-index: 1;
        }

        .emoji-wrapper:before {
            top: 0;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 35%, rgba(255, 255, 255, 0) 100%);
        }

        .dark .emoji-wrapper:before {
            background: linear-gradient(to bottom, rgba(31, 41, 55, 1) 0%, rgba(31, 41, 55, 1) 35%, rgba(31, 41, 55, 0) 100%);
        }

        .emoji-wrapper:after {
            bottom: 0;
            background: linear-gradient(to top, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 35%, rgba(255, 255, 255, 0) 100%);
        }

        .dark .emoji-wrapper:after {
            background: linear-gradient(to top, rgba(31, 41, 55, 1) 0%, rgba(31, 41, 55, 1) 35%, rgba(31, 41, 55, 0) 100%);
        }

        .emoji {
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: .3s;
        }

        .emoji>svg {
            margin: 15px 0;
            width: 70px;
            height: 70px;
            flex-shrink: 0;
        }

        #rating-1:checked~.emoji-wrapper>.emoji {
            transform: translateY(-100px);
        }

        #rating-2:checked~.emoji-wrapper>.emoji {
            transform: translateY(-200px);
        }

        #rating-3:checked~.emoji-wrapper>.emoji {
            transform: translateY(-300px);
        }

        #rating-4:checked~.emoji-wrapper>.emoji {
            transform: translateY(-400px);
        }

        #rating-5:checked~.emoji-wrapper>.emoji {
            transform: translateY(-500px);
        }

        .markdown-content h1,
        .markdown-content h2,
        .markdown-content h3 {
            font-weight: bold;
            margin: 0.5rem 0;
        }

        .markdown-content strong {
            font-weight: bold;
        }

        .markdown-content em {
            font-style: italic;
        }

        .markdown-content code {
            background: #f3f4f6;
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
            font-family: monospace;
        }

        .dark .markdown-content code {
            background: #374151;
        }

        .markdown-content blockquote {
            border-right: 4px solid #5D5CDE;
            padding: 0.5rem 1rem;
            margin: 0.5rem 0;
            background: #f9fafb;
            border-radius: 0.25rem;
        }

        .dark .markdown-content blockquote {
            background: #1f2937;
        }

        .markdown-content ul,
        .markdown-content ol {
            padding-right: 1.5rem;
            margin: 0.5rem 0;
        }

        .markdown-content ul li {
            list-style: disc;
        }

        .markdown-content ol li {
            list-style: decimal;
        }

        .markdown-content a {
            color: #5D5CDE;
            text-decoration: underline;
        }

        .reaction-popup {
            position: absolute;
            bottom: 100%;
            background: white;
            border-radius: 24px;
            padding: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 6px;
            z-index: 100;
            animation: fadeIn 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .dark .reaction-popup {
            background: #374151;
            border: 1px solid #4b5563;
        }

        .reaction-popup button {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 20px;
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .reaction-popup button:hover {
            transform: scale(1.3);
            background: #f3f4f6;
        }

        .dark .reaction-popup button:hover {
            background: #4b5563;
        }

        .reaction-adder {
            position: relative;
        }

        .toolbar-btn {
            position: relative;
        }

        .reaction-btn {
            transition: all 0.3s ease;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            margin: 1rem;
            animation: slideIn 0.3s ease;
        }

        .dark .modal-content {
            background: #1f2937;
        }

        .owner-controls {
            margin-right: auto;
        }

        .edit-form {
            margin-top: 1rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .dark .edit-form {
            background: #374151;
            border-color: #4b5563;
        }

        /* التعديل: أضفنا نفس أدوات التنسيق في نماذج التعديل */
        .edit-form .toolbar,
        .edit-reply-form .toolbar {
            display: flex;
            gap: 2px;
            flex-wrap: wrap;
        }

        /* إضافة تنسيقات النجوم القابلة للتعديل */
        .edit-star {
            transition: all 0.2s ease;
            font-size: 1.5rem;
        }

        .edit-star:hover {
            transform: scale(1.1);
        }

        .edit-star.selected {
            color: #fbbf24 !important;
        }

        /* Login Modal Styles */
        .login-modal {
            max-width: 450px;
        }

        .auth-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .auth-input {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }

        .auth-input:focus {
            border-color: #5D5CDE;
            box-shadow: 0 0 0 3px rgba(93, 92, 222, 0.1);
        }

        .user-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* شريط الأخبار المتحرك المحسن */
        .news-ticker-container {
            position: relative;
            overflow: hidden;
        }

        .news-ticker {
            display: flex;
            animation: scroll-ticker 30s linear infinite;
            width: 200%;
        }

        .news-ticker-content {
            white-space: nowrap;
            font-weight: 500;
            font-size: 1.1rem;
            line-height: 1.6;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .news-item {
            margin: 0 4rem;
            position: relative;
        }

        .news-item::after {
            content: "●";
            margin: 0 2rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }

        .news-item:last-child::after {
            content: "";
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
            .news-ticker-text {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <div class="main-content">
        <div class="max-w-4xl mx-auto p-4 sm:p-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary to-secondary p-6 rounded-2xl shadow-xl mb-8">
                <div class="flex justify-between items-center mb-2">
                    <h1 class="text-3xl font-bold text-white">نظام التقييمات والتعليقات</h1>
                    <div id="authSection">
                        <!-- سيتم ملؤها بواسطة JavaScript -->
                    </div>
                </div>
                <p class="text-white/80">شاركنا رأيك وتجربتك في موقعنا المتواضع</p>
            </div>

            <!-- News Ticker المحسن -->
            <div class="bg-primary text-white py-4 news-ticker-container rounded-xl mb-6 shadow-lg">
                <div class="news-ticker">
                    <div class="news-ticker-content">
                        <div class="news-item">سيتم تطويرها بشكل ديناميكي بالكامل مستقبلاً</div>
                        <div class="news-item">هذه الصفحة تحتوي على بيانات افتراضية تجريبية فقط</div>
                        <div class="news-item">ملاحظة: يُرجى الاتصال بالإنترنت لضمان عرض المحتوى بشكل صحيح</div>
                    </div>
                </div>
            </div>

            <!-- Rating Overview -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8 border border-gray-200 dark:border-gray-700">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Overall Rating -->
                    <div class="text-center">
                        <div class="text-5xl font-bold text-primary mb-2" id="overallRating">4.2</div>
                        <div class="flex justify-center mb-2" id="overallStars">
                            <!-- Stars will be populated by JS -->
                        </div>
                        <div class="text-gray-600 dark:text-gray-400">من أصل 5.0</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-2" id="totalReviews">52 تقييم</div>
                    </div>

                    <!-- Rating Distribution -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-3" data-rating="5">
                            <span class="text-sm w-3">5</span>
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                    style="width: 60%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400 w-8">31</span>
                        </div>
                        <div class="flex items-center gap-3" data-rating="4">
                            <span class="text-sm w-3">4</span>
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                    style="width: 25%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400 w-8">13</span>
                        </div>
                        <div class="flex items-center gap-3" data-rating="3">
                            <span class="text-sm w-3">3</span>
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                    style="width: 10%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400 w-8">5</span>
                        </div>
                        <div class="flex items-center gap-3" data-rating="2">
                            <span class="text-sm w-3">2</span>
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                    style="width: 3%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400 w-8">2</span>
                        </div>
                        <div class="flex items-center gap-3" data-rating="1">
                            <span class="text-sm w-3">1</span>
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                    style="width: 2%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400 w-8">1</span>
                        </div>
                    </div>
                </div>

                <!-- Add Review Button -->
                <div class="mt-8 text-center">
                    <button id="addReviewBtn"
                        class="bg-primary hover:bg-secondary text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة تقييم
                    </button>
                </div>
            </div>

            <!-- Add Review Form (Hidden by default) -->
            <div id="addReviewForm"
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8 border border-gray-200 dark:border-gray-700 hidden">
                <h3 class="text-xl font-bold mb-4">إضافة تقييم جديد</h3>

                <!-- Enhanced Star Rating Input -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">التقييم</label>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="rating">
                            <input type="radio" name="rating" id="rating-5">
                            <label for="rating-5"></label>
                            <input type="radio" name="rating" id="rating-4">
                            <label for="rating-4"></label>
                            <input type="radio" name="rating" id="rating-3">
                            <label for="rating-3"></label>
                            <input type="radio" name="rating" id="rating-2">
                            <label for="rating-2"></label>
                            <input type="radio" name="rating" id="rating-1">
                            <label for="rating-1"></label>
                            <div class="emoji-wrapper">
                                <div class="emoji">
                                    <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                        <path
                                            d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z"
                                            fill="#f4c534" />
                                        <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318"
                                            cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                                        <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822"
                                            rx="28.048" ry="28.08" fill="#3e4347" />
                                        <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993"
                                            rx="8.016" ry="5.296" fill="#5a5f63" />
                                        <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695"
                                            cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                                        <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84"
                                            rx="28.048" ry="28.08" fill="#3e4347" />
                                        <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794"
                                            cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                                        <path
                                            d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z"
                                            fill="#3e4347" />
                                    </svg>
                                    <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                        <path
                                            d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z"
                                            fill="#f4c534" />
                                        <path
                                            d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z"
                                            fill="#3e4347" />
                                        <path
                                            d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z"
                                            fill="#f4c534" />
                                        <path
                                            d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z"
                                            fill="#fff" />
                                        <path
                                            d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z"
                                            fill="#3e4347" />
                                        <path
                                            d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5-6.4 11.7-3 15z"
                                            fill="#fff" />
                                        <path
                                            d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z"
                                            fill="#f4c534" />
                                        <path
                                            d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z"
                                            fill="#fff" />
                                        <path
                                            d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z"
                                            fill="#3e4347" />
                                        <path
                                            d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z"
                                            fill="#fff" />
                                    </svg>
                                    <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                        <path
                                            d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z"
                                            fill="#f4c534" />
                                        <path
                                            d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z"
                                            fill="#3e4347" />
                                        <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z"
                                            fill="#fff" />
                                        <circle cx="340" cy="260.4" r="36.2" fill="#3e4347" />
                                        <g fill="#fff">
                                            <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5"
                                                ry="10" />
                                            <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z" />
                                        </g>
                                        <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347" />
                                        <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10"
                                            ry="6.5" fill="#fff" />
                                    </svg>
                                    <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                        <path
                                            d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z"
                                            fill="#3e4347" />
                                        <path
                                            d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z"
                                            fill="#f4c534" />
                                        <g fill="#fff">
                                            <path
                                                d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z" />
                                            <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81" />
                                        </g>
                                        <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                        <g fill="#fff">
                                            <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1"
                                                rx="12" ry="8.1" />
                                            <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81" />
                                        </g>
                                        <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                                        <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12"
                                            ry="8.1" fill="#fff" />
                                    </svg>
                                    <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                                        <path
                                            d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z"
                                            fill="#f4c534" />
                                        <path
                                            d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z"
                                            fill="#e24b4b" />
                                        <path
                                            d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z"
                                            fill="#d03f3f" />
                                        <path
                                            d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z"
                                            fill="#fff" />
                                        <path
                                            d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z"
                                            fill="#e24b4b" />
                                        <path
                                            d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z"
                                            fill="#d03f3f" />
                                        <path
                                            d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z"
                                            fill="#fff" />
                                        <path
                                            d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z"
                                            fill="#3e4347" />
                                        <path
                                            d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z"
                                            fill="#e24b4b" />
                                    </svg>
                                    <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <g fill="#ffd93b">
                                            <circle cx="256" cy="256" r="256" />
                                            <path
                                                d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z" />
                                        </g>
                                        <path
                                            d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z"
                                            fill="#e9eff4" />
                                        <path
                                            d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z"
                                            fill="#45cbea" />
                                        <path
                                            d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z"
                                            fill="#e84d88" />
                                        <g fill="#38c0dc">
                                            <path
                                                d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z" />
                                        </g>
                                        <g fill="#d23f77">
                                            <path
                                                d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z" />
                                        </g>
                                        <path
                                            d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z"
                                            fill="#3e4347" />
                                        <path
                                            d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z"
                                            fill="#e24b4b" />
                                        <path
                                            d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z"
                                            fill="#fff" opacity=".2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-2 text-center" id="ratingText">اختر تقييمك
                    </div>
                </div>

                <!-- Enhanced Comment Input with Toolbar -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">التعليق</label>
                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                        <div
                            class="bg-gray-50 dark:bg-gray-700 px-3 py-2 border-b border-gray-300 dark:border-gray-600">
                            <div class="flex gap-2 flex-wrap">
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="bold" title="عريض">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="italic" title="مائل">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="code" title="كود">
                                    <i class="fas fa-code"></i>
                                </button>
                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="h1" title="عنوان رئيسي">
                                    <i class="fas fa-heading"></i>
                                    <span class="text-xs">1</span>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="h2" title="عنوان فرعي">
                                    <i class="fas fa-heading"></i>
                                    <span class="text-xs">2</span>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="quote" title="اقتباس">
                                    <i class="fas fa-quote-right"></i>
                                </button>
                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="ul" title="قائمة نقاط">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="ol" title="قائمة مرقمة">
                                    <i class="fas fa-list-ol"></i>
                                </button>
                                <button type="button"
                                    class="toolbar-btn p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600"
                                    data-action="link" title="رابط">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>
                        <textarea id="commentInput"
                            class="w-full p-3 text-base resize-none bg-transparent border-none focus:outline-none min-h-[120px]"
                            placeholder="اكتب تعليقك هنا... يمكنك استخدام Markdown للتنسيق"></textarea>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">يمكنك استخدام Markdown للتنسيق -
                        **عريض**،
                        *مائل*، `كود`، > اقتباس</div>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3">
                    <button id="submitReview"
                        class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                        نشر التقييم
                    </button>
                    <button id="cancelReview"
                        class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                        إلغاء
                    </button>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8 border border-gray-200 dark:border-gray-700">
                <div class="flex gap-4 border-b border-gray-200 dark:border-gray-700">
                    <button class="filter-tab px-4 py-2 font-semibold border-b-2 border-primary text-primary"
                        data-filter="all">
                        الكل (52)
                    </button>
                    <button
                        class="filter-tab px-4 py-2 font-semibold border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                        data-filter="positive">
                        إيجابية (44)
                    </button>
                    <button
                        class="filter-tab px-4 py-2 font-semibold border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                        data-filter="negative">
                        سلبية (8)
                    </button>
                </div>
            </div>

            <!-- Reviews List -->
            <div id="reviewsList" class="space-y-6">
                <!-- Sample Review 1 -->
                <div class="review-item bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700"
                    data-sentiment="positive">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            م
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-semibold">محمد أحمد</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex text-yellow-500">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">منذ 3 أيام</span>
                                    </div>
                                </div>
                            </div>

                            <div class="markdown-content text-gray-700 dark:text-gray-300 mb-4">
                                <p>مدينة عدن التاريخية مكان <strong>رائع</strong> جداً! خاصة منطقة كريتر والأسواق
                                    القديمة. المناظر الطبيعية خلابة والتاريخ عريق.</p>
                            </div>

                            <!-- Enhanced Reactions -->
                            <div class="flex items-center gap-2 mb-4 flex-wrap">
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-blue-900 transition-all duration-300"
                                    data-reaction="like">
                                    <span class="text-blue-500">👍</span>
                                    <span class="text-sm font-medium">12</span>
                                </button>
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-red-100 dark:hover:bg-red-900 transition-all duration-300"
                                    data-reaction="love">
                                    <span class="text-red-500">❤️</span>
                                    <span class="text-sm font-medium">8</span>
                                </button>
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-yellow-100 dark:hover:bg-yellow-900 transition-all duration-300"
                                    data-reaction="laugh">
                                    <span class="text-yellow-500">😂</span>
                                    <span class="text-sm font-medium">2</span>
                                </button>
                                <div class="reaction-adder relative">
                                    <button
                                        class="add-reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                                        <span class="text-sm">+</span>
                                    </button>
                                    <div class="reaction-popup hidden">
                                        <button data-reaction="like">👍</button>
                                        <button data-reaction="love">❤️</button>
                                        <button data-reaction="laugh">😂</button>
                                        <button data-reaction="wow">😮</button>
                                        <button data-reaction="sad">😢</button>
                                        <button data-reaction="angry">😠</button>
                                        <button data-reaction="celebrate">🎉</button>
                                        <button data-reaction="thinking">🤔</button>
                                        <button data-reaction="fire">🔥</button>
                                        <button data-reaction="clap">👏</button>
                                        <button data-reaction="star">⭐</button>
                                        <button data-reaction="rocket">🚀</button>
                                    </div>
                                </div>
                                <button
                                    class="reply-btn text-primary hover:text-secondary font-medium text-sm transition-colors duration-300 mr-2">
                                    <i class="fas fa-reply ml-1"></i>
                                    رد
                                </button>
                            </div>

                            <!-- Replies -->
                            <div
                                class="replies-container space-y-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                                <div class="reply bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                            س
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h5 class="font-semibold text-sm">سارة محمود</h5>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">منذ يومين</span>
                                            </div>
                                            <div class="markdown-content text-sm text-gray-700 dark:text-gray-300 mb-2">
                                                <p>أتفق معك تماماً! أنا أيضاً اشتريت نفس المنتج والتجربة كانت رائعة.</p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button
                                                    class="reaction-btn flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-600 hover:bg-blue-100 dark:hover:bg-blue-800 transition-all duration-300 text-xs"
                                                    data-reaction="like">
                                                    <span class="text-blue-500">👍</span>
                                                    <span>3</span>
                                                </button>
                                                <button
                                                    class="reaction-btn flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-600 hover:bg-red-100 dark:hover:bg-red-800 transition-all duration-300 text-xs"
                                                    data-reaction="love">
                                                    <span class="text-red-500">❤️</span>
                                                    <span>1</span>
                                                </button>
                                                <div class="reaction-adder relative">
                                                    <button
                                                        class="add-reaction-btn flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-300 text-xs">
                                                        <span>+</span>
                                                    </button>
                                                    <div class="reaction-popup hidden">
                                                        <button data-reaction="like">👍</button>
                                                        <button data-reaction="love">❤️</button>
                                                        <button data-reaction="laugh">😂</button>
                                                        <button data-reaction="wow">😮</button>
                                                        <button data-reaction="sad">😢</button>
                                                        <button data-reaction="angry">😠</button>
                                                        <button data-reaction="celebrate">🎉</button>
                                                        <button data-reaction="thinking">🤔</button>
                                                        <button data-reaction="fire">🔥</button>
                                                        <button data-reaction="clap">👏</button>
                                                        <button data-reaction="star">⭐</button>
                                                        <button data-reaction="rocket">🚀</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reply Form (Hidden by default) -->
                            <div
                                class="reply-form hidden mt-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                        <div
                                            class="bg-gray-100 dark:bg-gray-600 px-3 py-2 border-b border-gray-300 dark:border-gray-500">
                                            <div class="flex gap-2 flex-wrap">
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="bold" title="عريض">
                                                    <i class="fas fa-bold"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="italic" title="مائل">
                                                    <i class="fas fa-italic"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="code" title="كود">
                                                    <i class="fas fa-code"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h1" title="عنوان رئيسي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">1</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h2" title="عنوان فرعي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">2</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="quote" title="اقتباس">
                                                    <i class="fas fa-quote-right text-xs"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ul" title="قائمة نقاط">
                                                    <i class="fas fa-list-ul text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ol" title="قائمة مرقمة">
                                                    <i class="fas fa-list-ol text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="link" title="رابط">
                                                    <i class="fas fa-link text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <textarea
                                            class="reply-input w-full p-3 text-sm resize-none bg-transparent border-none focus:outline-none min-h-[80px]"
                                            placeholder="اكتب ردك هنا..."></textarea>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button
                                            class="submit-reply bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            نشر الرد
                                        </button>
                                        <button
                                            class="cancel-reply bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            إلغاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Review 2 - تم إصلاحه -->
                <div class="review-item bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700"
                    data-sentiment="positive">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-secondary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            س
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-semibold">سارة محمود</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex text-yellow-500">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">منذ يومين</span>
                                    </div>
                                </div>
                            </div>

                            <div class="markdown-content text-gray-700 dark:text-gray-300 mb-4">
                                <p>شاطئ الغدير جميل جداً ولكن يحتاج لمزيد من التطوير والخدمات السياحية.</p>
                            </div>

                            <!-- Enhanced Reactions -->
                            <div class="flex items-center gap-2 mb-4 flex-wrap">
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-blue-900 transition-all duration-300"
                                    data-reaction="like">
                                    <span class="text-blue-500">👍</span>
                                    <span class="text-sm font-medium">8</span>
                                </button>
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-red-100 dark:hover:bg-red-900 transition-all duration-300"
                                    data-reaction="love">
                                    <span class="text-red-500">❤️</span>
                                    <span class="text-sm font-medium">4</span>
                                </button>
                                <div class="reaction-adder relative">
                                    <button
                                        class="add-reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                                        <span class="text-sm">+</span>
                                    </button>
                                    <div class="reaction-popup hidden">
                                        <button data-reaction="like">👍</button>
                                        <button data-reaction="love">❤️</button>
                                        <button data-reaction="laugh">😂</button>
                                        <button data-reaction="wow">😮</button>
                                        <button data-reaction="sad">😢</button>
                                        <button data-reaction="angry">😠</button>
                                        <button data-reaction="celebrate">🎉</button>
                                        <button data-reaction="thinking">🤔</button>
                                        <button data-reaction="fire">🔥</button>
                                        <button data-reaction="clap">👏</button>
                                        <button data-reaction="star">⭐</button>
                                        <button data-reaction="rocket">🚀</button>
                                    </div>
                                </div>
                                <button
                                    class="reply-btn text-primary hover:text-secondary font-medium text-sm transition-colors duration-300 mr-2">
                                    <i class="fas fa-reply ml-1"></i>
                                    رد
                                </button>
                            </div>

                            <!-- تم إضافة العناصر المفقودة هنا -->
                            <!-- Replies Container -->
                            <div
                                class="replies-container space-y-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                            </div>

                            <!-- Reply Form (Hidden by default) -->
                            <div
                                class="reply-form hidden mt-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                        <div
                                            class="bg-gray-100 dark:bg-gray-600 px-3 py-2 border-b border-gray-300 dark:border-gray-500">
                                            <div class="flex gap-2 flex-wrap">
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="bold" title="عريض">
                                                    <i class="fas fa-bold"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="italic" title="مائل">
                                                    <i class="fas fa-italic"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="code" title="كود">
                                                    <i class="fas fa-code"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h1" title="عنوان رئيسي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">1</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h2" title="عنوان فرعي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">2</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="quote" title="اقتباس">
                                                    <i class="fas fa-quote-right text-xs"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ul" title="قائمة نقاط">
                                                    <i class="fas fa-list-ul text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ol" title="قائمة مرقمة">
                                                    <i class="fas fa-list-ol text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="link" title="رابط">
                                                    <i class="fas fa-link text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <textarea
                                            class="reply-input w-full p-3 text-sm resize-none bg-transparent border-none focus:outline-none min-h-[80px]"
                                            placeholder="اكتب ردك هنا..."></textarea>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button
                                            class="submit-reply bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            نشر الرد
                                        </button>
                                        <button
                                            class="cancel-reply bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            إلغاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Review 3 (Negative) -->
                <div class="review-item bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700"
                    data-sentiment="negative">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-red-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            ع
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-semibold">علي سالم</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex text-yellow-500">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">منذ أسبوع</span>
                                    </div>
                                </div>
                            </div>

                            <div class="markdown-content text-gray-700 dark:text-gray-300 mb-4">
                                <p>للأسف حديقة السبعين لم تعد كما كانت عليه من قبل. تحتاج لإعادة تأهيل وصيانة.</p>
                            </div>

                            <!-- Enhanced Reactions -->
                            <div class="flex items-center gap-2 mb-4 flex-wrap">
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-blue-900 transition-all duration-300"
                                    data-reaction="like">
                                    <span class="text-blue-500">👍</span>
                                    <span class="text-sm font-medium">3</span>
                                </button>
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300"
                                    data-reaction="sad">
                                    <span class="text-gray-500">😢</span>
                                    <span class="text-sm font-medium">7</span>
                                </button>
                                <button
                                    class="reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-red-100 dark:hover:bg-red-900 transition-all duration-300"
                                    data-reaction="angry">
                                    <span class="text-red-600">😠</span>
                                    <span class="text-sm font-medium">2</span>
                                </button>
                                <div class="reaction-adder relative">
                                    <button
                                        class="add-reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                                        <span class="text-sm">+</span>
                                    </button>
                                    <div class="reaction-popup hidden">
                                        <button data-reaction="like">👍</button>
                                        <button data-reaction="love">❤️</button>
                                        <button data-reaction="laugh">😂</button>
                                        <button data-reaction="wow">😮</button>
                                        <button data-reaction="sad">😢</button>
                                        <button data-reaction="angry">😠</button>
                                        <button data-reaction="celebrate">🎉</button>
                                        <button data-reaction="thinking">🤔</button>
                                        <button data-reaction="fire">🔥</button>
                                        <button data-reaction="clap">👏</button>
                                        <button data-reaction="star">⭐</button>
                                        <button data-reaction="rocket">🚀</button>
                                    </div>
                                </div>
                                <button
                                    class="reply-btn text-primary hover:text-secondary font-medium text-sm transition-colors duration-300 mr-2">
                                    <i class="fas fa-reply ml-1"></i>
                                    رد
                                </button>
                            </div>

                            <!-- Replies -->
                            <div
                                class="replies-container space-y-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                            </div>

                            <!-- Reply Form (Hidden by default) -->
                            <div
                                class="reply-form hidden mt-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                        <div
                                            class="bg-gray-100 dark:bg-gray-600 px-3 py-2 border-b border-gray-300 dark:border-gray-500">
                                            <div class="flex gap-2 flex-wrap">
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="bold" title="عريض">
                                                    <i class="fas fa-bold"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="italic" title="مائل">
                                                    <i class="fas fa-italic"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="code" title="كود">
                                                    <i class="fas fa-code"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h1" title="عنوان رئيسي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">1</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="h2" title="عنوان فرعي">
                                                    <i class="fas fa-heading text-xs"></i>
                                                    <span class="text-xs">2</span>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="quote" title="اقتباس">
                                                    <i class="fas fa-quote-right text-xs"></i>
                                                </button>
                                                <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ul" title="قائمة نقاط">
                                                    <i class="fas fa-list-ul text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="ol" title="قائمة مرقمة">
                                                    <i class="fas fa-list-ol text-xs"></i>
                                                </button>
                                                <button type="button"
                                                    class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs"
                                                    data-action="link" title="رابط">
                                                    <i class="fas fa-link text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <textarea
                                            class="reply-input w-full p-3 text-sm resize-none bg-transparent border-none focus:outline-none min-h-[80px]"
                                            placeholder="اكتب ردك هنا..."></textarea>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button
                                            class="submit-reply bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            نشر الرد
                                        </button>
                                        <button
                                            class="cancel-reply bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                            إلغاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal hidden">
        <div class="modal-content login-modal">
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">مرحباً بك!</h2>
                <p class="text-gray-600 dark:text-gray-400">سجل دخولك لتتمكن من إضافة التقييمات والتفاعل مع التعليقات
                </p>
            </div>

            <form id="loginForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">اسم المستخدم</label>
                    <input type="text" id="username"
                        class="auth-input w-full p-3 text-base rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                        placeholder="أدخل اسم المستخدم" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">كلمة المرور</label>
                    <input type="password" id="password"
                        class="auth-input w-full p-3 text-base rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none"
                        placeholder="أدخل كلمة المرور" required>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="auth-button flex-1 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300">
                        <i class="fas fa-sign-in-alt ml-2"></i>
                        تسجيل الدخول
                    </button>
                    <button type="button" id="cancelLogin"
                        class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300">
                        إلغاء
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    لأغراض التجربة، يمكنك استخدام أي اسم مستخدم وكلمة مرور
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white py-8" style="
    background: #705bb3;
    background: linear-gradient(90deg, rgb(71, 83, 219) 0%, rgba(70, 47, 204, 0.92) 100%);
">
        <div class="container mx-auto px-4 text-center">
            <p class="text-white flex justify-center items-center gap-4"> <!-- مسافة 1rem بين العناصر -->
                <span>المراجعة والتقييم</span>
                <span><i>BY MANAL FROM WEB PIONEER 2025</i>© </span>
            </p>
        </div>
    </footer>

    <script>
        // Dark mode detection
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        // Authentication state
        let isLoggedIn = false;
        let currentUser = null;

        // Rating statistics tracking
        let ratingStats = {
            totalRatings: 52,
            ratingCounts: {
                5: 31,
                4: 13,
                3: 5,
                2: 2,
                1: 1
            },
            currentAverage: 4.2
        };

        // Calculate new average and update UI
        function updateRatingStatistics(newRating) {
            // Add new rating to counts
            ratingStats.ratingCounts[newRating]++;
            ratingStats.totalRatings++;

            // Calculate new average
            let totalPoints = 0;
            for (let rating = 1; rating <= 5; rating++) {
                totalPoints += rating * ratingStats.ratingCounts[rating];
            }
            ratingStats.currentAverage = totalPoints / ratingStats.totalRatings;

            // Update UI
            updateRatingDisplay();
        }

        // Remove rating from statistics when deleting
        function removeRatingFromStatistics(ratingToRemove) {
            // Remove rating from counts
            if (ratingStats.ratingCounts[ratingToRemove] > 0) {
                ratingStats.ratingCounts[ratingToRemove]--;
                ratingStats.totalRatings--;

                // Recalculate average
                if (ratingStats.totalRatings > 0) {
                    let totalPoints = 0;
                    for (let rating = 1; rating <= 5; rating++) {
                        totalPoints += rating * ratingStats.ratingCounts[rating];
                    }
                    ratingStats.currentAverage = totalPoints / ratingStats.totalRatings;
                } else {
                    // If no ratings left, reset to default
                    ratingStats.currentAverage = 0;
                }

                // Update UI
                updateRatingDisplay();
            }
        }

        // Update rating statistics when editing (remove old, add new)
        function updateRatingOnEdit(oldRating, newRating) {
            // Don't update if rating didn't change
            if (oldRating === newRating) return;

            // Remove old rating from counts
            if (ratingStats.ratingCounts[oldRating] > 0) {
                ratingStats.ratingCounts[oldRating]--;
            }

            // Add new rating to counts
            ratingStats.ratingCounts[newRating]++;

            // Total ratings count stays the same since we're editing, not adding/removing

            // Recalculate average
            let totalPoints = 0;
            for (let rating = 1; rating <= 5; rating++) {
                totalPoints += rating * ratingStats.ratingCounts[rating];
            }
            ratingStats.currentAverage = totalPoints / ratingStats.totalRatings;

            // Update UI
            updateRatingDisplay();
        }

        // Get rating from review element
        function getRatingFromReview(reviewElement) {
            const stars = reviewElement.querySelectorAll('.flex.text-yellow-500 .fas.fa-star');
            return stars.length;
        }

        // Update the rating display with new statistics
        function updateRatingDisplay() {
            // Update overall rating number
            document.getElementById('overallRating').textContent = ratingStats.currentAverage.toFixed(1);

            // Update total reviews count
            document.getElementById('totalReviews').textContent = `${ratingStats.totalRatings} تقييم`;

            // Update overall stars
            updateOverallStars();

            // Update rating distribution
            updateRatingDistribution();

            // Update filter tabs counts
            updateFilterTabCounts();
        }

        function updateOverallStars() {
            const container = document.getElementById('overallStars');
            const rating = ratingStats.currentAverage;
            container.innerHTML = '';

            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                if (i <= Math.floor(rating)) {
                    star.className = 'fas fa-star text-yellow-500 text-xl';
                } else if (i - 0.5 <= rating) {
                    star.className = 'fas fa-star-half-alt text-yellow-500 text-xl';
                } else {
                    star.className = 'far fa-star text-yellow-500 text-xl';
                }
                container.appendChild(star);
            }
        }

        function updateRatingDistribution() {
            for (let rating = 1; rating <= 5; rating++) {
                const ratingElement = document.querySelector(`[data-rating="${rating}"]`);
                if (ratingElement) {
                    const count = ratingStats.ratingCounts[rating];
                    const percentage = (count / ratingStats.totalRatings) * 100;

                    // Update count
                    const countSpan = ratingElement.querySelector('span:last-child');
                    countSpan.textContent = count;

                    // Update progress bar width with animation
                    const progressBar = ratingElement.querySelector('.bg-yellow-500');
                    progressBar.style.width = `${percentage}%`;
                }
            }
        }

        function updateFilterTabCounts() {
            const positiveCount = ratingStats.ratingCounts[5] + ratingStats.ratingCounts[4] + ratingStats.ratingCounts[3];
            const negativeCount = ratingStats.ratingCounts[2] + ratingStats.ratingCounts[1];

            // Update filter tab texts
            document.querySelector('[data-filter="all"]').textContent = `الكل (${ratingStats.totalRatings})`;
            document.querySelector('[data-filter="positive"]').textContent = `إيجابية (${positiveCount})`;
            document.querySelector('[data-filter="negative"]').textContent = `سلبية (${negativeCount})`;
        }

        // Check if user is logged in and update UI
        function updateAuthUI() {
            const authSection = document.getElementById('authSection');

            if (isLoggedIn && currentUser) {
                authSection.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="user-info px-4 py-2 rounded-lg text-white flex items-center gap-2">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <span class="font-bold text-sm">${currentUser.charAt(0).toUpperCase()}</span>
                            </div>
                            <span class="font-medium">${currentUser}</span>
                        </div>
                        <button id="logoutBtn" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300">
                            <i class="fas fa-sign-out-alt ml-1"></i>
                            خروج
                        </button>
                    </div>
                `;
            } else {
                authSection.innerHTML = `
                    <button id="loginBtn" class="bg-white/20 hover:bg-white/30 text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                        <i class="fas fa-sign-in-alt ml-2"></i>
                        تسجيل الدخول
                    </button>
                `;
            }
        }

        // Check if user needs to login for action
        function requireLogin(action) {
            if (!isLoggedIn) {
                showLoginModal();
                return false;
            }
            return true;
        }

        // Show login modal
        function showLoginModal() {
            const modal = document.getElementById('loginModal');
            modal.classList.remove('hidden');
        }

        // Hide login modal
        function hideLoginModal() {
            const modal = document.getElementById('loginModal');
            modal.classList.add('hidden');
            document.getElementById('loginForm').reset();
        }

        // Handle login
        function handleLogin(username, password) {
            // Simple validation - in real app, this would be server-side
            if (username.trim() && password.trim()) {
                isLoggedIn = true;
                currentUser = username.trim();
                updateAuthUI();
                hideLoginModal();
                showCustomAlert('تم تسجيل الدخول بنجاح!', 'success');
                return true;
            }
            return false;
        }

        // Handle logout
        function handleLogout() {
            isLoggedIn = false;
            currentUser = null;
            updateAuthUI();
            showCustomAlert('تم تسجيل الخروج بنجاح!', 'success');
        }

        // Initialize overall rating stars
        function initOverallStars() {
            updateOverallStars();
        }

        // Enhanced Star rating with emojis functionality
        let selectedRating = 0;
        const ratingTexts = {
            0: 'اختر تقييمك',
            1: 'سيء جداً ',
            2: 'سيء ',
            3: 'متوسط ',
            4: 'جيد ',
            5: 'ممتاز '
        };

        function initRatingInput() {
            const radioInputs = document.querySelectorAll('input[name="rating"]');
            const ratingText = document.getElementById('ratingText');

            radioInputs.forEach((input, index) => {
                input.addEventListener('change', () => {
                    if (input.checked) {
                        selectedRating = parseInt(input.id.split('-')[1]);
                        ratingText.textContent = ratingTexts[selectedRating];
                    }
                });
            });
        }

        // Enhanced Add review form functionality
        document.addEventListener('click', (e) => {
            if (e.target.closest('#addReviewBtn')) {
                if (!requireLogin()) return;

                const form = document.getElementById('addReviewForm');
                form.classList.remove('hidden');
                form.classList.add('slide-in');
                form.scrollIntoView({
                    behavior: 'smooth'
                });
            }

            if (e.target.closest('#loginBtn')) {
                showLoginModal();
            }

            if (e.target.closest('#logoutBtn')) {
                handleLogout();
            }

            if (e.target.closest('#cancelLogin')) {
                hideLoginModal();
            }
        });

        // Login form handling
        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (!handleLogin(username, password)) {
                showCustomAlert('يرجى إدخال اسم مستخدم وكلمة مرور صحيحين', 'error');
            }
        });

        document.getElementById('cancelReview').addEventListener('click', () => {
            const form = document.getElementById('addReviewForm');
            form.classList.add('hidden');
            selectedRating = 0;
            document.querySelectorAll('input[name="rating"]').forEach(input => input.checked = false);
            document.getElementById('ratingText').textContent = ratingTexts[0];
            document.getElementById('commentInput').value = '';
        });

        // Enhanced Toolbar functionality
        function initToolbar() {
            document.addEventListener('click', (e) => {
                if (e.target.closest('.toolbar-btn')) {
                    const btn = e.target.closest('.toolbar-btn');
                    const action = btn.dataset.action;
                    const textarea = btn.closest('.border').querySelector('textarea');

                    const start = textarea.selectionStart;
                    const end = textarea.selectionEnd;
                    const selectedText = textarea.value.substring(start, end);

                    let replacement = selectedText;
                    let cursorOffset = 0;

                    switch (action) {
                        case 'bold':
                            replacement = `**${selectedText}**`;
                            cursorOffset = selectedText ? 0 : 2;
                            break;
                        case 'italic':
                            replacement = `*${selectedText}*`;
                            cursorOffset = selectedText ? 0 : 1;
                            break;
                        case 'code':
                            replacement = `\`${selectedText}\``;
                            cursorOffset = selectedText ? 0 : 1;
                            break;
                        case 'h1':
                            replacement = `# ${selectedText}`;
                            cursorOffset = selectedText ? 0 : 0;
                            break;
                        case 'h2':
                            replacement = `## ${selectedText}`;
                            cursorOffset = selectedText ? 0 : 0;
                            break;
                        case 'quote':
                            replacement = `> ${selectedText}`;
                            cursorOffset = selectedText ? 0 : 0;
                            break;
                        case 'ul':
                            replacement = `- ${selectedText}`;
                            cursorOffset = selectedText ? 0 : 0;
                            break;
                        case 'ol':
                            replacement = `1. ${selectedText}`;
                            cursorOffset = selectedText ? 0 : 0;
                            break;
                        case 'link':
                            replacement = `[${selectedText || 'نص الرابط'}](https://example.com)`;
                            cursorOffset = selectedText ? 0 : 7;
                            break;
                    }

                    textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
                    textarea.focus();

                    const newCursorPos = selectedText ? start + replacement.length : start + replacement.length - cursorOffset;
                    textarea.setSelectionRange(newCursorPos, newCursorPos);
                }
            });
        }

        // Submit review
        document.getElementById('submitReview').addEventListener('click', () => {
            if (!requireLogin()) return;

            const comment = document.getElementById('commentInput').value.trim();

            if (selectedRating === 0) {
                showCustomAlert('يرجى اختيار تقييم');
                return;
            }

            if (!comment) {
                showCustomAlert('يرجى كتابة تعليق');
                return;
            }

            // Update rating statistics first
            updateRatingStatistics(selectedRating);

            // Create new review element
            const newReview = createReviewElement({
                name: currentUser,
                rating: selectedRating,
                date: 'الآن',
                comment: comment,
                sentiment: selectedRating >= 4 ? 'positive' : selectedRating >= 3 ? 'neutral' : 'negative',
                isOwner: true // المستخدم مالك هذا التعليق
            });

            // Add to reviews list
            const reviewsList = document.getElementById('reviewsList');
            reviewsList.insertBefore(newReview, reviewsList.firstChild);

            // Hide form and reset
            document.getElementById('addReviewForm').classList.add('hidden');
            selectedRating = 0;
            document.querySelectorAll('input[name="rating"]').forEach(input => input.checked = false);
            document.getElementById('ratingText').textContent = ratingTexts[0];
            document.getElementById('commentInput').value = '';

            showCustomAlert('تم إضافة تقييمك بنجاح!', 'success');
        });

        // Create review element with owner controls and editable rating
        function createReviewElement(review) {
            const div = document.createElement('div');
            div.className = `review-item bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 slide-in`;
            div.dataset.sentiment = review.sentiment;
            div.dataset.reviewId = Date.now(); // معرف فريد للتعليق

            const stars = Array.from({
                    length: 5
                }, (_, i) =>
                i < review.rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>'
            ).join('');

            // إضافة أزرار التحكم للمالك فقط
            const ownerControls = review.isOwner ? `
                <div class="owner-controls flex gap-2 mr-auto">
                    <button class="edit-review-btn text-blue-500 hover:text-blue-700 text-sm font-medium transition-colors duration-300">
                        <i class="fas fa-edit ml-1"></i>
                        تعديل
                    </button>
                    <button class="delete-review-btn text-red-500 hover:text-red-700 text-sm font-medium transition-colors duration-300">
                        <i class="fas fa-trash ml-1"></i>
                        حذف
                    </button>
                </div>
            ` : '';

            const editStars = Array.from({
                    length: 5
                }, (_, i) =>
                `<i class="edit-star fas fa-star cursor-pointer hover:text-yellow-600 transition-colors duration-200 ${i < review.rating ? 'text-yellow-500 selected' : 'text-gray-300 dark:text-gray-600'}" data-rating="${i + 1}"></i>`
            ).join('');

            div.innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                        ${review.name.charAt(0)}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-4">
                                <div>
                                    <h4 class="font-semibold">${review.name}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex text-yellow-500">
                                            ${stars}
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">${review.date}</span>
                                    </div>
                                </div>
                            </div>
                            ${ownerControls}
                        </div>
                        
                        <div class="review-content">
                            <div class="markdown-content text-gray-700 dark:text-gray-300 mb-4">
                                ${marked.parse(review.comment)}
                            </div>
                        </div>
                        
                        <!-- Enhanced Edit Form with Interactive Rating (Hidden by default) -->
                        <div class="edit-form hidden">
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">التقييم</label>
                                <div class="flex gap-1 edit-rating-container" data-current-rating="${review.rating}">
                                    ${editStars}
                                </div>
                                <input type="hidden" class="edit-rating-value" value="${review.rating}">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">التعليق</label>
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 dark:bg-gray-700 px-3 py-2 border-b border-gray-300 dark:border-gray-600">
                                        <div class="flex gap-2 flex-wrap">
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="bold" title="عريض">
                                                <i class="fas fa-bold"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="italic" title="مائل">
                                                <i class="fas fa-italic"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="code" title="كود">
                                                <i class="fas fa-code"></i>
                                            </button>
                                            <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="h1" title="عنوان رئيسي">
                                                <i class="fas fa-heading text-xs"></i>
                                                <span class="text-xs">1</span>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="h2" title="عنوان فرعي">
                                                <i class="fas fa-heading text-xs"></i>
                                                <span class="text-xs">2</span>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="quote" title="اقتباس">
                                                <i class="fas fa-quote-right text-xs"></i>
                                            </button>
                                            <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="ul" title="قائمة نقاط">
                                                <i class="fas fa-list-ul text-xs"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="ol" title="قائمة مرقمة">
                                                <i class="fas fa-list-ol text-xs"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 text-xs" data-action="link" title="رابط">
                                                <i class="fas fa-link text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <textarea class="edit-comment-input w-full p-3 text-base resize-none bg-transparent border-none focus:outline-none min-h-[120px]" placeholder="اكتب تعليقك هنا...">${review.comment}</textarea>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="save-edit-btn bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                    حفظ التغييرات
                                </button>
                                <button class="cancel-edit-btn bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                    إلغاء
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-4 flex-wrap">
                            <div class="reaction-adder relative">
                                <button class="add-reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                                    <span class="text-sm">+</span>
                                </button>
                                <div class="reaction-popup hidden">
                                    <button data-reaction="like">👍</button>
                                    <button data-reaction="love">❤️</button>
                                    <button data-reaction="laugh">😂</button>
                                    <button data-reaction="wow">😮</button>
                                    <button data-reaction="sad">😢</button>
                                    <button data-reaction="angry">😠</button>
                                    <button data-reaction="celebrate">🎉</button>
                                    <button data-reaction="thinking">🤔</button>
                                    <button data-reaction="fire">🔥</button>
                                    <button data-reaction="clap">👏</button>
                                    <button data-reaction="star">⭐</button>
                                    <button data-reaction="rocket">🚀</button>
                                </div>
                            </div>
                            <button class="reply-btn text-primary hover:text-secondary font-medium text-sm transition-colors duration-300 mr-2">
                                <i class="fas fa-reply ml-1"></i>
                                رد
                            </button>
                        </div>

                        <div class="replies-container space-y-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                        </div>

                        <div class="reply-form hidden mt-4 border-r-2 border-gray-200 dark:border-gray-700 pr-4 mr-4">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                    <div class="bg-gray-100 dark:bg-gray-600 px-3 py-2 border-b border-gray-300 dark:border-gray-500">
                                        <div class="flex gap-2 flex-wrap">
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="bold" title="عريض">
                                                <i class="fas fa-bold"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="italic" title="مائل">
                                                <i class="fas fa-italic"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="code" title="كود">
                                                <i class="fas fa-code"></i>
                                            </button>
                                            <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="h1" title="عنوان رئيسي">
                                                <i class="fas fa-heading text-xs"></i>
                                                <span class="text-xs">1</span>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="h2" title="عنوان فرعي">
                                                <i class="fas fa-heading text-xs"></i>
                                                <span class="text-xs">2</span>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="quote" title="اقتباس">
                                                <i class="fas fa-quote-right text-xs"></i>
                                            </button>
                                            <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="ul" title="قائمة نقاط">
                                                <i class="fas fa-list-ul text-xs"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="ol" title="قائمة مرقمة">
                                                <i class="fas fa-list-ol text-xs"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="link" title="رابط">
                                                <i class="fas fa-link text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <textarea class="reply-input w-full p-3 text-sm resize-none bg-transparent border-none focus:outline-none min-h-[80px]" placeholder="اكتب ردك هنا..."></textarea>
                                </div>
                                <div class="flex gap-2 mt-3">
                                    <button class="submit-reply bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                        نشر الرد
                                    </button>
                                    <button class="cancel-reply bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300">
                                        إلغاء
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Initialize the reaction adder for the new review
            setTimeout(() => {
                const addReactionBtn = div.querySelector('.add-reaction-btn');
                const reactionPopup = div.querySelector('.reaction-popup');
                initReactionAdder(addReactionBtn, reactionPopup);
            }, 100);

            return div;
        }

        // Enhanced Reaction functionality with login check
        document.addEventListener('click', (e) => {
            if (e.target.closest('.reaction-btn')) {
                if (!requireLogin()) return;

                const btn = e.target.closest('.reaction-btn');
                const countSpan = btn.querySelector('span:last-child');
                let count = parseInt(countSpan.textContent);

                if (btn.classList.contains('reacted')) {
                    btn.classList.remove('reacted');
                    count--;

                    // إذا وصل العدد إلى صفر، احذف الزر تماماً مع انيميشن سموث
                    if (count <= 0) {
                        btn.style.transform = 'scale(0)';
                        btn.style.opacity = '0';
                        setTimeout(() => {
                            btn.remove();
                        }, 300);
                        return;
                    }
                } else {
                    btn.classList.add('reacted');
                    count++;
                    btn.classList.add('reaction-bounce');
                    setTimeout(() => btn.classList.remove('reaction-bounce'), 400);
                }

                countSpan.textContent = count;
            }

            if (e.target.closest('.add-reaction-btn')) {
                if (!requireLogin()) return;
            }
        });

        // Initialize reaction adder
        function initReactionAdder(addReactionBtn, reactionPopup) {
            if (!addReactionBtn || !reactionPopup) return;

            addReactionBtn.addEventListener('click', (e) => {
                if (!requireLogin()) return;

                e.stopPropagation();
                reactionPopup.classList.toggle('hidden');
            });

            // Handle reaction selection
            reactionPopup.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    if (!requireLogin()) return;

                    e.stopPropagation();
                    const reaction = btn.dataset.reaction;
                    const emoji = btn.textContent;

                    // Check if this reaction already exists
                    const parentContainer = addReactionBtn.parentElement.parentElement;
                    const existingBtn = parentContainer.querySelector(`.reaction-btn[data-reaction="${reaction}"]`);

                    if (existingBtn) {
                        // Increment existing reaction
                        const countSpan = existingBtn.querySelector('span:last-child');
                        let count = parseInt(countSpan.textContent);
                        count++;
                        countSpan.textContent = count;

                        if (!existingBtn.classList.contains('reacted')) {
                            existingBtn.classList.add('reacted');
                            existingBtn.classList.add('reaction-bounce');
                            setTimeout(() => existingBtn.classList.remove('reaction-bounce'), 400);
                        }
                    } else {
                        // Create new reaction button
                        const newReactionBtn = document.createElement('button');
                        newReactionBtn.className = 'reaction-btn flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-blue-900 transition-all duration-300';
                        newReactionBtn.dataset.reaction = reaction;
                        newReactionBtn.innerHTML = `
                            <span>${emoji}</span>
                            <span class="text-sm font-medium">1</span>
                        `;
                        newReactionBtn.classList.add('reacted', 'reaction-bounce');
                        setTimeout(() => newReactionBtn.classList.remove('reaction-bounce'), 400);

                        // Insert before the reaction adder
                        addReactionBtn.parentElement.parentElement.insertBefore(newReactionBtn, addReactionBtn.parentElement);
                    }

                    reactionPopup.classList.add('hidden');
                });
            });

            // Close popup when clicking outside
            document.addEventListener('click', (e) => {
                if (!reactionPopup.contains(e.target) && e.target !== addReactionBtn) {
                    reactionPopup.classList.add('hidden');
                }
            });
        }

        // Initialize all reaction adders on page load
        function initAllReactionAdders() {
            document.querySelectorAll('.reaction-adder').forEach(adder => {
                const addReactionBtn = adder.querySelector('.add-reaction-btn');
                const reactionPopup = adder.querySelector('.reaction-popup');
                initReactionAdder(addReactionBtn, reactionPopup);
            });
        }

        // Enhanced Reply functionality with login check
        document.addEventListener('click', (e) => {
            if (e.target.closest('.reply-btn')) {
                if (!requireLogin()) return;

                const reviewItem = e.target.closest('.review-item');
                const replyForm = reviewItem.querySelector('.reply-form');

                // Hide all other reply forms
                document.querySelectorAll('.reply-form').forEach(form => {
                    if (form !== replyForm) {
                        form.classList.add('hidden');
                    }
                });

                replyForm.classList.toggle('hidden');
                if (!replyForm.classList.contains('hidden')) {
                    replyForm.querySelector('textarea').focus();
                }
            }

            if (e.target.closest('.cancel-reply')) {
                const replyForm = e.target.closest('.reply-form');
                replyForm.classList.add('hidden');
                replyForm.querySelector('textarea').value = '';
            }

            if (e.target.closest('.submit-reply')) {
                if (!requireLogin()) return;

                const replyForm = e.target.closest('.reply-form');
                const textarea = replyForm.querySelector('textarea');
                const replyText = textarea.value.trim();

                if (!replyText) {
                    showCustomAlert('يرجى كتابة رد');
                    return;
                }

                const repliesContainer = replyForm.previousElementSibling;
                const newReply = createReplyElement({
                    name: currentUser,
                    date: 'الآن',
                    comment: replyText,
                    isOwner: true
                });

                repliesContainer.appendChild(newReply);
                replyForm.classList.add('hidden');
                textarea.value = '';

                showCustomAlert('تم إضافة ردك بنجاح!', 'success');
            }
        });

        // Create reply element
        function createReplyElement(reply) {
            const div = document.createElement('div');
            div.className = 'reply bg-gray-50 dark:bg-gray-700 rounded-lg p-4 slide-in';
            div.dataset.replyId = Date.now();

            // إضافة أزرار التحكم للمالك فقط
            const ownerControls = reply.isOwner ? `
                <div class="owner-controls flex gap-2 mr-auto">
                    <button class="edit-reply-btn text-blue-500 hover:text-blue-700 text-xs font-medium transition-colors duration-300">
                        <i class="fas fa-edit ml-1"></i>
                        تعديل
                    </button>
                    <button class="delete-reply-btn text-red-500 hover:text-red-700 text-xs font-medium transition-colors duration-300">
                        <i class="fas fa-trash ml-1"></i>
                        حذف
                    </button>
                </div>
            ` : '';

            div.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center font-bold text-sm">
                        ${reply.name.charAt(0)}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h5 class="font-semibold text-sm">${reply.name}</h5>
                            <span class="text-xs text-gray-500 dark:text-gray-400">${reply.date}</span>
                            ${ownerControls}
                        </div>
                        <div class="reply-content">
                            <div class="markdown-content text-sm text-gray-700 dark:text-gray-300 mb-2">
                                ${marked.parse(reply.comment)}
                            </div>
                        </div>

                        <!-- Edit Form for Reply (Hidden by default) -->
                        <div class="edit-reply-form hidden mb-2">
                            <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 dark:bg-gray-600 px-3 py-2 border-b border-gray-300 dark:border-gray-500">
                                    <div class="flex gap-2 flex-wrap">
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="bold" title="عريض">
                                            <i class="fas fa-bold"></i>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="italic" title="مائل">
                                            <i class="fas fa-italic"></i>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="code" title="كود">
                                            <i class="fas fa-code"></i>
                                        </button>
                                        <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="h1" title="عنوان رئيسي">
                                            <i class="fas fa-heading text-xs"></i>
                                            <span class="text-xs">1</span>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="h2" title="عنوان فرعي">
                                            <i class="fas fa-heading text-xs"></i>
                                            <span class="text-xs">2</span>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="quote" title="اقتباس">
                                            <i class="fas fa-quote-right text-xs"></i>
                                        </button>
                                        <div class="w-px bg-gray-300 dark:bg-gray-500"></div>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="ul" title="قائمة نقاط">
                                            <i class="fas fa-list-ul text-xs"></i>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="ol" title="قائمة مرقمة">
                                            <i class="fas fa-list-ol text-xs"></i>
                                        </button>
                                        <button type="button" class="toolbar-btn p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-500 text-xs" data-action="link" title="رابط">
                                            <i class="fas fa-link text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <textarea class="edit-reply-input w-full p-3 text-sm resize-none bg-transparent border-none focus:outline-none min-h-[80px]" placeholder="اكتب ردك هنا...">${reply.comment}</textarea>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <button class="save-reply-edit-btn bg-primary hover:bg-secondary text-white px-3 py-1 rounded-lg font-semibold text-xs transition-all duration-300">
                                    حفظ
                                </button>
                                <button class="cancel-reply-edit-btn bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-3 py-1 rounded-lg font-semibold text-xs transition-all duration-300">
                                    إلغاء
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="reaction-adder relative">
                                <button class="add-reaction-btn flex items-center gap-1 px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-300 text-xs">
                                    <span>+</span>
                                </button>
                                <div class="reaction-popup hidden">
                                    <button data-reaction="like">👍</button>
                                    <button data-reaction="love">❤️</button>
                                    <button data-reaction="laugh">😂</button>
                                    <button data-reaction="wow">😮</button>
                                    <button data-reaction="sad">😢</button>
                                    <button data-reaction="angry">😠</button>
                                    <button data-reaction="celebrate">🎉</button>
                                    <button data-reaction="thinking">🤔</button>
                                    <button data-reaction="fire">🔥</button>
                                    <button data-reaction="clap">👏</button>
                                    <button data-reaction="star">⭐</button>
                                    <button data-reaction="rocket">🚀</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Initialize reaction adder for the reply
            setTimeout(() => {
                const addReactionBtn = div.querySelector('.add-reaction-btn');
                const reactionPopup = div.querySelector('.reaction-popup');
                initReactionAdder(addReactionBtn, reactionPopup);
            }, 100);

            return div;
        }

        // Enhanced Owner controls functionality with interactive rating
        document.addEventListener('click', (e) => {
            // Edit review
            if (e.target.closest('.edit-review-btn')) {
                const reviewItem = e.target.closest('.review-item');
                const editForm = reviewItem.querySelector('.edit-form');
                const reviewContent = reviewItem.querySelector('.review-content');

                editForm.classList.remove('hidden');
                reviewContent.classList.add('hidden');

                // Focus on textarea
                editForm.querySelector('textarea').focus();
            }

            // Cancel edit review
            if (e.target.closest('.cancel-edit-btn')) {
                const reviewItem = e.target.closest('.review-item');
                const editForm = reviewItem.querySelector('.edit-form');
                const reviewContent = reviewItem.querySelector('.review-content');

                editForm.classList.add('hidden');
                reviewContent.classList.remove('hidden');
            }

            // Enhanced Save edit review with rating update
            if (e.target.closest('.save-edit-btn')) {
                const reviewItem = e.target.closest('.review-item');
                const editForm = reviewItem.querySelector('.edit-form');
                const reviewContent = reviewItem.querySelector('.review-content');
                const newComment = editForm.querySelector('.edit-comment-input').value.trim();
                const newRating = parseInt(editForm.querySelector('.edit-rating-value').value);

                if (!newComment) {
                    showCustomAlert('يرجى كتابة تعليق');
                    return;
                }

                if (!newRating || newRating < 1 || newRating > 5) {
                    showCustomAlert('يرجى اختيار تقييم صحيح');
                    return;
                }

                // Get the old rating before updating
                const oldRating = getRatingFromReview(reviewItem);

                // Update statistics if rating changed
                updateRatingOnEdit(oldRating, newRating);

                // Update rating display
                const starsContainer = reviewItem.querySelector('.flex.text-yellow-500');
                starsContainer.innerHTML = Array.from({
                        length: 5
                    }, (_, i) =>
                    i < newRating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>'
                ).join('');

                // Update comment
                reviewContent.querySelector('.markdown-content').innerHTML = marked.parse(newComment);

                editForm.classList.add('hidden');
                reviewContent.classList.remove('hidden');

                showCustomAlert('تم تحديث التقييم بنجاح!', 'success');
            }

            // Enhanced Edit star rating functionality
            if (e.target.closest('.edit-star')) {
                const star = e.target.closest('.edit-star');
                const rating = parseInt(star.dataset.rating);
                const editForm = star.closest('.edit-form');
                const ratingContainer = editForm.querySelector('.edit-rating-container');
                const allStars = ratingContainer.querySelectorAll('.edit-star');
                const hiddenInput = editForm.querySelector('.edit-rating-value');

                // Update hidden input value
                hiddenInput.value = rating;

                // Remove selected class from all stars
                allStars.forEach(s => s.classList.remove('selected', 'text-yellow-500'));
                allStars.forEach(s => s.classList.add('text-gray-300', 'dark:text-gray-600'));

                // Add selected class to clicked star and all previous stars
                for (let i = 0; i < rating; i++) {
                    allStars[i].classList.add('selected', 'text-yellow-500');
                    allStars[i].classList.remove('text-gray-300', 'dark:text-gray-600');
                }

                // Add animation effect
                star.classList.add('star-fill');
                setTimeout(() => star.classList.remove('star-fill'), 300);
            }

            // Delete review
            if (e.target.closest('.delete-review-btn')) {
                const reviewItem = e.target.closest('.review-item');

                showConfirmationModal('هل أنت متأكد من حذف هذا التقييم؟', () => {
                    // Get the rating before deleting the review
                    const deletedRating = getRatingFromReview(reviewItem);

                    // Remove from statistics
                    removeRatingFromStatistics(deletedRating);

                    // Remove element with animation
                    reviewItem.style.transform = 'scale(0)';
                    reviewItem.style.opacity = '0';
                    setTimeout(() => {
                        reviewItem.remove();
                    }, 300);

                    showCustomAlert('تم حذف التقييم بنجاح!', 'success');
                });
            }

            // Edit reply
            if (e.target.closest('.edit-reply-btn')) {
                const reply = e.target.closest('.reply');
                const editForm = reply.querySelector('.edit-reply-form');
                const replyContent = reply.querySelector('.reply-content');

                editForm.classList.remove('hidden');
                replyContent.classList.add('hidden');

                editForm.querySelector('textarea').focus();
            }

            // Cancel edit reply
            if (e.target.closest('.cancel-reply-edit-btn')) {
                const reply = e.target.closest('.reply');
                const editForm = reply.querySelector('.edit-reply-form');
                const replyContent = reply.querySelector('.reply-content');

                editForm.classList.add('hidden');
                replyContent.classList.remove('hidden');
            }

            // Save edit reply
            if (e.target.closest('.save-reply-edit-btn')) {
                const reply = e.target.closest('.reply');
                const editForm = reply.querySelector('.edit-reply-form');
                const replyContent = reply.querySelector('.reply-content');
                const newComment = editForm.querySelector('.edit-reply-input').value.trim();

                if (!newComment) {
                    showCustomAlert('يرجى كتابة رد');
                    return;
                }

                replyContent.querySelector('.markdown-content').innerHTML = marked.parse(newComment);

                editForm.classList.add('hidden');
                replyContent.classList.remove('hidden');

                showCustomAlert('تم تحديث الرد بنجاح!', 'success');
            }

            // Delete reply
            if (e.target.closest('.delete-reply-btn')) {
                const reply = e.target.closest('.reply');
                showConfirmationModal('هل أنت متأكد من حذف هذا الرد؟', () => {
                    reply.style.transform = 'scale(0)';
                    reply.style.opacity = '0';
                    setTimeout(() => {
                        reply.remove();
                    }, 300);
                    showCustomAlert('تم حذف الرد بنجاح!', 'success');
                });
            }
        });

        // Custom confirmation modal
        function showConfirmationModal(message, onConfirm) {
            const modal = document.createElement('div');
            modal.className = 'modal';
            modal.innerHTML = `
                <div class="modal-content">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">تأكيد الحذف</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">${message}</p>
                    <div class="flex justify-end space-x-3 gap-3">
                        <button class="cancel-modal px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition-colors duration-300">إلغاء</button>
                        <button class="confirm-modal px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded transition-colors duration-300">حذف</button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            modal.querySelector('.cancel-modal').addEventListener('click', () => {
                modal.remove();
            });

            modal.querySelector('.confirm-modal').addEventListener('click', () => {
                onConfirm();
                modal.remove();
            });

            // Close on backdrop click
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        // Filter functionality
        document.addEventListener('click', (e) => {
            if (e.target.closest('.filter-tab')) {
                const tab = e.target.closest('.filter-tab');
                const filter = tab.dataset.filter;

                // Update active tab
                document.querySelectorAll('.filter-tab').forEach(t => {
                    t.className = 'filter-tab px-4 py-2 font-semibold border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:text-primary transition-colors';
                });
                tab.className = 'filter-tab px-4 py-2 font-semibold border-b-2 border-primary text-primary';

                // Filter reviews
                const reviews = document.querySelectorAll('.review-item');
                reviews.forEach(review => {
                    const sentiment = review.dataset.sentiment;
                    if (filter === 'all') {
                        review.style.display = 'block';
                    } else if (filter === 'positive' && (sentiment === 'positive' || sentiment === 'neutral')) {
                        review.style.display = 'block';
                    } else if (filter === 'negative' && sentiment === 'negative') {
                        review.style.display = 'block';
                    } else {
                        review.style.display = 'none';
                    }
                });
            }
        });

        // Custom alert function
        function showCustomAlert(message, type = 'info') {
            const alert = document.createElement('div');
            alert.className = `
                fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm slide-in ${
                    type === 'success' ? 'bg-green-500 text-white' :
                    type === 'error' ? 'bg-red-500 text-white' :
                    'bg-blue-500 text-white'
                }
            `;
            alert.textContent = message;

            document.body.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 3000);
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', () => {
            updateAuthUI();
            initOverallStars();
            initRatingInput();
            initToolbar();
            initAllReactionAdders();
        });
    </script>
</body>

</html>