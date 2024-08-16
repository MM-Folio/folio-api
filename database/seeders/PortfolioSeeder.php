<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {

            $portfolio = Portfolio::factory()->create([
                'title' => 'Portfolio ' . $i,
                'valid_till' => date('Y-m-d', strtotime('+1 month')),
                'urlId' => base64_encode('view' . $i),
            ]);

            $portfolio->artists()->sync([1, 2, 3, 4, 5]);
        }
    }
}
