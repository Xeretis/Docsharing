<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SpaceController;
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

Route::get('/', function () {
    return redirect()->route('spaces.index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('spaces')->name('spaces.')->controller(SpaceController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/join', 'join')->name('join');
        Route::post('/enter', 'enter')->name('enter');
        Route::get('/{space}/join', 'joinInvite')->name('join-invite');
        Route::post('/{space}/enter', 'enterInvite')->name('enter-invite');

        Route::get('/{space}/edit', 'edit')->name('edit');
        Route::put('/{space}', 'update')->name('update');

        Route::get('/{space}', 'view')->name('view');
        Route::delete('/{space}', 'delete')->name('delete');
    });

    Route::prefix('posts')->name('posts.')->controller(PostController::class)->group(function () {
        Route::get('/{space}/create', 'create')->name('create');
        Route::delete('/{post}', 'delete')->name('delete');
        Route::get('/{post}/edit', 'edit')->name('edit');
    });
});
