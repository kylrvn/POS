$(document).ready(function () {
  // $('.form-control').attr('disabled','disabled');
  $('.btn_add_item').attr('disabled','disabled');

});


$(document).on('click', '#save_payment', function () {
  $.post({
        url: 'payment/service/Payment_service/save_payment',
        data: {
            Order_id     : $(this).data('oid'),
            Amount_paid     : $('#Amount_paid').val(),
            Payment_mode   : $('#Payment_mode').val()
        },
        success:function(e)
            {
            var e = JSON.parse(e);
            if(e.has_error == false){
                // $('.inpt').attr('disabled', 'disabled');
                // $('#c_order').css('display','inline');
                // $('#submit_customer').css('display','none');
                $('#modal-default').modal('hide');
                // $('#FName').attr('class', 'form-control inpt');
                // $('#Company').attr('class', 'form-control inpt');
                toastr.success(e.message);


            } else {
                $('#Amount_paid').attr('class', 'form-control form-control-sm inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
            }
        },
    })
}); 



$('#Amount_paid').keyup(function() {
   $x = $(this).val();
   $y = $('#Balance').val();

   $value = $x - $y;

   $('#change').val($value.toFixed(2));
});