<?php

namespace App\Service\Rss;

use App\Models\Feed;

class Reader
{
    /**
     * @param \App\Models\Feed $feed
     * @return \App\Service\Rss\PostDto[]
     */
    public function fetch(Feed $feed): array
    {
        return [
            new PostDto(
                title: "Ceci est un test",
                authorName: "John Doe",
                url: "https://laravel-france.com",
                thumbnail: "https://example.org/image.jpg",
                description: "qsdqs",
                publishedAt: new \DateTime(),
            )
        ];
    }
}
