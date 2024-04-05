<?php

namespace Database\Seeders;

use App\Models\Feed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feed::factory()->count(5)->create();

        Feed::factory()->create([
            'title' => 'Laravel France',
            'url' => 'https://laravel-france.com/rss',
        ]);
    }
}
