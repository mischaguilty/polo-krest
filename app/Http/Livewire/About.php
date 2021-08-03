<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Traits\NeedsSEO;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class About extends Component
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
            Route::any(LaravelLocalization::transRoute('routes.about'), static::class)->name('about');
        });
    }

    public function render()
    {
        return view('livewire.about')->with([
            'slides' => $this->company->getMedia('about')->map(function (Media $media) {
                return [
                    'picture' => $media->getFullUrl(),
                ];
            }),
        ])->layout('layouts.guest');
    }
}
