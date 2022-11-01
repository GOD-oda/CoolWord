<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\Name;
use Main\Domain\CoolWord\Tag;
use Main\Domain\CoolWord\TagCollection;
use Main\Domain\CoolWord\TagId;
use Tests\TestCase;

class CoolWordTest extends TestCase
{
    public function testProperties(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: 'description',
            tags: new TagCollection()
        );

        $this->assertInstanceOf(CoolWordId::class, $coolWord->id());
        $this->assertSame(1, $coolWord->id()->value);
        $this->assertInstanceOf(Name::class, $coolWord->name());
        $this->assertSame('foo', $coolWord->name()->value);
        $this->assertIsInt($coolWord->views());
        $this->assertSame(0, $coolWord->views());
        $this->assertIsString($coolWord->description());
        $this->assertSame('description', $coolWord->description());
        $this->assertInstanceOf(TagCollection::class, $coolWord->tags());
    }

    public function testHasId(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $this->assertTrue($coolWord->hasId());

        $coolWord = new CoolWord(
            id: null,
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $this->assertFalse($coolWord->hasId());
    }

    public function testChangeName(): void
    {
        $beforeName = new Name('foo');
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: $beforeName,
            views: 0,
            description: '',
            tags: new TagCollection()
        );

        $newName = new Name('bar');
        $coolWord->changeName($newName);

        $this->assertSame('bar', $coolWord->name()->value);
    }

    public function testCountUpViews(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $this->assertSame(0, $coolWord->views());

        $coolWord->countUpViews(1);

        $this->assertSame(1, $coolWord->views());
    }

    public function testChangeDescription(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: 'foo',
            tags: new TagCollection()
        );
        $coolWord->changeDescription('bar');

        $this->assertSame('bar', $coolWord->description());
    }

    public function testAddTag(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: 'foo',
            tags: new TagCollection()
        );
        $coolWord->addTag(
            new Tag(
                id: new TagId(1),
                name: 'foo'
            )
        );
        $this->assertCount(1, $coolWord->tags()->all());
    }

    public function testChangTags(): void
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: 'foo',
            tags: new TagCollection(...[
                new Tag(
                    id: new TagId(1),
                    name: 'foo'
                )
            ])
        );
        $coolWord->changeTags(
            new TagCollection(...[
                new Tag(
                    id: new TagId(2),
                    name: 'bar'
                )
            ])
        );
        $this->assertCount(1, $coolWord->tags()->all());
        $this->assertSame(2, $coolWord->tags()->all()[0]->id()->value);
    }

    public function testNew(): void
    {
        $coolWord = CoolWord::new(
            name: new Name('foo'),
            description: 'foo'
        );

        $this->assertNull($coolWord->id());
        $this->assertSame('foo', $coolWord->name()->value);
        $this->assertSame(0, $coolWord->views());
        $this->assertSame('foo', $coolWord->description());
        $this->assertCount(0, $coolWord->tags());
    }
}
