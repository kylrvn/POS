$(document).ready(function () {
  // $('.form-control').attr('disabled','disabled');
  $('.btn_add_item').attr('disabled','disabled');
  $('.select_update').attr('disabled','disabled');
  $('#cancel').css('display','none');
  $('#save_dets').css('display','none');
  $('.note_area').css('display','none');
  $('.dates').css('display','none');

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
    $('.note_area').css('display','inline');
    $('.note_area2').css('display','none');
    $(this).css('display','none');
  $('.dates').css('display','block');
  $('.dates2').css('display','none');

 });

 $(document).on('click', '#cancel', function () {
    toastr.warning("Update Cancelled"); 

    $('.select_update').attr('disabled','disabled');
    $('#update_dets').css('display','inline');
    $('#save_dets').css('display','none');
    $(this).css('display','none');
    
    $('.note_area').css('display','none');
    $('.note_area2').css('display','block');
    
    $('.dates').css('display','none');
    $('.dates2').css('display','block');
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
            b_note   : $('#b_note').val(),
            d_note   : $('#d_note').val(),
            freebies   : $('#freebies').val(),
            d_date   : $('#d_date').val(),
        },
        success:function(e)
            {
            var e = JSON.parse(e);
            if(e.has_error == false){
                toastr.success(e.message);
                $('.select_update').attr('disabled','disabled');
                $('#d_date').attr('disabled','disabled');    
                $('.note_area').attr('disabled','disabled');
                $('#update_dets').css('display','inline');
                $('#save_dets').css('display','none');
                $('#cancel').css('display','none');
                setTimeout(function(){
                    window.location.reload();
                },2000); 


            } else {
                toastr.error(e.message); 
            }
        },
    })

 });

 $(document).on('click', '#submit_req', function() {
    var formData = new FormData($("#uploadForm")[0]);
    var cid = $(this).data('name');
    var oid = $(this).data('oid');

    $.ajax({
        url: baseUrl + 'payment/service/Payment_service/save_modal_req?cid='+cid+'&oid='+oid,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            var parsedResponse = JSON.parse(response);
            if (parsedResponse.has_error == false) {
                toastr.success("Document(s) Successfully uploaded.");
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            } else {
                toastr.error("ERROR");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    setTimeout(function() {
        window.location.reload();
    }, 500);
});

$(document).on('click', '#view_mockup', function () {
    $.post({
        url: 'payment/retrieve_design',
        data: {
            Order_id     : $(this).data('oid'),
        },
        success:function(e)
            {
            // var e = JSON.parse(e);
            // if(e.has_error == false){
            //     toastr.success(e.message);
            //     $('.select_update').attr('disabled','disabled');
            //     $('#d_date').attr('disabled','disabled');    
            //     $('.note_area').attr('disabled','disabled');
            //     $('#update_dets').css('display','inline');
            //     $('#save_dets').css('display','none');
            //     $('#cancel').css('display','none');
            //     setTimeout(function(){
            //         window.location.reload();
            //     },2000); 


            // } else {
            //     toastr.error(e.message); 
            // }
        },
    })

 });