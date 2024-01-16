
<table id="example1" class="table table-hover text-nowrap table-sm table-striped text-center" aria-describedby="example1_info">
    <thead>
        <tr>
            <th tabindex="0" rowspan="1" colspan="1">#</th>
            <th tabindex="0" rowspan="1" colspan="1">Date</th>
            <th tabindex="0" rowspan="1" colspan="1">Item</th>
            <th tabindex="0" rowspan="1" colspan="1">Type</th>
            <th tabindex="0" rowspan="1" colspan="1">Quantity</th>
            <th tabindex="0" rowspan="1" colspan="1">Entered By</th>
        </tr>
    </thead>
    <tbody>
                                  
        <?php
        $session = (object)get_userdata(USER);

        if (!empty($history)) {
            foreach ($history as $key => $value) {
                ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= date('M d, Y', strtotime(@$value->date_created)) ?></td>
                        <td class="text-wrap"><?= ucfirst(@$value->item_name) ?></td>
                        <td class="text-wrap" style="color: <?=$value->type == "IN"? 'green': 'red'?>"><?=$value->type?></td>
                        <td class="text-wrap" style="color: <?=$value->type == "IN"? 'green': 'red'?>"><?=$value->quantity?></td>
                        <td class="text-wrap"><?= @$value->FName." ".@$value->LName ?></td>
                    </tr>

                <?php
            } ?>


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