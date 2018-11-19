<?php

namespace App\Http\Controllers\Approved;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
