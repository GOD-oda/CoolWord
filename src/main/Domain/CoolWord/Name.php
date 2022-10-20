<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

final class Name
{
    public readonly string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('name is required.');
        }

        $this->value = $value;
    }
}
