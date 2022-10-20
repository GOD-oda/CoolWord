<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\TagId;
use Tests\TestCase;

class TagIdTest extends TestCase
{
    public function testConstruct()
    {
        $tagId = new TagId(1);
        $this->assertSame(1, $tagId->value);
    }
}
