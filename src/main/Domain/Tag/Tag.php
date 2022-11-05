<?php

declare(strict_types=1);

namespace Main\Domain\Tag;

final class Tag
{
    public function __construct(
        private readonly ?TagId $id,
        private readonly string $name
    ) {}

    public function id(): ?TagId
    {
        return $this->id;
    }

    public function hasId(): bool
    {
        return $this->id !== null;
    }

    public function name(): string
    {
        return $this->name;
    }

    public static function new(string $name): self
    {
        return new self(
            id: null,
            name: $name
        );
    }
}
