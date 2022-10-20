<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

final class TagId
{
    public function __construct(public readonly int $value) {}
}
