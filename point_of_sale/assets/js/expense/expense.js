$(document).ready(function () {
    load_expenses();
})

//load expenses table/grid
var load_expenses = () => {
    $(document).gmLoadPage({
       url: 'expense/get_expenses',
       load_on: '#load_expenses'
   });
  }

//compute balance onchange
$(document).on('keyup', '#aexp', function () {
    var money = $('#aamount').val();
    var expense = $('#aexp').val();
    var balance = 0;

    balance = money-expense;
    $("#balance").val(balance.toFixed(2));
}); 

//save expenses
$('#expbtn').click(function() {

    $.post({
        url: 'expense/service/Expense_service/save',
        // selector: '.form-control',
        data: {
            Date_added     : $('#date_exp').val(),
            Desc     : $('#desc').val(),
            Actual_money   : $('#aamount').val(),
            Incharge   : $('#incharge').val(),
            Actual_Expenses  : $('#aexp').val(),
            Balance   : $('#balance').val(),
            Branch    : $('#Branch').val(),
        },
        success:function(e)
            {
                var e = JSON.parse(e);
                if(e.has_error == false){
                    toastr.success(e.message);
                } else {
                    toastr.error(e.message); 
                }
        },
    })
});
