<?php

namespace Modules\EmailTemplate\Database\Seeders;

use Illuminate\Database\Seeder;

class EmailTemplateDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(EmailTemplateSeeder::class);
    }
}
