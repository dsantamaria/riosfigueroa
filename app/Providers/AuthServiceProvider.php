<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Log;

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

        $gate->define('special-role', function ($user) {
           return $user->hasAccess(['user_out_mx']);
        });

        $gate->define('user-role', function ($user) {
           return $user->hasAccess(['default']);
        });

        $gate->define('admin-role', function ($user) {
           return $user->hasAccess(['admin']);
        });

        $gate->define('super-role', function ($user) {
           return $user->hasAccess(['super']);
        });

        $gate->define('import', function ($user) {
           return !$user->hasToolAccess(['import']);
        });

        $gate->define('price', function ($user) {
           return !$user->hasToolAccess(['price']);
        });

        $gate->define('market', function ($user) {
           return !$user->hasToolAccess(['market']);
        });

        $gate->define('priceImport', function ($user) {
           return !$user->hasToolAccess(['price']) || !$user->hasToolAccess(['import']);
        });

    }
}
