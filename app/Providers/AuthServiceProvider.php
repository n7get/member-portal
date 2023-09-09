<?php

namespace App\Providers;

use App\Models\members\Capability;
use App\Models\members\Certification;
use App\Models\members\Member;
use App\Models\members\Other;
use App\Models\resources\Category;
use App\Policies\members\CapabilityPolicy;
use App\Policies\members\CertificationPolicy;
use App\Policies\members\MemberPolicy;
use App\Policies\members\OtherPolicy;
use App\Policies\resources\CategoryPolicy;
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
        Category::class => CategoryPolicy::class,
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
