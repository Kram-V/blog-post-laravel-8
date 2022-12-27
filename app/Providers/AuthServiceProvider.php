<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Model\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\Model\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // THESE ARE THE GATES STRUCTURE
        // $user VARIABLE IS AUTOMATICALLY GETTING FROM THE LARAVEL APPLICATION
        // Gate::define('update-post', function($user, $post) {
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', function($user, $post) {
        //     return $user->id === $post->user_id;
        // });

        Gate::define('admin', function($user) {
            return $user->is_admin;
        });

        // THESE ARE THE POLICIES STRUCTURE
        // Gate::define('posts.update', [BlogPostPolicy::class, 'update']);
        // Gate::define('posts.delete', [BlogPostPolicy::class, 'delete']);

        // Gate::resource('posts', BlogPostPolicy::class);

         // $user VARIABLE IS AUTOMATICALLY GETTING FROM THE LARAVEL APPLICATION
        Gate::before(function($user, $ability) {
            if ($user->is_admin && in_array($ability, ['delete'])) {
                return true;
            }
        });
    }
}
