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
    /*
     * The model to policy mappings for the application.
     ! if the name of your policy be ModelNamePolicy laravel will find it authomatically, but if it is another name you should define it here so the laravel be able to understand where it is:
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // ! for example: Idea is the model and IdeaPermissions is the policy
        // todo: Idea::class => IdeaPermissions::class
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

        /*
         ! use gate to define permissions (delete and edit):
         ? we are going to use policies for permisions:
         ? with gate:
        todo: Gate::define('idea.delete', function (User $user, Idea $idea): bool {
             ! admin or the owner of idea be able to delete the idea:
        todo:    return ((bool) $user->is_admin || $user->id === $idea->user_id);
        todo: });

        todo: Gate::define('idea.edit', function (User $user, Idea $idea): bool {
             ! admin or the owner of idea be able to delete the idea:
        todo:    return ((bool) $user->is_admin || $user->id === $idea->user_id);
        todo: });
        */

        Gate::define('user.edit', function (User $user, $profileID): bool {
            // ! admin or the owner of idea be able to delete the idea:
            return ((bool) $user->is_admin || $user->id === $profileID);
        });
    }
}
