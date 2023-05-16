<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Roles;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            Roles::class
        ]);
    }
}
