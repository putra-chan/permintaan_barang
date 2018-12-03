<?php

namespace App\Http\Controllers\Approved;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Product;
use App\PurchasingOrder;
use App\PurchasingRequest;
use App\User;

class ApprovedController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('approval');
  }
  public function tableApp(Request $request)
  {
    if ($request->ajax()) {
      $approved = PurchasingRequest::groupBy('pr_code')->orderBy('id', 'desc')->get();
      return DataTables::of($approved)
                        ->addIndexColumn()
                        ->addColumn('name', function($approved){
                          $name = User::where('id', $approved->user_id)->first();
                          return $name->name;
                        })
                        ->editColumn('status', function($approved){
                          $po = PurchasingOrder::where('pr_id', $approved->id)->first();
                          if (isset($po->process_by)) {
                            if (isset($po->approved_id)) {
                              return "Approved";
                            }
                            else {
                              return "Waiting for approve";
                            }
                          }
                          else {
                            if (isset($approved->quantity_approve)) {
                              return "Processed, waiting for PO";
                            }
                            else {
                              return "Waiting for process";
                            }
                          }
                        })
                        ->addColumn('total', function($approved){
                          $total = PurchasingRequest::where('pr_code', $approved->pr_code)->sum('quantity');
                          return $total;
                        })
                        ->editColumn('show', function($approved){
                          $html ="<a href='#approve-modal' onclick='showApprove(\"".$approved->pr_code."\")'  data-togle='modal'><i class='material-icons'>remove_red_eye</i></a>";
                          return $html;
                        })
                        ->rawColumns(['name', 'status','total', 'show'])
                        ->make(true);
    }
    else {
      return view('approve.dashboard');
    }
  }

  public function fetchPR(Request $request)
  {
    $dataPR = PurchasingRequest::where('pr_code', $request->pr_code)->get();

    $html = "";
    $i = 1;
    foreach ($dataPR as $data) {
      $product = Product::where('id', $data->product_id)->first();
      $html .= "<tr id='tr-pr-".$data->id."'>";
      $html .= "<td>".$i."</td>";
      $html .= "<td>".$product->name."</td>";
      $html .= "<td>".$data->quantity."</td>";
      $html .= "<td><div class='input-field col s12'><input id='pr-".$data->id."' type='number' class='validate' placeholder='Qty Approve'></div></td>";
      $html .= "<td><button class='waves-effect waves-light btn red darken-2' onclick='reject(\"".$data->id."\")'>Tolak</button></td>";
      $html .= "<td><button class='waves-effect waves-light btn' onclick='approve(\"".$data->id."\")'>Setuju</button></td>";
      $html .= "</tr>";
      $i++;
    }
    return response()
      ->json(['status' => true, 'description' => 'success menyetujui', 'data'=> $html]);
  }


  public function success(Request $request)
  {

    $pr = PurchasingRequest::where('id', $request->pr_id)->first();
    if ($request->qty > $pr->quantity) {
      return response()
                    ->json(['status' => false, 'description' => 'Aprrove Quantity Melebihi']);
    }
    else {
      if ($request->quantity == NULL) {
        $pr->quantity_approve = $pr->quantity;
        $pr->save();
      }
      else {
        $pr->quantity_approve = $request->qty;
        $pr->save();
      }

      return response()
      ->json(['status' => true, 'description' => 'success']);
    }

  }

  public function reject(Request $request){
    $pr = PurchasingRequest::where('id', $request->pr_id)->first();
    if ($request->qty > $pr->quantity) {
      return response()
                    ->json(['status' => false, 'description' => 'Aprrove Quantity Melebihi']);
    }
    else {
      $pr->quantity_approve = 0;
      $pr->save();

      return response()
      ->json(['status' => true, 'description' => 'success']);
    }
  }

}
