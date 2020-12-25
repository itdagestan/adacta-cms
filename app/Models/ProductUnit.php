<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
