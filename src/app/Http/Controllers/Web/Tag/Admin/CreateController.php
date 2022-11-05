<?php

namespace App\Http\Controllers\Web\Tag\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Main\Domain\Tag\Tag;
use Main\Domain\Tag\TagRepository;

/**
 * TODO: test
 */
class CreateController extends Controller
{
    public function __construct(private readonly TagRepository $tagRepository)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request // TODO: form request
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // TODO: check duplicated

        $tag = Tag::new(name: $request->get('name'));

        $this->tagRepository->store($tag);

        return redirect()->route('admin.tags.index')
            ->with('success_msg', '作成成功');
    }
}
