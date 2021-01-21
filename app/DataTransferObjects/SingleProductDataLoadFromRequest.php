<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class SingleProductDataLoadFromRequest implements DataTransferObjectLoadFromRequest
{

    protected string $name;
    protected string $slug;
    protected float $price_old;
    protected float $price_new;
    protected int $category_id;
    protected ?string $description;
    protected bool $is_active;
    protected ?UploadedFile $thumbnail;
    protected ?string $link;

    public function __construct(
        string $name,
        string $slug,
        float $price_old,
        float $price_new,
        int $category_id,
        ?string $description,
        bool $is_active,
        ?UploadedFile $thumbnail,
        ?string $link
    )
    {
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

    /**
     * @param Request $request
     * @return SingleProductDataLoadFromRequest
     */
    public static function loadFromRequest(Request $request): SingleProductDataLoadFromRequest
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getPriceOld(): float
    {
        return $this->price_old;
    }

    public function setPriceOld(float $price_old): void
    {
        $this->price_old = $price_old;
    }

    public function getPriceNew(): float
    {
        return $this->price_new;
    }

    public function setPriceNew(float $price_new): void
    {
        $this->price_new = $price_new;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
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

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): void
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
