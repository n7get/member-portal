<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\RedirectToPrevious;
use App\Http\Requests\members\MemberRequest;
use App\Models\members\Capability;
use App\Models\members\Certification;
use App\Models\members\Member;
use App\Models\members\Other;
use App\Models\User;
use App\Providers\members\MemberProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    use RedirectToPrevious;

    public function __construct(
        protected MemberProvider $memberProvider,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('index', Member::class);

        $members = Member::with('user')->orderby('callsign')->get();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, User $user): View
    {
        if ($request->user()->member) {
            return view('members.show', $request->user()->member, ['member' => $request->user()->member]);
        }

        if ($user->id) {
            $request->session()->put('user_id', $user->id);
            $this->savePreviousRoute($request, $user->id);
        } else {
            $request->session()->put('user_id', $request->user()->id);
            $this->savePreviousRoute($request, $request->user()->id);
        }

        $member = new Member();
        if(env('PREFILL_FORMS', false)) {
            $member['first_name'] = 'Alfred';
            $member['last_name'] = 'Newman';
            $member['callsign'] = 'Z0ZZZ';
            $member['expiration'] = date('Y-m-d', strtotime('+10 years'));
            $member['cellPhone'] = '800 555 1212';
            $member['cell_sms_carrier'] = 'who knows?';
        }

        return view('members.create', $this->memberProvider->populateModel($request, $member));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request): RedirectResponse
    {
        if ($request->user()->member) {
            return redirect()->route('members.show', $request->user()->member);
        }

        $member = new Member();
        $member->user_id = $$request->session()->get('user_id');

        $this->memberProvider->persist($request, $member);

        $request->session()->remove('user_id');
        return $this->redirectToPrevious($request, 'members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member): View
    {
        $this->authorize('show', $member);

        return view('members.show', [
            'member' => $member,
            'capabilities' => Capability::orderby('order')->get(),
            'certifications' => Certification::orderby('order')->get(),
            'other' => Other::orderby('order')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Member $member): View
    {
        $this->authorize('edit', $member);

        $this->savePreviousRoute($request, $member->id);

        return view('members.edit', $this->memberProvider->populateModel($request, $member));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $this->authorize('update', $member);

        $this->memberProvider->persist($request, $member);

        return $this->redirectToPrevious($request, 'members.index', $member->id)
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member): RedirectResponse
    {
        $this->authorize('destroy', $member);
        
        $member->delete();

        return redirect()->route('members.index');
    }

    public function cancel(Request $request): RedirectResponse
    {
        return $this->redirectToPrevious($request, 'members.index');
    }
}
