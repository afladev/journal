<?php

namespace App\Service\Rss;

use Bluestone\DataTransferObject\DataTransferObject;
use DateTime;

class PostDto extends DataTransferObject
{
    public string $title;
    public string $url;
    public string $authorName;
    public ?string $thumbnail;
    public ?string $description;
    public DateTime $publishedAt;
}
