<?php

namespace App\Providers;

use App\Models\activities\ActivityMode;
use App\Models\activities\ActivityType;
use App\Models\members\Capability;
use App\Models\members\Certification;
use App\Models\members\Member;
use App\Models\members\Other;
use App\Models\resources\Category;
use App\Models\resources\File;
use App\Policies\activities\ActivityModePolicy;
use App\Policies\activities\ActivityTypePolicy;
use App\Policies\members\CapabilityPolicy;
use App\Policies\members\CertificationPolicy;
use App\Policies\members\MemberPolicy;
use App\Policies\members\OtherPolicy;
use App\Policies\resources\CategoryPolicy;
use App\Policies\resources\FilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    ActivityMode::class => ActivityModePolicy::class,
    ActivityType::class => ActivityTypePolicy::class,
    Capability::class => CapabilityPolicy::class,
    Category::class => CategoryPolicy::class,
    Certification::class => CertificationPolicy::class,
    File::class => FilePolicy::class,
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
