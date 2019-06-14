<?php

namespace App\Providers;
use App\cargos;
use Illuminate\Support\ServiceProvider;

class CargosProvider extends ServiceProvider{

    public function boot()
    {
            view()->composer('*',function($view){
            $view->with('cargos_select', cargos::all());
        });

    }
}
