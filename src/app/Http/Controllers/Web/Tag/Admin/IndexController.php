<?php

namespace App\Http\Controllers\Web\Tag\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Main\Domain\CoolWord\TagRepository;

class IndexController extends Controller
{
    private const PER_PAGE = 30;

    public function __construct(private readonly TagRepository $tagRepository)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $input = $request->toArray();
        $currentPage = Paginator::resolveCurrentPage();
        $where = [
            'name' => $request->get('name', '')
        ];

        $count = $this->tagRepository->count(
            where: $where
        );
        $tagCollection = $this->tagRepository->index(
            page: $currentPage,
            perPage: static::PER_PAGE,
            where: $where
        );

        $resource = TagResource::collection($tagCollection->all());
        $paginator = new Paginator(
            items: $resource->toArray($request),
            total: $count,
            perPage: static::PER_PAGE,
            currentPage: $currentPage,
            options: [
                'path' => route('admin.tags.index')
            ]
        );
        $paginator->withQueryString();

        return view('cool_word.admin.tags.index', compact('paginator', 'input'));
    }
}
