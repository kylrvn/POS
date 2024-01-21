var searchInput;
var searchText;

function capitalizeWord(word) {
    let capitalizedWord = '';
    
    for (let i = 0; i < word.length; i++) {
      capitalizedWord += word[i].toUpperCase();
    }
    
    return capitalizedWord;
}

// document.getElementById('new_item').addEventListener('input', function() {
//     // Convert the entered text to uppercase
//     this.value = this.value.toUpperCase();
// });

var load_inventory = () => {
    $(document).gmLoadPage({
        url: 'inventory/load_inventory',
        load_on: '#load_table'
    });
}

var load_inventory_history = () => {
    $(document).gmLoadPage({
        url: 'inventory/load_inventory_history',
        load_on: '#load_table'
    });
}

// Get the text typed into the item search filter
$('.select2bs4').on('select2:open', function (e) {
    searchInput = $('.select2-search__field');

    searchInput.on('input', function () {
      searchText = $(this).val();
    //   searchText = capitalizeWord(searchText);
    });
});

$(document).ready(function () {
    load_inventory();
})

$(document).on('change', '#inventory_table_type', function () {
    if($('#inventory_table_type').val() == "stocks"){
        load_inventory();
    }
    else{
        load_inventory_history();
    }
}); 

function stock_type(element){
    if (element.id == "stock_in"){
        document.getElementById('label_color1').classList.remove('bg-red');
        document.getElementById('label_color1').classList.add('bg-green');
        
        document.getElementById('label_color2').classList.remove('bg-red');
        document.getElementById('label_color2').classList.add('bg-green');
    }
    else{
        document.getElementById('label_color1').classList.remove('bg-green');
        document.getElementById('label_color1').classList.add('bg-red');
        
        document.getElementById('label_color2').classList.remove('bg-green');
        document.getElementById('label_color2').classList.add('bg-red');
    }
}

// ADD STOCK FUNCTION
$(document).on('click', '#add_stock', function () {
    // Existing Item
    if($('#new_item').val() == null || $('#new_item').val() == ""){
        // alert($('#item').val()+$('[name="type"]:checked').val()+$('#quantity').val());
        let item_id = $('#item').val().split('+')[0];
        let item_name = $('#item').val().split('+')[1];
        $.ajax({
            type: 'POST',
            url: base_url + 'inventory/service/inventory_service/add_existing_item',
            data: {
                item_ID: item_id,
                item_name: item_name,
                type: $('[name="type"]:checked').val(),
                quantity: $('#quantity').val(),
                created_by: $('#created_by').val(),
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.has_error == true){
                    toastr.error(response.message);
                }
                else{
                    document.getElementById('quantity').value = "";
                    toastr.success(response.message);
                    load_inventory();
                }
            },
        })
    }
    // New Item
    else{
        // alert($('#new_item').val()+$('[name="type"]:checked').val()+$('#quantity').val());
        $.ajax({
            type: 'POST',
            url: base_url + 'inventory/service/inventory_service/add_new_item',
            data: {
                new_item_name: $('#new_item').val(),
            },
            success: function (response) {
                var response = JSON.parse(response);
                // console.log();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'inventory/service/inventory_service/add_existing_item',
                    data: {
                        item_ID: response.insert_ID,
                        item_name: response.item_name[0].List_name,
                        type: $('[name="type"]:checked').val(),
                        quantity: $('#quantity').val(),
                        created_by: $('#created_by').val(),
                    },
                    success: function (response) {
                        var response = JSON.parse(response);
                        if(response.has_error == true){
                            toastr.error(response.message);
                        }
                        else {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                })
            },
        })
    }

    // Clear Values
    document.getElementById('new_item').hidden = true;
    document.getElementById('new_item').value = "";
    searchText="";

    // Reload When New Item Is Added
    // if (item_added == true){
    //     location.reload();
    // }
}); 

// ADD ITEM FUNCTION
$(document).on('click', '#add_item', function () {
//  alert(searchText);
    document.getElementById('new_item').hidden = false;

    if(searchText == undefined || searchText == null || searchText == ""){
        document.getElementById('new_item').value = "";
    }
    else{
        document.getElementById('new_item').value = searchText;
    }
}); 
