<?php

namespace App\Providers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use  App\Policies\PostPolicy;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Posts::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($doctor, string $token) {

            return route('doctors.resetPassword', ['token' => $token]) . '?email=' . $doctor->email;
        });

        // định nghĩa gate
        // cách 1
        Gate::define('posts.add', function (User $user) {
            return true;
        });

        // cách 2
        // Gate::define('posts.add', [PostPolicy::class, 'add']);

        Gate::define('posts.edit', function (User $user,  $post) {
            return $user->id == $post->user_id;
        });
    }
}
