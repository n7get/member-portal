<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Capability;

class CapabilityMemberSeeder extends Seeder
{
    public function run()
    {
        $members = Member::all();
        $capabilities = Capability::all();

        foreach ($members as $member) {
            $selectedCapabilities = $capabilities->random(rand(1, $capabilities->count()));
            foreach ($selectedCapabilities as $capability) {
                $rand = rand(0,3);
                if($rand !== 0) {
                    $member->capabilities()->attach($capability->id, [
                        'base' => ($rand & 2) != 0,
                        'portable' => ($rand & 1) != 0,
                    ]);
                }
            }
        }
    }
}
