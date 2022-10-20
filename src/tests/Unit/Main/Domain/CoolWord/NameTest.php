<?php

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\Name;
use Tests\TestCase;

class NameTest extends TestCase
{
    public function testInvalidArgumentWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectErrorMessage('name is required.');

        new Name('');
    }

    public function testValue(): void
    {
        $name = new Name('foo');
        $this->assertSame('foo', $name->value);
    }
}
