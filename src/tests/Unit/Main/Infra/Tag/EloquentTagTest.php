<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Infra\Tag;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\Tag\Tag;
use Main\Domain\Tag\TagCollection;
use Main\Domain\Tag\TagId;
use Main\Domain\Tag\TagRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EloquentTagTest extends TestCase
{
    use DatabaseMigrations;

    private TagRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(TagRepository::class);
    }

    public function testStoreNewTag()
    {
        $tag = Tag::new(
            name: 'foo'
        );
        $tagId = $this->repository->store($tag);

        $this->assertInstanceOf(TagId::class, $tagId);
        $this->assertSame(1, \App\Models\Tag::count());
    }

    public function testFindByIds()
    {
        $tagIds = [];

        $tag = Tag::new(
            name: 'foo'
        );
        $tagId = $this->repository->store($tag);
        $tagIds[] = $tagId->value;

        $tag = Tag::new(
            name: 'bar'
        );
        $tagId = $this->repository->store($tag);
        $tagIds[] = $tagId->value;

        $tags = $this->repository->findByIds($tagIds);
        $this->assertInstanceOf(TagCollection::class, $tags);
        $this->assertCount(2, $tags->all());
    }
}
