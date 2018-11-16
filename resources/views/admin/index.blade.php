@extends('index')
@section('title', 'Admin-Dashboard')
@section('css')

@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col s12" width="100%" height="100">
        <canvas id="myCanvas"></canvas>
      </div>
    </div>
  </div>
@section('js')
  <script type="text/javascript" src="{{ asset('js/Chart.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/admin/index.js')}}"></script>
@endsection
@endsection
