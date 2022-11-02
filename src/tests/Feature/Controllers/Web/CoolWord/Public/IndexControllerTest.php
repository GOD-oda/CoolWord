<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\CoolWord\Public;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testOk(): void
    {
        $response = $this->get(route('cool_words.index'));
        $response->assertStatus(200);
    }
}
