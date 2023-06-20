$(document).ready(function () {
    $('#bill').css('display','none');
    $('#proceed_payment').css('display','none');


});
passRowCount = '';
$(document).on('click', '.btn_add_item', function () {
    
    var table = document.getElementById('table_id');
    var i_id = $(this).data('id');
    var row = document.createElement('tr');
    var rowCount = table.rows.length;
    row.setAttribute("id", 'row_'+i_id+'');
    row.innerHTML = '<td style="width: 10px" id="row_'+i_id+'" class="row_num'+rowCount+'">'+rowCount+
    '</td><td class="w-50 item_id" data-id="'+i_id+'"style="word-break:break-word;">'+$(this).val()+
    '</td><td class="w-25"><input type="number" class="form-control qty_'+i_id+' computation" data-qty="'+i_id+'">'+
    '</td><td class="w-25"><input type="number" class="form-control amount computation" data-id="'+i_id+'">'+
    '<span><small><b class="text-danger">&#8369</b> </small><cite class="item_subtotal" id="subtotal'+i_id+
    '"></cite><cite class="item_qty"  style="display:none" id="item_qty'+i_id+
    '"></cite></span></td>'+
    '<td><a role="button" id="del_row" class="text-danger text-bold del_row" data-row="'+i_id+'">x<a></td>';
    table.append(row);

}); 

$(document).on('keyup', '.computation', function () {
    var y = $(this).data('id');
    var amnt = $(this).val();
    var qty = $('.qty_'+y+'').val();

    var subtotal = qty * amnt;
    var total = subtotal - discount;

    $('#subtotal'+y+'').html(subtotal);
    
    $('#item_qty'+y+'').html(qty);
    $('#total_amount').html(total.toFixed(2));
    
    calculate_subtotal();
    calculate_qty();
}); 

$(document).on('keyup', '#discount', function () {
    calculate_subtotal();
}); 

$(document).on('click', '.del_row', function () {
    var y = $(this).data('row');
    $('#row_' + y).remove();
    calculate_subtotal();
    calculate_qty();

    // alert(y);
}); 

function calculate_subtotal() {
    var items_subtotal = parseFloat(0);
    var items = document.getElementsByClassName('item_subtotal');
    var discount = $('#discount').val();

    for(var i=0; i < items.length; i++){
        items_subtotal += parseFloat(items[i].innerHTML);
    }
    
    var total = items_subtotal - discount;

    items_subtotal = Math.round((items_subtotal + Number.EPSILON) * 100) / 100;
    $('#all_subtotal').val(items_subtotal);
    $('#total_amount').html(total);
}

function calculate_qty() {
    var items_qty = parseFloat(0);
    var qty = document.getElementsByClassName('item_qty');

    for(var i=0; i < qty.length; i++){
        items_qty +=  parseFloat(qty[i].innerHTML);
    }
    
    $('#t_qty').val(items_qty);
}



$(document).on('click', '#save_items', function () {
    
        // item ID
    var items = document.getElementsByClassName('item_id');
    var item_name = [];
    for(var i=0; i < items.length; i++){
        var items_id = $(items[i]).data('id');
        item_name.push(items_id);
    }

        // item qty
    var items_qty = parseFloat(0);
    var qty = document.getElementsByClassName('item_qty');
    var item_qty = [];
    for(var i=0; i < qty.length; i++){
        items_qty =  parseFloat(qty[i].innerHTML);
        item_qty.push(items_qty);
    }
  
    // item price
    var items_subtotal = parseFloat(0);
    var items = document.getElementsByClassName('item_subtotal');
    var item_amount = [];

    for(var i=0; i < items.length; i++){
        items_subtotal = parseFloat(items[i].innerHTML);
        item_amount.push(items_subtotal);
    }

$.post({
    url: base_url + 'create_order/service/Create_order_service/save_order',
    // selector: '.form-control',
    data: {
        ID     : $('#cust_id').val(),
        Qty     : $('#t_qty').val(),
        Total     : $('#total_amount').html(),
        Subtotal : $('#all_subtotal').val(),
        Discount : $('#discount').val(),
        B_date     : $('#b_date').val(),
        D_date     : $('#d_date').val(),
        D_notes: $('#d_notes').val(),
        B_notes: $('#b_notes').val(),
        Freebies: $('#freebies').val(),
        Item_id : item_name,
        Item_qty: item_qty,
        Item_amount: item_amount,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            if(e.has_error == false){
                $('#modal-default').modal('hide');
                toastr.success(e.message);
                $('#save').css('display','none');
                $('#bill').css('display','inline');
                $('#proceed_payment').css('display','block');
                $('.form-control').attr('disabled','disabled');
                $('.btn_add_item').attr('disabled','disabled');
                
                $('#proceed_payment').click(function() {
                    window.location.href = base_url+"point_of_sale/payment/?custid="+$('#cust_id').val()+'&oid='+e.id;
                });

            } else {
            //   $('#List').attr('class', 'form-control inpt is-invalid');
              $('#modal-default').modal('hide');
              toastr.error(e.message); 
            }
    },
})

}); 