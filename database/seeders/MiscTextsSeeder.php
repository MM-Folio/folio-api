<?php

namespace Database\Seeders;

use App\Models\MiscTexts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiscTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MiscTexts::factory()->create([
            'textid' => 'AboutUs'
        ]);

        MiscTexts::factory()->create([
            'textid' => 'ContactUs'
        ]);

        MiscTexts::factory()->create([
            'textid' => 'PrivacyPolicy'
        ]);

        MiscTexts::factory()->create([
            'textid' => 'TermsAndConditions'
        ]);

        MiscTexts::factory()->create([
            'textid' => 'CookiePolicy'
        ]);

        MiscTexts::factory()->create([
            'textid' => 'Imprint'
        ]);


    }
}
