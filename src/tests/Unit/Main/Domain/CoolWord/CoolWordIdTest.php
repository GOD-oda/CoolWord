<?php

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\CoolWordId;
use Tests\TestCase;

class CoolWordIdTest extends TestCase
{
    public function testId(): void
    {
        $coolWordId = new CoolWordId(1);
        $this->assertSame(1, $coolWordId->value);
    }
}
