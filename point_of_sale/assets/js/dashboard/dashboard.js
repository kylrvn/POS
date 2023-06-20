
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