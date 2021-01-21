<?php


namespace App\Services;

use App\Models\ProductCategory;
use App\DataTransferObjects\ProductCategoryDataLoadFromRequest;

final class ProductCategoryService
{

    /**
     * @param ProductCategory $modelProductCategory
     * @param ProductCategoryDataLoadFromRequest $productCategoryData
     * @return void
     * @throws \Exception
     */
    public function saveProductCategory(
        ProductCategory $modelProductCategory,
        ProductCategoryDataLoadFromRequest $productCategoryData
    ): void
    {
        $modelProductCategory->name = $productCategoryData->getName();
        $modelProductCategory->slug = $productCategoryData->getSlug();
        $modelProductCategory->is_active = $productCategoryData->getIsActive();
        if (!$modelProductCategory->save()) {
            throw new \Exception();
        }
    }

}
