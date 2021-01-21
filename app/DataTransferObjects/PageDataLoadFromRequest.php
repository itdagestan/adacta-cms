<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class PageDataLoadFromRequest implements DataTransferObjectLoadFromRequest
{

    protected string $name;
    protected string $slug;
    protected string $html;
    protected bool $is_active;

    /**
     * @param string $name
     * @param string $slug
     * @param string $html
     * @param bool $is_active
     */
    public function __construct(
        string $name,
        string $slug,
        string $html,
        bool $is_active
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->html = $html;
        $this->is_active = $is_active;
    }

    /**
     * @param Request $request
     * @return PageDataLoadFromRequest
     */
    public static function loadFromRequest(Request $request): PageDataLoadFromRequest
    {
        return new self(
            $request['name'],
            $request['slug'],
            $request['html'],
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
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
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
