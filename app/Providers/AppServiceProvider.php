<?php

namespace App\Providers;

use App\School;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        if ($this->app->environment() == 'local') {
            $this->app->register('Appzcoder\CrudGenerator\CrudGeneratorServiceProvider');
        }
    }

    protected function currentSchool()
    {

        // Share settings
        $this->app->singleton('currentSchool', function() {
            return School::find(session('current_school_id'));
        });
        if (Schema::hasTable('schools')) {
        view()->share('currentSchool', app('currentSchool'));
        }
    }


    protected function supervisorsSchool()
    {
        // Share settings
        $this->app->singleton('supervisors_school', function() {
           return session('supervisor_schools');
        });
        view()->share('supervisors_school', app('supervisors_school'));
    }
    protected function adminUser()
    {

        // Share settings
        $this->app->singleton('adminUser', function() {
            $id=User::ADMIN_TYPE;
            //dd($id);
            return User::find(session($id));
        });
        if (Schema::hasTable('users')) {
        view()->share('adminUser', app('adminUser'));
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');;
        }
        $this->currentSchool();
        $this->supervisorsSchool();
        $this->adminUser();
        Schema::defaultStringLength(191);
    }
}
