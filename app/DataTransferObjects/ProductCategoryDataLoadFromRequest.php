<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class ProductCategoryDataLoadFromRequest implements DataTransferObjectLoadFromRequest
{

    protected string $name;
    protected string $slug;
    protected bool $is_active;

    /**
     * @param string $name
     * @param string $slug
     * @param bool $is_active
     */
    public function __construct(
        string $name,
        string $slug,
        bool $is_active
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->is_active = $is_active;
    }

    /**
     * @param Request $request
     * @return ProductCategoryDataLoadFromRequest
     */
    public static function loadFromRequest(Request $request): ProductCategoryDataLoadFromRequest
    {
        return new self(
            $request['name'],
            $request['slug'],
            (bool)$request['is_active'],
        );
    }

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
}
