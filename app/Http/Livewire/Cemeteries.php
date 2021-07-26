<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Cemeteries extends Component
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
            Route::get(LaravelLocalization::transRoute('routes.cemeteries'), static::class)->name('cemeteries');
        });
    }

    public function render()
    {
        return view('livewire.cemeteries')->layout('livewire.layouts.guest');
    }
}
