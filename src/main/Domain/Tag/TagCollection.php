<?php

declare(strict_types=1);

namespace Main\Domain\Tag;

use Traversable;

/**
 * TODO: test
 */
final class TagCollection implements \IteratorAggregate
{
    private readonly array $items;

    public function __construct(Tag ...$items)
    {
        $this->items = $items;
    }

    public function add(Tag $tag): self
    {
        return new self(...array_merge($this->items, [$tag]));
    }

    /**
     * @return Tag[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function ids(): array
    {
        $ids = [];

        foreach ($this->items as $item) {
            $ids[] = $item->id()->value;
        }

        return $ids;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
