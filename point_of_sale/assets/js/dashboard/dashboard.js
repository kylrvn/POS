
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
    // use this for local
    window.location.href = base_url+"point_of_sale/payment/?custid="+x+'&oid='+e;
    
    // use this for hosting
    // window.location.href = base_url+"payment/?custid="+x+'&oid='+e;
}
var load_status_filter = (y,x) => {
    $(document).gmLoadPage({
       url: 'dashboard/get_details',
       data: {
        Filter_value: y,
        Filter_type: x,
       },
       load_on: '#load_details'
   });
  }

  $('#Status_filter').change(function() {
    var y = $(this).val();
    var x = $('#Filter_by').val();
    load_status_filter(y,x);
});


$('#search_customer').keyup(function() {
    var y = $(this).val();
    var x = $('#Filter_by').val();
    load_status_filter(y,x);
});

$('#Payment_filter').change(function() {
    var y = $(this).val();
    var x = $('#Filter_by').val();
    load_status_filter(y,x);
});

$('#Filter_by').change(function() {
   var selected = $(this).val();

   if(selected == "Order Status"){
        $('#search_customer').hide();
        $('#Payment_filter').hide();
        $('#Status_filter').show();
   } else if(selected == "Payment Status"){
        $('#search_customer').hide();
        $('#Status_filter').hide();
        $('#Payment_filter').show();
   } else if(selected == "Customer"){
        $('#Status_filter').hide();
        $('#Payment_filter').hide();
        $('#search_customer').show();
   }

});
