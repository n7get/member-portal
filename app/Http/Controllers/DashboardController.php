<?php

namespace App\Http\Controllers;

use App\Models\members\Member;
use App\Providers\activities\ActivityProvider;
use App\Providers\resources\ResourceFilesProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function __construct(
    protected ActivityProvider $activityProvider,
    protected ResourceFilesProvider $resourceFilesProvider
  )
  {
  }

  public function index()
  {
    $user = Auth::user();

    if ($user->member !== null) {
      $futureActivities = $this->activityProvider->loadFutureActivities($user->member->id);
      $unloggedActivityLogs = $this->activityProvider->loadUnloggedActivityLogs($user->member->id);
    }

    if ($user->hasRole('leadership')) {
      $pendingMembers = Member::where('status', 'pending')->get();
      $leadershipResources = $this->resourceFilesProvider->getResources('leadership');
    }

    if ($user->hasRole('member')) {
      $memberResources = $this->resourceFilesProvider->getResources('member');
    }

    return view('dashboard', [
      'user' => $user,
      'futureActivities' => $futureActivities ?? [],
      'leadershipResources' => $leadershipResources ?? [],
      'memberResources' => $memberResources ?? [],
      'pendingMembers' => $pendingMembers ?? [],
      'unloggedActivityLogs' => $unloggedActivityLogs ?? [],
    ]);
  }
}
