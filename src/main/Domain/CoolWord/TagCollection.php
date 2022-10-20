<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

use Traversable;

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

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
