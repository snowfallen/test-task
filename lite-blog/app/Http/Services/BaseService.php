<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseService
{
    public static function paginate(Model $model, int $authorsPerPage): LengthAwarePaginator
    {
        return $model::paginate($authorsPerPage);
    }
}
