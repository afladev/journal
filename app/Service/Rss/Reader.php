<?php

namespace App\Service\Rss;

use App\Models\Feed;
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
            $thumbnail = null;
            $description = null;

            foreach ($item->getMedias() as $media) {
                if ($media->getThumbnail()) {
                    $thumbnail = $media->getThumbnail();
                    $description = $media->getDescription();
                }
            }

            $posts[] = new PostDto(
                title: $item->getTitle(),
                authorName: $result->getFeed()->getTitle(),
                url: $item->getLink(),
                thumbnail: $thumbnail,
                description: $item->getContent() ?? $description,
                publishedAt: $item->getLastModified(),
            );
        }

        return $posts;
    }
}
