<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        view()->share('categories', Category::all(['name','slug']));
        
//        view()->composer(['layouts.site',...,...,...], function($view) {
//        view()->composer('layouts.site', function($view) {
//            $view->with('categories', Category::all(['name','slug']));
//        });
//        view()->composer('layouts.site', 'App\Http\Views\Composer\CategoriesViewComposer@compose');
    }
}
