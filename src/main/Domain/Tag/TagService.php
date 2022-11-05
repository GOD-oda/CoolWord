<?php

declare(strict_types=1);

namespace Main\Domain\Tag;

final class TagService
{
    public function __construct(private readonly TagRepository $tagRepository)
    {
    }

    public function isDuplicated(Tag $tag): bool
    {
        $found = $this->tagRepository->findByName($tag);

        return $found !== null;
    }
}
