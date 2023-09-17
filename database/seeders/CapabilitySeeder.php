<?php

namespace Database\Seeders;

use App\Models\members\Capability;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CapabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = array(
            'VHF Voice',
            'UHF Voice',
            'HF Voice',
            'VHF/UHF data',
            'HF data',
            'DSTAR',
            'DMR',
            'FRS/GMRS/CB',
            'Mesh',
            'SATCOM INTERNET',
        );

        foreach ($descriptions as $key => $description) {
            DB::table('member_capabilities')->insert([
                'description' => $description,
                'order' => $key,
            ]);
        }
    }
}
