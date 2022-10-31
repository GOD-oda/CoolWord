<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use Main\Domain\CoolWord\CoolWordId;
use Main\Domain\CoolWord\CoolWordRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateController extends Controller
{
    public function __construct(
        private CoolWordRepository $coolWordRepository
    ) {}

    /**
     * Handle the incoming request.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $id, Request $request)
    {
        $coolWord = $this->coolWordRepository->findById(new CoolWordId($id));

        $coolWord->changeDescription($request->get('description'));
        $this->coolWordRepository->store($coolWord);

        return redirect()->route('admin.cool_words.show', ['id' => $coolWord->id()->value])
            ->with('success_msg', '更新成功');
    }
}
