$(document).ready(function(){
    $('.modal').modal();
  });
var table;
function openModal(obj){
  $("#form")[0].reset();
  $("#product-id").val("");
  $("#popup").modal('open');

  if($(obj).attr('data-val')){

    if( typeof(cropper) !== 'undefined' ){
      cropper.slim('destroy');
    }

    cropper = $("#product-image").slim({
      ratio: '1:1',
      maxFileSize: 1,
      crop: {
          x: 0,
          y: 0,
          width: 200,
          height: 200
      },
      meta: {
          userId:''
      }
    });

    var data = JSON.parse($(obj).attr('data-val'));
    $("#product-id").val(data.id);
    $("#name").val(data.name);
    $("#name").focus();
    $("#price").val(data.price);
    $("#price").focus();
    $("#product-image").slim('load', '/data/images/'+data.image);
  }
  else {
    if( typeof(cropper) !== 'undefined' ){
      cropper.slim('destroy');
    }

    cropper = $("#product-image").slim({
      ratio: '1:1',
      maxFileSize: 1,
      crop: {
          x: 0,
          y: 0,
          width: 200,
          height: 200
      },
      meta: {
          userId:''
      }
    });
  }
}

function saveItem(obj){
  // loading(obj);
  var form = $('#form');
  $.ajax({
    url : 'product',
    type: 'POST',
    data: form.serialize(),
      success: function (data){
        if(data.status == true){
          swal('Success', data.description, 'success');
          $('#table').DataTable().ajax.reload();
          $('#popup').modal('close');
        }
        else {
          var span =document.createElement("span");
          span.innerHTML = data.description;
          swal({
            title: "Oops!",
            content: span,
            icon: 'error'
          });
        }
        // dismiss_loading(obj, 'Save');
      }
  }, 'json');
}

function deleteItem(id, name){
  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete'
}).then((result) => {
  if (result.value) {
    $.ajax({
        url: 'product/delete',
        type: 'POST',
        data: {
                '_token':$('meta[name="csrf-token"]').attr('content'),
                'product_id': id
            },
        success: function (data){
            if( data.status == true ){
                swal('Success', data.description, 'success');
                $('#table').DataTable().ajax.reload();
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
  else {

  }
  });
}

$(document).ready(function(){
  table = $("#table").dataTable({
    processing: true,
    serverSide: true,
    ajax: 'product',
    columns: [
        {data: 'DT_Row_Index', name: 'DT_Row_Index'},
        {data: 'image', name: 'image'},
        {data: 'name', name: 'name'},
        {data: 'edit', name: 'edit', orderable: false, searchable: false},
        {data: 'delete', name: 'delete', orderable: false, searchable: false}
    ],
    order: [[ 0, "asc" ]],
  });
});
