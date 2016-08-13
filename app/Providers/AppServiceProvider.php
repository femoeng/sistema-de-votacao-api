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

            \App\Visitante::saving(function($visitante) {
        $var=rand(0,9999);
        
        if($var >= 0 && $var<10){
         $var = "000". $var;
        }
        else if($var >= 10 && $var<100){
          $var = "00". $var;
        }
        else if($var >= 100 && $var<1000){
         $var = "0". $var;
        }
    
        else {
          
        }
        $visitante->slug = $var;
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
