<?php

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Events\CoolWord\CoolWordViewed;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoolWord\CoolWordResource;
use App\Http\Resources\Tag\TagResource;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Events\Dispatcher;
use Main\Domain\Tag\TagRepository;

class EditController extends Controller
{
    public function __construct(
        private readonly CoolWordRepository $coolWordRepository,
        private readonly TagRepository $tagRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param $id
     */
    public function __invoke($id)
    {
        $coolWordId = new CoolWordId($id);

        $coolWord = $this->coolWordRepository->findById($coolWordId);
        if ($coolWord === null) {
            abort(404);
        }
        $coolWordResource = CoolWordResource::make($coolWord);

        $tagCollection = $this->tagRepository->all();
        $tagResource = TagResource::collection($tagCollection->all());

        return view('admin.cool_words.edit', [
            'coolWord' => $coolWordResource->toArray(),
            'tags' => $tagResource->collection->map->toArray()->all()
        ]);
    }
}
