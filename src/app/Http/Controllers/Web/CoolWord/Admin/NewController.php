<?php

namespace App\Http\Controllers\Web\CoolWord\Admin;

use App\Http\Controllers\Controller;

class NewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('cool_word.admin.cool_words.new');
    }
}
