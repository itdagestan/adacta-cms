<?php


namespace App\Services;

use App\Models\ProductCategory;
use App\DataTransferObjects\ProductCategoryData;

final class ProductCategoryService
{

    /**
     * @param ProductCategory $modelProductCategory
     * @param ProductCategoryData $productCategoryData
     * @return void
     * @throws \Exception
     */
    public function savePage(
        ProductCategory $modelProductCategory,
        ProductCategoryData $productCategoryData
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
