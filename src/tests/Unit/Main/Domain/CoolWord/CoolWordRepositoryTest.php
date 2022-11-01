<?php

declare(strict_types=1);

namespace Tests\Unit\Main\Domain\CoolWord;

use App\Models\CoolWord as EloquentCoolWord;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordCollection;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Main\Domain\CoolWord\Name;
use Main\Domain\CoolWord\Tag;
use Main\Domain\CoolWord\TagCollection;
use Main\Domain\CoolWord\TagId;
use Main\Domain\CoolWord\TagRepository;
use Database\Factories\CoolWordFactory;
use Tests\TestCase;

class CoolWordRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private CoolWordRepository $coolWordRepository;
    private TagRepository $tagRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->coolWordRepository = $this->app->make(CoolWordRepository::class);
        $this->tagRepository = $this->app->make(TagRepository::class);
    }

    /**
     * @param array $initialCoolWordParameters
     * @param int $page
     * @param int $perPage
     * @param array $where
     * @param int $expectedCount
     * @return void
     * @dataProvider providesIndexPatterns
     */
    public function testIndex(array $initialCoolWordParameters, int $page, int $perPage, array $where, int $expectedCount): void
    {
        CoolWordFactory::new($initialCoolWordParameters)->create();

        $res = $this->coolWordRepository->index($page, $perPage, $where);
        $this->assertInstanceOf(CoolWordCollection::class, $res);
        $this->assertCount($expectedCount, $res);
        // TODO: tag_id
    }

    private function providesIndexPatterns(): array
    {
        return [
            [[], 1, 1, [], 1],
            [['name' => 'foo'], 1, 1, ['name' => 'foo'], 1],
            [[], 1, 1, ['name' => 'foo'], 0],
        ];
    }

    public function testFindById(): void
    {
        $coolWordId = new CoolWordId(1);
        $res = $this->coolWordRepository->findById($coolWordId);
        $this->assertNull($res);

        $coolWord = CoolWordFactory::new()->create();
        $coolWordId = new CoolWordId($coolWord->id);
        $res = $this->coolWordRepository->findById($coolWordId);
        $this->assertInstanceOf(CoolWord::class, $res);
        // TODO: tag_id
    }

    public function testFindByName(): void
    {
        $name = new Name('foo');
        $res = $this->coolWordRepository->findByName($name);
        $this->assertNull($res);

        $coolWord = CoolWordFactory::new()->create();
        $name = new Name($coolWord->name);
        $res = $this->coolWordRepository->findByName($name);
        $this->assertInstanceOf(CoolWord::class, $res);
        // TODO: tag_id
    }

    public function testStoreNew(): void
    {
        $coolWord = CoolWord::new(
            name: new Name('foo'),
            description: 'description'
        );
        $tag = \App\Models\Tag::factory()->create();
        $coolWord->addTag(new Tag(
            id: new TagId($tag->id),
            name: $tag->name
        ));

        $coolWordId = $this->coolWordRepository->store($coolWord);
        $saved = $this->coolWordRepository->findById($coolWordId);

        $this->assertNotNull($saved->id());
        // 値だけ確認できれば良いのでEqualsを使っている
        $this->assertEquals($coolWord->name(), $saved->name());
        $this->assertEquals($coolWord->views(), $saved->views());
        $this->assertEquals($coolWord->description(), $saved->description());
        $this->assertSame($tag->name, $saved->tags()->all()[0]->name());
    }

    public function testStoreSaved(): void
    {
        $coolWord = \App\Models\CoolWord::factory()
            ->has(\App\Models\Tag::factory([
                'name' => 'before'
            ]))
            ->create([
                'name' => 'before',
                'description' => 'before',
            ]);
        $coolWordBeforeSave = $this->coolWordRepository->findById(new CoolWordId($coolWord->id));

        $tag = \App\Models\Tag::factory()->create([
            'name' => 'after'
        ]);
        $tags = new TagCollection(...[
            new Tag(
                id: new TagId($tag->id),
                name: $tag->name
            )
        ]);
        $coolWordId = $this->coolWordRepository->store(new CoolWord(
            id: new CoolWordId($coolWord->id),
            name: new Name('after'),
            views: 1,
            description: 'after',
            tags: $tags
        ));

        $updatedCoolWord = $this->coolWordRepository->findById($coolWordId);
        $this->assertNotSame($coolWordBeforeSave->name(), $updatedCoolWord->name()->value);
        $this->assertSame('after', $updatedCoolWord->name()->value);
        $this->assertNotSame($coolWordBeforeSave->description(), $updatedCoolWord->description());
        $this->assertSame('after', $updatedCoolWord->description());
        $this->assertNotSame($coolWordBeforeSave->views(), $updatedCoolWord->views());
        $this->assertSame(1, $updatedCoolWord->views());
        $this->assertNotSame($coolWordBeforeSave->tags()->all()[0]->name(), $updatedCoolWord->tags()->all()[0]->name());
        $this->assertSame('after', $updatedCoolWord->tags()->all()[0]->name());
    }

    public function testCount(): void
    {
        $this->assertSame(0, $this->coolWordRepository->count());

        EloquentCoolWord::factory()->create();

        $this->assertSame(1, $this->coolWordRepository->count());
    }

    public function testCountUpViews()
    {
        $model = EloquentCoolWord::factory()->create();
        $id = new CoolWordId($model->id);

        $this->coolWordRepository->countUpViews($id, 1);

        $this->assertSame(1, $this->coolWordRepository->findById($id)->views());
    }
}
