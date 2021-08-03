<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\ProductGroup;
use App\Models\ServiceGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

trait NeedsSEO
{
    protected static array $SEO = [
        'PageTitle',
        'PageDescription',
        'PageH1',
        'robots',
        'googlebot',
        'schema',
    ];

    public ?Collection $seo = null;

    public function getSeo(): array
    {
        return collect(self::$SEO)->mapWithKeys(function (string $key) {
            return [
                $key => trans(implode('.', [
                    str_starts_with(Route::currentRouteName(), 'cemeteries') ? collect(explode('.', Route::currentRouteName()))->first() : collect(explode('.', Route::currentRouteName()))->implode('/'),
                    $key,
                ]), [
                    'companyName' => optional($this->hasProperty('company') ? $this->company : View::shared('company'), function (Company $company) {
                        return optional($company->hasTranslation('name', app()->getLocale()) ? $company->getTranslation('name', app()->getLocale()) : null, function (string $name) {
                            return $name;
                        });
                    }),
                    'productName' => optional($this->hasProperty('productGroup') ? $this->productGroup : null, function (ProductGroup $productGroup) {
                        return optional($productGroup->hasTranslation('name', app()->getLocale()) ? $productGroup->getTranslation('name', app()->getLocale()) : null, function (string $name) {
                            return $name;
                        });
                    }),
                    'serviceName' => optional($this->hasProperty('serviceGroup') ? $this->serviceGroup : null, function (ServiceGroup $serviceGroup) {
                        return optional($serviceGroup->hasTranslation('name', app()->getLocale()) ? $serviceGroup->getTranslation('name', app()->getLocale()) : null, function (string $name) {
                            return $name;
                        });
                    }),
                ]),
            ];
        })->toArray();
    }

    public function mountNeedsSEO()
    {
        $this->seo = optional($this->getSeo() ?? null, function (array $seo) {
            return collect($seo);
        }) ?? [];
        View::share('seo', $this->seo);
    }
}
