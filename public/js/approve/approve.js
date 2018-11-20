var table;

$(document).ready(function() {
  table = $('#table-approve').dataTable({
    processing: true,
    serverSide: true,
    ajax: '/approve',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'name', name: 'name'},
      {data: 'pr_code', name: 'pr_code'},
      {data: 'quantity', name: 'quantity'},
      {data: 'status', name: 'status'},
      {data: 'show', name: 'show'},
    ],
    order: [[0, "asc"]],
  });
});

function showApprove(pr_code)
{
  $.ajax({
    url: '/approve',
    type: 'POST',
    data: {
      '_token':$('meta[name="csrf-token"]').attr('content'),
      'pr_code': pr_code,
    },
    success: function(data){
      if (data.status) {
        $("#approve-modal").modal('open');
        $("#isiApprove").html(data.data);
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