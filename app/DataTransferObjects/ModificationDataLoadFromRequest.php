<?php
namespace App\DataTransferObjects;

use Illuminate\Http\Request;

use App\Interfaces\DataTransferObjectLoadFromArray;

final class ModificationDataLoadFromRequest implements DataTransferObjectLoadFromArray
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
     * @return ModificationDataLoadFromRequest
     */
    public static function loadFromArray(array $request): ModificationDataLoadFromRequest
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
