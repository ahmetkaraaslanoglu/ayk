<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Absence;
use App\Models\Homework;
use App\Models\Team;
use App\Policies\AbsencePolicy;
use App\Policies\HomeworkPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Homework::class => HomeworkPolicy::class,
        Absence::class => AbsencePolicy::class,
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
