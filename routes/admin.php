<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::prefix('new-post-calculator')->name('new-post-calculator/')->group(
    static function () {
        Route::get('/', [Admin\NewPostCalculatorController::class, 'index'])->name('show-new-post-calculator');
    }
);

Route::prefix('admin-users')->name('admin-users/')->group(
    static function () {
        Route::get('/', [Admin\AdminUsersController::class, 'index'])->name('index');
        Route::get('/create', [Admin\AdminUsersController::class, 'create'])->name('create');
        Route::post('/', [Admin\AdminUsersController::class, 'store'])->name('store');
        Route::get(
            '/{adminUser}/impersonal-login',
            [Admin\AdminUsersController::class, 'impersonalLogin']
        )->name('impersonal-login');
        Route::get('/{adminUser}/edit', [Admin\AdminUsersController::class, 'edit'])->name(
            'edit'
        );
        Route::post('/{adminUser}', [Admin\AdminUsersController::class, 'update'])->name(
            'update'
        );
        Route::delete('/{adminUser}', [Admin\AdminUsersController::class, 'destroy'])->name(
            'destroy'
        );
        Route::get(
            '/{adminUser}/resend-activation',
            [Admin\AdminUsersController::class, 'resendActivationEmail']
        )->name(
            'resendActivationEmail'
        );
    }
);

Route::prefix('profile')->name('profile/')->group(
    static function () {
        Route::get('/', [Admin\ProfileController::class, 'editProfile'])->name('edit-profile');
        Route::post('/', [Admin\ProfileController::class, 'updateProfile'])->name('update-profile');
        Route::get('/password', [Admin\ProfileController::class, 'editPassword'])->name('edit-password');
        Route::post('/password', [Admin\ProfileController::class, 'updatePassword'])->name('update-password');
    }
);
