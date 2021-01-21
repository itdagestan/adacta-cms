<?php
namespace App\EloquentProxies;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Page;

class PageEloquentProxies
{

    public function all(): Collection
    {
        return Page::query()->orderBy('id', 'desc')->get();
    }

    public function allWithPaginate(?int $perPage = 10): LengthAwarePaginator
    {
        return Page::query()->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function getByIdOrFail(int $id): Page
    {
        return Page::query()->findOrFail($id);
    }
}
