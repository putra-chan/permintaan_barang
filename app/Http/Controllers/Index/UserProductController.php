<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class UserProductController extends Controller
{
    public function store(Request $request){
      $request= Product::where('id', $request->id)->first();
      $request->name = $request->name;
      $request->product = $request->product;
      $product->save();
      return response()
        ->json(['status' => true, 'description' => 'Data Success']);
    }
}
