<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface DataTransferObjectLoadFromModel
{
    public static function loadFromModel(Model $model);
}
