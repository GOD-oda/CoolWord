<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Web\Tag\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
    use DatabaseMigrations;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testSuccessCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->from(route('admin.tags.new'))
            ->post(route('admin.tags.create'), ['name' => 'foo']);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.tags.index'));
    }

    public function testFailCreate()
    {
        $response = $this->actingAs($this->user)
            ->from(route('admin.cool_words.new'))
            ->post(route('admin.cool_words.create'), []);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.cool_words.new'));
    }
}
