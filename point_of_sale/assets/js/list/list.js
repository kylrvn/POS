var load_list = () => {
    $(document).gmLoadPage({
       url: 'management/load_list',
       load_on: '#load_list'
   });
 }

 var load_user = () => {
  $(document).gmLoadPage({
     url: 'management/load_user',
     load_on: '#load_user'
 });
}

 
 $(document).ready(function () {
   load_list();
   load_user();
});

// SAVE CUSTOMER DETAILS
$('#save_list').click(function() {
  $.post({
      url: 'management/service/Management_service/save_list',
      // selector: '.form-control',
      data: {
          List_name     : $('#List').val(),
          List_category : $('#Category').val(),
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_list();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#List').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

// SAVE USER DETAILS
$('#save_user').click(function() {
  $.post({
      url: 'service/Management_service/save_user',
      // selector: '.form-control',
      data: {
          FName     : $('#FName').val(),
          LName     : $('#LName').val(),
          Username     : $('#UName').val(),
          Branch     : $('#Branch').val(),
          Role     : $('#Role').find(':selected').data('id'),
          Role_name     : $('#Role').find(':selected').data('role')
          
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#LName').attr('class', 'form-control inpt is-invalid');
                $('#FName').attr('class', 'form-control inpt is-invalid');
                $('#UName').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

var editFunction = (x) => {
  $.post({
    url: 'management/get_user_details',
    // selector: '.form-control',
    data: {
        user_id : x,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            $('#LName').val(e.LName);
            $('#FName').val(e.FName);
            $('#UName').val(e.Username);
            $('#Role').val(e.Role);
            $('#Branch').val(e.Branch);
            $('#Update').val(e.U_ID);
            $('#delete_user').val(e.U_ID);
            $('#reset_pass').val(e.U_ID);
            
            $('#Save').css('display','none');
            $('#Update').css('display','inline');
            $('#Reset').css('display','inline');
            $('#Delete').css('display','inline');
    },
  })
}

var editFunctionList = (x) => {
  $.post({
    url: 'management/get_list_details',
    // selector: '.form-control',
    data: {
        list_id : x,
    },
    success:function(e)
        {
            var e = JSON.parse(e);
            $('#List').val(e.List_name);
            $('#Category').val(e.List_category);
            var x = document.getElementById("List").disabled = true;
            var y = document.getElementById("Category").disabled = true;
            $('#delete_list').val(e.ID);
            
            $('#Save').css('display','none');
            $('#Delete').css('display','inline');
    },
  })
}

$('#Update').click(function() {
  $.post({
      url: 'service/Management_service/update_user',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
          FName     : $('#FName').val(),
          LName     : $('#LName').val(),
          Username     : $('#UName').val(),
          Branch     : $('#Branch').val(),
          Role     : $('#Role').find(':selected').data('id'),
          Role_name     : $('#Role').find(':selected').data('role')
          
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#LName').attr('class', 'form-control inpt is-invalid');
                $('#FName').attr('class', 'form-control inpt is-invalid');
                $('#UName').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});

$('#delete_user').click(function() {
  $.post({
      url: 'service/Management_service/delete_user',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
          
      },
      success:function(e)
          {
          var e = JSON.parse(e);
          if(e.has_error == false){
              $('#modal-default').modal('hide');
              toastr.success(e.message);
              load_user();
              setTimeout(function(){
                window.location.reload();
            },2000); 

          } 
      },
  })
});

$('#delete_list').click(function() {
  $.post({
      url: 'management/service/Management_service/delete_list',
      // selector: '.form-control',
      data: {
          ID: $(this).val(),
          
      },
      success:function(e)
          {
          var e = JSON.parse(e);
          if(e.has_error == false){
              $('#modal-default').modal('hide');
              toastr.success(e.message);
              load_list();
              setTimeout(function(){
                window.location.reload();
            },2000); 

          } 
      },
  })
});

$('#reset_pass').click(function() {
  $.post({
      url: 'service/Management_service/reset',
      // selector: '.form-control',
      data: {
          U_ID: $(this).val(),
      },
      success:function(e)
          {
              var e = JSON.parse(e);
              if(e.has_error == false){
                  $('#modal-default').modal('hide');
                  toastr.success(e.message);
                  load_user();
                  setTimeout(function(){
                    window.location.reload();
                },2000); 

              } else {
                $('#LName').attr('class', 'form-control inpt is-invalid');
                $('#FName').attr('class', 'form-control inpt is-invalid');
                $('#UName').attr('class', 'form-control inpt is-invalid');
                $('#modal-default').modal('hide');
                toastr.error(e.message); 
              }
      },
  })
});