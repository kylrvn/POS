
<table id="example1" class="table table-hover text-nowrap table-sm table-striped text-center" aria-describedby="example1_info">
    <thead>
        <tr>
            <th tabindex="0" rowspan="1" colspan="1">#</th>
            <th tabindex="0" rowspan="1" colspan="1">Item</th>
            <th tabindex="0" rowspan="1" colspan="1">In-Stock</th>
        </tr>
    </thead>
    <tbody>
                                  
        <?php
        $session = (object)get_userdata(USER);
        $inventory_filtered = [];

        if (!empty($inventory)) {
            // Foreach insert only once/unique values
            foreach ($inventory as $value1) {
                if($value1->type == "IN"){
                    $isUnique = true;
                
                    foreach ($inventory_filtered as $value2) {
                        if ($value1->item_ID == $value2->item_ID) {
                            $isUnique = false;
                            break;
                        }
                    }
                
                    if ($isUnique) {
                        $inventory_filtered[] = $value1;
                    }
                }
            }
            // For adding and subracting inventory quantity based on type of inventory
            foreach ($inventory as $value1) {
                foreach ($inventory_filtered as $value2){
                    if($value2->ID != $value1->ID && $value1->type == "IN" && $value2->item_ID == $value1->item_ID){
                        $value2->quantity = $value2->quantity + $value1->quantity;
                        break;
                    }
                    if($value2->ID != $value1->ID && $value1->type == "OUT" && $value2->item_ID == $value1->item_ID){
                        $value2->quantity = $value2->quantity - $value1->quantity;
                        break;
                    }
                }
            }

            // Display inventory quantity
            foreach ($inventory_filtered as $key=> $value){
                // var_dump($value);
                ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td class="text-wrap"><?= @$value->item_name?></td>
                        <td class="text-wrap" style="color: <?=$value->quantity <= 3? 'red' : 'green' ?>;"><b><?= @$value->quantity?></b></td>
                    </tr>
                <?php
            }
             ?>

                    


        <?php } else { ?>
            <tr>
                <td colspan="8">
                    <div>
                        <center>
                            <h6>No data available in table.</h6>
                        </center>
                    </div>
                </td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>

<script>//For Excel, PDF, And Print

    $(function () {
        // Initialize DataTable
        var table = $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 50,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
    });
    
</script>