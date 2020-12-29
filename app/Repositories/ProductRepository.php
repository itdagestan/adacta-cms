<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @return array
     */
    public function all(): array
    {
        return Product::query()->all();
    }

    /**
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function allWithPaginate(?int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * @param ProductCategory $productCategory
     * @return array
     */
    public function getByCategory(ProductCategory $productCategory): array
    {
        return Product::query()->where('category_id', '=', $productCategory->id)->get();
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getByIdOrFail(int $id): Product
    {
        return Product::query()->findOrFail($id);
    }
}
