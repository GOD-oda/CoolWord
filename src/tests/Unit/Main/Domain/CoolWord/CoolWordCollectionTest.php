<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordCollection;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\Name;
use Main\Domain\Tag\TagCollection;
use Tests\TestCase;

class CoolWordCollectionTest extends TestCase
{
    public function testAdd()
    {
        $collection = new CoolWordCollection();
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $collection = $collection->add($coolWord);

        $this->assertCount(1, $collection->all());
    }
}
