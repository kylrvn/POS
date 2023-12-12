$(document).ready(function() {
    // $('.form-control').attr('disabled','disabled');
    $('.btn_add_item').attr('disabled', 'disabled');
    $('.select_update').attr('disabled', 'disabled');
    $('#cancel').css('display', 'none');
    $('#save_dets').css('display', 'none');
    $('.note_area').css('display', 'none');
    $('.dates').css('display', 'none');

});

// document.addEventListener("DOMContentLoaded", function() {
//     // Get the Pay button element
//     var payBtn = document.getElementById('pay');

//     // Add a click event listener to the Pay button
//     payBtn.addEventListener('click', function() {
//         // Get the filename from the data-mockup-filename attribute of the button
//         var mockupFilename = payBtn.dataset.mockupFilename;

//         // Now, you have the filename, and you can use it for further processing or include it in the data sent to the server when submitting the payment
//         console.log("Mockup Design Filename: " + mockupFilename);
//         // Do further processing with the filename as needed
//         // ...
//     });
// });


$(document).on('click', '#pay', function() {
    var formData = new FormData();
    formData.append('Order_id', $(this).data('oid'));
    formData.append('Amount_paid', $('#Amount_paid').val());
    formData.append('Amount_rendered', $('#Amount_rendered').val());
    formData.append('Payment_mode', $('#Payment_mode').val());
    formData.append('Receipt_number', $('#Receipt_number').val());
    formData.append('Reference_number', $('#Reference_number').val());
    formData.append('Due_date', $('#Due_date').val());
    formData.append('Waybill_number', $('#Waybill_number').val());
    formData.append('po_number', $('#po_number').val());
    formData.append('image', $("#payment_proof")[0].files[0]);

    var payBtn = document.getElementById('pay');
    var mockupFilename = payBtn.dataset.mockupFilename;

    // Now, you have the filename, and you can use it for further processing or include it in the data sent to the server when submitting the payment
    console.log("Mockup Design Filename: " + mockupFilename);

    // Append the mockupFilename to the formData
    formData.append('mockupFilename', mockupFilename);

    // Do further processing with the filename as needed

    $.ajax({
        url: 'payment/service/Payment_service/save_payment',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            response = JSON.parse(response);
            if (response.has_error == false) {
                $('#modal-default').modal('hide');
                toastr.success(response.message);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
              
            } else {
                $('#Amount_paid').addClass('is-invalid');
                $('#Receipt_number').addClass('is-invalid');
                $('#Reference_number').addClass('is-invalid');
                $('#po_number').addClass('is-invalid');
                $('#Waybill_number').addClass('is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(response.message);
                return;
            }
        },
    });
});



$('#Amount_paid').keyup(function() {
    $x = $(this).val();
    $y = $('#Amount_rendered').val();

    $value = $x - $y;

    $('#change').val($value.toFixed(2));``
});

$('#Amount_rendered').keyup(function() {
    $x = $(this).val();
    $y = $('#Amount_paid').val();

    $value = $x - $y;

    $('#change').val($value.toFixed(2));``
});

$(document).on('click', '#update_dets', function() {

    $('.select_update').attr('disabled', false);
    $('#cancel').css('display', 'inline');
    $('#save_dets').css('display', 'inline');
    $('.note_area').css('display', 'inline');
    $('.note_area2').css('display', 'none');
    $(this).css('display', 'none');
    $('.dates').css('display', 'block');
    $('.dates2').css('display', 'none');

});

$(document).on('click', '#cancel', function() {
    toastr.warning("Update Cancelled");

    $('.select_update').attr('disabled', 'disabled');
    $('#update_dets').css('display', 'inline');
    $('#save_dets').css('display', 'none');
    $(this).css('display', 'none');

    $('.note_area').css('display', 'none');
    $('.note_area2').css('display', 'block');

    $('.dates').css('display', 'none');
    $('.dates2').css('display', 'block');
});

$(document).on('click', '#save_dets', function() {
    $.post({
        url: 'payment/service/Payment_service/update_details',
        data: {
            Order_id: $(this).data('oid'),
            Order_status: $('#o_status').val(),
            Sewer: $('#sewer').val(),
            Lay_artist: $('#layout').val(),
            Set_artist: $('#setup').val(),
            b_note: $('#b_note').val(),
            d_note: $('#d_note').val(),
            freebies: $('#freebies').val(),
            d_date: $('#deadline_date').val(),
        },
        success: function(e) {
            var e = JSON.parse(e);
            if (e.has_error == false) {
                toastr.success(e.message);
                $('.select_update').attr('disabled', 'disabled');
                $('#d_date').attr('disabled', 'disabled');
                $('.note_area').attr('disabled', 'disabled');
                $('#update_dets').css('display', 'inline');
                $('#save_dets').css('display', 'none');
                $('#cancel').css('display', 'none');
                setTimeout(function() {
                    window.location.reload();
                }, 2000);


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
        url: baseUrl + 'payment/service/Payment_service/save_modal_req?cid=' + cid + '&oid=' + oid,
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
                }, 2000);
            } else {
                toastr.error("ERROR");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    // setTimeout(function() {
    //     window.location.reload();
    // }, 500);
});

// $(document).on('click', '#view_mockup', function() {
//     $.post({
//         url: 'payment/retrieve_design',
//         data: {
//             Order_id: $(this).data('oid'),
//         },
//         success: function(e) {
//             // var e = JSON.parse(e);
//             // if(e.has_error == false){
//             //     toastr.success(e.message);
//             //     $('.select_update').attr('disabled','disabled');
//             //     $('#d_date').attr('disabled','disabled');    
//             //     $('.note_area').attr('disabled','disabled');
//             //     $('#update_dets').css('display','inline');
//             //     $('#save_dets').css('display','none');
//             //     $('#cancel').css('display','none');
//             //     setTimeout(function(){
//             //         window.location.reload();
//             //     },2000); 


//             // } else {
//             //     toastr.error(e.message); 
//             // }
//         },
//     })

// });
$(document).ready(function() {
    // Event listener for the select element
    $('#Payment_mode').change(function() {
        // Get the selected option value
        var selectedOption = $(this).val();

        // Get the proof of payment group element
        var proofOfPaymentGroup = $('#proof_of_payment_group');
        var rec_num = $('#rec_num');
        var ref_num = $('#ref_num');
        var way_num = $('#way_num');
        var terms = $('#terms');
        var amount = $('#amnt');
        var amount_render = $('#amnt_rendered');
        var change = $('#chnge');
        var d_date = $('#d_date');

        // Check if the selected option is "Online"
        if (selectedOption === "50") {
            // Proof of payment
            proofOfPaymentGroup.css('display', 'inline');
            ref_num.show();
            amount.show();
            change.show();
            rec_num.css('display', 'none');
            amount_render.css('display', 'none');
            way_num.css('display', 'none');
            terms.css('display', 'none');
            d_date.css('display', 'none');
            // document.getElementById('amnt').disabled = false;
        } else if(selectedOption === "49"){
            // Cash
            proofOfPaymentGroup.css('display', 'none');
            ref_num.css('display', 'none');
            way_num.css('display', 'none');
            terms.css('display', 'none');
            d_date.css('display', 'none');
            rec_num.show();
            amount_render.show();
            amount.show();
            change.show();
        } else if(selectedOption === "51"){
            // COD
            proofOfPaymentGroup.css('display', 'none');
            ref_num.css('display', 'none');
            rec_num.css('display', 'none');
            amount_render.css('display', 'none');
            amount.css('display', 'none');
            change.css('display', 'none');
            terms.css('display', 'none');
            way_num.show();
            d_date.show();
        } else if(selectedOption === "52"){
            // Terms
            proofOfPaymentGroup.css('display', 'none');
            ref_num.css('display', 'none');
            rec_num.css('display', 'none');
            amount_render.css('display', 'none');
            amount.css('display', 'none');
            change.css('display', 'none');
            way_num.css('display', 'none');
            d_date.show();
            terms.show();
        }
    });
});
// Event listener for the file input change event
$('#proof_of_payment').change(function() {
    // Get the selected file
    var file = this.files[0];

    // Send the file value to a JavaScript file or perform further processing
    // Example: Sending the file value to a JavaScript function
    // processFileValue(file);
});

// Function to process the file value
// function processFileValue(file) {
//     // Perform the necessary operations with the file value
//     // Example: Log the file name to the console
//     console.log("Selected file: " + file.name);
// }
$(document).on('click', '#view_mockup', function() {
    $('#view_modal').modal('show');
});
$(document).on('click', '.clickable-row', function() {
    // Get the specific modal ID for the clicked row
    var modalID = $(this).attr('data-modal-id');
    $('#' + modalID).modal('show');
});

$(document).on('click', '#cancel_order', function() {
    if (confirm("Are you sure you want to cancel this order?") == true) {
      $.post({
        url: baseUrl + 'payment/service/Payment_service/cancel_order',
        data: {
            Order_id: $(this).val(),
        },
        success: function(e) {
            var e = JSON.parse(e);
            if (e.has_error == false) {
                toastr.success(e.message);
                setTimeout(function() {
                    window.location.href = base_url+"/dashboard";
                }, 2000);
            } else {
                toastr.error(e.message);
            }
        },
    })
    } else {
      return;
    }
   
});

// november 17
$(document).on('click', '#update_order', function() {
    $('.to_hide_update').hide();
    $('.to_hide_update_2').show();
    $('#cancel_update').show();
    $(this).hide();
    document.querySelectorAll(".to_edit").forEach(element => element.disabled = false);

   
});

$(document).on('click', '#cancel_update', function() {
    $('.to_hide_update').show();
    $('.to_hide_update_2').hide();
    document.querySelectorAll(".to_edit").forEach(element => element.disabled = true);
    $('#update_order').show();
    $(this).hide();
   
});

$(document).on('click', '#delete_item', function() {
    if (confirm("Are you sure you want to delete this item?") == true) {
        $.post({
          url: baseUrl + 'payment/service/Payment_service/delete_item',
          data: {
              Item_id: $(this).data('id'),
              Amount: $(this).data('amount'),
              Qty: $(this).data('qty'),
              Oid: $(this).data('oid'),
          },
          success: function(e) {
              var e = JSON.parse(e);
              if (e.has_error == false) {
                  toastr.success(e.message);
                  setTimeout(function() {
                      window.location.reload();
                  }, 2000);
              } else {
                  toastr.error(e.message);
              }
          },
      })
      } else {
        return;
      }
     
});

$(document).on('click', '#update_item', function() {
    var qty = $('.item_qty_'+$(this).data('id')).val();
    var amount = $('.item_amount_'+$(this).data('id')).val() * qty;

    if (confirm("Are you sure you want to update this item?") == true) {
        $.post({
          url: baseUrl + 'payment/service/Payment_service/update_item',
          data: {
              Item_id: $(this).data('id'),
              Amount: amount,
              Qty: qty,
              Oid: $(this).data('oid'),
          },
          success: function(e) {
              var e = JSON.parse(e);
              if (e.has_error == false) {
                  toastr.success(e.message);
                  setTimeout(function() {
                      window.location.reload();
                  }, 2000);
              } else {
                  toastr.error(e.message);
              }
          },
      })
      } else {
        return;
      }
     
});

// end of november 17