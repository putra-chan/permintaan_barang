<?php

namespace App\Http\Controllers\Purchasing_Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Gloudemans\Shoppingcart\Cart;
use App\Product;
use App\PurchasingRequest;
use App\PurchasingOrder;
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
        $cart->destroy();
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
        $purchasingrequest = PurchasingRequest::groupBy('pr_code')->orderBy('id', 'desc')->get();
        return DataTables::of($purchasingrequest)
                          ->addIndexColumn()
                          ->addColumn('total', function($purchasingrequest){
                            $total = PurchasingRequest::where('pr_code', $purchasingrequest->pr_code)->sum('quantity');
                            return $total;
                          })
                          ->addColumn('date', function($purchasingrequest){
                            return date('d F Y', strtotime($purchasingrequest->created_at));
                          })
                          ->addColumn('show', function($purchasingrequest){
                            $html ="<a href='#' onclick='showInventory(\"".$purchasingrequest->pr_code."\")'  data-togle='modal'><i class='material-icons'>remove_red_eye</i></a>";
                            return $html;
                          })
                          ->rawColumns(['total', 'date', 'show'])
                          ->make(true);
      }
      else {
        return view('pr.pr_home');
      }
    }

    public function pr_detail(Request $request, $prcode)
    {
      if ($request->ajax()) {
        $purchasingrequest = PurchasingRequest::where('pr_code', $prcode)->orderBy('id', 'desc')->get();

        return DataTables::of($purchasingrequest)
                          ->addIndexColumn()
                          ->addColumn('product_name', function($purchasingrequest){
                            $product = Product::takeOne($purchasingrequest->product_id);
                            return $product->name;
                          })
                          ->editColumn('quantity_approve', function($purchasingrequest){
                            if (isset($purchasingrequest->quantity_approve)) {
                              return $purchasingrequest->quantity_approve;
                            }
                            else {
                              return 0;
                            }
                          })
                          ->addColumn('pr_status', function($purchasingrequest){
                            if ($purchasingrequest->quantity_approve == 0 ) {
                              return "Rejected";
                            }
                            else if ($purchasingrequest->quantity_approve >= 1) {
                              return "Approved";
                            }
                            else {
                              return "Waiting for proccess";
                            }
                          })
                          ->rawColumns(['product_name', 'quantity_approve', 'pr_status'])
                          ->make(true);
      }
      else {
        return abort(404);
      }
    }

    public function cancel(Cart $cart)
    {
      $cart->destroy();
      return response()
                      ->json(['status' => true, 'description' =>'Success']);
    }
}
