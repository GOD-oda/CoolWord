<?php

declare(strict_types=1);

namespace Main\Infra\CoolWord;

use Main\Domain\CoolWord\Tag;
use Main\Domain\CoolWord\TagCollection;
use Main\Domain\CoolWord\TagId;
use Main\Domain\CoolWord\TagRepository;

final class EloquentTag implements TagRepository
{
    public function store(Tag $tag): TagId
    {
        if ($tag->hasId()) {
            $eloquentTag = \App\Models\Tag::findOrFail($tag->id()->value);
        } else {
            $eloquentTag =  new \App\Models\Tag();
        }

        $eloquentTag->name = $tag->name();
        $eloquentTag->save();

        return new TagId($eloquentTag->id);
    }

    public function findByIds(array $ids): TagCollection
    {
        $tags = \App\Models\Tag::find($ids)->map(function ($tag) {
            return new Tag(
                id: new TagId($tag->id),
                name: $tag->name
            );
        });

        return new TagCollection(...$tags);
    }

    public function findById(TagId $tagId): ?Tag
    {
        $tag = \App\Models\Tag::find($tagId->value);
        if ($tag === null) {
            return null;
        }

        return new Tag(
            id: new TagId($tag->id),
            name: $tag->name
        );
    }
}
