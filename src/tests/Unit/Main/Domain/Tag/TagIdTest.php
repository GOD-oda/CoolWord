<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\Tag;

use Main\Domain\Tag\TagId;
use Tests\TestCase;

class TagIdTest extends TestCase
{
    public function testConstruct()
    {
        $tagId = new TagId(1);
        $this->assertSame(1, $tagId->value);
    }
}
