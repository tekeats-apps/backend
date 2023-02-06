<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a super admin user
        $matchThese = ['name'=>'Super Admin'];
        $superAdmin = User::updateOrCreate($matchThese,[
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('admin')
        ]);
        $superAdmin->assignRole('super admin');
    }
}
