<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\CoolWord\Public;

use App\Models\CoolWord;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use DatabaseMigrations;

    private CoolWordRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(CoolWordRepository::class);
    }

    public function testOk(): void
    {
        $model = CoolWord::factory()->create();

        $response = $this->get(route('cool_word.show', ['id' => $model->id]));
        $response->assertStatus(200);
    }

    public function testNotFound(): void
    {
        $response = $this->get(route('cool_word.show', ['id' => 1]));

        $response->assertStatus(404);
    }

    public function testViewedEvent()
    {
        $model = CoolWord::factory()->create();
        $coolWordId = new CoolWordId($model->id);

        $this->get(route('cool_word.show', ['id' => $model->id]));
        $coolWord = $this->repository->findById($coolWordId);
        $this->assertSame(1, $coolWord->views());

        $this->get(route('cool_word.show', ['id' => $model->id]));
        $coolWord = $this->repository->findById($coolWordId);
        $this->assertSame(2, $coolWord->views());
    }
}
