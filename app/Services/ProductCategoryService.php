<?php


namespace App\Services;

use App\Models\ProductCategory;
use App\DataTransferObjects\ProductCategoryDTO;

final class ProductCategoryService
{

    /**
     * @param ProductCategory $modelProductCategory
     * @param ProductCategoryDTO $productCategoryData
     * @return void
     * @throws \Exception
     */
    public function saveProductCategory(
        ProductCategory $modelProductCategory,
        ProductCategoryDTO $productCategoryData
    ): void
    {
        $modelProductCategory->name = $productCategoryData->getName();
        $modelProductCategory->slug = $productCategoryData->getSlug();
        $modelProductCategory->parent_id = $productCategoryData->getParentId();
        $modelProductCategory->is_active = $productCategoryData->getIsActive();
        if (!$modelProductCategory->save()) {
            throw new \Exception();
        }
    }

}
