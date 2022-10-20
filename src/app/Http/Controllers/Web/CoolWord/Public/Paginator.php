<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\CoolWord\Public;

use Illuminate\Pagination\LengthAwarePaginator;

final class Paginator extends LengthAwarePaginator
{
    public static $defaultView = 'pagination::bootstrap-5';
}
