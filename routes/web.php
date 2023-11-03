<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRecommendationHistoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/recommendation_history', [UserRecommendationHistoryController::class, 'index'])->name('recommendation_history');
    Route::group([
        'prefix' => '/profile'
    ], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::group([
        'prefix'=>'/posts'
    ], function () {
        Route::post('/{postId}/like', [PostController::class, 'like'])->name('posts.like');
        Route::post('/{postId}/save', [PostController::class, 'save'])->name('posts.save');
        Route::post('/{postId}/rate', [PostController::class, 'rate'])->name('posts.rate');
    });
});

require __DIR__.'/auth.php';
