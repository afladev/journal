<?php

namespace Tests\Feature\Console;

use App\Models\Feed;
use App\Models\Post;
use App\Service\Rss\PostDto;
use App\Service\Rss\Reader;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FetchPostsUsingFeedTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_new_post_using_feed()
    {
        $expectedFeed = Feed::factory()->create();

        $this->mock(Reader::class, function (MockInterface $mock) use ($expectedFeed) {
            $mock->shouldReceive('fetch')
                ->with(Mockery::on(function ($feed) use ($expectedFeed) {
                    return $feed->id === $expectedFeed->id;
                }))
                ->andReturn([
                      new PostDto(
                        title: "Ceci est un test",
                        authorName: "John Doe",
                        url: "https://laravel-france.com",
                        thumbnail: "https://example.org/image.jpg",
                        description: "qsdqs",
                        publishedAt: new DateTime(),
                    )
                ]);
        });

        $this->artisan('feed:fetch-posts')
            ->assertSuccessful();

        $this->assertDatabaseCount(Post::class, 1);

        $this->assertDatabaseHas(Post::class, [
            'title' => "Ceci est un test",
            'author' => "John Doe",
            'url' => "https://laravel-france.com",
            'thumbnail' => "https://example.org/image.jpg",
            'description' => "qsdqs",
            'published_at' => new DateTime(),
            'feed_id' => $expectedFeed->id,
        ]);
    }
}
