@extends('index')
@section('title', 'Tambah Product')
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/product.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="col s12">
        <div class="row">
            <div class="col s10 m8 l10">
                <div class="row">
                    <h3 class="mb5">Dashboard</h3>
                    <p class="mt0">List Product</p>
                </div>
            </div>
            <div class="col s2 m4 l2">
                <div class="row pt63">
                    <button type="button" name="button" class="waves-effect waves-light btn modal-trigger" onclick="openModal(this)">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col s12">
        <div class="row">
            <table class="responsive-table" id="table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Gambar</td>
                        <td>Nama</td>
                        <td>Edit</td>
                        <td>Hapus</td>
                    </tr>
                </thead>
            </table>

            <div id="popup" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Add Product</h5>
                    </div>
                    <form class="col s12" id="form" onsubmit="return false">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" id="product-id">
                        <div class="row">
                            <div class="input-field inline col s12">
                                <input type="text" name="name" class="validate" id="name">
                                <label for="name">Nama Produk</label>
                            </div>
                            <div class="col s12 m6 l4">
                                <div class="slim-content">
                                    <div class="slim circle photo-container" {{-- data-label="upload image here" --}} data-size="230,230" {{-- Ukuran Gambar--}} data-ratio="1:1" data-jpeg-compression="80" data-status-upload-success="berhasil disimpan"
                                      data-force-type="jpg" id="product-image">
                                        <input type="file" name="image[]" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="button" class="modal-action modal-close waves-effect waves-green btn-flat">Close</button>
                    <button type="submit" name="submit" class="waves-effect waves-light btn mt10" onclick="saveItem(this)">Save</button>
                </div>
            </div>
            </form>
            {{-- {{ $products->render() }} --}}
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript" src="{{ asset('js/admin/product.js') }}"></script>
@endsection
@endsection
