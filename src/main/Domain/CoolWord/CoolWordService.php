<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

final class CoolWordService
{
    public function __construct(
        private CoolWordRepository $coolWordRepository
    ) {}

    public function isDuplicated(CoolWord $coolWord): bool
    {
        $found = $this->coolWordRepository->findByName($coolWord->name());

        return $found !== null;
    }
}
