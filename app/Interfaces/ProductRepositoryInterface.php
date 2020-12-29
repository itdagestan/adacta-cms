<?php
namespace App\Interfaces;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getByIdOrFail(int $id): Product;
    public function all(): array;
    public function allWithPaginate(?int $perPage): LengthAwarePaginator;
    public function getByCategory(ProductCategory $productCategory): array;
}
