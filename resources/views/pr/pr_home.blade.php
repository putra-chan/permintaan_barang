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
                        <th>No</th>
                        <th>PR Number</th>
                        <th>Total Items</th>
                        <th>Date</th>
                        <th></th>
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
        <table id="table1" class="responsive-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Inventory Name</th>
                    <th>Quantity</th>
                    <th>Qty Approved</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/PR/pr-main.js') }}"></script>
@endsection
