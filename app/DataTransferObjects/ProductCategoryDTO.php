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
    protected ?int $parent_id;
    protected ?bool $is_active;

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $slug,
        ?int $parent_id,
        ?bool $is_active
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->parent_id = $parent_id;
        $this->is_active = $is_active;
    }

    public static function getEmptyDTO(): ProductCategoryDTO
    {
        return new self(
            null,
            null,
            null,
            null,
            null
        );
    }

    public static function loadFromRequest(Request $request): ProductCategoryDTO
    {
        return new self(
            $request['id'] ?? null,
            $request['name'],
            $request['slug'],
            $request['parent_id'],
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
            $modelProductCategory->parent_id,
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
            $array['parent_id'],
            (bool)$array['is_active'],
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

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(?int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }
}
