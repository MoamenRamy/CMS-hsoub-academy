<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\RoleComposer;

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
        View::composer(['partials.slidebar', 'list.categories'], CategoryComposer::class);
        View::composer('list.roles', RoleComposer::class);
    }
}
