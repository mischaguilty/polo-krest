<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Services extends Component
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
            Route::get(LaravelLocalization::transRoute('routes.services'), static::class)->name('services');
        });
    }

    public function render()
    {
        return view('livewire.services')->layout('livewire.layouts.guest');
    }
}
