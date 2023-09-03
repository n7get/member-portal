<?php

namespace App\Http\Controllers;

use App\Models\members\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = ['user' => $user];

        if ($user->hasRole('leadership')) {
            $this->populateLeadership($user, $data);
        }
        return view('dashboard', $data);
    }

    private function populateLeadership($user, &$data) {
        $data['pendingMembers'] = Member::where('status', 'pending')->get();
    }
}
