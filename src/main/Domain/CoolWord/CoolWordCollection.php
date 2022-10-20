<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

use Traversable;

final class CoolWordCollection implements \IteratorAggregate
{
    /** @var CoolWord[]  */
    private readonly array $items;

    public function __construct(CoolWord ...$items)
    {
        $this->items = $items;
    }

    /**
     * @param CoolWord $coolWord
     * @return $this
     */
    public function add(CoolWord $coolWord): self
    {
        return new self(...array_merge($this->items, [$coolWord]));
    }

    /**
     * @return CoolWord[]
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
