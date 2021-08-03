<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Traits\NeedsSEO;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Welcome extends Component
{
    use NeedsSEO;

    public Company $company;

    public function mount()
    {
        $this->company = optional(View::shared('company') ?? null, function (Company $company) {
            return $company;
        });
    }

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
            Route::get(LaravelLocalization::transRoute('routes.welcome'), static::class)->name('welcome');
        });
    }

    public function render()
    {
        return view('livewire.welcome')->with([
            'slides' => [
                [
                'picture' => $this->company->getFirstMedia() ?? url('bg.jpg'),
                    ],
            ],
        ])->layout('layouts.guest');
    }
}
