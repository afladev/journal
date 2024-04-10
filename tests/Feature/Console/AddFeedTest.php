<?php

namespace Tests\Feature\Console;

use App\Models\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_a_new_feed()
    {
        $title = "Mon feed";
        $url = "https://laravel-france.com/rss";

        $this->artisan("feed:add '$title' $url")
            ->expectsOutput("Nouveau feed ajouté : Mon feed")
            ->assertSuccessful();

        $this->assertDatabaseHas(Feed::class, [
            'title' => $title,
            'url' => $url,
        ]);
    }
}
