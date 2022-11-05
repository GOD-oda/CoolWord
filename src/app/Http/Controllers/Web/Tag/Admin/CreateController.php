<?php

namespace App\Http\Controllers\Web\Tag\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Main\Domain\Tag\Tag;
use Main\Domain\Tag\TagRepository;
use Main\Domain\Tag\TagService;

/**
 * TODO: test
 */
class CreateController extends Controller
{
    public function __construct(
        private readonly TagRepository $tagRepository,
        private readonly TagService $tagService
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request // TODO: form request
     * @throws ValidationException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // TODO: check duplicated

        $tag = Tag::new(name: $request->get('name'));
        if ($this->tagService->isDuplicated($tag)) {
            throw ValidationException::withMessages([
                'errorMsg' => [
                    '同名のタグが既に存在しています'
                ]
            ]);
        }

        $this->tagRepository->store($tag);

        return redirect()->route('admin.tags.index')
            ->with('success_msg', '作成成功');
    }
}
