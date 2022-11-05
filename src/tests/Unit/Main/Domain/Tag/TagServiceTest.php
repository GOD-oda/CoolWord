<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\Tag;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\Tag\Tag;
use Main\Domain\Tag\TagRepository;
use Main\Domain\Tag\TagService;
use Tests\TestCase;

class TagServiceTest extends TestCase
{
    use DatabaseMigrations;

    private readonly TagRepository $tagRepository;
    private readonly TagService $tagService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tagRepository = $this->app->make(TagRepository::class);
        $this->tagService = $this->app->make(TagService::class);
    }

    public function testFalseIsDuplicated(): void
    {
        $tag = Tag::new(
            name: 'foo'
        );
        $this->assertFalse($this->tagService->isDuplicated($tag));
    }

    public function testTrueIsDuplicated(): void
    {
        $tag = Tag::new(
            name: 'foo'
        );
        $this->tagRepository->store($tag);
        $this->assertTrue($this->tagService->isDuplicated($tag));
    }
}
