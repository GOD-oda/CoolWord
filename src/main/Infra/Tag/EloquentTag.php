<?php

declare(strict_types=1);

namespace Main\Infra\Tag;

use Main\Domain\Tag\Tag;
use Main\Domain\Tag\TagCollection;
use Main\Domain\Tag\TagFactory;
use Main\Domain\Tag\TagId;
use Main\Domain\Tag\TagRepository;

final class EloquentTag implements TagRepository
{
    public function __construct(private readonly TagFactory $tagFactory)
    {
    }

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
            return $this->tagFactory->buildFromEloquent($tag);
        });

        return new TagCollection(...$tags);
    }

    public function findById(TagId $tagId): ?Tag
    {
        $tag = \App\Models\Tag::find($tagId->value);
        if ($tag === null) {
            return null;
        }

        return $this->tagFactory->buildFromEloquent($tag);
    }

    public function count(array $where = []): int
    {
        return \App\Models\Tag::query()
            ->name($where['name'] ?? '')
            ->count();
    }

    public function index(int $page, int $perPage, array $where = []): TagCollection
    {
        $eloquentTags = \App\Models\Tag::query()
            ->name($where['name'] ?? '')
            ->forPage($page, $perPage)
            ->get();

        $collection = $eloquentTags->map(function (\App\Models\Tag $tag) {
            return $this->tagFactory->buildFromEloquent($tag);
        });

        return new TagCollection(...$collection);
    }

    public function all(): TagCollection
    {
        $eloquentTags = \App\Models\Tag::all();

        $collection = $eloquentTags->map(function (\App\Models\Tag $tag) {
            return $this->tagFactory->buildFromEloquent($tag);
        });

        return new TagCollection(...$collection);
    }

    public function findByName(Tag $tag): ?Tag
    {
        $eloquentTag = \App\Models\Tag::name($tag->name())->first();

        if ($eloquentTag === null) {
            return null;
        }

        return $this->tagFactory->buildFromEloquent($eloquentTag);
    }
}
