<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\ProductModification;
use App\DataTransferObjects\UnitData;
use App\DataTransferObjects\ModificationData;
use App\DataTransferObjects\SingleProductData;

final class ProductService
{

    public function saveProductOrThrow(
        Product $modelProduct,
        string $productType,
        SingleProductData $productData
    ): Product
    {
        $fileUploadService = new FileUploadService();
        $modelProduct->name = $productData->getName();
        $modelProduct->slug = $productData->getSlug();
        $modelProduct->price_old = $productData->getPriceOld();
        $modelProduct->price_new = $productData->getPriceNew();
        $modelProduct->category_id = $productData->getCategoryId();
        $modelProduct->description = $productData->getDescription();
        $modelProduct->is_active = $productData->getIsActive();
        $modelProduct->link = $productData->getLink();
        $modelProduct->type = $productType;
        if ($productData->getThumbnail() !== null) {
            $fileUploadService->uploadOneThumbnail($productData->getThumbnail());
            $modelProduct->thumbnail_path = $fileUploadService->filenameWithExtension;
        }
        if (!$modelProduct->save()) {
            throw new \Exception();
        }
            return $modelProduct;
    }

    public function saveModificationOrThrow(
        Product $modelProduct,
        ModificationData $modificationData
    ): ProductModification
    {
        $modelProductModification = new ProductModification();
        if ($modificationData->getId() !== null) {
            $modelProductModification = ProductModification::query()->findOrFail($modificationData->getId());
        }
        $modelProductModification->product_id = $modelProduct->id;
        $modelProductModification->name = $modificationData->getName();
        $modelProductModification->price = $modificationData->getPrice();
        $modelProductModification->price_type = $modificationData->getPriceType();
        if (!$modelProductModification->save()) {
            throw new \Exception();
        }
        return $modelProductModification;
    }

    public function saveUnitOrThrow(
        Product $modelProduct,
        UnitData $unitData
    ): ProductUnit
    {
        $modelProductUnit = new ProductUnit();
        $modelProductUnit->product_id = $modelProduct->id;
        if ($unitData->getId() !== null) {
            $modelProductUnit = ProductUnit::query()->findOrFail($unitData->getId());
        }
        $modelProductUnit->count = $unitData->getCount();
        $modelProductUnit->unit_type = $unitData->getUnitType();
        $modelProductUnit->price = $unitData->getPrice();
        if (!$modelProductUnit->save()) {
            throw new \Exception();
        }
        return $modelProductUnit;
    }

    public function deleteUnusedUnitsOrThrow(array $unitIdsInRequest): void
    {
        try {
            DB::beginTransaction();
            $unitIdsInDB = collect(ProductUnit::getList())->pluck('id');
            $unusedUnitIds = $unitIdsInDB->diff($unitIdsInRequest)->all();
            foreach ($unusedUnitIds as $unitId) {
                ProductUnit::query()->findOrFail($unitId)->delete();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
    }

    public function deleteUnusedModificationsOrThrow(array $modificationIdsInRequest): void {
        try {
            DB::beginTransaction();
            $modificationIdsInDB = collect(ProductModification::getList())->pluck('id');
            $unusedModificationIds = $modificationIdsInDB->diff($modificationIdsInRequest)->all();
            foreach ($unusedModificationIds as $modificationId) {
                ProductModification::query()->findOrFail($modificationId)->delete();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
    }

}
