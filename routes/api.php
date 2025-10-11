<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APINewsController;
use App\Http\Controllers\NewsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('news')->group(function () {
    Route::get('/', [APINewsController::class, 'index']);       // جلب كل الأخبار
    Route::get('/{id}', [APINewsController::class, 'show']);   // جلب خبر واحد
    Route::post('/', [APINewsController::class, 'store']);     // إضافة خبر جديد
    Route::put('/{id}', [APINewsController::class, 'update']); // تحديث خبر
    Route::delete('/{id}', [APINewsController::class, 'destroy']); // حذف خبر
});
