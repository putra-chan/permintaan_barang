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
  public function appDashboard()
  {
    return view('approve.dashboard');
  }
  public function tableApp(Request $request)
  {
    if ($request->ajax()) {
    }
    else {
      return abort(404);
    }
  }
}
