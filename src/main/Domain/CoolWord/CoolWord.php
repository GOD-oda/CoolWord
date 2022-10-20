<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

final class CoolWord
{
    public function __construct(
        private readonly ?CoolWordId $id,
        private Name $name,
        private int $views,
        private string $description,
        private TagCollection $tags
    ) {}

    public function id(): ?CoolWordId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function hasId(): bool
    {
        return $this->id !== null;
    }

    public function changeName(Name $name): void
    {
        $this->name = $name;
    }

    public function views(): int
    {
        return $this->views;
    }

    public function countUpViews(int $increments): void
    {
        $this->views += $increments;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function changeDescription(string $description): void
    {
        $this->description = $description;
    }

    public function tags(): TagCollection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): void
    {
        $this->tags = $this->tags()->add($tag);
    }

    public static function new(Name $name, string $description): self
    {
        return new self(
            id: null,
            name: $name,
            views: 0,
            description: $description,
            tags: new TagCollection()
        );
    }
}
