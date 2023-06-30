<?php

namespace Database\Seeders;

use Database\Seeders\Roles;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            Roles::class,
            CategorySeeder::class
        ]);
    }
}
