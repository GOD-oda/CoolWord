<?php

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use Main\Domain\CoolWord\TagRepository;

class NewController extends Controller
{
    public function __construct(private readonly TagRepository $tagRepository)
    {
    }


    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $tagCollection = $this->tagRepository->all();
        $tagResource = TagResource::collection($tagCollection->all());

        return view('cool_word.admin.cool_words.new', [
            'tags' => $tagResource->collection->map->toArray()->all()
        ]);
    }
}
