$(document).ready(function () {
  load_deposit();
})

//load expenses table/grid
var load_deposit = () => {
  $(document).gmLoadPage({
     url: 'deposit/get_deposit',
     load_on: '#load_deposit'
 });
}

$("#add").click(function () {
    // Get the values from the form inputs
    var date = $("#date").val();
    var note = $("#notes").val();
    var cash = $("#cash").val();
    var mode = $("#Mode").val();
    
    // Get the uploaded image file
    var imageFile = $("#image")[0].files[0]; // This will get the first selected file (you can add validation if needed)
  
    // Create a FormData object to send both form data and the image
    var formData = new FormData();
    formData.append("Date", date);
    formData.append("Note", note);
    formData.append("Cash", cash);
    formData.append("Mode", mode);
    formData.append("image", imageFile);
  
    // Use AJAX to send the form data and image to the server
    $.ajax({
      type: "POST",
      url: "deposit/service/Deposit_service/save",
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
      load_deposit();
      $("#total_deposit").load(" #total_deposit");
      $("#total_undeposit").load(" #total_undeposit");
      $("#total_profit").load(" #total_profit");
      // $("#total_withdrawal").load(" #total_withdrawal");

      },
      error: function () {
        toastr.error("An error occurred during the upload.");
      },
    });
  });

$(document).on('click', '.delete', function() {
  if (confirm("Are you sure you want to delete this?") == true) {
    $.post({
      url: base_url+'deposit/service/Deposit_service/delete',
      data: {
          Deposit_id: $(this).val(),
      },
      success: function(e) {
          var e = JSON.parse(e);
          if (e.has_error == false) {
              toastr.success(e.message);
            load_deposit();
            $("#total_deposit").load(" #total_deposit");
            $("#total_undeposit").load(" #total_undeposit");
            $("#total_profit").load(" #total_profit");
            // $("#total_withdrawal").load(" #total_withdrawal");
          } else {
              toastr.error(e.message);
          }
      },
  })
  } else {
    return;
  }
  
});


$(document).on('click', '.view_image', function() {
  const features = 'width=800,height=800,scrollbars=yes';

  var imageUrl = base_url+"assets/uploaded/proofs/"+$(this).val();
var htmlContent = `
    <img src="${imageUrl}" alt="Your Image">
`;

var newWindow = window.open("", 'PopupWindow', features);
newWindow.document.write(htmlContent);
newWindow.document.close();

});

$(document).on('click', '#submit_filter_deposit', function() {
  
  $(document).gmLoadPage({
      url:  base_url+'deposit/get_deposit',
      data: {
          d_from: $('#d_from').val(),
          d_to: $('#d_to').val(),
          branch: $('#branch_filter').val(), 
      },
      load_on: "#load_deposit",
  })

});