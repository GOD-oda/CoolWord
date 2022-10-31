<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Tag\Admin;

use Illuminate\Pagination\LengthAwarePaginator;

final class Paginator extends LengthAwarePaginator
{
    public static $defaultView = 'pagination::bootstrap-5';
}
