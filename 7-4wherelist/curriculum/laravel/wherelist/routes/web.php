<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

use App\Http\Controllers\Lists\ListController;
use App\Http\Controllers\Lists\ListIndexController;
use App\Http\Controllers\Lists\WishlistController;
use App\Http\Controllers\Lists\VisitedController;
use App\Http\Controllers\Lists\ListCreateController;
use App\Http\Controllers\Lists\ListEditController;
use App\Http\Controllers\Lists\ListShowController;
use App\Http\Controllers\Lists\GroupController;

// use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AreaCategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\PostController;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 認証関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/password-reset', [PasswordResetController::class, 'showPasswordResetForm'])->name('password_reset');
Route::post('/password-reset', [PasswordResetController::class, 'sendPasswordResetLink']);

// リスト関連
Route::middleware('auth')->group(function () {
    Route::get('/lists', [ListIndexController::class, 'index'])->name('lists.index');
    Route::get('/lists/wishlist', [WishlistController::class, 'index'])->name('lists.wishlist');
    Route::get('/lists/visited', [VisitedController::class, 'index'])->name('lists.visited');

    Route::get('/lists/create', [ListCreateController::class, 'create'])->name('lists.create');
    Route::post('/lists', [ListCreateController::class, 'store'])->name('lists.store');

    Route::get('/lists/{id}/edit', [ListEditController::class, 'edit'])->name('lists.edit');
    Route::put('/lists/{id}', [ListEditController::class, 'update'])->name('lists.update');
    Route::put('/lists/{id}/visited', [ListEditController::class, 'markVisited'])->name('lists.markVisited');
    Route::get('/lists/{id}', [ListShowController::class, 'show'])->name('lists.show');
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::post('/groups/create', [GroupController::class, 'store'])->name('groups.store');
    Route::post('/groups/login', [GroupController::class, 'login'])->name('groups.login');
});

// グループ管理
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');

Route::get('/admin/area-categories', [AreaCategoryController::class, 'edit'])->name('admin.area_categories.edit');
Route::post('/admin/area-categories', [AreaCategoryController::class, 'update'])->name('admin.area_categories.update');

// 管理者ログイン画面表示
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// 管理者ダッシュボード
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');


// 管理者用画面
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('area-categories', [AreaCategoryController::class, 'edit'])->name('area_categories.edit');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.delete');
});

Route::post('/admin/users/{id}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
