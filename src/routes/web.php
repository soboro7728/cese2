<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Models\Reservation;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    // Route::get('/', [AuthController::class, 'index']);
    // マイページ
    Route::get('/mypage', [AuthController::class, 'index']);
});
Route::post('/shop/create', [shopController::class, 'shop_create']);

Route::get('/test', [shopController::class, 'test']);
Route::get('/', [shopController::class, 'index']);
Route::get('/detail', [shopController::class, 'detail']);

// 店舗登録
Route::get('shop/register', [shopController::class, 'shop_register']);
// 確認画面遷移
Route::post('/shop/confirm', [ReservationController::class, 'reservation_create']);

// マイページ
// Route::get('/mypage', [AuthController::class, 'index']);


// 予約削除
Route::post('/reservation/delete', [ReservationController::class, 'reservation_delete']);

// お気に入り登録
Route::post('/favorites/create', [AuthController::class, 'favorites_create']);
// お気に入り解除
Route::post('/favorites/delete', [AuthController::class, 'favorites_delete']);
// 地域検索
Route::get('/search/region', [shopController::class, 'search_region']);
// ジャンル検索
// Route::get('/search/genre', [shopController::class, 'search_genre']);

// 管理者ミドルウェア
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if (Route::middleware('auth:admin')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    });
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });
});


// Route::middleware(['auth:web', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// 管理者ログイン画面

