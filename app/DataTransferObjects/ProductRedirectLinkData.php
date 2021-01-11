<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Interfaces\DataTransferObject;

class ProductRedirectLinkData extends SingleProductData implements DataTransferObject
{

    protected string $link;

    /**
     * @param string $name
     * @param string $slug
     * @param float $price_old
     * @param float $price_new
     * @param int $category_id
     * @param string|null $description
     * @param bool $is_active
     * @param UploadedFile|null $thumbnail
     * @param string $link
     */
    public function __construct(
        string $name,
        string $slug,
        float $price_old,
        float $price_new,
        int $category_id,
        ?string $description,
        bool $is_active,
        ?UploadedFile $thumbnail,
        string $link
    )
    {
        parent::__construct(
            $name,
            $slug,
            $price_old,
            $price_new,
            $category_id,
            $description,
            $is_active,
            $thumbnail
        );
        $this->link = $link;
    }

    /**
     * @param Request $request
     * @return ProductRedirectLinkData
     */
    public static function loadFromRequest(Request $request): ProductRedirectLinkData
    {
        return new self(
            $request['name'],
            $request['slug'],
            $request['price_old'],
            $request['price_new'],
            $request['category_id'],
            $request['description'],
            (bool)$request['is_active'],
            $request->file('thumbnail_file'),
            $request['link'],
        );
    }

    public static function loadFromArray(array $request): void {}

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}
