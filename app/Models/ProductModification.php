<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
