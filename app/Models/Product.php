<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name Название
 * @property string $slug ЧПУ
 * @property string|null $price_old Старая цена
 * @property string|null $price_new Новая цена
 * @property int $category_id Категория
 * @property string|null $description Описание
 * @property string|null $thumbnail_path Путь к превью
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool $is_active Показывать на сайте
 * @property string $type Тип товара
 * @property string|null $link Редирект ссылка
 * @property-read mixed $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePriceNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePriceOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnailPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedBy($value)
 * @property-read \App\Models\ProductCategory $category
 * @property-read \App\Models\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductModification[] $modifications
 * @property-read int|null $modifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductUnit[] $units
 * @property-read int|null $units_count
 * @property-read \App\Models\User $updatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 */
class Product extends Model
{
    use HasFactory;

    const TYPE_SINGLE_PRODUCT = 'Одиночный товар';
    const TYPE_PRODUCT_WITH_MODIFICATIONS_AND_UNITS = 'Товар с модификациями и тиражами';
    const TYPE_PRODUCT_REDIRECT_LINK = 'Редирект ссылка';

    protected $fillable = ['name', 'slug', 'price_old', 'price_new', 'category_id', 'price_old',
        'price_old', 'thumbnail_path', 'is_active', 'type', 'link'];

    protected $guarded = [];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $currentUserId = Auth::id();
            $model->created_by = $currentUserId;
            $model->updated_by = $currentUserId;
        });
        self::updating(function($model){
            $currentUserId = Auth::id();
            $model->updated_by = $currentUserId;
        });
    }

    public function getThumbnailAttribute()
    {
        return $this->thumbnail_file;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function units()
    {
        return $this->hasMany('App\Models\ProductUnit', 'product_id');
    }

    public function modifications()
    {
        return $this->hasMany('App\Models\ProductModification', 'product_id');
    }

}
