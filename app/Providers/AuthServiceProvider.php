<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
     ! herer is where you define gates(gate is a permission or a role)
     */
    public function boot(): void
    {
        // ! use gate to define a role:
        Gate::define('admin', function (User $user): bool {
            return (bool) $user->is_admin;
        });

        // ! use gate to define permissions (delete and edit):
        Gate::define('idea.delete', function (User $user, Idea $idea): bool {
            // ! admin or the owner of idea be able to delete the idea:
            return ((bool) $user->is_admin || $user->id === $idea->user_id);
        });

        Gate::define('idea.edit', function (User $user, Idea $idea): bool {
            // ! admin or the owner of idea be able to delete the idea:
            return ((bool) $user->is_admin || $user->id === $idea->user_id);
        });

        Gate::define('user.edit', function (User $user, $profileID): bool {
            // ! admin or the owner of idea be able to delete the idea:
            return ((bool) $user->is_admin || $user->id === $profileID);
        });
    }
}
