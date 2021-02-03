<?php


namespace App\Services;

use App\Models\Page;
use App\DataTransferObjects\PageDTO;

final class PageService
{

    /**
     * @param Page $modelPage
     * @param PageDTO $pageData
     * @return void
     * @throws \Exception
     */
    public function savePage(
        Page $modelPage,
        PageDTO $pageData
    ): void
    {
        $modelPage->name = $pageData->getName();
        $modelPage->slug = $pageData->getSlug();
        $modelPage->html = $pageData->getHtml();
        $modelPage->is_active = $pageData->getIsActive();
        if (!$modelPage->save()) {
            throw new \Exception();
        }
    }

}
