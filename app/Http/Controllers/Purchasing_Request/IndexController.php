<?php

namespace App\Http\Controllers\Purchasing_Request;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Cart;
use App\Product;
use App\PurchasingRequest;
use DB;

class IndexController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function store(Request $request, Cart $cart){
      try {
        $checkPR  = PurchasingRequest::select(DB::raw('MAX(substr(pr_code, 4,5)) as jum'))->get();
        $nomor    = $checkPR[0]->jum+=1;
        $prcode   = "PR-".str_pad($nomor,5,"0", STR_PAD_LEFT);
        $c = $cart->content();

        foreach ($c as $crt) {
          $pr = new PurchasingRequest;
          $pr->pr_code = $prcode;
          $pr->user_id = Auth::id();
          $pr->product_id = $crt->id;
          $pr->quantity = $crt->qty;
          $pr->save();
        }


        return response()
                      ->json(['status' => true, 'description' => 'Success']);

      } catch (\Exception $e) {
        return response()
                      ->json(['status' => false, 'description' => $e->getMessage()]);
      }

    }
    public function pr(Request $request)
    {
      if ($request->ajax()) {
        $purchasingrequest = PurchasingRequest::orderBy('id', 'desc')->get();
        return DataTables::of($purchasingrequest)
                          ->addIndexColumn()
                          ->addColumn('show', function($purchasingrequest){
                            $html ="<button onclick='showInventory(\"".$purchasingrequest->pr_code."\")' class='btn btn-danger btn-rounded btn-icon' data-togle='modal'><i class='material-icons'>remove_red_eye</i></button>";
                            return $html;
                          })
                          ->rawColumns(['show'])
                          ->make(true);
      }
      else {
        return view('pr.pr_home');
      }
    }

    public function cancel(Cart $cart)
    {
      $cart->destroy();
      return response()
                      ->json(['status' => true, 'description' =>'Success']);
    }
}