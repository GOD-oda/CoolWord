<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoolWord\CoolWordResource;
use App\Http\Resources\Tag\TagResource;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Http\Request;
use Main\Domain\Tag\TagRepository;

class IndexController extends Controller
{
    private const PER_PAGE = 30;

    public function __construct(
        private readonly CoolWordRepository $coolWordRepository,
        private readonly TagRepository $tagRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param CoolWordRepository $coolWordRepository
     */
    public function __invoke(Request $request)
    {
        $input = $request->toArray();
        $currentPage = Paginator::resolveCurrentPage();
        $where = [
            'name' => $request->get('name', '')
        ];
        $tagCollection = $this->tagRepository->findByIds($request->get('tag_ids', []));

        $count = $this->coolWordRepository->count(
            where: $where,
            tagCollection: $tagCollection
        );
        $coolWordCollection = $this->coolWordRepository->index(
            page: $currentPage,
            perPage: static::PER_PAGE,
            where: $where,
            tagCollection: $tagCollection
        );

        $resource = CoolWordResource::collection($coolWordCollection->all());
        $paginator = new Paginator(
            items: $resource->toArray($request),
            total: $count,
            perPage: static::PER_PAGE,
            currentPage: $currentPage,
            options: [
                'path' => route('admin.cool_words.index')
            ]
        );
        $paginator->withQueryString();

        $tagResource = TagResource::collection($this->tagRepository->all()->all());
        $tags = $tagResource->collection->map->toArray()->all();

        return view('admin.cool_words.index', [
            'paginator' => $paginator,
            'input' => $input,
            'tags' => $tags,
            'originalTagIds' => $input['tag_ids'] ?? []
        ]);
    }
}
