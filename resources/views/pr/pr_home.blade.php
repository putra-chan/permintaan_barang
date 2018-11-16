@extends('index')

@section('title', 'Purchasing Request')
@section('css')

@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col s12">
      <h3>Permintaan Bulan Ini</h3>
      <table id="table" class="responsive-table">
        <thead>
          <tr>
            <td>No</td>
            <td>No Pesanan</td>
            <td>Barang Saya</td>
            <td>Status</td>
          </tr>
        </thead>
      </table>
      </div>
    </div>
  </div>

  


  @section('js')
    <script type="text/javascript" src="{{ asset('js/PR/pr-main.js') }}"></script>
  @endsection
@endsection
