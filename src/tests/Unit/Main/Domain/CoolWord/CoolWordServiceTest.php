<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\CoolWord;

use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Main\Domain\CoolWord\CoolWordService;
use Main\Domain\CoolWord\Name;
use Main\Domain\CoolWord\TagCollection;
use Tests\TestCase;

class CoolWordServiceTest extends TestCase
{
    private CoolWordRepository $repository;
    private CoolWordService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(CoolWordService::class);
        $this->repository = $this->app->make(CoolWordRepository::class);
    }

    public function testFalseIsDuplicated()
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $this->assertFalse($this->service->isDuplicated($coolWord));
    }

    public function testTrueIsDuplicated()
    {
        $coolWord = new CoolWord(
            id: null,
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );
        $this->repository->store($coolWord);

        $anotherCoolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo'),
            views: 0,
            description: '',
            tags: new TagCollection()
        );

        $this->assertTrue($this->service->isDuplicated($anotherCoolWord));
    }
}
