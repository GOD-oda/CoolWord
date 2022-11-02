<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoolWord\CoolWordResource;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private const PER_PAGE = 25;

    public function __construct(private CoolWordRepository $coolWordRepository)
    {
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

        $count = $this->coolWordRepository->count(
            where: $where
        );
        $coolWordCollection = $this->coolWordRepository->index(
            page: $currentPage,
            perPage: static::PER_PAGE,
            where: $where
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

        return view('admin.cool_words.index', compact('paginator', 'input'));
    }
}
