<?php

namespace App\Http\Controllers\Web\CoolWord\Public;

use App\Events\CoolWord\CoolWordViewed;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoolWord\CoolWordResource;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\View;

class ShowController extends Controller
{
    public function __construct(
        private CoolWordRepository $coolWordRepository,
        private Dispatcher $dispatcher
    ) {}

    /**
     * Handle the incoming request.
     *
     * @param $id
     * @return View
     */
    public function __invoke($id): View
    {
        $coolWordId = new CoolWordId($id);

        $coolWord = $this->coolWordRepository->findById($coolWordId);
        if ($coolWord === null) {
            abort(404);
        }
        $resource = CoolWordResource::make($coolWord);

        $this->dispatcher->dispatch(new CoolWordViewed($coolWordId));

        return view('cool_word.public.cool_words.show', [
            'coolWord' => $resource->toArray()
        ]);
    }
}
