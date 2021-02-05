<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductCategory;
use App\Interfaces\DataTransferObjectLoadFromArray;
use App\Interfaces\DataTransferObjectLoadFromModel;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class ProductCategoryDTO implements DataTransferObjectLoadFromRequest, DataTransferObjectLoadFromModel, DataTransferObjectLoadFromArray
{

    protected ?int $id;
    protected ?string $name;
    protected ?string $slug;
    protected ?bool $is_active;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $slug
     * @param bool $is_active
     */
    public function __construct(
        ?int $id,
        ?string $name,
        ?string $slug,
        ?bool $is_active
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->is_active = $is_active;
    }

    public static function getEmptyDTO(): ProductCategoryDTO
    {
        return new self(
            null,
            null,
            null,
            null
        );
    }

    /**
     * @param Request $request
     * @return ProductCategoryDTO
     */
    public static function loadFromRequest(Request $request): ProductCategoryDTO
    {
        return new self(
            $request['id'] ?? null,
            $request['name'],
            $request['slug'],
            (bool)$request['is_active'],
        );
    }

    /**
     * @param ProductCategory $modelProductCategory
     * @return ProductCategoryDTO
     */
    public static function loadFromModel(Model $modelProductCategory): ProductCategoryDTO
    {
        return new self(
            $modelProductCategory->id,
            $modelProductCategory->name,
            $modelProductCategory->slug,
            $modelProductCategory->is_active,
        );
    }

    /**
     * @param array $array
     * @return ProductCategoryDTO
     */
    public static function loadFromArray(array $array): ProductCategoryDTO
    {
        return new self(
            $array['id'] ?? null,
            $array['name'],
            $array['slug'],
            (bool)$array['is_active'],
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return bool
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }
}
