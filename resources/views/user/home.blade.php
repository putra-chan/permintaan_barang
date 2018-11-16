@extends('index')
@section('title', 'Dashboard')
@section('css')

@endsection
@section('content')
<div class="row">
    <div class="container">
        <div class="col s12 m8 l8 mt50 p20">
            <div class="card">
                <form class="" method="post" onsubmit="return false">
                    <div class="search input-field col s10 m12 l12">
                        <input id="search" class="validate" placeholder="cari barang" onkeyup="searchData()">
                    </div>
                </form>
            </div>
            @php
            $i = 1;
            @endphp
            @foreach ($products as $product)
              <div class="col s6 m4 l3 p10 product-item" onclick="add( {{ $product->id }} )" id="product-item-{{ $product->id }}">
                <div class="card">
                  <div class="card-image">
                    <div class="wrapper-image">
                        <img src="{{ asset('/data/images/'.$product->image) }}" alt="product" width="100px" height="100px">
                    </div>
                    <div class="wrapper- product" data-val="{{ $product }}">
                      <p>{{ $product->name }}</p>
                    </div>
                  </div>
                </div>
              </div>
            @php
            $i++;
            @endphp
            @endforeach
        </div>
        <div class="col s12 m4 l4 mt50 p20">
            <div class="row card">
                <div class="col s12 m12 l12" id="cart">
                </div>
                <div class="col s12 m12 l12">

                </div>
            </div>
            <div class="row">
              <div class="col s12 m12 l12 wrapper-button">
                <button type="button" name="button" class="waves-effect waves-dark btn modal-trigger red left" onclick="cancel(this)">Batal</button>
                <button type="button" name="button" class="waves-effect waves-light btn modal-trigger right" onclick="save(this)">Save</button>
              </div>
            </div>
        </div>
        <div class="page-navigate center">
            <div class="wrapper">
                {{ $products->render() }}
            </div>
        </div>
    </div>
</div>
@section('js')
  <script type="text/javascript" src="{{ asset('js/PR/pr-main.js') }}"></script>
@endsection
@endsection
