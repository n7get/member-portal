<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            CapabilitySeeder::class,
            CertificationSeeder::class,
            OtherSeeder::class,
            MemberSeeder::class,
            CapabilityMemberSeeder::class,
            CertificationMemberSeeder::class,
            MemberOtherSeeder::class,
            ResourceCategorySeeder::class,
            ResourceFileSeeder::class,
            ResourcesCategoriesFilesSeeder::class,
            ActiivitySeeder::class,
        ]);
    }
}
