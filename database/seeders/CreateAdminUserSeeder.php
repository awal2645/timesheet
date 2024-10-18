<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'timesheet',
            'email' => 'admin@mail.com',
            'role' => 'superadmin',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::first();

        $permissions = Permission::pluck('id', 'id')->all();

        $role->givePermissionTo($permissions);

        $user->assignRole([$role->id]);
    }
}
