<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Article;
use Illuminate\Contracts\View\View;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->composeNavigation();
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

    public function composeNavigation()
    {
//        view()->composer('partial.nav', 'App\Http\Composers\NavigationComposer');
        view()->composer('partials.nav', function ($view) {
            $view->with('latest', Article::latest()->first());
        });
    }

}
