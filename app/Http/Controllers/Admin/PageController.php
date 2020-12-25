<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelsPage = Page::orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.page.index')->with('modelsPage', $modelsPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        Page::create($request->all());
        return redirect()->route('admin.page.index')->with('success','Категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $modelPage = Page::findOrFail($id);
        return view('admin.page.show', ['modelPage' => $modelPage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $modelPage = Page::findOrFail($id);
        return view('admin.page.edit', ['modelPage' => $modelPage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StorePageRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePageRequest $request, int $id)
    {
        $modelPage = Page::findOrFail($id);
        $modelPage->fill($request->validated());
        $modelPage->update();
        return redirect()->route('admin.page.index')->with('success','Категория успешно создана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $modelPage = Page::findOrFail($id);
        $modelPage->delete();
        return redirect()->route('admin.page.index')->with('success','Post deleted successfully');
    }
}
