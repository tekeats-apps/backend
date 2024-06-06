<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
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

        $roles=[
            ['name' => 'super admin'],
            ['name' => 'admin'],
            ['name' => 'developer']
        ];

        // Create roles
        if(isset($roles) && !empty($roles)){
            foreach($roles as $role){
                Role::create($role);
            }
        }
    }
}
