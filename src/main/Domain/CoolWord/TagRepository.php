<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

interface TagRepository
{
    public function store(Tag $tag): TagId;

    public function findByIds(array $ids): TagCollection;
}
