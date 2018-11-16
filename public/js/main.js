var table;

function add(id) {
  $.ajax({
    url: '/home',
    type: 'POST',
    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'id': id},
    success: function (data){
      if (data.status) {
        fetch();
      }
      else {
        console.log(data);
      }
    }
  }, 'json');
}

function fetch(){
  $.ajax({
    url: '/home/fetch',
    type: 'POST',
    data: {'_token': $('meta[name="csrf-token"]').attr('content')},
    success: function (data){
      $("#cart").html(data);
    }
  })
}

$(document).ready(function(){
  $(".button-collapse").sideNav();
  $(".dropdown-button").dropdown('open');
  fetch();
})
