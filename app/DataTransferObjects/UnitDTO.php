<?php
namespace App\DataTransferObjects;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\DataTransferObjectLoadFromModel;

use App\Models\ProductUnit;
use App\Interfaces\DataTransferObjectLoadFromArray;

final class UnitDTO implements DataTransferObjectLoadFromArray, DataTransferObjectLoadFromModel
{

    protected ?int $id;
    protected ?int $count;
    protected ?string $unitType;
    protected ?float $price;

    public function __construct(?int $id, int $count, string $unitType, float $price)
    {
        $this->id = $id;
        $this->count = $count;
        $this->unitType = $unitType;
        $this->price = $price;
    }

    public static function loadFromArray(array $array): UnitDTO
    {
        return new self(
            $array['id'] ?? null,
            $array['count'],
            $array['unit_type'],
            $array['price']
        );
    }

    /**
     * @param ProductUnit $modelProductUnit
     * @return UnitDTO
     */
    public static function loadFromModel(Model $modelProductUnit): UnitDTO
    {
        return new self(
            $modelProductUnit->id,
            $modelProductUnit->count,
            $modelProductUnit->unit_type,
            $modelProductUnit->price
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

    public function getCount(): string
    {
        return $this->count;
    }

    public function setCount(?string $count): void
    {
        $this->count = $count;
    }

    public function getUnitType(): ?string
    {
        return $this->unitType;
    }

    public function setUnitType(?string $unitType): void
    {
        $this->unitType = $unitType;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
}
