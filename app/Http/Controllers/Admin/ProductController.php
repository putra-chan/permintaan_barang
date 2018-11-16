<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\slim;

class ProductController extends Controller
{
  public function __construct(){
    $this->path 	= './data/images/';
    $this->middleware('auth');
    $this->middleware('admin');
  }
  public function product(Request $request){
    if ($request->ajax()) {
      $product = Product::where('is_deleted', 0)->orderBy('id', 'desc')->get();
      return DataTables::of($product)
                        ->addIndexColumn()
                        ->editColumn('image', function($product){
                          return "<img src='/data/images/".$product->image."' width='100px'/>";
                        })
                        ->addColumn('edit', function ($product){
                          $html = '<button onclick="openModal(this);" data-togle="modal" data-val=\''.json_encode($product).'\' class="btn btn-primary btn-rounded btn-icon"><i class="material-icons">edit</i></button>';
                          return $html;
                        })
                        ->addColumn('delete', function($product){
                          $html = "<button onclick='deleteItem(\"".$product->id."\",\"".$product->name."\")' class='btn btn-danger btn-rounded btn-icon'><i class='material-icons'>close</i></button>";
                          return $html;
                        })
                        ->rawColumns(['edit','delete', 'image'])
                        ->make(true);
    }
    else {
      return view('admin.product');
    }
  }

  public function store(Request $request)
  {
    if (isset($request->id)) {
      $product = Product::where('id', $request->id)->first();
      $product->name  = $request->name;
      if (isset(Slim::getImages('image')[0])) {

      $image = Slim::getImages('image')[0];

      if ( isset($image['output']['data']) )
          {
             $name                 = $image['output']['name'];
             $data                 = $image['output']['data'];
             $file                 = Slim::saveFile($data, $name, $this->path);
             $product->image       = $file['name'];
          }
        }
        $product->save();
      return response()
        ->json(['status' => true, 'description' => 'Add Product']);
    }
    else {
      $product = new Product;
      $product->name  = $request->name;
      if (isset(Slim::getImages('image')[0])) {

      $image = Slim::getImages('image')[0];

      if ( isset($image['output']['data']) )
          {
             $name                 = $image['output']['name'];
             $data                 = $image['output']['data'];
             $file                 = Slim::saveFile($data, $name, $this->path);
             $product->image       = $file['name'];
          }
        }
        $product->save();
      return response()
        ->json(['status' => true, 'description' => 'Product'. $product->name .'has been stored successfully']);
    }
  }
  public function destroy(Request $request)
  {
    $product = Product::where('id', $request->product_id)->first();
    $product->is_deleted = 1;
    $product->save();
      return response()
        ->json(['status' => true, 'description' => 'Product is deleted']);
  }
}
