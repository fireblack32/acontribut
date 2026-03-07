<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\ServiceProvider;
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
        view()->composer('theme.lte.aside', function ($view) {
            $menus = Menu::getMenu(true);
            $view->with('menusComposer', $menus);
        });
        
        //View::share('theme', 'lte');
        view()->share('theme', 'lte');
        //
    }
}
