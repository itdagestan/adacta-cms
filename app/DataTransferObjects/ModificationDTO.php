<?php
namespace App\DataTransferObjects;

use App\Interfaces\DataTransferObjectLoadFromArray;
use App\Interfaces\DataTransferObjectLoadFromModel;
use App\Models\ProductModification;
use Illuminate\Database\Eloquent\Model;

final class ModificationDTO implements DataTransferObjectLoadFromArray, DataTransferObjectLoadFromModel
{

    protected ?int $id;
    protected ?string $name;
    protected ?float $price;
    protected ?string $priceType;

    public function __construct(?int $id, ?string $name, ?float $price, ?string $priceType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->priceType = $priceType;
    }

    public static function loadFromArray(array $array): ModificationDTO
    {
        return new self(
            $array['id'] ?? null,
            $array['name'],
            $array['price'],
            $array['price_type']
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getPriceType(): ?string
    {
        return $this->priceType;
    }

    public function setPriceType(?string $priceType): void
    {
        $this->priceType = $priceType;
    }

}
