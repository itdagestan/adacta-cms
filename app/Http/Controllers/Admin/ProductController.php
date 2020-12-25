<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use App\Traits\UploadThumbnailTrait;
use App\DataTransferObjects\UnitData;
use App\DataTransferObjects\ModificationData;
use App\DataTransferObjects\SingleProductData;
use App\Http\Requests\StoreSingleProductRequest;
use App\Http\Requests\StoreProductWithModificationsAndUnitsRequest;

class ProductController extends Controller
{
    use UploadThumbnailTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $modelsProduct = Product::orderBy('id', 'desc')
            ->paginate(50);
        return view('admin.product.index', [
            'modelsProduct' => $modelsProduct
        ]);
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(string $type)
    {
        $modelProduct = new Product();
        $modelsProductCategory = ProductCategory::orderBy('id')->get();
        return view('admin.product.create', [
            'modelProduct' => $modelProduct,
            'modelsProductCategory' => $modelsProductCategory,
            'type' => $type
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        /** @var Product $modelProduct */
        $modelProduct = Product::query()->findOrFail($id);
        $modelsProductCategory = ProductCategory::query()->orderBy('id')->get();
        return view('admin.product.edit', [
            'modelProduct' => $modelProduct,
            'modelsProductCategory' => $modelsProductCategory,
            'type' => $modelProduct->type,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $modelProduct = Product::query()->findOrFail($id);
        return view('admin.product.show', [
            'modelProduct' => $modelProduct,
        ]);
    }

    /**
     * @param StoreSingleProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSingleProduct(
        StoreSingleProductRequest $request,
        ProductService $productService
    )
    {
        $singleProductData = SingleProductData::loadFromRequest($request);
        $modelProduct = new Product();
        $productService->saveProduct(
            $modelProduct,
            Product::TYPE_SINGLE_PRODUCT,
            $singleProductData
        );
        return redirect()
            ->route('admin.product.index')
            ->with('success','Категория успешно создана');
    }

    /**
     * @param StoreSingleProductRequest $request
     * @param int $id
     * @param ProductService $productService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSingleProduct(
        StoreSingleProductRequest $request,
        int $id,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $singleProductData = SingleProductData::loadFromRequest($request);
        $modelProduct = Product::query()->findOrFail($id);
        $productService->saveProduct(
            $modelProduct,
            Product::TYPE_SINGLE_PRODUCT,
            $singleProductData
        );
        return redirect()
            ->route('admin.product.index')
            ->with('success','Товар успешно изменен');
    }

    /**
     * @param StoreProductWithModificationsAndUnitsRequest $request
     * @param ProductService $productService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProductWithModificationsAndUnits(
        StoreProductWithModificationsAndUnitsRequest $request,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $modelProduct = new Product();
            $singleProductData = SingleProductData::loadFromRequest($request);
            $modelProduct = $productService->saveProduct(
                $modelProduct,
                Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                $singleProductData
            );
            foreach ($request->get('product_modification') as $productModification) {
                $modificationData = ModificationData::loadFromArray($productModification);
                $productService->saveModification($modelProduct, $modificationData);
            }
            foreach ($request->get('product_unit') as $productUnit) {
                $unitData = UnitData::loadFromArray($productUnit);
                $productService->saveUnit($modelProduct, $unitData);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
        return redirect()->route('admin.product.index')->with('success','Категория успешно создана');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProductWithModificationsAndUnitsRequest $request
     * @param int $id
     * @param ProductService $productService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProductWithModificationsAndUnits(
        StoreProductWithModificationsAndUnitsRequest $request,
        int $id,
        ProductService $productService
    )
    {
        try {
            DB::beginTransaction();
            $modelProduct = Product::query()->findOrFail($id);
            $singleProductData = SingleProductData::loadFromRequest($request);
            $modelProduct = $productService->saveProduct(
                $modelProduct,
                Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                $singleProductData
            );
            foreach ($request->get('product_modification') as $productModification) {
                $modificationData = ModificationData::loadFromArray($productModification);
                $productService->saveModification($modelProduct, $modificationData);
            }
            foreach ($request->get('product_unit') as $productUnit) {
                $unitData = UnitData::loadFromArray($productUnit);
                $productService->saveUnit($modelProduct, $unitData);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception();
        }
        return redirect()
            ->route('admin.product.index')
            ->with('success','Товар успешно изменен');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $modelProduct = Product::query()->findOrFail($id);
        $modelProduct->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success','Post deleted successfully');
    }
}
