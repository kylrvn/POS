$(document).ready(function () {
    $('#n_customer_form').css('display','none');
    $('#s_customer_form').css('display','none');
    $('#c_order').css('display','none');
    $('.cust_details').css('display','none');
    $('#cancel_edit_customer').css('display','none');
    $('#save_edit_customer').css('display','none');
    $('#edit_customer').attr('disabled', 'disabled');
    $('#c_order_2').attr('disabled', 'disabled');

});

$(document).on('click', '#n_customer', function () {
    $('#n_customer_form').css('display','block');
    $('#s_customer_form').css('display','none');
    $('.cust_details').css('display','none');

}); 

$(document).on('click', '#s_customer', function () {
    $('#n_customer_form').css('display','none');
    $('#s_customer_form').css('display','block');
    $('.cust_details').css('display','block');
}); 

// SAVE CUSTOMER DETAILS
$('#save_customer').click(function() {
    $.post({
        url: 'customer/service/Customer_service/save',
        // selector: '.form-control',
        data: {
            FName     : $('#FName').val(),
            LName     : $('#LName').val(),
            Company   : $('#Company').val(),
            CNumber   : $('#CNumber').val(),
            Branch    : $('#Branch').val(),
        },
        success:function(e)
            {
                var e = JSON.parse(e);
                if(e.has_error == false){
                    $('.inpt').attr('disabled', 'disabled');
                    $('#c_order').css('display','inline');
                    $('#submit_customer').css('display','none');
                    $('#modal-default').modal('hide');
                    $('#FName').attr('class', 'form-control inpt');
                    $('#Company').attr('class', 'form-control inpt');
                    toastr.success(e.message);

                    $('#c_order').click(function() {
                        window.location.href = "create_order/index/"+e.cust_id;
                    });

                } else {
                    $('#FName').attr('class', 'form-control inpt is-invalid');
                    $('#Company').attr('class', 'form-control inpt is-invalid');
                    $('#modal-default').modal('hide');
                    toastr.error(e.message); 
                }
        },
    })
});

var load_orders = () => {
    $(document).gmLoadPage({
       url: 'customer/get_orders?id='+$('#search_customer').val(),
       load_on: '#load_orders'
   });
  }
  
var x;

// DISPLAY SEARCHED CUSTOMER
$('#search_customer').change(function() {
    load_orders();
    $.post({
        url: 'customer/get_cust_details',
        // selector: '.form-control',
        data: {
            Cust_id     : $(this).val(),
        },
        success:function(e)
        {
            var e = JSON.parse(e);
           $('#FName_v').val(e.FName);
           $('#LName_v').val(e.LName);
           $('#Company_v').val(e.Company);
           $('#CNumber_v').val(e.CNumber);
           $('#Branch_v').val(e.Branch);
           $('#ID_v').val(e.ID);
           $('#edit_customer').attr('disabled', false);
           $('#c_order_2').attr('disabled', false);

           $('#c_order_2').click(function() {
                window.location.href = "create_order/index/"+ e.ID;
            });

            // CANCEL EDIT CUSTOMER DETAILS
            $('#cancel_edit_customer').click(function() {

                toastr.warning("Update Cancelled"); 
                $('#FName_v').val(e.FName);
                $('#LName_v').val(e.LName);
                $('#Company_v').val(e.Company);
                $('#CNumber_v').val(e.CNumber);
                $('#Branch_v').val(e.Branch);

                $('.inpt_edit').attr('disabled', 'disabled');
                $('#cancel_edit_customer').css('display','none');
                $('#save_edit_customer').css('display','none');
                $('#edit_customer').css('display', 'inline');
                $('#c_order_2').css('display','inline');
            });

        },
    })
});

// EDIT CUSTOMER DETAILS
$('#edit_customer').click(function() {
    $('.inpt_edit').attr('disabled', false);
    $('#cancel_edit_customer').css('display','inline');
    $('#save_edit_customer').css('display','inline');
    $(this).css('display', 'none');
    $('#c_order_2').css('display','none');
});

// SAVE CHANGES
$('#save_edit_customer').click(function() {
    $.post({
        url: 'customer/service/Customer_service/update',
        // selector: '.form-control',
        data: {
            ID     : $('#ID_v').val(),
            FName     : $('#FName_v').val(),
            LName     : $('#LName_v').val(),
            Company   : $('#Company_v').val(),
            CNumber   : $('#CNumber_v').val(),
            Branch    : $('#Branch_v').val(),
        },
        success:function(e)
        {
            var e = JSON.parse(e);
            if(e.has_error == false){
                toastr.success(e.message);
                $('.inpt_edit').attr('disabled', 'disabled');
                $('#cancel_edit_customer').css('display','none');
                $('#save_edit_customer').css('display','none');
                $('#edit_customer').css('display', 'block');
            } else {
                $('#FName_v').attr('class', 'form-control inpt is-invalid');
                $('#Company_v').attr('class', 'form-control inpt is-invalid');
                toastr.error(e.message); 
              
            }
        },
    })
});

function myFunction(e,x){
    window.location.href = "point_of_sale/payment/?custid="+x+'&oid='+e;
}