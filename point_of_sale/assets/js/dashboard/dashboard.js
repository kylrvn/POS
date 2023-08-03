
var load_details = () => {
    $(document).gmLoadPage({
       url: 'dashboard/get_details',
       load_on: '#load_details'
   });
  }
  


$(document).ready(function () {
    load_details();
});


function myFunction(e,x){
    window.location.href = base_url+"point_of_sale/payment/?custid="+x+'&oid='+e;
}

var load_status_filter = (y) => {
    $(document).gmLoadPage({
       url: 'dashboard/get_details',
       data: {
        ID: y,
       },
       load_on: '#load_details'
   });
  }

  $('#Status_filter').change(function() {
    var y = $(this).val();
    load_status_filter(y);
});