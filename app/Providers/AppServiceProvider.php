<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\View\Composers\DevisionsComposer;
use App\View\Composers\CategoriesComposer;

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
        view()->composer(['*'],DevisionsComposer::class);
        view()->composer(['*'],CategoriesComposer::class);
    }
}
