<?php

namespace App\Http\Livewire;

use App\Models\ServiceGroup;
use App\Traits\NeedsSEO;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Services extends Component
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
            Route::get(LaravelLocalization::transRoute('routes.services.index'), static::class)->name('services.index');
        });
    }

    public function render()
    {
        return view('livewire.services')->with([
            'serviceGroups' => ServiceGroup::all(),
        ])->layout('layouts.guest');
    }
}
