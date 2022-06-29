<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Inputs\Button;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            $expression = trim($expression,'\'');
            $expression = trim($expression,"\"");
            $dateObject = date_create($expression);

            if(!empty($dateObject)){
                $dateformate = $dateObject ->format('d-m-Y H:i:s');
                return $dateformate;
            }
            return false;
        });
        Blade::if('env',function($value) {
            if(config('app.env') === $value){
                return true;
            }
            return false;
        });
        Blade::component('button',Button::class);

        Blade::component('package-alert',Alert::class);
    }
}
