<?php

declare(strict_types=1);

namespace Main\Domain\Tag;

final class TagFactory
{
    public function buildFromEloquent(\App\Models\Tag $tag): Tag
    {
        return new Tag(
            id: new TagId($tag->id),
            name: $tag->name
        );
    }
}
