<?php
namespace App\DataTransferObjects;

use App\Interfaces\DataTransferObjectLoadFromArray;
use App\Interfaces\DataTransferObjectLoadFromModel;
use App\Models\ProductModification;
use Illuminate\Database\Eloquent\Model;

final class ModificationDTO implements DataTransferObjectLoadFromArray, DataTransferObjectLoadFromModel
{

    private ?int $id;
    private string $name;
    private float $price;
    private string $priceType;

    /**
     * @param int|null $id
     * @param string $name
     * @param float $price
     * @param string $priceType
     */
    public function __construct(?int $id, string $name, float $price, string $priceType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->priceType = $priceType;
    }

    /**
     * @param array $request
     * @return ModificationDTO
     */
    public static function loadFromArray(array $request): ModificationDTO
    {
        $id = isset($request['id']) ? $request['id'] : null;
        return new self(
            $id,
            $request['name'],
            $request['price'],
            $request['price_type']
        );
    }

    /**
     * @param ProductModification $modelProductModification
     * @return ModificationDTO
     */
    public static function loadFromModel(Model $modelProductModification): ModificationDTO
    {
        return new self(
            $modelProductModification->id,
            $modelProductModification->name,
            $modelProductModification->price,
            $modelProductModification->price_type
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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPriceType(): string
    {
        return $this->priceType;
    }

    /**
     * @param string $priceType
     */
    public function setPriceType(string $priceType): void
    {
        $this->priceType = $priceType;
    }

}
