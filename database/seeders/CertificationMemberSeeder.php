<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\members\Member;
use App\Models\members\Certification;

class CertificationMemberSeeder extends Seeder
{
    public function run()
    {
        $certifications = Certification::all();

        Member::all()->each(function ($member) use ($certifications) {
            $member->certifications()->attach(
                $certifications->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
