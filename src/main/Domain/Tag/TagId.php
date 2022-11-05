<?php

declare(strict_types=1);

namespace Main\Domain\Tag;

final class TagId
{
    public function __construct(public readonly int $value) {}
}
