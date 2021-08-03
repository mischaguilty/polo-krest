<?php

namespace App\Providers;

use App\Models\Company;
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
            optional(Company::find(1) ?? null, function (Company $company) {
                View::share('company', $company);
            });
        }
    }
}
