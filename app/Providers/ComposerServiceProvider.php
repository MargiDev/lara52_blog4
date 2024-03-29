<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Use closure base composer to bind data to the view
        view()->composer('layouts.sidebar', function($view){
          $categories = Category::with(['posts' => function($query){
              $query->published();
          }])->orderBy('title', 'asc')->get();

          return $view->with('categories', $categories);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
