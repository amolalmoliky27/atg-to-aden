<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم التقييمات والتعليقات - لوحة تحكم بسيطة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        secondary: '#4F46E5'
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

        .tab-active {
            border-bottom: 2px solid #5D5CDE;
            color: #5D5CDE;
            background: rgba(93, 92, 222, 0.1);
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        footer {
            margin-top: auto;
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
            .news-ticker-content {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <div id="app">
        <div class="main-content">
            <div class="max-w-6xl mx-auto p-4 sm:p-6">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-secondary p-6 rounded-2xl shadow-xl mb-4">
                    <h1 class="text-3xl font-bold text-white text-center mb-2">لوحة تحكم التقييمات والتعليقات</h1>
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

                <!-- Tabs -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg mb-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex border-b border-gray-200 dark:border-gray-700">
                        <button class="tab-btn px-6 py-4 font-semibold tab-active" data-tab="reviews">
                            <i class="fas fa-star ml-2"></i>
                            التقييمات والتعليقات
                        </button>
                        <button
                            class="tab-btn px-6 py-4 font-semibold text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                            data-tab="replies">
                            <i class="fas fa-comments ml-2"></i>
                            الردود
                        </button>
                        <button
                            class="tab-btn px-6 py-4 font-semibold text-gray-600 dark:text-gray-400 hover:text-primary transition-colors"
                            data-tab="reactions">
                            <i class="fas fa-heart ml-2"></i>
                            التفاعلات
                        </button>
                    </div>
                </div>

                <!-- Filter Bar -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 mb-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                            <i class="fas fa-filter ml-2 text-primary"></i>
                            فلترة النتائج
                        </h3>
                        <select id="filterSelect"
                            class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-base font-medium shadow-sm hover:shadow-md transition-all duration-200 focus:ring-2 focus:ring-primary focus:border-primary">
                            <!-- Options will be populated based on active tab -->
                        </select>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviewsTab" class="space-y-4">
                    <!-- Reviews will be populated here -->
                </div>

                <!-- Replies Tab -->
                <div id="repliesTab" class="space-y-4 hidden">
                    <!-- Replies will be populated here -->
                </div>

                <!-- Reactions Tab -->
                <div id="reactionsTab" class="space-y-4 hidden">
                    <!-- Reactions will be populated here -->
                </div>
            </div>
        </div>



        <!-- Footer -->
        <footer class="text-white py-8" style="
            background: #705bb3;
            background: linear-gradient(90deg, rgb(71, 83, 219) 0%, rgba(70, 47, 204, 0.92) 100%);
        ">
            <div class="container mx-auto px-4 text-center">
                <p class="text-white flex justify-center items-center gap-4">
                    <span>المراجعة والتقييم</span>
                    <span><i>BY MANAL FROM WEB PIONEER 2025</i>© </span>
                </p>
            </div>
        </footer>
    </div>

    <!-- Edit Review Modal -->
    <div id="editReviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">تعديل التقييم</h3>
                    <button
                        class="close-modal text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">المستخدم</label>
                        <input type="text" id="editReviewUserName" readonly
                            class="w-full p-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">التقييم</label>
                        <select id="editReviewRating" readonly disabled
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 cursor-not-allowed">
                            <option value="1">1 نجمة</option>
                            <option value="2">2 نجمة</option>
                            <option value="3">3 نجوم</option>
                            <option value="4">4 نجوم</option>
                            <option value="5">5 نجوم</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">التعليق</label>
                        <textarea id="editReviewComment" rows="5"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 resize-none"></textarea>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button id="saveReviewEdit"
                            class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                            <i class="fas fa-save ml-2"></i>
                            حفظ التغييرات
                        </button>
                        <button
                            class="close-modal bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                            إلغاء
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Reply Modal -->
    <div id="editReplyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">تعديل الرد</h3>
                    <button
                        class="close-modal text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">المستخدم</label>
                        <input type="text" id="editReplyUserName" readonly
                            class="w-full p-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">الرد على</label>
                        <input type="text" id="editReplyParent" readonly
                            class="w-full p-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">الرد</label>
                        <textarea id="editReplyComment" rows="4"
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 resize-none"></textarea>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button id="saveReplyEdit"
                            class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                            <i class="fas fa-save ml-2"></i>
                            حفظ التغييرات
                        </button>
                        <button
                            class="close-modal bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300">
                            إلغاء
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4 text-red-600">تأكيد الحذف</h3>
                <p id="deleteMessage" class="text-gray-600 dark:text-gray-400 mb-6">هل أنت متأكد من حذف هذا العنصر؟ لا
                    يمكن التراجع عن هذا الإجراء.</p>
                <div class="flex gap-3 justify-end">
                    <button id="cancelDelete"
                        class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">إلغاء</button>
                    <button id="confirmDelete"
                        class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded-lg">حذف</button>
                </div>
            </div>
        </div>
    </div>

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

        // Sample data
        let reviewsData = [{
                id: 1,
                user: 'محمد أحمد',
                rating: 5,
                comment: 'مدينة عدن التاريخية مكان **رائع** جداً! خاصة منطقة كريتر والأسواق القديمة. المناظر الطبيعية خلابة والتاريخ عريق.',
                date: '2024-01-15',
                reactions: ['like-1', 'love-2', 'like-3']
            },
            {
                id: 2,
                user: 'سارة محمود',
                rating: 4,
                comment: 'شاطئ الغدير جميل جداً ولكن يحتاج لمزيد من التطوير والخدمات السياحية.',
                date: '2024-01-14',
                reactions: ['like-4', 'love-5']
            },
            {
                id: 3,
                user: 'علي سالم',
                rating: 2,
                comment: 'للأسف حديقة السبعين لم تعد كما كانت عليه من قبل. تحتاج لإعادة تأهيل وصيانة.',
                date: '2024-01-13',
                reactions: ['sad-6', 'angry-7']
            }
        ];

        let repliesData = [{
                id: 1,
                user: 'فاطمة أحمد',
                comment: 'أتفق معك تماماً! زرت كريتر الأسبوع الماضي والمكان فعلاً تاريخي ومميز.',
                parentReview: 'محمد أحمد',
                parentComment: 'مدينة عدن التاريخية مكان **رائع** جداً! خاصة منطقة كريتر والأسواق القديمة. المناظر الطبيعية خلابة والتاريخ عريق.',
                parentRating: 5,
                parentId: 1,
                date: '2024-01-15',
                reactions: ['like-8', 'love-9']
            },
            {
                id: 2,
                user: 'خالد محمد',
                comment: 'هل يمكنك توضيح أكثر عن الخدمات المفقودة في الشاطئ؟',
                parentReview: 'سارة محمود',
                parentComment: 'شاطئ الغدير جميل جداً ولكن يحتاج لمزيد من التطوير والخدمات السياحية.',
                parentRating: 4,
                parentId: 2,
                date: '2024-01-14',
                reactions: ['like-10']
            },
            {
                id: 3,
                user: 'أميرة سالم',
                comment: 'للأسف أنا أيضاً لاحظت إهمال الحديقة. كانت من أجمل الأماكن في عدن.',
                parentReview: 'علي سالم',
                parentComment: 'للأسف حديقة السبعين لم تعد كما كانت عليه من قبل. تحتاج لإعادة تأهيل وصيانة.',
                parentRating: 2,
                parentId: 3,
                date: '2024-01-13',
                reactions: ['sad-11', 'sad-12']
            }
        ];

        let reactionsData = [{
                id: 'like-1',
                user: 'أحمد علي',
                type: 'like',
                emoji: '👍',
                target: 'تقييم محمد أحمد',
                targetType: 'review',
                targetId: 1,
                targetRating: 5,
                targetComment: 'مدينة عدن التاريخية مكان **رائع** جداً! خاصة منطقة كريتر والأسواق القديمة. المناظر الطبيعية خلابة والتاريخ عريق.',
                date: '2024-01-15'
            },
            {
                id: 'love-2',
                user: 'سعد محمد',
                type: 'love',
                emoji: '❤️',
                target: 'تقييم محمد أحمد',
                targetType: 'review',
                targetId: 1,
                targetRating: 5,
                targetComment: 'مدينة عدن التاريخية مكان **رائع** جداً! خاصة منطقة كريتر والأسواق القديمة. المناظر الطبيعية خلابة والتاريخ عريق.',
                date: '2024-01-15'
            },
            {
                id: 'like-3',
                user: 'مريم أحمد',
                type: 'like',
                emoji: '👍',
                target: 'تقييم محمد أحمد',
                targetType: 'review',
                targetId: 1,
                targetRating: 5,
                targetComment: 'مدينة عدن التاريخية مكان **رائع** جداً! خاصة منطقة كريتر والأسواق القديمة. المناظر الطبيعية خلابة والتاريخ عريق.',
                date: '2024-01-15'
            },
            {
                id: 'like-4',
                user: 'يوسف سالم',
                type: 'like',
                emoji: '👍',
                target: 'تقييم سارة محمود',
                targetType: 'review',
                targetId: 2,
                targetRating: 4,
                targetComment: 'شاطئ الغدير جميل جداً ولكن يحتاج لمزيد من التطوير والخدمات السياحية.',
                date: '2024-01-14'
            },
            {
                id: 'love-5',
                user: 'نورا خالد',
                type: 'love',
                emoji: '❤️',
                target: 'تقييم سارة محمود',
                targetType: 'review',
                targetId: 2,
                targetRating: 4,
                targetComment: 'شاطئ الغدير جميل جداً ولكن يحتاج لمزيد من التطوير والخدمات السياحية.',
                date: '2024-01-14'
            },
            {
                id: 'sad-6',
                user: 'عبدالله محمد',
                type: 'sad',
                emoji: '😢',
                target: 'تقييم علي سالم',
                targetType: 'review',
                targetId: 3,
                targetRating: 2,
                targetComment: 'للأسف حديقة السبعين لم تعد كما كانت عليه من قبل. تحتاج لإعادة تأهيل وصيانة.',
                date: '2024-01-13'
            },
            {
                id: 'angry-7',
                user: 'ليلى أحمد',
                type: 'angry',
                emoji: '😠',
                target: 'تقييم علي سالم',
                targetType: 'review',
                targetId: 3,
                targetRating: 2,
                targetComment: 'للأسف حديقة السبعين لم تعد كما كانت عليه من قبل. تحتاج لإعادة تأهيل وصيانة.',
                date: '2024-01-13'
            },
            {
                id: 'like-8',
                user: 'محمد سعد',
                type: 'like',
                emoji: '👍',
                target: 'رد فاطمة أحمد',
                targetType: 'reply',
                targetId: 1,
                targetComment: 'أتفق معك تماماً! زرت كريتر الأسبوع الماضي والمكان فعلاً تاريخي ومميز.',
                date: '2024-01-15'
            },
            {
                id: 'love-9',
                user: 'زينب علي',
                type: 'love',
                emoji: '❤️',
                target: 'رد فاطمة أحمد',
                targetType: 'reply',
                targetId: 1,
                targetComment: 'أتفق معك تماماً! زرت كريتر الأسبوع الماضي والمكان فعلاً تاريخي ومميز.',
                date: '2024-01-15'
            },
            {
                id: 'like-10',
                user: 'هشام محمد',
                type: 'like',
                emoji: '👍',
                target: 'رد خالد محمد',
                targetType: 'reply',
                targetId: 2,
                targetComment: 'هل يمكنك توضيح أكثر عن الخدمات المفقودة في الشاطئ؟',
                date: '2024-01-14'
            },
            {
                id: 'sad-11',
                user: 'رانيا سالم',
                type: 'sad',
                emoji: '😢',
                target: 'رد أميرة سالم',
                targetType: 'reply',
                targetId: 3,
                targetComment: 'للأسف أنا أيضاً لاحظت إهمال الحديقة. كانت من أجمل الأماكن في عدن.',
                date: '2024-01-13'
            },
            {
                id: 'sad-12',
                user: 'كريم أحمد',
                type: 'sad',
                emoji: '😢',
                target: 'رد أميرة سالم',
                targetType: 'reply',
                targetId: 3,
                targetComment: 'للأسف أنا أيضاً لاحظت إهمال الحديقة. كانت من أجمل الأماكن في عدن.',
                date: '2024-01-13'
            }
        ];

        let currentTab = 'reviews';
        let currentEditId = null;
        let currentDeleteId = null;
        let currentDeleteType = null;

        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tab = btn.dataset.tab;
                switchTab(tab);
            });
        });

        function switchTab(tab) {
            currentTab = tab;

            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('text-gray-600', 'dark:text-gray-400');
            });
            document.querySelector(`[data-tab="${tab}"]`).classList.add('tab-active');
            document.querySelector(`[data-tab="${tab}"]`).classList.remove('text-gray-600', 'dark:text-gray-400');

            // Hide all tabs
            document.querySelectorAll('[id$="Tab"]').forEach(tabContent => {
                tabContent.classList.add('hidden');
            });

            // Show current tab
            document.getElementById(`${tab}Tab`).classList.remove('hidden');

            // Update filter options
            updateFilterOptions();

            // Render content
            if (tab === 'reviews') {
                renderReviews();
            } else if (tab === 'replies') {
                renderReplies();
            } else if (tab === 'reactions') {
                renderReactions();
            }
        }

        function updateFilterOptions() {
            const filterSelect = document.getElementById('filterSelect');
            filterSelect.innerHTML = '';

            if (currentTab === 'reviews') {
                filterSelect.innerHTML = `
                    <option value="all">جميع التقييمات</option>
                    <option value="5">5 نجوم</option>
                    <option value="4">4 نجوم</option>
                    <option value="3">3 نجوم</option>
                    <option value="2">2 نجوم</option>
                    <option value="1">1 نجمة</option>
                `;
            } else if (currentTab === 'replies') {
                filterSelect.innerHTML = `
                    <option value="all">جميع الردود</option>
                    <option value="recent">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                `;
            } else if (currentTab === 'reactions') {
                filterSelect.innerHTML = `
                    <option value="all">جميع التفاعلات</option>
                    <option value="recent">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                `;
            }
        }

        // Render functions
        function renderReviews(reviews = reviewsData) {
            const container = document.getElementById('reviewsTab');
            container.innerHTML = '';

            reviews.forEach(review => {
                const reviewCard = createReviewCard(review);
                container.appendChild(reviewCard);
            });
        }

        function renderReplies(replies = repliesData) {
            const container = document.getElementById('repliesTab');
            container.innerHTML = '';

            replies.forEach(reply => {
                const replyCard = createReplyCard(reply);
                container.appendChild(replyCard);
            });
        }

        function renderReactions(reactions = reactionsData) {
            const container = document.getElementById('reactionsTab');
            container.innerHTML = '';

            reactions.forEach(reaction => {
                const reactionCard = createReactionCard(reaction);
                container.appendChild(reactionCard);
            });
        }

        // Create card functions
        function createReviewCard(review) {
            const div = document.createElement('div');
            div.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700';

            const stars = Array.from({
                    length: 5
                }, (_, i) =>
                i < review.rating ? '<i class="fas fa-star text-yellow-500"></i>' : '<i class="far fa-star text-yellow-500"></i>'
            ).join('');

            const reactionCount = review.reactions.length;

            div.innerHTML = `
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-lg">
                            ${review.user.charAt(0)}
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg">${review.user}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex">${stars}</div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">${review.date}</span>
                                <span class="text-sm text-blue-500">• ${reactionCount} تفاعل</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editReview(${review.id})" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="تعديل">
                            <i class="fas fa-edit text-lg"></i>
                        </button>
                        <button onclick="deleteItem(${review.id}, 'review')" class="text-red-600 hover:text-red-800 dark:text-red-400 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="حذف">
                            <i class="fas fa-trash text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        ${marked.parse(review.comment)}
                    </div>
                </div>
            `;

            return div;
        }

        function createReplyCard(reply) {
            const div = document.createElement('div');
            div.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700';

            const reactionCount = reply.reactions.length;

            div.innerHTML = `
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center font-bold">
                            ${reply.user.charAt(0)}
                        </div>
                        <div>
                            <h4 class="font-semibold">${reply.user}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm text-gray-500 dark:text-gray-400">رد على: ${reply.parentReview}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">• ${reply.date}</span>
                                <span class="text-sm text-blue-500">• ${reactionCount} تفاعل</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editReply(${reply.id})" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteItem(${reply.id}, 'reply')" class="text-red-600 hover:text-red-800 dark:text-red-400 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="حذف">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Original Comment -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-4 border-r-4 border-blue-500">
                    <div class="flex items-center gap-2 mb-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">التعليق الأصلي:</p>
                        <div class="flex text-sm">
                            ${Array.from({ length: 5 }, (_, i) =>
                i < reply.parentRating ? '<i class="fas fa-star text-yellow-500"></i>' : '<i class="far fa-star text-yellow-500"></i>'
            ).join('')}
                        </div>
                    </div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">
                        ${marked.parse(reply.parentComment)}
                    </div>
                </div>

                <!-- Reply Content -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        ${marked.parse(reply.comment)}
                    </div>
                </div>
            `;

            return div;
        }

        function createReactionCard(reaction) {
            const div = document.createElement('div');
            div.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700';

            div.innerHTML = `
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-2xl">
                            ${reaction.emoji}
                        </div>
                        <div>
                            <h4 class="font-semibold">${reaction.user}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">تفاعل مع: ${reaction.target}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">${reaction.date}</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="deleteItem('${reaction.id}', 'reaction')" class="text-red-600 hover:text-red-800 dark:text-red-400 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="حذف">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Target Content -->
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border-r-4 border-green-500">
                    <div class="flex items-center gap-2 mb-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">المحتوى المُتفاعل معه:</p>
                        ${reaction.targetRating ? `
                            <div class="flex text-sm">
                                ${Array.from({ length: 5 }, (_, i) =>
                i < reaction.targetRating ? '<i class="fas fa-star text-yellow-500"></i>' : '<i class="far fa-star text-yellow-500"></i>'
            ).join('')}
                            </div>
                        ` : ''}
                    </div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">
                        ${marked.parse(reaction.targetComment)}
                    </div>
                </div>
            `;

            return div;
        }

        // Edit functions
        function editReview(id) {
            const review = reviewsData.find(r => r.id === id);
            if (!review) return;

            currentEditId = id;
            document.getElementById('editReviewUserName').value = review.user;
            document.getElementById('editReviewRating').value = review.rating;
            document.getElementById('editReviewComment').value = review.comment;
            document.getElementById('editReviewModal').classList.remove('hidden');
        }

        function editReply(id) {
            const reply = repliesData.find(r => r.id === id);
            if (!reply) return;

            currentEditId = id;
            document.getElementById('editReplyUserName').value = reply.user;
            document.getElementById('editReplyParent').value = reply.parentReview;
            document.getElementById('editReplyComment').value = reply.comment;
            document.getElementById('editReplyModal').classList.remove('hidden');
        }

        // Save functions
        function saveReviewEdit() {
            if (!currentEditId) return;

            const review = reviewsData.find(r => r.id === currentEditId);
            if (!review) return;

            const newComment = document.getElementById('editReviewComment').value.trim();

            if (!newComment) {
                showAlert('يرجى كتابة التعليق', 'error');
                return;
            }

            // Only update the comment, rating stays the same
            review.comment = newComment;

            renderReviews();
            closeModal('editReviewModal');
            showAlert('تم حفظ التغييرات بنجاح!', 'success');
        }

        function saveReplyEdit() {
            if (!currentEditId) return;

            const reply = repliesData.find(r => r.id === currentEditId);
            if (!reply) return;

            const newComment = document.getElementById('editReplyComment').value.trim();

            if (!newComment) {
                showAlert('يرجى كتابة الرد', 'error');
                return;
            }

            reply.comment = newComment;

            renderReplies();
            closeModal('editReplyModal');
            showAlert('تم حفظ التغييرات بنجاح!', 'success');
        }

        // Delete functions
        function deleteItem(id, type) {
            currentDeleteId = id;
            currentDeleteType = type;

            const message = type === 'review' ? 'هل أنت متأكد من حذف هذا التقييم؟' :
                type === 'reply' ? 'هل أنت متأكد من حذف هذا الرد؟' :
                'هل أنت متأكد من حذف هذا التفاعل؟';

            document.getElementById('deleteMessage').textContent = message;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function confirmDelete() {
            if (!currentDeleteId || !currentDeleteType) return;

            if (currentDeleteType === 'review') {
                const index = reviewsData.findIndex(r => r.id === currentDeleteId);
                if (index !== -1) {
                    // Also remove related reactions and replies
                    reactionsData = reactionsData.filter(r => !(r.targetType === 'review' && r.targetId === currentDeleteId));
                    repliesData = repliesData.filter(r => r.parentId !== currentDeleteId);
                    reviewsData.splice(index, 1);
                    renderReviews();
                }
            } else if (currentDeleteType === 'reply') {
                const index = repliesData.findIndex(r => r.id === currentDeleteId);
                if (index !== -1) {
                    // Also remove related reactions
                    reactionsData = reactionsData.filter(r => !(r.targetType === 'reply' && r.targetId === currentDeleteId));
                    repliesData.splice(index, 1);
                    renderReplies();
                }
            } else if (currentDeleteType === 'reaction') {
                const index = reactionsData.findIndex(r => r.id === currentDeleteId);
                if (index !== -1) {
                    reactionsData.splice(index, 1);
                    renderReactions();
                    // Update review/reply reaction counts
                    if (currentTab === 'reviews') renderReviews();
                    if (currentTab === 'replies') renderReplies();
                }
            }

            closeModal('deleteModal');
            showAlert('تم الحذف بنجاح!', 'success');
        }

        // Modal functions
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            currentEditId = null;
            currentDeleteId = null;
            currentDeleteType = null;
        }

        // Filter content
        function filterContent() {
            const filterValue = document.getElementById('filterSelect').value;

            if (currentTab === 'reviews') {
                let filtered = reviewsData;

                if (filterValue !== 'all') {
                    filtered = filtered.filter(review => review.rating == filterValue);
                }

                renderReviews(filtered);
            } else if (currentTab === 'replies') {
                let filtered = [...repliesData];

                if (filterValue === 'recent') {
                    filtered = filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
                } else if (filterValue === 'oldest') {
                    filtered = filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
                }

                renderReplies(filtered);
            } else if (currentTab === 'reactions') {
                let filtered = [...reactionsData];

                if (filterValue === 'recent') {
                    filtered = filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
                } else if (filterValue === 'oldest') {
                    filtered = filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
                }

                renderReactions(filtered);
            }
        }

        // Alert function
        function showAlert(message, type = 'info') {
            const alert = document.createElement('div');
            alert.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm slide-in ${type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                    'bg-blue-500 text-white'
                }`;
            alert.textContent = message;

            document.body.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 3000);
        }

        // Event listeners
        document.getElementById('filterSelect').addEventListener('change', filterContent);

        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const modal = e.target.closest('[id$="Modal"]');
                if (modal) closeModal(modal.id);
            });
        });

        document.getElementById('saveReviewEdit').addEventListener('click', saveReviewEdit);
        document.getElementById('saveReplyEdit').addEventListener('click', saveReplyEdit);
        document.getElementById('cancelDelete').addEventListener('click', () => closeModal('deleteModal'));
        document.getElementById('confirmDelete').addEventListener('click', confirmDelete);

        // Close modals when clicking outside
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === e.currentTarget) closeModal(modal.id);
            });
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            switchTab('reviews');
        });
    </script>
</body>

</html>