<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Insert default roles
        DB::table('roles')->insert([
            ['name' => 'superadmin', 'guard_name' => 'web'],
            ['name' => 'employer', 'guard_name' => 'web'],
            ['name' => 'employee', 'guard_name' => 'web'],
            ['name' => 'client', 'guard_name' => 'web'],
        ]);
    }
}
