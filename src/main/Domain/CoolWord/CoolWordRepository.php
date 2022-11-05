<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

use Main\Domain\Tag\TagCollection;

interface CoolWordRepository
{
    // TODO: Criteria insteadof $where
    public function index(int $page, int $perPage, array $where = [], TagCollection $tagCollection = new TagCollection()): CoolWordCollection;

    public function findById(CoolWordId $id): ?CoolWord;

    public function findByName(Name $name): ?CoolWord;

    public function store(CoolWord $coolWord): CoolWordId;

    // TODO: Criteria insteadof $where
    public function count(array $where = [], TagCollection $tagCollection = new TagCollection()): int;

    public function countUpViews(CoolWordId $id, int $increments): void;
}
