<?php

namespace App\Http\Livewire;

use App\Traits\NeedsSEO;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Contacts extends Component
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
            Route::get(LaravelLocalization::transRoute('routes.contacts'), static::class)
                ->name('contacts');
        });
    }

    public function render()
    {
        return view('livewire.contacts')->layout('layouts.guest');
    }
}
