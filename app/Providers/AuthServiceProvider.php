<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Member;
use App\Policies\MemberPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Capability::class => CapabilityPolicy::class,
        Certification::class => CertificationPolicy::class,
        Member::class => MemberPolicy::class,
        Other::class => OtherPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
