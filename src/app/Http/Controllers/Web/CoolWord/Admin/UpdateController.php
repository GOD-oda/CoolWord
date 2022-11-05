<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Http\Request;
use Main\Domain\Tag\TagRepository;

/**
 * TODO: test
 */
class UpdateController extends Controller
{
    public function __construct(
        private readonly CoolWordRepository $coolWordRepository,
        private readonly TagRepository $tagRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param int $id
     * @param Request $request // TODO: Use FormRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $id, Request $request)
    {
        $coolWord = $this->coolWordRepository->findById(new CoolWordId($id));

        $coolWord->changeDescription($request->get('description'));

        $tags = $this->tagRepository->findByIds($request->get('tag_ids', []));
        $coolWord->changeTags($tags);

        $this->coolWordRepository->store($coolWord);

        return redirect()->route('admin.cool_words.show', ['id' => $coolWord->id()->value])
            ->with('success_msg', '更新成功');
    }
}
