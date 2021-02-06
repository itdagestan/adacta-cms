<?php
namespace App\EloquentProxies;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\ProductCategory;

class ProductCategoryEloquentProxies
{

    public function all(): Collection
    {
        return ProductCategory::query()->orderBy('id', 'desc')->get();
    }

    public function allWithoutId(int $Id): Collection
    {
        return ProductCategory::query()->where('id', '!=', $Id)->orderBy('id', 'desc')->get();
    }

    public function allWithPaginate(?int $perPage = 10): LengthAwarePaginator
    {
        return ProductCategory::query()->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function getByIdOrFail(int $id): ProductCategory
    {
        return ProductCategory::query()->findOrFail($id);
    }
}
