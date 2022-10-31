<?php

declare(strict_types=1);

namespace Main\Domain\CoolWord;

/**
 * TODO: test
 */
interface TagRepository
{
    public function store(Tag $tag): TagId;

    public function findById(TagId $tagId): ?Tag;

    public function findByIds(array $ids): TagCollection;
}
