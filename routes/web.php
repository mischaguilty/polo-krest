<?php


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

Route::prefix('dash')->group(function () {
    Route::get('login', \App\Http\Livewire\Auth\Login::class)->name('login');
});

Route::get('/', function() {
    return redirect()->to(app()->getLocale());
});


Route::group([
    'middleware' => 'lang',
], function() {
    Route::prefix('{lang}')->group(function() {
        Route::get('', function () {
            return view('welcome');
        })->name('welcome');
    });
});
