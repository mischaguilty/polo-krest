<?php

namespace App\Http\Livewire;

use App\Traits\NeedsSEO;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Cemeteries extends Component
{
    use NeedsSEO;

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
            Route::get(LaravelLocalization::transRoute('routes.cemeteries.list'), static::class)->name('cemeteries.list');
        });
    }

    public function render()
    {
        return view('livewire.cemeteries')->layout('layouts.guest');
    }
}
