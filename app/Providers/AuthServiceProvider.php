<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('user', 'App\Policies\UserPolicy');
        Gate::resource('pacient', 'App\Policies\PacientPolicy');
        Gate::resource('doctor', 'App\Policies\DoctorPolicy');
        Gate::resource('branch', 'App\Policies\BranchPolicy');
        Gate::resource('material', 'App\Policies\MaterialPolicy');
        Gate::resource('test', 'App\Policies\TestPolicy');
        Gate::resource('parameter', 'App\Policies\ParameterPolicy');
        Gate::define('add_test', 'App\Policies\PacientPolicy@add_test');
        Gate::define('parameter', 'App\Policies\PacientPolicy@edit_test');
        Gate::define('today_report', 'App\Policies\ReportPolicy@today_report');
        Gate::define('tabular_report', 'App\Policies\ReportPolicy@tabular_report');
        Gate::define('sale_summary', 'App\Policies\ReportPolicy@sale_summary');



    }
}
