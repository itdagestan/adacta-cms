<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Interfaces\DataTransferObject;

class SingleProductData implements DataTransferObject
{

    protected string $name;
    protected string $slug;
    protected float $price_old;
    protected float $price_new;
    protected int $category_id;
    protected ?string $description;
    protected bool $is_active;
    protected ?UploadedFile $thumbnail;

    /**
     * @param string $name
     * @param string $slug
     * @param float $price_old
     * @param float $price_new
     * @param int $category_id
     * @param string $description
     * @param bool $is_active
     * @param UploadedFile|null $thumbnail
     */
    public function __construct(
        string $name,
        string $slug,
        float $price_old,
        float $price_new,
        int $category_id,
        ?string $description,
        bool $is_active,
        ?UploadedFile $thumbnail
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
    }

    /**
     * @param Request $request
     * @return SingleProductData
     */
    public static function loadFromRequest(Request $request): SingleProductData
    {
        return new self(
            $request['name'],
            $request['slug'],
            $request['price_old'],
            $request['price_new'],
            $request['category_id'],
            $request['description'],
            (bool)$request['is_active'],
            $request->file('thumbnail_file')
        );
    }

    public static function loadFromArray(array $request): void {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return float
     */
    public function getPriceOld(): float
    {
        return $this->price_old;
    }

    /**
     * @param float $price_old
     */
    public function setPriceOld(float $price_old): void
    {
        $this->price_old = $price_old;
    }

    /**
     * @return float
     */
    public function getPriceNew(): float
    {
        return $this->price_new;
    }

    /**
     * @param float $price_new
     */
    public function setPriceNew(float $price_new): void
    {
        $this->price_new = $price_new;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    /**
     * @return UploadedFile|null
     */
    public function getThumbnail(): ?UploadedFile
    {
        return $this->thumbnail;
    }

    /**
     * @param UploadedFile|null $thumbnail
     */
    public function setThumbnail(?UploadedFile $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }
}
