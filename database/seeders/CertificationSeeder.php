<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = array(
            'ARRL EC-001',
            'ICS-100',
            'ICS-200',
            'ICS-300',
            'ICS-400',
            'ICS-700',
            'ICS-800',
            'DHS Auxiliary Communications',
            'ICS COML',
            'CERT',
        );

        foreach ($descriptions as $key => $description) {
            DB::table('certifications')->insert([
                'description' => $description,
                'order' => ($key + 1) * 10,
            ]);
        }
    }
}
