<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface DataTransferObjectLoadFromRequest
{
    public static function loadFromRequest(Request $request);
}
