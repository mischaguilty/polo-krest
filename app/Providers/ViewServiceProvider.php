<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('companies')) {
            $company = optional(Company::find(1) ?? null, function (Company $company) {
                return $company;
            });

            View::share('company', $company);
            $uri = request()->getPathInfo() !== '/' ? trim(request()->getPathInfo(), '/') : request()->getPathInfo();
            View::share('page', optional(Page::firstWhere([
                    'uri' => $uri,
                ]) ?? null, function (Page $page) {
                    return $page;
                }));
        }

        if (Schema::hasTable('pages')) {
            View::share('page', Page::firstWhere([
                'uri' => request()->getPathInfo() !== '/' ? trim(request()->getPathInfo(), '/') : request()->getPathInfo(),
            ]));
        }
    }
}
