
var load_images = () => {
    $(document).gmLoadPage({
       url: 'artist/get_images',
       load_on: '#load_images'
   });
  }
  


$(document).ready(function () {
    load_images();
});



// $('#order_status').change(function() {
//    alert();
// });

$(document).on('change', '#order_status', function () {
    var status = $(this).val();
    var order_id = $(this).data('order');

        $.post({
        url: base_url+'artist/update_status',
        // selector: '.form-control',
        data: {
            status     : status,
            order_id     : order_id,
           
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