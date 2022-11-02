<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\CoolWord\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use DatabaseMigrations;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testOk(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.cool_words.index'));
        $response->assertStatus(200);
    }
}
