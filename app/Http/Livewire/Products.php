<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Products extends Component
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
            Route::get(LaravelLocalization::transRoute('routes.products.index'), static::class)->name('products.index');
        });
    }

    public function render()
    {
        return view('livewire.products')->layout('layouts.guest');
    }
}
