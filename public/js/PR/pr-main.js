var tablePR;
var table;

function save(){
  $.ajax({
    url: '/store',
    type: 'POST',
    data: {
      '_token':$('meta[name="csrf-token"]').attr('content'),
    },
    success: function(data){
      if (data.status == true) {
        swal('Success', data.description, 'success');
        window.location.href = '/pr_home';
      }
      else {
        var span = document.createElement("span");
        span.innerHTML = data.description;
        swal({
          title: "Oops!",
          content: span,
          icon: 'error'
        });
      }
    }
  }, 'json');
}


//searchData
function searchData() {
    var item = $( ".product" );
    var filter = $( "#search" ).val().toUpperCase().trim();

    for(var i=0; i<item.length; i++ ){
      var product_name = $(item[i]).text().toUpperCase().trim();
      var data = JSON.parse($(item[i]).attr('data-val'));
      var data_id = data.id;
      $("#product-item-"+ data_id).show();
      if( product_name.indexOf(filter) == -1 ){
        $("#product-item-"+ data_id).hide();
      }
    }
  }

// cancel data
function cancel()
{
  $.ajax({
    url: '/pr',
    type: 'POST',
    data: {
      '_token':$('meta[name="csrf-token"]').attr('content'),
    },
    success: function(data){
      if (data.status = true) {
        window.location.href = '/';
      }
    }
  }, 'json');
}
// show showInventory
$(document).ready(function(){
    $('.modal').modal();
  });
function showInventory(pr_code)
{
  $('#pr-popup').modal('open');
  $('#popup-title').text(pr_code);

  $("#table1").dataTable().fnDestroy();

  tablePR = $("#table1").dataTable({
    processing: true,
    serverSide: true,
    ajax: 'pr/' + pr_code,
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'product_name', name: 'product_name'},
      {data: 'quantity', name: 'quantity'},
      {data: 'quantity_approve', name: 'quantity_approve'},
      {data: 'pr_status', name: 'pr_status', orderable: false, searchable: false},
    ],
    order: [[0, "asc"]],
  });
}
//Data Table PR
$(document).ready(function(){
  table = $("#table").dataTable({
    processing: true,
    serverSide: true,
    ajax: 'pr',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'pr_code', name: 'pr_code'},
      {data: 'total', name: 'total'},
      {data: 'date', name: 'date'},
      {data: 'show', name: 'show', orderable: false, searchable: false},
    ],
    order: [[ 0, "asc" ]],
  });
});
