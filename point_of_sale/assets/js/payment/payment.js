$(document).ready(function () {
  // $('.form-control').attr('disabled','disabled');
  $('.btn_add_item').attr('disabled','disabled');
  $('.select_update').attr('disabled','disabled');
  $('#cancel').css('display','none');
  $('#save_dets').css('display','none');

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
                $('#modal-default').modal('hide');
                toastr.success(e.message);
                setTimeout(function(){
                    window.location.reload();
                },2000); 


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

$(document).on('click', '#update_dets', function () {

    $('.select_update').attr('disabled',false);
    $('#cancel').css('display','inline');
    $('#save_dets').css('display','inline');
    $(this).css('display','none');
 });

 $(document).on('click', '#cancel', function () {
    toastr.warning("Update Cancelled"); 

    $('.select_update').attr('disabled','disabled');
    $('#update_dets').css('display','inline');
    $('#save_dets').css('display','none');
    $(this).css('display','none');

 });

 $(document).on('click', '#save_dets', function () {
    $.post({
        url: 'payment/service/Payment_service/update_details',
        data: {
            Order_id     : $(this).data('oid'),
            Order_status     : $('#o_status').val(),
            Sewer     : $('#sewer').val(),
            Lay_artist   : $('#layout').val(),
            Set_artist   : $('#setup').val(),
        },
        success:function(e)
            {
            var e = JSON.parse(e);
            if(e.has_error == false){
                toastr.success(e.message);
                $('.select_update').attr('disabled','disabled');
                $('#update_dets').css('display','inline');
                $('#save_dets').css('display','none');
                $('#cancel').css('display','none');
                // setTimeout(function(){
                //     window.location.reload();
                // },2000); 


            } else {
                toastr.error(e.message); 
            }
        },
    })

 });