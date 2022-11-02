<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\CoolWord\Admin;

use App\Models\CoolWord;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditControllerTest extends TestCase
{
    use DatabaseMigrations;

    private User $user;
    private CoolWordRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->repository = $this->app->make(CoolWordRepository::class);
    }

    public function testOk(): void
    {
        $model = CoolWord::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('admin.cool_words.show', ['id' => $model->id]));
        $response->assertStatus(200);
    }

    public function testNotFound(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.cool_words.show', ['id' => 1]));

        $response->assertStatus(404);
    }
}
