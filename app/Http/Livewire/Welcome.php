<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Welcome extends Component
{
    public function route()
    {
        return Route::group([
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [
                'localize',
                'localizationRedirect',
                'localeSessionRedirect',
                'localeCookieRedirect',
                'localeViewPath'
            ],
        ], function () {
            Route::get('/', static::class)->name('welcome');
        });
    }

    public function render()
    {
        return view('livewire.welcome')->with([
            'slides' => [
                [
                    'picture' => 'default-bg.jpg',
                    'text' => 'Lorem Ipsum'
                ],
                [
                    'picture' => 'default-bg.jpg',
                    'text' => 'Lorem Ipsum'
                ],
            ],
        ])->layout('livewire.layouts.guest');
    }
}
