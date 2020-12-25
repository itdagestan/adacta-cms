<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;

use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelsProductCategories = ProductCategory::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.product-category.index')->with('modelsProductCategories', $modelsProductCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create($request->all());
        return redirect()->route('admin.product-category.index')->with('success','Категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $modelProductCategory = ProductCategory::findOrFail($id);
        return view('admin.product-category.show', ['modelProductCategory' => $modelProductCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $modelProductCategory = ProductCategory::findOrFail($id);
        return view('admin.product-category.edit', ['modelProductCategory' => $modelProductCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProductCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductCategoryRequest $request, int $id)
    {
        $modelProductCategory = ProductCategory::findOrFail($id);
        $modelProductCategory->fill($request->validated());
        $modelProductCategory->update();
        return redirect()->route('admin.product-category.index')->with('success','Категория успешно создана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $modelProductCategory = ProductCategory::findOrFail($id);
        $modelProductCategory->delete();
        return redirect()->route('admin.product-category.index')->with('success','Post deleted successfully');
    }
}
