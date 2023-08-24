$(document).ready(function () {
    // load_expenses();
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
// $('#expbtn').click(function() {

//     $.post({
//         url: 'expense/service/Expense_service/save',
//         // selector: '.form-control',
//         data: {
//             Date_added     : $('#date_exp').val(),
//             Desc     : $('#desc').val(),
//             Actual_money   : $('#aamount').val(),
//             Incharge   : $('#incharge').val(),
//             Actual_Expenses  : $('#aexp').val(),
//             Balance   : $('#balance').val(),
//             Branch    : $('#Branch').val(),
//         },
//         success:function(e)
//             {
//                 var e = JSON.parse(e);
//                 if(e.has_error == false){
//                     toastr.success(e.message);
//                 } else {
//                     toastr.error(e.message); 
//                 }
//         },
//     })
// });

$(document).on('click', '.edit_exp', function () {
  $('.act_exp').css('display','inline');
  $('.act_balance').css('display','inline');
  $('.act_image').css('display','inline');
  editFunction($(this).val());
}); 

var editFunction = (x) => {
  $.post({
    url: 'expense/get_expense_details',
    // selector: '.form-control',
    data: {
        exp_id : x,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            $('#date_exp').val(e.Date);
            $('#desc').val(e.Descr);
            $('#aamount').val(e.Actual_Money);
            $('#aexp').val(e.expense);
            $('#balance').val(e.Balance);
            $('#ID').val(e.ID);
            $('#image_2').val(e.Image);
            
            $('#expbtn').css('display','none');
            $('#expedit').css('display','inline');
            // $('#Reset').css('display','inline');
    },
  })
}

$("#expbtn").click(function () {
    // Get the values from the form inputs
    var date = $("#date_exp").val();
    var description = $("#desc").val();
    var actualMoney = $("#aamount").val();
    var incharge = $("#incharge").val();
    var actualExpenses = $("#aexp").val();
    var balance = $("#balance").val(); // Since it's disabled, you may not want to include this here
    var branch = $("#Branch").val();
  
    // Get the uploaded image file
    var imageFile = $("#image")[0].files[0]; // This will get the first selected file (you can add validation if needed)
  
    // Create a FormData object to send both form data and the image
    var formData = new FormData();
    formData.append("Date_added", date);
    formData.append("Desc", description);
    formData.append("Actual_money", actualMoney);
    formData.append("Incharge", incharge);
    formData.append("Actual_Expenses", actualExpenses);
    formData.append("Balance", balance);
    formData.append("Branch", branch);
    formData.append("image", imageFile);
  
    // Use AJAX to send the form data and image to the server
    $.ajax({
      type: "POST",
      url: "expense/service/Expense_service/save",
      data: formData,
      processData: false, // Prevent jQuery from processing the data (important for file uploads)
      contentType: false, // Prevent jQuery from automatically setting the Content-Type header
      success: function (response) {
        var e = JSON.parse(response);
        if (e.has_error == false) {
          toastr.success(e.message);
        } else {
          toastr.error(e.message);
        }
        setTimeout(function() {
          window.location.reload();
      }, 2000);
      },
      error: function () {
        toastr.error("An error occurred during the upload.");
      },
    });
  });

  $("#expedit").click(function () {
   
    // Get the values from the form inputs
    var date = $("#date_exp").val();
    var description = $("#desc").val();
    var actualMoney = $("#aamount").val();
    var incharge = $("#incharge").val();
    var actualExpenses = $("#aexp").val();
    var balance = $("#balance").val(); // Since it's disabled, you may not want to include this here
    var branch = $("#Branch").val();
    var ID = $("#ID").val();
    var image_2 = $("#image_2").val();
  
    // Get the uploaded image file
    var imageFile = $("#image")[0].files[0]; // This will get the first selected file (you can add validation if needed)
  
    // Create a FormData object to send both form data and the image
    var formData = new FormData();
    formData.append("image_2", image_2);
    formData.append("ID", ID);
    formData.append("Date_added", date);
    formData.append("Desc", description);
    formData.append("Actual_money", actualMoney);
    formData.append("Incharge", incharge);
    formData.append("Actual_Expenses", actualExpenses);
    formData.append("Balance", balance);
    formData.append("Branch", branch);
    formData.append("image", imageFile);
  
    // Use AJAX to send the form data and image to the server
    $.ajax({
      type: "POST",
      url: base_url + "expense/service/Expense_service/edit",
      data: formData,
      processData: false, // Prevent jQuery from processing the data (important for file uploads)
      contentType: false, // Prevent jQuery from automatically setting the Content-Type header
      success: function (response) {
        var e = JSON.parse(response);
        if (e.has_error == false) {
          toastr.success(e.message);
        } else {
          toastr.error(e.message);
        }
        setTimeout(function() {
          window.location.reload();
      }, 2000);
      },
      error: function () {
        toastr.error("An error occurred during the upload.");
      },
    });
  });
  
  $(document).on('click', '.clickable-row', function() {
    var img = $(this).data('img');
    console.log(img);
    var imgTag = '<img id="paymentProofImage" src="'+base_url+'assets/uploaded/proofs/'+ img +'" alt="Proof of Receipt" class="img-fluid">';
    $('.modal-body').html(imgTag);
    $('#paymentProofModal').modal('show');
    // alert();
  });

  function sampleFunction(e,x){
    // window.location.href = base_url+"point_of_sale/payment/?custid="+x+'&oid='+e;
    // alert();
}