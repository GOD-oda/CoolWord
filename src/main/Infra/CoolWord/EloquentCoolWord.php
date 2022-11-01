<?php

declare(strict_types=1);

namespace Main\Infra\CoolWord;

use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordCollection;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Main\Domain\CoolWord\Name;
use Main\Domain\CoolWord\Tag;
use Main\Domain\CoolWord\TagCollection;
use Main\Domain\CoolWord\TagId;

class EloquentCoolWord implements CoolWordRepository
{
    public function findById(CoolWordId $id): ?CoolWord
    {
        $coolWord = \App\Models\CoolWord::find($id->value);
        if ($coolWord === null) {
            return null;
        }

        $tags = [];
        $coolWord->tags()->each(function (\App\Models\Tag $tag) use (&$tags) {
            $tags[] = new Tag(
                id: new TagId($tag->id),
                name: $tag->name
            );
        });

        return new CoolWord(
            id: new CoolWordId($coolWord->id),
            name: new Name($coolWord->name),
            views: $coolWord->views,
            description: $coolWord->description,
            tags: new TagCollection(...$tags)
        );
    }

    public function findByName(Name $name): ?CoolWord
    {
        $coolWord = \App\Models\CoolWord::where([
            'name' => $name->value
        ])->first();
        if ($coolWord === null) {
            return null;
        }

        $tags = [];
        $coolWord->tags()->each(function (\App\Models\Tag $tag) use (&$tags) {
            $tags[] = new Tag(
                id: new TagId($tag->id),
                name: $tag->name
            );
        });

        return new CoolWord(
            id: new CoolWordId($coolWord->id),
            name: new Name($coolWord->name),
            views: $coolWord->views,
            description: $coolWord->description,
            tags: new TagCollection(...$tags)
        );
    }

    public function store(CoolWord $coolWord): CoolWordId
    {
        if ($coolWord->hasId()) {
            $eloquentCoolWord = \App\Models\CoolWord::findOrFail($coolWord->id()->value);
        } else {
            $eloquentCoolWord = new \App\Models\CoolWord();
        }

        $eloquentCoolWord->name = $coolWord->name()->value;
        $eloquentCoolWord->views = $coolWord->views();
        $eloquentCoolWord->description = $coolWord->description();
        $eloquentCoolWord->save();

        $tagIds = array_map(function (Tag $tag) {
            return $tag->id()->value;
        }, $coolWord->tags()->all());
        $eloquentCoolWord->tags()->sync($tagIds);

        return new CoolWordId($eloquentCoolWord->id);
    }

    public function index(int $page, int $perPage, array $where = []): CoolWordCollection
    {
        $eloquentCoolWords = \App\Models\CoolWord::query()
            ->name($where['name'] ?? '')
            ->forPage($page, $perPage)
            ->get();

        $collection = $eloquentCoolWords->map(function (\App\Models\CoolWord $coolWord) {
            $tags = [];
            $coolWord->tags()->each(function (\App\Models\Tag $tag) use (&$tags) {
                $tags[] = new Tag(
                    id: new TagId($tag->id),
                    name: $tag->name
                );
            });

            return new CoolWord(
                id: new CoolWordId($coolWord->id),
                name: new Name($coolWord->name),
                views: $coolWord->views,
                description: $coolWord->description,
                tags: new TagCollection(...$tags)
            );
        });

        return new CoolWordCollection(...$collection);
    }

    public function count(array $where = []): int
    {
        return \App\Models\CoolWord::query()
            ->name($where['name'] ?? '')
            ->count();
    }

    public function countUpViews(CoolWordId $id, int $increments): void
    {
        $coolWord = $this->findById($id);

        $coolWord->countUpViews($increments);

        $this->store($coolWord);
    }
}
