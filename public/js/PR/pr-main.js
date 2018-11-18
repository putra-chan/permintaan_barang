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

  tablePR = $("#pr-status").dataTable({
    processing: true,
    serverSide: true,
    ajax: 'pr/' + pr_code,
    columns: [
        {data: 'DT_Row_Index', name: 'DT_Row_Index'},
        {data: 'name', name: 'name'},
        {data: 'qty', name: 'qty'},
        {data: 'qty_approved', name: 'qty_approved'},
        {data: 'status', name: 'status', orderable: false, searchable: false},
    ],
    order: [[ 0, "asc" ]],
  });

}
//Data Table PR
$(document).ready(function(){
  table = $("#table").dataTable({
    processing: true,
    serverSide: true,
    ajax: 'pr',
    columns: [
        {data: 'DT_Row_Index', name: 'DT_Row_Index'},
        {data: 'pr_code', name: 'pr_code'},
        {data: 'total', name: 'total'},
        {data: 'date', name: 'date'},
        {data: 'show', name: 'show', orderable: false, searchable: false},
    ],
    order: [[ 0, "asc" ]],
  });
});
