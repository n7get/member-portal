<?php

namespace App\Http\Controllers;

use App\Helpers\FormCapabilities;
use App\Helpers\FormOther;
use App\Http\Requests\MemberRequest;
use App\Models\Capability;
use App\Models\Certification;
use App\Models\Member;
use App\Models\Other;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('index', Member::class);

        $members = Member::orderby('callsign')->get();

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Member::class);

        $member = new Member();
        if(env('PREFILL_FORMS', false)) {
            $member['first_name'] = 'Alfred';
            $member['last_name'] = 'Newman';
            $member['callsign'] = 'Z0ZZZ';
            $member['expiration'] = date('Y-m-d', strtotime('+10 years'));
            $member['cellPhone'] = '800 555 1212';
            $member['cell_sms_carrier'] = 'who knows?';
        }

        return view('admin.members.create', [
            'member' => $member,
            'capabilities' => Capability::orderby('order')->get(),
            'certifications' => Certification::orderby('order')->get(),
            'others' => Other::orderby('order')->get(),
            'formCapabilities' => new FormCapabilities($request, $member),
            'formOthers' => new FormOther($request, $member),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request): RedirectResponse
    {
        $this->authorize('store', Member::class);

        $member = Member::create($request->all());

        if ($request->has('certifications')) {
            $member->certifications()->sync(array_keys($this->filterCertifications($request)));
        }

        $member->capabilities()->sync($request->input('capabilities', []));

        $member->others()->sync($this->filterAndMapOthers($request));

        $member->save();

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member): View
    {
        $this->authorize('show', $member);
        
        return view('admin.members.show', [
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

        return view('admin.members.edit', [
            'member' => $member,
            'capabilities' => Capability::orderBy('order')->get(),
            'certifications' => Certification::orderby('order')->get(),
            'others' => Other::orderby('order')->get(),
            'formCapabilities' => new FormCapabilities($request, $member),
            'formOthers' => new FormOther($request, $member),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $this->authorize('update', $member);

        $member->update($request->all());

        if ($request->has('certifications')) {
            $member->certifications()->sync(array_keys($this->filterCertifications($request)));
        } else {
            $member->certifications()->detach();
        }

        $member->capabilities()->sync($request->input('capabilities', []));

        $member->others()->sync($this->filterAndMapOthers($request));

        return redirect()->route('members.index');
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

    private function filterCertifications($request) {
        return array_filter($request->certifications, function ($value) {
            return $value == "1";
        });
    }

    private function filterAndMapOthers($request) {
        $others = array_filter($request->others, function ($value) {
            return array_key_exists('id', $value);
        });

        return array_map(function ($value) {
            if (array_key_exists('extra_info', $value)) {
                return ['extra_info' => $value['extra_info']];
            }
            return [];
        }, $others);
    }
}
