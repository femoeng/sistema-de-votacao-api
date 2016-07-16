<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Slugify;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      \App\Curso::saving(function($curso) {
        $curso->slug = Slugify::slugify($curso->nome);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
