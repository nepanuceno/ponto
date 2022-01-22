<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::directive('dateToPtBr', function ($date) {
            //$date = Carbon::createFromIsoFormat('YYYY-MM-DD', '2022-01-22', 'UTC');
            //$date->isoFormat('DD/MM/YYYY'); // 2022/01/21 18:33
        });

    }
}
