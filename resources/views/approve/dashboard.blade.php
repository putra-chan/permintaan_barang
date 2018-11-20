@extends('index')
@section('title', 'Approve Barang')
@section('css')

@endsection
@section('content')
  <div class="container">
    <div class="header-approve">
      <h3>Approve Barang</h3>
    </div>
    <div class="appro-table">
      <table id="table-approve">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No PR</th>
            <th>Quantity</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
    <div id="approve-modal" class="modal">
      <div class="modal-content">
        <h4 id="approve-header"></h4>
        <table class="responsive-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Quantity Diminta</th>
              <th>Quantity Approve</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody id="isiApprove">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Keluar</a>
      </div>
    </div>
  </div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/approve/approve.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/PR/pr-main.js') }}"></script>
@endsection
