<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductModification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use App\DataTransferObjects\UnitDTO;
use App\DataTransferObjects\ModificationDTO;
use App\DataTransferObjects\SingleProductDTO;
use App\EloquentProxies\ProductEloquentProxies;
use App\Http\Requests\StoreSingleProductRequest;
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
     * @param Request $request
     * @param string $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request, string $type)
    {
        $productDTO = SingleProductDTO::getEmptyDTO();
        if($request->old()) {
            $productDTO = SingleProductDTO::loadFromArray($request->old());
        }

        $unitDTOAsArray = [];
        if($request->old('product_unit')) {
            foreach ($request->old('product_unit') as $unit) {
                array_push($unitDTOAsArray, UnitDTO::loadFromArray($unit));
            }
        }

        $modificationDTOAsArray = [];
        if($request->old('product_modification')) {
            foreach ($request->old('product_modification') as $modification) {
                array_push($modificationDTOAsArray, ModificationDTO::loadFromArray($modification));
            }
        }

        return view('admin.product.create', [
            'type' => $type,
            'productDTO' => $productDTO,
            'unitDTOAsArray' => $unitDTOAsArray,
            'modificationDTOAsArray' => $modificationDTOAsArray,
            'modificationsPriceTypeEnum' => ProductModification::$PRICE_TYPE_ENUM,
            'modelsProductCategory' => $this->productCategoryEloquentProxies->all(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Request $request, int $id)
    {
        $modelProduct = $this->productEloquentProxies->getByIdOrFail($id);
        if($request->old()) {
            $productDTO = SingleProductDTO::loadFromArray($request->old());
            $productDTO->setId($modelProduct->id);
        } else {
            $productDTO = SingleProductDTO::loadFromModel($modelProduct);
        }

        $unitDTOAsArray = [];
        if($request->old('product_unit')) {
            foreach ($request->old('product_unit') as $unit) {
                array_push($unitDTOAsArray, UnitDTO::loadFromArray($unit));
            }
        } else {
            foreach ($modelProduct->units as $modelProductUnit) {
                array_push($unitDTOAsArray, UnitDTO::loadFromModel($modelProductUnit));
            }
        }

        $modificationDTOAsArray = [];
        if($request->old('product_modification')) {
            foreach ($request->old('product_modification') as $modification) {
                array_push($modificationDTOAsArray, ModificationDTO::loadFromArray($modification));
            }
        } else {
            foreach ($modelProduct->modifications as $modelProductModification) {
                array_push($modificationDTOAsArray, ModificationDTO::loadFromModel($modelProductModification));
            }
        }

        return view('admin.product.edit', [
            'type' => $modelProduct->type,
            'productDTO' => $productDTO,
            'unitDTOAsArray' => $unitDTOAsArray,
            'modificationDTOAsArray' => $modificationDTOAsArray,
            'modificationsPriceTypeEnum' => ProductModification::$PRICE_TYPE_ENUM,
            'modelsProductCategory' => $this->productCategoryEloquentProxies->all(),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('admin.product.show', [
            'modelProduct' => $this->productEloquentProxies->getByIdOrFail($id),
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
        $singleProductData = SingleProductDTO::loadFromRequest($request);
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
        $singleProductData = SingleProductDTO::loadFromRequest($request);
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
            $singleProductData = SingleProductDTO::loadFromRequest($request);
            $modelProduct = $productService->saveProductOrThrow(
                $modelProduct,
                Product::TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS,
                $singleProductData
            );
            if ($request->get('product_unit')) {
                foreach ($request->get('product_unit') as $productUnit) {
                    $unitData = UnitDTO::loadFromArray($productUnit);
                    $productService->saveUnitOrThrow($modelProduct, $unitData);
                }
            }
            if ($request->get('product_modification')) {
                foreach ($request->get('product_modification') as $productModification) {
                    $modificationData = ModificationDTO::loadFromArray($productModification);
                    $productService->saveModificationOrThrow($modelProduct, $modificationData);
                }
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
            $singleProductData = SingleProductDTO::loadFromRequest($request);
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
                $modificationData = ModificationDTO::loadFromArray($productModification);
                $productService->saveModificationOrThrow($modelProduct, $modificationData);
            }

            $productUnits = $request->get('product_unit') ?? [];
            $unitIdsInRequest = collect($productUnits)
                ->pluck('id')
                ->all();
            $productService->deleteUnusedUnitsOrThrow($unitIdsInRequest);
            foreach ($productUnits as $productUnit) {
                $unitData = UnitDTO::loadFromArray($productUnit);
                $productService->saveUnitOrThrow($modelProduct, $unitData);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
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
        StoreSingleProductRequest $request,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $productRedirectLinkData = SingleProductDTO::loadFromRequest($request);
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
        StoreSingleProductRequest $request,
        int $id,
        ProductService $productService
    ): \Illuminate\Http\RedirectResponse
    {
        $productRedirectLinkData = SingleProductDTO::loadFromRequest($request);
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
