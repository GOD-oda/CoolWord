<?php

namespace App\Http\Controllers\Web\Tag\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('cool_word.admin.tags.new');
    }
}
