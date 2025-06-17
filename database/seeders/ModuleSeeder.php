<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'Notice', 'status' => true],
            ['name' => 'Zoom', 'status' => true],
            ['name' => 'Language', 'status' => true],
            ['name' => 'Testimonial', 'status' => true],
            ['name' => 'Payment', 'status' => true],
            ['name' => 'Newsletter', 'status' => true],
            ['name' => 'Backup Restore', 'status' => true],
            ['name' => 'Email Templates', 'status' => true],
        ];

        foreach ($modules as $module) {
            Module::updateOrCreate(['name' => $module['name']], $module);
        }
    }
} 