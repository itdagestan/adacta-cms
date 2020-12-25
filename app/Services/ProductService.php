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

    public function saveProduct(
        Product $modelProduct,
        string $productType,
        SingleProductData $productData
    ): Product {
        try {
            DB::beginTransaction();
            $fileUploadService = new FileUploadService();
            $modelProduct->name = $productData->getName();
            $modelProduct->slug = $productData->getSlug();
            $modelProduct->price_old = $productData->getPriceOld();
            $modelProduct->price_new = $productData->getPriceNew();
            $modelProduct->category_id = $productData->getCategoryId();
            $modelProduct->description = $productData->getDescription();
            $modelProduct->is_active = $productData->getIsActive();
            $modelProduct->type = $productType;
            if ($productData->getThumbnail() !== null) {
                $fileUploadService->uploadOneThumbnail($productData->getThumbnail());
                $modelProduct->thumbnail_path = $fileUploadService->filenameWithExtension;
            }
            if (!$modelProduct->save()) {
                throw new \Exception();
            }
            DB::commit();
            return $modelProduct;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
    }

    /**
     * @param Product $modelProduct
     * @param ModificationData $modificationData
     * @return ProductModification
     * @throws \Exception
     */
    public function saveModification(
        Product $modelProduct,
        ModificationData $modificationData
    ): ProductModification {
        try {
            DB::beginTransaction();
            $modelProductModification = new ProductModification();
            $modelProductModification->product_id = $modelProduct->id;
            if ($modificationData->getId() !== null) {
                $modelProductModification = ProductModification::query()->findOrFail($modificationData->getId());
            }
            $modelProductModification->name = $modificationData->getName();
            $modelProductModification->price = $modificationData->getPrice();
            $modelProductModification->price_type = $modificationData->getPriceType();
            if (!$modelProductModification->save()) {
                throw new \Exception();
            }
            DB::commit();
            return $modelProductModification;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
    }

    /**
     * @param Product $modelProduct
     * @param UnitData $unitData
     * @return ProductUnit
     * @throws \Exception
     */
    public function saveUnit(
        Product $modelProduct,
        UnitData $unitData
    ): ProductUnit {
        try {
            DB::beginTransaction();
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
            DB::commit();
            return $modelProductUnit;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
    }

    /**
     * @param array $unitIdsInRequest
     * @throws \Exception
     */
    public function deleteUnusedUnits(array $unitIdsInRequest): void {
        try {
            DB::beginTransaction();
            $unitIdsInDB = collect(ProductUnit::getList());
            $unitIdsInDB = $unitIdsInDB->pluck('id');
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

    /**
     * @param array $modificationIdsInRequest
     * @throws \Exception
     */
    public function deleteUnusedModifications(array $modificationIdsInRequest): void {
        try {
            DB::beginTransaction();
            $modificationIdsInDB = collect(ProductModification::getList());
            $modificationIdsInDB = $modificationIdsInDB->pluck('id');
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
