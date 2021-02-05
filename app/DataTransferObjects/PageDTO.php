<?php
namespace App\DataTransferObjects;

use App\Interfaces\DataTransferObjectLoadFromArray;
use App\Interfaces\DataTransferObjectLoadFromModel;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Interfaces\DataTransferObjectLoadFromRequest;

class PageDTO implements DataTransferObjectLoadFromRequest, DataTransferObjectLoadFromArray, DataTransferObjectLoadFromModel
{

    protected ?int $id;
    protected ?string $name;
    protected ?string $slug;
    protected ?string $html;
    protected ?bool $is_active;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $slug
     * @param string|null $html
     * @param bool $is_active
     */
    public function __construct(
        ?int $id,
        ?string $name,
        ?string $slug,
        ?string $html,
        ?bool $is_active
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->html = $html;
        $this->is_active = $is_active;
    }

    public static function getEmptyDTO(): PageDTO
    {
        return new self(
            null,
            null,
            null,
            null,
            null
        );
    }

    /**
     * @param Request $request
     * @return PageDTO
     */
    public static function loadFromRequest(Request $request): PageDTO
    {
        return new self(
            $request['id'] ?? null,
            $request['name'],
            $request['slug'],
            $request['html'],
            (bool)$request['is_active'],
        );
    }

    /**
     * @param Page $modelPage
     * @return PageDTO
     */
    public static function loadFromModel(Model $modelPage): PageDTO
    {
        return new self(
            $modelPage->id,
            $modelPage->name,
            $modelPage->slug,
            $modelPage->html,
            $modelPage->is_active,
        );
    }

    /**
     * @param array $array
     * @return PageDTO
     */
    public static function loadFromArray(array $array): PageDTO
    {
        return new self(
            $array['id'] ?? null,
            $array['name'],
            $array['slug'],
            $array['html'],
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
     * @return string
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }

    /**
     * @param string|null $html
     */
    public function setHtml(?string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return bool
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool|null $is_active
     */
    public function setIsActive(?bool $is_active): void
    {
        $this->is_active = $is_active;
    }
}
