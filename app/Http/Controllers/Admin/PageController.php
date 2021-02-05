<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Services\PageService;
use App\DataTransferObjects\PageDTO;
use App\Http\Requests\StorePageRequest;
use App\EloquentProxies\PageEloquentProxies;
use Illuminate\Http\Request;

class PageController extends Controller
{

    private PageEloquentProxies $pageEloquentProxies;

    public function __construct(PageEloquentProxies $pageEloquentProxies)
    {
        $this->pageEloquentProxies = $pageEloquentProxies;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $perPage = 50;
        $modelsPage = $this->pageEloquentProxies->allWithPaginate($perPage);
        return view('admin.page.index')->with('modelsPage', $modelsPage);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $pageDTO = PageDTO::getEmptyDTO();
        if($request->old()) {
            $pageDTO = PageDTO::loadFromArray($request->old());
        }
        return view('admin.page.create', [
            'pageDTO' => $pageDTO,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Request $request, int $id)
    {
        $modelPage = $this->pageEloquentProxies->getByIdOrFail($id);
        if($request->old()) {
            $pageDTO = PageDTO::loadFromArray($request->old());
            $pageDTO->setId($modelPage->id);
        } else {
            $pageDTO = PageDTO::loadFromModel($modelPage);
        }
        return view('admin.page.edit', [
            'pageDTO' => $pageDTO,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $modelPage = $this->pageEloquentProxies->getByIdOrFail($id);
        return view('admin.page.show', ['modelPage' => $modelPage]);
    }

    /**
     * @param StorePageRequest $request
     * @param PageService $pageService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(
        StorePageRequest $request,
        PageService $pageService
    )
    {
        $pageData = PageDTO::loadFromRequest($request);
        $modelPage = new Page();
        $pageService->savePage(
            $modelPage,
            $pageData
        );
        return redirect()->route('admin.page.index')->with('success','Категория успешно создана');
    }

    /**
     * @param int $id
     * @param StorePageRequest $request
     * @param PageService $pageService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(
        int $id,
        StorePageRequest $request,
        PageService $pageService
    )
    {
        $pageData = PageDTO::loadFromRequest($request);
        $modelPage = $this->pageEloquentProxies->getByIdOrFail($id);
        $pageService->savePage(
            $modelPage,
            $pageData
        );
        return redirect()->route('admin.page.index')->with('success','Категория успешно создана');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $modelPage = $this->pageEloquentProxies->getByIdOrFail($id);
        $modelPage->delete();
        return redirect()->route('admin.page.index')->with('success','Post deleted successfully');
    }
}
