@extends('index')
@section('title', 'Purchasing Order')
@section('css')

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col s12 m2 l2">
        <button type="button" class="btn waves-effect waves-light modal-trigger" href="#po-modal"><i class="material-icons">add</i></button>
      </div>
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        <table id="purchasingOrder">
          <thead>
            <th>No</th>
            <th>No Purchasing Order</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Print PO</th>
          </thead>
        </table>
      </div>
    </div>
    <div class="modal bottom-sheet" id="po-modal">
      <div class="modal-content">

      </div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('js/admin/purchasingOrder.js') }}"></script>
@endsection
