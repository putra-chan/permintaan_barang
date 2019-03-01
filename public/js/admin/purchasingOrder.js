$(document).ready(function() {
  table = $('#purchasingOrder').dataTable({
    processing: true,
    serverSide: true,
    ajax: '/purchasingOrder',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'po_code', name: 'po_code'},
      {data: 'Qty', name: 'Qty'},
      {data: 'Price', name: 'Price'},
      {data: 'print', name: 'print'},
    ],
    order: [[0, "asc"]],
  });
});
