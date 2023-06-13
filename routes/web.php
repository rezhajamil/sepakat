<?php

use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\SurveyController as AdminSurveyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
    });

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/{slug}', [EventController::class, 'show'])->name('show');
    });

    Route::resource('survey', SurveyController::class);

    Route::prefix('admin')->name('admin.')->middleware('ensureRole:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('news', AdminNewsController::class);
        Route::resource('event', AdminEventController::class);
        Route::resource('survey', AdminSurveyController::class);

        Route::put('change_status/{survey}', [AdminSurveyController::class, 'change_status'])->name('survey.change_status');
        Route::get('/resume/survey/{id}', [AdminSurveyController::class, 'resume'])->name('survey.resume');
        Route::get('/result/survey/{id}', [AdminSurveyController::class, 'result'])->name('survey.result');
    });
});

// Route::get('/dashboard', [])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
