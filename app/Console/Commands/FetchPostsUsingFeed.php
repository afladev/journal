<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Models\Post;
use App\Service\Rss\Reader;
use Illuminate\Console\Command;

class FetchPostsUsingFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:fetch-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch posts using feed';

    /**
     * Execute the console command.
     */
    public function handle(Reader $reader)
    {
        Feed::each(function (Feed $feed) use ($reader) {
            $posts = $reader->fetch($feed);

            foreach ($posts as $postDto) {
                $post = Post::firstOrNew(
                    [
                        'url' => $postDto->url,
                    ],
                    [
                        'title' => $postDto->title,
                        'url' => $postDto->url,
                        'author' => $postDto->authorName,
                        'thumbnail' => $postDto->thumbnail,
                        'description' => $postDto->description,
                        'published_at' => $postDto->publishedAt,
                    ]
                );

                $feed->posts()->save($post);
            }
        });
    }
}
