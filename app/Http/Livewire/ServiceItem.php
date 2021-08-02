<?php

namespace App\Http\Livewire;

use App\Models\ServiceGroup;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceItem extends Component
{
    public ServiceGroup $serviceGroup;

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
            Route::get(LaravelLocalization::transRoute('routes.services.show').'/{serviceGroup}', static::class)->name('services.show');
        });
    }

    public function mount(ServiceGroup $serviceGroup)
    {
        $this->serviceGroup = $serviceGroup;
    }

    public function render()
    {
        return view('livewire.service-item')->layout('livewire.layouts.guest');
    }
}
