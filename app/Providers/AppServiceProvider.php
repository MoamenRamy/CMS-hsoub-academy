<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\RoleComposer;
use App\Http\ViewComposers\CommentComposer;
use App\Http\ViewComposers\PageComposer;
use Illuminate\Support\Facades\Blade;

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
        View::composer('partials.slidebar', CommentComposer::class);
        View::composer('partials.navbar', PageComposer::class);
        Blade::if('admin', function(){
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
