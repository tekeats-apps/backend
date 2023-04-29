<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dleteting roles list
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        $roles = [
            ['name' => 'admin', 'guard_name' => 'store'],
            ['name' => 'staff', 'guard_name' => 'store'],
            ['name' => 'accountant', 'guard_name' => 'store'],
            ['name' => 'support manager', 'guard_name' => 'store']
        ];

        // Create roles
        if (isset($roles) && !empty($roles)) {
            foreach ($roles as $role) {
                Role::create($role);
            }
        }
    }
}
