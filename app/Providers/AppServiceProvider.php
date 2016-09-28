<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Slugify;
use Ramsey\Uuid\Uuid;
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

      \App\Criterio::saving(function($criterio) {
        $criterio->id = Slugify::slugify($criterio->nome);
      });


      \App\Visitante::creating(function($visitante) {
        $var = rand(0,9999);

        if ($var >= 0 && $var<10) {
         $var = "000". $var;
        } else if ($var >= 10 && $var<100) {
          $var = "00". $var;
        } else if($var >= 100 && $var<1000) {
         $var = "0". $var;
        } else {
          
        }

        $visitante->codigo = str_random(32);
        $visitante->pin = $var;

          $contacto = $visitante->contacto;
          $id=Uuid::uuid4();
         
          $sms_data=[
            "id"=>$id->toString(),
            "mensagem"=>"O seu pin e:"+$pin,
            "contacto"=>$contacto
          ];
           $sms_data=\App\Mensagem::create($sms_data);
     
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
