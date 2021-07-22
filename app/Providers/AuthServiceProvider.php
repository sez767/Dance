<?php

namespace App\Providers;

use App\Role;
use App\User;
use App\School;
use App\Policies\SchoolPolicy;
use App\Policies\Clothescategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        School::class => SchoolPolicy::class,
        Clothescategory::class => ClothescategoryPolicy::class,
       
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isModerator', function($user) {
            $permission=$user->roles()->where('name','Moderator')->exists();
            return $permission;
        });
        //
    }
}

