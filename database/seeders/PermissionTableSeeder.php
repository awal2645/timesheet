<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        [
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            16,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            36,
            37,
            38,
            40,
            41,
            42,
            43,
            44,
            45,
            46,
            47,
            48,
            49,
            50,
            51,
            52,
            53
            
        ];
        $permissions = [
            'Employer view',
            'Employer create',
            'Employer update',
            'Employer destroy',
            'Employee view',
            'Employee create',
            'Employee update',
            'Employee destroy',
            'Client view',
            'Client create',
            'Client update',
            'Client destroy',
            'Project view',
            'Project store',
            'Project update',
            'Project destroy',
            'Report view',
            'Report create',
            'Report update',
            'Report status',
            'Report feedback',
            'Role view',
            'Role create',
            'Role edit',
            'Role update',
            'Role destroy',
            'Invite send',
            'Invite employer',
            'Invite employee',
            'Timesheet view',
            'Plan view',
            'Plan create',
            'Plan update',
            'Plan destroy',
            'Order view',
            'Order create',
            'SMTP Config',
            'Email Templates',
            'General Settings',
            'Leave view',
            'Leave create',
            'Leave approve',
            'Leave deny',
            'Invoice view',
            'Invoice create',
            'Invoice update',
            'Invoice destroy',
            'Weekly Holidays',
            'Email view',
            'Cms',
            'Language ',
            'Notice view',
            'Leave Types view',
            'Holiday view',
            'Weekly Holidays view',
            'Zoom Meeting view',
            'Zoom Meeting create',
            "Contact view",
            "Testimonial view",
            "Employee Salary view",
            "Newsletter view",
            "Project create",
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
