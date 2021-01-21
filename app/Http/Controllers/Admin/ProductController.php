<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use App\DataTransferObjects\UnitDataLoadFromRequest;
use App\DataTransferObjects\ModificationDataLoadFromRequest;
use App\DataTransferObjects\SingleProductDataLoadFromRequest;
use App\EloquentProxies\ProductEloquentProxies;
use App\Http\Requests\StoreSingleProductRequest;
use App\Http\Requests\StoreProductRedirectLinkRequest;
use App\EloquentProxies\ProductCategoryEloquentProxies;
use App\Http\Requests\StoreProductWithModificationsAndUnitsRequest;

class ProductController extends Controller
{

    private ProductEloquentProxies $productEloquentProxies;
    private ProductCategoryEloquentProxies $productCategoryEloquentProxies;

    public function __construct(
        ProductEloquentProxies $productRepository,
        ProductCategoryEloquentProxies $productCategoryEloquentProxies
    )
    {
        $this->productEloquentProxies = $productRepository;
        $this->productCategoryEloquentProxies = $productCategoryEloquentProxies;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $perPage = 50;
        $modelsProduct = $this->productEloquentProxies->allWithPaginate($perPage);
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
        $modelsProductCategory = $this->productCategoryEloquentProxies->all();
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
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
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
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
        return view('admin.product.show', [
            'modelProduct' => $modelProduct,
        ]);
    }

    /**
     * @param StoreSingleProductRequest $request
     * @param ProductService $productService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function storeSingleProduct(
        StoreSingleProductRequest $request,
        ProductService $productService
    )
    {
        $singleProductData = SingleProductDataLoadFromRequest::loadFromRequest($request);
        $modelProduct = new Product();
        $productService->saveProductOrThrow(
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
     * @throws \Exception
     */
    public function updateSingleProduct(
        StoreSingleProductRequest $request,
        int $id,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $singleProductData = SingleProductDataLoadFromRequest::loadFromRequest($request);
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
        $productService->saveProductOrThrow(
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
            $singleProductData = SingleProductDataLoadFromRequest::loadFromRequest($request);
            $modelProduct = $productService->saveProductOrThrow(
                $modelProduct,
                Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                $singleProductData
            );
            foreach ($request->get('product_modification') as $productModification) {
                $modificationData = ModificationDataLoadFromRequest::loadFromArray($productModification);
                $productService->saveModificationOrThrow($modelProduct, $modificationData);
            }
            foreach ($request->get('product_unit') as $productUnit) {
                $unitData = UnitDataLoadFromRequest::loadFromArray($productUnit);
                $productService->saveUnitOrThrow($modelProduct, $unitData);
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
            $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
            $singleProductData = SingleProductDataLoadFromRequest::loadFromRequest($request);
            $modelProduct = $productService->saveProductOrThrow(
                $modelProduct,
                Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                $singleProductData
            );

            $productModifications = $request->get('product_modification') ?? [];
            $modificationIdsInRequest = collect($productModifications)
                ->pluck('id')
                ->all();
            $productService->deleteUnusedModificationsOrThrow($modificationIdsInRequest);
            foreach ($productModifications as $productModification) {
                $modificationData = ModificationDataLoadFromRequest::loadFromArray($productModification);
                $productService->saveModificationOrThrow($modelProduct, $modificationData);
            }

            $productUnits = $request->get('product_unit') ?? [];
            $unitIdsInRequest = collect($productUnits)
                ->pluck('id')
                ->all();
            $productService->deleteUnusedUnitsOrThrow($unitIdsInRequest);
            foreach ($productUnits as $productUnit) {
                $unitData = UnitDataLoadFromRequest::loadFromArray($productUnit);
                $productService->saveUnitOrThrow($modelProduct, $unitData);
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
     * @param StoreSingleProductRequest $request
     * @param ProductService $productService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function storeProductRedirectLink(
        StoreProductRedirectLinkRequest $request,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $productRedirectLinkData = SingleProductDataLoadFromRequest::loadFromRequest($request);
        $modelProduct = new Product();
        $productService->saveProductOrThrow(
            $modelProduct,
            Product::TYPE_PRODUCT_REDIRECT_LINK,
            $productRedirectLinkData
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
     * @throws \Exception
     */
    public function updateProductRedirectLink(
        StoreProductRedirectLinkRequest $request,
        int $id,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $productRedirectLinkData = SingleProductDataLoadFromRequest::loadFromRequest($request);
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
        $productService->saveProductOrThrow(
            $modelProduct,
            Product::TYPE_PRODUCT_REDIRECT_LINK,
            $productRedirectLinkData
        );
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
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
        $modelProduct->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success','Post deleted successfully');
    }
}
