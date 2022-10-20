<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

interface CoolWordRepository
{
    public function index(int $page, int $perPage, array $where = []): CoolWordCollection;

    public function findById(CoolWordId $id): ?CoolWord;

    public function findByName(Name $name): ?CoolWord;

    public function store(CoolWord $coolWord): CoolWordId;

    public function count(array $where = []): int;

    public function countUpViews(CoolWordId $id, int $increments): void;
}
