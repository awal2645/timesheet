<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Notice\Database\Seeders\NoticeDatabaseSeeder;
use Modules\EmailTemplate\Database\Seeders\DatabaseSeeder as EmailTemplateDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',

        // ]);

        $this->call([
            PermissionTableSeeder::class,
            RoleSeeder::class,
            CreateAdminUserSeeder::class,
            CreateEmployerUserSeeder::class,
            CreateEmployeeUserSeeder::class,
            CreateClientUserSeeder::class,
            ProjectSeeder::class,
            PlanDatabaseSeeder::class,
            LanguageDatabaseSeeder::class,
            ThemeSeeder::class,
            LeaveTypeSeeder::class,
            HolidaySeeder::class,
            LeaveApplicationSeeder::class,
            InvoiceSeeder::class,
            TaskSeeder::class,
            EarningSeeder::class,
            UserPlanSeeder::class,
            TimesheetsTableSeeder::class,
            TimeReportsTableSeeder::class,
            ContactSeeder::class,
            ModuleSeeder::class,
            EmailTemplateDatabaseSeeder::class,
        ]);
    }
}
