<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductModification
 *
 * @property int $id
 * @property int $product_id Товар
 * @property string $name Название
 * @property string $price Цена
 * @property string $price_type Тип подсчета стоимости
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductModification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductModification extends Model
{
    use HasFactory;

    public $fillable = ['name', 'price', 'price_type'];

    const PRICE_TYPE_ONE = 'Цена за количество товара + цена за модификацию';
    const PRICE_TYPE_TWO = 'Цена товара + цена модификации';

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getList() {
        return static::query()->get();
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
