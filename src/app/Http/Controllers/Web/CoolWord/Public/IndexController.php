<?php

namespace App\Http\Controllers\Web\CoolWord\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoolWord\CoolWordResource;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Contracts\View\View;
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
     * @param \Illuminate\Http\Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $input = $request->toArray();
        $currentPage = Paginator::resolveCurrentPage();

        $coolWordCollection = $this->coolWordRepository->index(
            page: $currentPage,
            perPage: static::PER_PAGE,
        );

        $count = $this->coolWordRepository->count();
        $resource = CoolWordResource::collection($coolWordCollection->all());
        $paginator = new Paginator(
            items: $resource->toArray($request),
            total: $count,
            perPage: static::PER_PAGE,
            currentPage: $currentPage,
            options: [
                'path' => route('cool_words.index')
            ]
        );
        $paginator->withQueryString();

        return view('public.cool_words.index', compact('paginator', 'input'));
    }
}
