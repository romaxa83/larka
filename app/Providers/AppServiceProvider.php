<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Blade;
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
//        Blade::directive('roles_str', function($collectionRoles) {
//            /** @var Collection $collectionRoles */
////            $roles = $collectionRoles->pluck('role');
//            dd($collectionRoles);
/*            return "<?php echo implode(',', {$roles}); ?>";*/
//        });
    }
}
