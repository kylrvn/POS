$(document).ready(function () {

});

var passRowCount = '';
$(document).on('click', '.btn_add_item', function () {
    
    var table = document.getElementById('table_id');
    var row = document.createElement('tr');
    var rowCount = table.rows.length;
    row.innerHTML = '<td style="width: 10px" class="row_num'+rowCount+'">'+rowCount+
    '</td><td class="w-50 item_id" style="word-break:break-word;" id="item_id'+rowCount+'" data-id="'+$(this).data('id')+'">'+$(this).val()+
    '</td><td class="w-25"><input type="number" id="qty'+rowCount+'" class="form-control form-control-sm computation"></td> <td class="w-25"><input type="number" id="amount'+rowCount+
    '" class="form-control form-control-sm computation" ><span><small><b class="text-danger">&#8369</b> </small><cite class="item_subtotal" id="subtotal'+rowCount+
    '"></cite><cite class="item_qty" style="display:none" id="item_qty'+rowCount+
    '"></cite></span></td></td>';
    table.append(row);

    passRowCount = $('.row_num'+rowCount+'').html();
}); 

$(document).on('keyup', '.computation', function () {
    var qty = $('#qty'+passRowCount+'').val();
    var amount = $('#amount'+passRowCount+'').val();

    var subtotal = qty * amount;
    var total = subtotal - discount;

    $('#subtotal'+passRowCount+'').html(subtotal);
    $('#item_qty'+passRowCount+'').html(qty);
    $('#total_amount').html(total.toFixed(2));
    
    calculate_subtotal();
    calculate_qty();
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
        B_date     : $('#b_date').val(),
        Item_id : item_name,
        Item_qty: item_qty,
        Item_amount: item_amount,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            if(e.has_error == false){
                // $('#modal-default').modal('hide');
                toastr.success(e.message);
                // load_list();
                setTimeout(function(){
                  window.location.reload();
              },2000); 

            } else {
            //   $('#List').attr('class', 'form-control inpt is-invalid');
            //   $('#modal-default').modal('hide');
              toastr.error(e.message); 
            }
    },
})

}); 