<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ProductUnit
 *
 * @property int $id
 * @property int $product_id Товар
 * @property int $count Количество
 * @property string $unit_type Единица изменерения
 * @property string $price Цена
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductUnit extends Model
{
    use HasFactory;

    public $fillable = ['count', 'unit_type', 'price'];

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
