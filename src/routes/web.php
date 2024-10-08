<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ShopAdminLoginController;
use App\Http\Controllers\ShopAdminDashboardController;
use App\Http\Controllers\ReviewController;


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

Route::middleware('verified')->group(function () {
    Route::get('/mypage', [AuthController::class, 'index']);
    Route::get('/', [shopController::class, 'index'])->name('index');
});
Route::post('/shop/create', [shopController::class, 'shop_create']);

Route::get('/detail', [shopController::class, 'detail']);

// レビュー表示
Route::get('/review', [ReviewController::class, 'index']);

// 店舗登録
Route::get('shop/register', [shopController::class, 'shop_register']);
// 確認画面遷移
Route::post('/shop/confirm', [ReservationController::class, 'reservation_create']);

// 予約削除
Route::post('/reservation/delete', [ReservationController::class, 'reservation_delete']);
// 予約変更
Route::post('/reservation/change', [ReservationController::class, 'reservation_change']);
// 予約更新
Route::post('/reservation/update', [ReservationController::class, 'update']);
// レビュー入力画面
Route::post('/reservation/review', [ReviewController::class, 'form']);
// レビュー投稿
Route::post('/review/create', [ReviewController::class, 'create']);

// お気に入り登録
Route::post('/favorites/create', [AuthController::class, 'favorites_create']);
// お気に入り解除
Route::post('/favorites/delete', [AuthController::class, 'favorites_delete']);
// お気に入り解除マイページ向け
Route::post('/favorites/delete/mypage', [AuthController::class, 'favorites_delete_mypage']);
// 地域検索
Route::get('/search/region', [shopController::class, 'search_region']);
// ジャンル検索
Route::get('/search/keyword', [shopController::class, 'search_keyword']);

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
        Route::get('dashboard/shop', [AdminDashboardController::class, 'shop']);
        Route::post('dashboard/shop/create', [AdminDashboardController::class, 'shop_create']);
        Route::get('dashboard/admin', [AdminDashboardController::class, 'admin']);
        Route::post('dashboard/admin/create', [AdminDashboardController::class, 'admin_create']);
        Route::get('dashboard/review', [AdminDashboardController::class, 'review']);
        Route::post('dashboard/review/delete', [AdminDashboardController::class, 'review_delete']);
        Route::get('dashboard/csv', [AdminDashboardController::class, 'csv']);
        Route::post('dashboard/csv', [AdminDashboardController::class, 'csvImport']);
    });

});

//店舗管理者分
Route::prefix('shopadmin')->group(function () {
    Route::get('login', [ShopAdminLoginController::class, 'create'])->name('shopadmin.login');
    Route::post('login', [ShopAdminLoginController::class, 'store']);

    Route::middleware('auth:shopadmin')->group(function () {
        Route::get('dashboard', [ShopAdminDashboardController::class, 'index'])->name('shopadmin.dashboard');
        Route::get('dashboard/shop', [ShopAdminDashboardController::class, 'shop']);
        Route::post('dashboard/shop/create', [ShopAdminDashboardController::class, 'shop_create']);
        Route::get('dashboard/reservation', [ShopAdminDashboardController::class, 'reservation']);
        Route::get('dashboard/mail', [ShopAdminDashboardController::class, 'mail']);
        Route::post('dashboard/mail', [ShopAdminDashboardController::class, 'send']);
    });
});

// メール認証確認画面
Route::get('/verify', [AuthController::class, 'verify']);

// 入会テスト用システム
// レビュー投稿
Route::get('/review/post', [ReviewController::class, 'post']);
// レビュー編集
Route::get('/review/edit', [ReviewController::class, 'edit']);
Route::post('/review/post/update', [ReviewController::class, 'update']);
Route::post('/review/delete', [ReviewController::class, 'delete']);
Route::post('/review/image', [ReviewController::class, 'image']);
// 投稿てすと
Route::post('/review/post/action', [ReviewController::class, 'action']);
// 検索テスト
Route::get('/search', [shopController::class, 'search']);

// てすと
Route::get('test', [ShopAdminDashboardController::class, 'test']);
Route::post('/', [ShopAdminDashboardController::class, 'csvImport']);