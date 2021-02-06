<?php
namespace App\DataTransferObjects;

use App\Interfaces\DataTransferObjectLoadFromArray;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Interfaces\DataTransferObjectLoadFromModel;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class SingleProductDTO implements DataTransferObjectLoadFromRequest, DataTransferObjectLoadFromModel, DataTransferObjectLoadFromArray
{

    protected ?int $id;
    protected ?string $name;
    protected ?string $slug;
    protected ?float $price_old;
    protected ?float $price_new;
    protected ?int $category_id;
    protected ?string $description;
    protected ?bool $is_active;
    protected ?UploadedFile $thumbnail;
    protected ?string $link;

    private function __construct(
        ?int $id,
        ?string $name,
        ?string $slug,
        ?float $price_old,
        ?float $price_new,
        ?int $category_id,
        ?string $description,
        ?bool $is_active,
        ?UploadedFile $thumbnail,
        ?string $link
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->price_old = $price_old;
        $this->price_new = $price_new;
        $this->category_id = $category_id;
        $this->description = $description;
        $this->is_active = $is_active;
        $this->thumbnail = $thumbnail;
        $this->link = $link;
    }

    public static function getEmptyDTO(): SingleProductDTO
    {
        return new self(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }

    /**
     * @param Request $request
     * @return SingleProductDTO
     */
    public static function loadFromRequest(Request $request): SingleProductDTO
    {
        return new self(
            $request['id'] ?? null,
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

    /**
     * @param Product $modelProduct
     * @return SingleProductDTO
     */
    public static function loadFromModel(Model $modelProduct): SingleProductDTO
    {
        return new self(
            $modelProduct->id,
            $modelProduct->name,
            $modelProduct->slug,
            $modelProduct->price_old,
            $modelProduct->price_new,
            $modelProduct->category_id,
            $modelProduct->description,
            $modelProduct->is_active,
            null,
            $modelProduct->link,
        );
    }

    /**
     * @param array $array
     * @return SingleProductDTO
     */
    public static function loadFromArray(array $array): SingleProductDTO
    {
        return new self(
            $array['id'] ?? null,
            $array['name'],
            $array['slug'],
            $array['price_old'],
            $array['price_new'],
            $array['category_id'],
            $array['description'],
            $array['is_active'] ?? null,
            null,
            $array['link'] ?? null,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getPriceOld(): ?float
    {
        return $this->price_old;
    }

    public function setPriceOld(?float $price_old): void
    {
        $this->price_old = $price_old;
    }

    public function getPriceNew(): ?float
    {
        return $this->price_new;
    }

    public function setPriceNew(?float $price_new): void
    {
        $this->price_new = $price_new;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    public function getThumbnail(): ?UploadedFile
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?UploadedFile $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): void
    {
        $this->link = $link;
    }
}
