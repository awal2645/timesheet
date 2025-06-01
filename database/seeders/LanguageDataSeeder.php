<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Language\App\Models\LanguageData;

class LanguageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = loadLanguage();

        foreach ($languages as $language) {

            $jsonData = [
                'welcome' => 'Welcome',
                'hello' => 'Hello',
            ];

            LanguageData::create([
                'code' => $language->code,
                'data' => json_encode($jsonData),
            ]);
        }

    }
}
