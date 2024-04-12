<?php

namespace App\Service\Rss;

use App\Models\Feed;
use FeedIo\Feed\Item;
use FeedIo\FeedIo;

class Reader
{
    public function __construct(protected FeedIo $client)
    {
    }

    /**
     * @param \App\Models\Feed $feed
     * @return \App\Service\Rss\PostDto[]
     */
    public function fetch(Feed $feed): array
    {
        $result = $this->client->read($feed->url);

        $posts = [];

        foreach($result->getFeed() as $item) {
            $posts[] = new PostDto(
                title: $item->getTitle(),
                authorName: $feed->title,
                url: $item->getLink(),
                thumbnail: $this->getThumbnail($item),
                description: $item->getContent(),
                publishedAt: $item->getLastModified(),
            );
        }

        return $posts;
    }

    protected function getThumbnail(Item $item): ?string
    {
        foreach ($item->getMedias() as $media) {
            if ($media->getThumbnail()) {
                return $media->getThumbnail();
            }
        }

        return null;
    }
}
