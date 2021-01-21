<?php
namespace App\EloquentProxies;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductEloquentProxies
{

    public function all(): array
    {
        return Product::query()->get();
    }

    public function allWithPaginate(?int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function getByCategory(ProductCategory $productCategory): array
    {
        return Product::query()->where('category_id', '=', $productCategory->id)->get();
    }

    public function getByIdOrFail(int $id): Product
    {
        return Product::query()->findOrFail($id);
    }
}
