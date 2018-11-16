<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::where('is_deleted', 0)->paginate(12);
      return view('user.home', compact('products'));
    }

    public function store(Request $request, Cart $cart)
    {
        $product = Product::where('id', $request->id)->first();

        $cart->add([
          'id' => $product->id,
          'name' => $product->name,
          'qty' => 1,
          'price' => 0
        ]);

        return response()
                ->json(['status' => true, 'description' => 'success']);
    }

    public function fetch(Cart $cart)
    {
        $c = $cart->content();

        if ($cart->count() == 0) {
          $html = "";
        }
        else {
          $i = 1;
          $html = "<table class='striped mt10'>";
          $html .= "<thead>";
          $html .= "<th>No</th>";
          $html .= "<th>Item</th>";
          $html .= "<th>Qty</th>";
          $html .= "</thead>";
          $html .= "<tbody>";
          foreach ($c as $key) {
            $html .= "<tr>";
            $html .= "<td>";
            $html .= $i;
            $html .= "</td>";
            $html .= "<td>";
            $html .= $key->name;
            $html .= "</td>";
            $html .= "<td>";
            $html .= $key->qty;
            $html .= "</td>";
            $html .= "</tr>";
            $i++;
          }
          $html .= "</tbody>";
          $html .= "</table>";

          return $html;
        }
    }
    public function pr_home(){
      return view('pr.pr_home');
    }
}
