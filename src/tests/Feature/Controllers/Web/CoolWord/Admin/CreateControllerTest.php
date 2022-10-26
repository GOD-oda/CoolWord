<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\CoolWord\Admin;

use App\Models\User;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    private User $user;
    private CoolWordRepository $coolWordRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->coolWordRepository = $this->app->make(CoolWordRepository::class);
    }

    /**
     * @dataProvider providesSuccessParameterPatterns
     */
    public function testSuccessCreate(array $params): void
    {
        $response = $this->actingAs($this->user)
            ->from(route('cool_word.admin.cool_words.show', ['id' => $this->user->id]))
            ->post(route('cool_word.admin.cool_words.create'), $params);

        $response->assertStatus(302)
            ->assertRedirect(route('cool_word.admin.cool_words.show', ['id' => $this->user->id]));

        $this->assertSame(1, $this->coolWordRepository->count());
    }

    private function providesSuccessParameterPatterns(): array
    {
        return [
            [
                ['name' => 'foo']
            ],
            [
                ['name' => 'foo', 'description' => '']
            ],
            [
                ['name' => 'foo', 'description' => 'bar']
            ]
        ];
    }

    public function testFailCreate()
    {
        $response = $this->actingAs($this->user)
            ->from(route('cool_word.admin.cool_words.show', ['id' => $this->user->id]))
            ->post(route('cool_word.admin.cool_words.create'), []);

        $response->assertStatus(302)
            ->assertRedirect(route('cool_word.admin.cool_words.show', ['id' => $this->user->id]));

        $this->assertSame(0, $this->coolWordRepository->count());
    }
}
