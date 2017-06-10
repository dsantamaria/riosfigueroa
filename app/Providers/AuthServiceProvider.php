<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function ($user) {
            if($user->inRole('super_admin')){
                return true;
            }
        });

        $gate->define('user-role', function ($user) {
           return $user->hasAccess(['default']);
        });

        $gate->define('admin-role', function ($user) {
           return $user->hasAccess(['admin']);
        });
        
        $gate->define('super-role', function ($user) {
           return $user->hasAccess(['super_admin']);
        });
    }
}
