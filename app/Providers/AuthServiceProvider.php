<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate::define('delete-post', function($user, $post){
        //     return $user->hasAllow('delete-post') && ($user->id == $post->user->id || $user->isAdmin());
        // });

        // Gate::define('edit-post', function($user, $post){
        //     return $user->hasAllow('edit-post') && ($user->id == $post->user->id || $user->isAdmin());
        // });

        // Permission::get(['name'])->map(function($per){
        //     Gate::define($per->name, function($user, $post) use ($per) {
        //         return $user->hasAllow($per->name) && ($user->id == $post->user_id || $user->isAdmin());
        //     });
        // });

        Permission::whereIn('name', ['edit-post', 'delete-post', 'add-post'])->get()->map(function($per){
            Gate::define($per->name, function($user, $post) use ($per) {
                return $user->hasAllow($per->name) && ($user->id == $post->user_id || $user->isAdmin());
            });
        });

        Permission::whereIn('name', ['edit-user', 'delete-user', 'add-user'])->get()->map(function($per){
            Gate::define($per->name, function($user) use ($per) {
                return $user->hasAllow($per->name) &&  $user->isAdmin();
            });
        });
    }
}
