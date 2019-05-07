<?php

namespace App\Providers;
use App\Policies\EscenarioPolicy;
use App\Policies\PrestamoPolicy;
use Spatie\Permission\Models\Permission;
use App\Escenario;
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
        //'App\Model' => 'App\Policies\ModelPolicy',
        Prestamo::class => PrestamoPolicy::class,
        Escenario::class => EscenarioPolicy::class //solo escenarios propios 
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
