<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CommentReactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FoodAppController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MallController;
use App\Http\Controllers\SeaController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminNewsController;




Route::get('/test-admin', function () {
    $user = Auth::user();
    if (!$user) {
        return 'لم تسجل الدخول بعد';
    }
    return response()->json($user);
});


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/guest-enter', function () {
    Auth::logout(); // تسجيل خروج
    session()->flush(); // مسح بيانات الجلسة
    session(['guest_mode' => true]);
    return redirect()->route('home');
})->name('guest.enter');


require __DIR__ . '/auth.php';

Route::get('/wether', function () {
    return view('weather');
})->name('weather');

Route::get('/aden-map', function () {
    return view('tourism.aden-map');
})->name('aden.map');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/test-categories', function () {
    $categories = DB::table('places')->distinct()->pluck('category');
    return $categories;
});


Route::middleware(['check.access'])->group(function () {

    Route::get('/home', function () {
        return view('index');
    })->name('home');

    Route::resource('categories', CategoryController::class);
    Route::resource('restaurants', CategoryController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('cafe', CafeController::class);
    Route::resource('hotel', HotelController::class);
    Route::resource('mall', MallController::class);
    Route::resource('sea', SeaController::class);
    Route::resource('park', ParkController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('tran', TranController::class);

    Route::put('/places/{id}', [PlaceController::class, 'update'])->name('places.update');

    // لوحة التحكم العامة (للمستخدمين العاديين)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // الملف الشخصي
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.access', 'can:admin-access'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});




Route::middleware('auth')->group(function () {
     // إنشاء/تعديل/حذف منشورات
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'Edit'])->name('posts.edit');
    Route::put('/posts/{post}/update', [PostController::class, 'Update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/{post}/react', [PostController::class, 'react'])->name('posts.react');
Route::delete('/posts/{post}/react', [PostController::class, 'react']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::post('/comments/{comment}/react', [CommentReactionController::class, 'store'])->name('comment.react');

   
  Route::post('/favorites/toggle/{tran}', [FavoriteController::class, 'toggle'])->name('toggle.favorite');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});
   

//posts admin
Route::middleware(['onlyAdmin'])->group(function () {
    Route::get('/admin/dashboard2', [AdminController::class, 'index'])->name('admin.dashboard2');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('admin/posts/{post}/update', [PostController::class, 'Update'])->name('admin.posts.update');
    Route::get('/admin/comments', [AdminController::class, 'manageComments'])->name('admin.comments');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');




Route::post('/foodapps/store', [FoodAppController::class, 'store'])->name('foodapps.store');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//..

// الصفحة الرئيسية (عرض الأخبار للزوار)

Route::get('/projectB', [NewsController::class, 'index'])->name('projectB');

// صفحات عامة (ما تحتاج صلاحيات)
Route::get('news/rating-system', function () {
    return view('news.rating-system');
})->name('news.rating-system');

// صفحات الـ admin2 (تحتاج صلاحيات)
Route::middleware(['auth', 'can:admin-access'])->prefix('admin2')->group(function () {
    Route::view('/news-dash', 'admin2.news-dash')->name('admin2.news-dash');
    Route::view('/rating-system-dash', 'admin2.rating-system-dash')->name('admin2.rating-system-dash');
});

// لوحة التحكم للأخبار (CRUD)
Route::middleware(['auth', 'can:admin-access'])->prefix('admin')->group(function () {
    // لوحة التحكم الرئيسية
    Route::get('/dashboard', [AdminNewsController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD للأخبار
    Route::get('/news/data', [AdminNewsController::class, 'getNewsData'])->name('admin.news.data');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::put('/news/{id}', [AdminNewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{id}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::get('/news/{id}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
});


require __DIR__ . '/auth.php';
