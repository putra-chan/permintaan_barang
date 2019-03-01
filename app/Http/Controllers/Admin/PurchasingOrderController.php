<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\User;
use App\PurchasingOrder;

class PurchasingOrderController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
  }
  public function PurchasingOrder(Request $request){
    if ($request->ajax()) {
      $purchasingOrder = PurchasingOrder::groupBy('po_code')->orderBy('id', 'desc')->get();
      return DataTables::of($purchasingOrder)
                          ->addIndexColumn()
                          ->editColumn('print', function($purchasingOrder){
                            $html = '</a href="#print"><i class="material-icons">picture_as_pdf</i></a>';
                            return html;
                          })
                          ->rawColumns(['print'])
                          ->make(true);
    }
    else {
      return view('pr.admin_po');
    }
  }
}
