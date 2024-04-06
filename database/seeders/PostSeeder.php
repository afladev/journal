<?php

namespace Database\Seeders;

use App\Models\Feed;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(50)->create();

        Post::factory()
            ->for(Feed::factory()->create())
            ->count(5)
            ->create();
    }
}
