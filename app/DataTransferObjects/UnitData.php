<?php
namespace App\DataTransferObjects;

use App\Interfaces\DataTransferObject;
use Illuminate\Http\Request;

final class UnitData implements DataTransferObject
{

    private ?int $id;
    private int $count;
    private string $unitType;
    private float $price;

    /**
     * @param int|null $id
     * @param int $count
     * @param string $unitType
     * @param float $price
     */
    public function __construct(?int $id, int $count, string $unitType, float $price)
    {
        $this->id = $id;
        $this->count = $count;
        $this->unitType = $unitType;
        $this->price = $price;
    }

    public static function loadFromRequest(Request $request): void {}

    /**
     * @param array $request
     * @return UnitData
     */
    public static function loadFromArray(array $request): UnitData
    {
        $id = isset($request['id']) ? $request['id'] : null;
        return new self(
            $id,
            $request['count'],
            $request['unit_type'],
            $request['price']
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
    public function getCount(): string
    {
        return $this->count;
    }

    /**
     * @param string $count
     */
    public function setCount(string $count): void
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getUnitType(): string
    {
        return $this->unitType;
    }

    /**
     * @param string $unitType
     */
    public function setUnitType(string $unitType): void
    {
        $this->unitType = $unitType;
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
}
