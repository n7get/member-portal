<?php

namespace App\Providers;

use App\Helpers\FormCapabilities;
use App\Helpers\FormOther;
use App\Models\Capability;
use App\Models\Certification;
use App\Models\Member;
use App\Models\Other;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MemberProvider extends ServiceProvider
{
    public function __construct() {}

    public function populateModel(Request $request, Member $member): array {
        return [
            'member' => $member,
            'capabilities' => Capability::orderby('order')->get(),
            'certifications' => Certification::orderby('order')->get(),
            'others' => Other::orderby('order')->get(),
            'formCapabilities' => new FormCapabilities($request, $member),
            'formOthers' => new FormOther($request, $member),
        ];
    }

    public function persist(Request $request, Member $member): void {
        $member->fill($request->all());

        if (Auth::user()->can('manage-members')) {
            $member->status = $request->input('status', 'pending');
        }

        if($member->id == null) {
            $member->save();
        } else {
            $member->update();
        }

        if ($request->has('certifications')) {
            $member->certifications()->sync(array_keys($this->filterCertifications($request)));
        }

        $member->capabilities()->sync($request->input('capabilities', []));

        $member->others()->sync($this->filterAndMapOthers($request));

        $this->setRoles($member);
    }

    public function setRoles(Member $member): void {
        if (Auth::user()->can('manage-members')) {
            $user = User::find($member->user_id);

            if ($member->status == 'active') {
                $user->assignRole('member');
            } else {
                $user->removeRole('member');
            }
        }
    }

    private function filterCertifications($request)
    {
        return array_filter($request->certifications, function ($value) {
            return $value == "1";
        });
    }

    private function filterAndMapOthers($request)
    {
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
