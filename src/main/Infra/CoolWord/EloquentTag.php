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
            $eloquentTag = \App\Models\CoolWord\Tag::findOrFail($tag->id()->value);
        } else {
            $eloquentTag =  new \App\Models\CoolWord\Tag();
        }

        $eloquentTag->name = $tag->name();
        $eloquentTag->save();

        return new TagId($eloquentTag->id);
    }

    public function findByIds(array $ids): TagCollection
    {
        $tags = \App\Models\CoolWord\Tag::find($ids)->map(function ($tag) {
            return new Tag(
                id: new TagId($tag->id),
                name: $tag->name
            );
        });

        return new TagCollection(...$tags);
    }
}
