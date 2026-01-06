<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Jurusan;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.partials.navbar', function ($view) {
            $view->with(
                'navJurusan',
                Jurusan::orderBy('order')->get()
            );
        });

        Paginator::useBootstrap();
    }
}
