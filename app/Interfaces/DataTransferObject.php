<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface DataTransferObject
{
    public static function loadFromRequest(Request $request);

    public static function loadFromArray(array $request);
}
