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

Route::get('/', \App\Http\Livewire\Welcome::class)->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('login', \App\Http\Livewire\Auth\Login::class)->name('login');
    Route::get('password/forgot', \App\Http\Livewire\Auth\Password\Forgot::class)->name('password.forgot');
    Route::get('password/reset/{token}/{email}', \App\Http\Livewire\Auth\Password\Reset::class)->name('password.reset');
    Route::get('register', \App\Http\Livewire\Auth\Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', \App\Http\Livewire\Auth\Login::class)->name('logout');
    Route::get('home', \App\Http\Livewire\Home::class)->name('home');
});
