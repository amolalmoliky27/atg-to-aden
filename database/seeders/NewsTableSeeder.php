<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ['سياحة', 'فعاليات', 'ثقافة', 'تراث', 'تطوير'];
        $locations = [
            'شاطئ الذهبي',
            'قلعة صيرة',
            'مطار عدن الدولي',
            'منطقة كريتر',
            'منطقة التواهي',
            'منطقة المعلا',
            'منطقة خورمكسر',
            'منطقة الشيخ عثمان'
        ];

        $news = [
            [
                'title' => 'مهرجان السياحة الأول في عدن يجذب آلاف الزوار',
                'content' => 'شهدت مدينة عدن إقبالاً كبيراً على مهرجان السياحة الأول الذي نظمته وزارة السياحة بالتعاون مع محافظة عدن. حيث تم تقديم عروض تراثية وفنية متنوعة تعكس ثقافة وتاريخ المدينة الساحلية.',
                'category' => 'سياحة',
                'location' => $locations[0],
                'author' => 'أحمد البحري',
                'image' => 'news_images/tourism_festival.jpg',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'افتتاح مركز ثقافي جديد في منطقة كريتر',
                'content' => 'تم اليوم افتتاح المركز الثقافي الجديد في قلب منطقة كريتر التاريخية، والذي يهدف إلى دعم المواهب الشابة في مجال الفنون والآداب. يحتوي المركز على قاعة للمعارض ومكتبة ومسرح صغير.',
                'category' => 'ثقافة',
                'location' => $locations[3],
                'author' => 'فاطمة العولقي',
                'image' => 'news_images/cultural_center.jpg',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'مشروع تطوير الواجهة البحرية يدخل مراحله النهائية',
                'content' => 'أعلنت شركة التطوير العمراني عن قرب اكتمال مشروع تطوير الواجهة البحرية لمدينة عدن، والذي يشمل إنشاء ممشى سياحي وحدائق عامة ومناطق ترفيهية. من المتوقع أن يسهم المشروع في تنشيط الحركة السياحية.',
                'category' => 'تطوير',
                'location' => $locations[0],
                'author' => 'محمد السقاف',
                'image' => 'news_images/waterfront_project.jpg',
                'created_at' => Carbon::now()->subWeek(),
                'updated_at' => Carbon::now()->subWeek(),
            ],
            [
                'title' => 'معرض التراث اليمني يعرض مخطوطات نادرة',
                'content' => 'انطلق معرض التراث اليمني في متحف عدن الوطني بمشاركة 20 داراً للمخطوطات والتحف الأثرية. يعرض المعرض مخطوطات تاريخية نادرة تعود إلى القرن العاشر الهجري، بالإضافة إلى قطع أثرية من مختلف مناطق اليمن.',
                'category' => 'تراث',
                'location' => $locations[3],
                'author' => 'علي ناصر',
                'image' => 'news_images/heritage_exhibition.jpg',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'حفل غنائي ضخم في قلعة صيرة',
                'content' => 'تنظم وزارة الثقافة حفلاً غنائياً ضخماً في قلعة صيرة التاريخية بمشاركة أشهر الفنانين اليمنيين والعرب. سيقام الحفل يوم الجمعة القادم وسيتم بثه مباشرة على القنوات المحلية والعربية.',
                'category' => 'فعاليات',
                'location' => $locations[1],
                'author' => 'لمى عبدالله',
                'image' => 'news_images/music_concert.jpg',
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'title' => 'انتهاء أعمال ترميم سوق العيدروس التاريخي',
                'content' => 'أكملت فرق الترميم أعمالها في سوق العيدروس التاريخي بعد عامين من العمل المتواصل. تم ترميم 50 محلاً تجارياً وإعادة تأهيل البنية التحتية للسوق مع الحفاظ على الطراز المعماري الأصلي.',
                'category' => 'تراث',
                'location' => $locations[3],
                'author' => 'خالد بامطرف',
                'image' => null,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'مشروع جديد لزراعة أشجار المانجروف على السواحل',
                'content' => 'أطلقت جمعية حماية البيئة مشروعاً لزراعة 10 آلاف شتلة من أشجار المانجروف على سواحل عدن. يهدف المشروع إلى حماية الشواطئ من التآكل وتوفير موائل طبيعية للأسماك والطيور.',
                'category' => 'تطوير',
                'location' => $locations[0],
                'author' => 'نادية أحمد',
                'image' => 'news_images/mangrove_project.jpg',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'متحف عدن يطلق برنامجاً للزيارات المدرسية المجانية',
                'content' => 'أعلن متحف عدن الوطني عن إطلاق برنامج الزيارات المدرسية المجانية لطلاب المدارس الحكومية. يتضمن البرنامج جولات إرشادية وورش عمل حول تاريخ المدينة وحضارتها.',
                'category' => 'ثقافة',
                'location' => $locations[3],
                'author' => 'سامي الجفري',
                'image' => 'news_images/museum_program.jpg',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'مهرجان الأطعمة البحرية يجذب عشاق المأكولات البحرية',
                'content' => 'انطلقت فعاليات مهرجان الأطعمة البحرية في كورنيش عدن بمشاركة 30 مطعماً متخصصاً. يقدم المهرجان تشكيلة واسعة من الأطباق البحرية بأسعار مخفضة مع عروض ترفيهية مصاحبة.',
                'category' => 'فعاليات',
                'location' => $locations[0],
                'author' => 'يوسف الحسني',
                'image' => 'news_images/seafood_festival.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'إطلاق خدمة العبارات البحرية بين عدن والمخا',
                'content' => 'أطلقت شركة النقل البحري خدمة جديدة للعبارات البحرية بين ميناء عدن وميناء المخا. ستقلل الخدمة الجديدة زمن الرحلة إلى 3 ساعات فقط وتوفر بديلاً آمناً للطرق البرية.',
                'category' => 'تطوير',
                'location' => $locations[2],
                'author' => 'عمر باذيب',
                'image' => 'news_images/ferry_service.jpg',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
        ];

        DB::table('news')->insert($news);
    }
}
