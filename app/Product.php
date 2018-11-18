<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function takeOne($id)
    {
        return Product::where('id', $id)->first();
    }
}
