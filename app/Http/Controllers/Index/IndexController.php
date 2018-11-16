<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;

class IndexController extends Controller
{
    public function index(){
      $products = Product::where('is_deleted', 0)->paginate(12);
      return view('user.home', compact('products'));
    }
}
