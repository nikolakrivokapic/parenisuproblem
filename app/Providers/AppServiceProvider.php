<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Main;
use App\User;
use Event;
use App\Poruke1;
use App\Events\ItemCreated;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('lokacije', Main::orderBy('lokacija', 'asc')->groupBy('lokacija')
            ->get());
        view()->share('korisnici', User::orderBy('fullname', 'asc')->groupBy('fullname')
            ->get());
        
        Poruke1::created(function ($item) {
            Event::fire(new ItemCreated($item));
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
