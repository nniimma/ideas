<?php
// !codes that run before the application itself runs:
namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

// ! here is to perform some logic or run some code before anything render on the page:

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
        // ! this part is to tell which css framework we are using:
        Paginator::useBootstrapFive();

        // ! app() method give access to the application
        // ! with this code we can set the language of the website
        app()->setLocale('en');
        // ? another way to do this:
        // todo: App::setLocale('en');

        // ! share a variable to all our blades instead of writing the code inside all contrillers:
        View::share('topUsers', User::withCount('ideas')->orderBy('ideas_count', 'DESC')->limit(5)->get());
    }
}
