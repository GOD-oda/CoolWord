<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoolWord\Admin\StoreCoolWordFormRequest;
use Main\Domain\CoolWord\CoolWord;
use Main\Domain\CoolWord\CoolWordRepository;
use Main\Domain\CoolWord\CoolWordService;
use Main\Domain\CoolWord\Name;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function __construct(
        private CoolWordService $coolWordService,
        private CoolWordRepository $coolWordRepository
    ) {}

    /**
     * Handle the incoming request.
     *
     * @param StoreCoolWordFormRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function __invoke(StoreCoolWordFormRequest $request): RedirectResponse
    {
        $coolWord = CoolWord::new(
            name: new Name($request->validated('name')),
            description: $request->validated('description', '')
        );
        if ($this->coolWordService->isDuplicated($coolWord)) {
            throw ValidationException::withMessages([
                'errorMsg' => [
                    '名前は既に存在しています'
                ]
            ]);
        }
        $coolWordId = $this->coolWordRepository->store($coolWord);
        $newCoolWord = $this->coolWordRepository->findById($coolWordId);

        return redirect()->route('cool_word.admin.cool_words.show', ['id' => $newCoolWord->id()->value])
            ->with('success_msg', '作成成功');
    }
}
