@extends('index')

@section('title', 'Purchasing Request')
@section('css')

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col s12">
      <h3>Permintaan Barang</h3>
      <table id="table" class="responsive-table">
        <thead>
          <tr>
            <td>No</td>
            <td>PR Number</td>
            <td>Total Items</td>
            <td>Date</td>
            <td></td>
          </tr>
        </thead>
      </table>
      </div>
    </div>
  </div>
  <div id="pr-popup" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="popup-title"></h3>
      </div>
      <table id="pr-status">
        <thead>
          <tr>
            <td>Inventory Name</td>
            <td>Quantity</td>
            <td>Qty Approved</td>
            <td>Status</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>



  @section('js')
    <script type="text/javascript" src="{{ asset('js/PR/pr-main.js') }}"></script>
  @endsection
@endsection
