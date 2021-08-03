<?php

namespace App\Http\Livewire;

use App\Models\ProductGroup;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductItem extends Component
{
    public ProductGroup $productGroup;

    public function mount(ProductGroup $productGroup)
    {
        $this->productGroup = $productGroup;
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
            Route::get(LaravelLocalization::transRoute('routes.products.show'), static::class)->name('products.show');
        });
    }

    public function render()
    {
        return view('livewire.product-item')->layout('layouts.guest');
    }
}
