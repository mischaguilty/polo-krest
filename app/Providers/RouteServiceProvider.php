<?php

namespace App\Providers;

use App\Models\ProductGroup;
use App\Models\ServiceGroup;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/company';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind('productGroup', function ($value) {
            return optional(ProductGroup::query()->whereHas('menuitem', function (Builder $builder) use ($value) {
                    $builder->whereHas('slug', function (Builder $builder) use ($value) {
                        $builder->where([
                            implode('->', [
                                'name',
                                app()->getLocale(),
                            ]) => $value,
                        ]);
                    });
                })->first() ?? null, function (ProductGroup $productGroup) {
                return $productGroup;
            });
        });

        Route::bind('serviceGroup', function ($value) {
            return optional(ServiceGroup::query()->whereHas('menuitem', function (Builder $builder) use ($value) {
                    $builder->whereHas('slug', function (Builder $builder) use ($value) {
                        $builder->where([
                            implode('->', [
                                'name',
                                app()->getLocale(),
                            ]) => $value,
                        ]);
                    });
                })->first() ?? null, function (ServiceGroup $serviceGroup) {
                return $serviceGroup;
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
