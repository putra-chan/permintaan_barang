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
                            return "Waiting for process";
                          }
                        })
                        ->editColumn('show', function($approved){
                          $html ="<a href='#approve-modal' onclick='showApprove(\"".$approved->pr_code."\")'  data-togle='modal'><i class='material-icons'>remove_red_eye</i></a>";
                          return $html;
                        })
                        ->rawColumns(['name', 'status', 'show'])
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
      $html .= "<tr>";
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
    
  }

}
