<div class="card-body table-responsive p-0" style="margin-top:1rem;">
    <table id="example1" class="table table-hover text-wrap table-sm table-striped" style="font-size: 10pt;">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Book Date</th>
                <th>Item</th>
                <th>Amount to Pay</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Proof</th>
                <th>Cashier</th>
                <th>Status</th>
                <th>Waybill Number</th>
                <th>Cash</th>
                <th>Online Payment</th>
                <th>Action</th>
                <td></td>

            </tr>
        </thead>
        <tbody>
            <?php
             $session = (object)get_userdata(USER);
            if(!empty($details)){
                $total_c = 0;
                $total_o = 0;
                foreach($details as $key => $value){ 
                    $value->List_name == "Cash" ? $total_c += $value->P_Amount_paid : $total_o += $value->P_Amount_paid;
                    ?>
                <tr class="<?=$value->List_name == "Online Payment" && $value->P_Verified == 0 ? 'bg-secondary' : ''?>">
                    <td><?=$value->Jo_num?></td>
                    <td><?=date('M d, Y', strtotime($value->P_Date_paid))?></td>
                    <td><?=ucfirst($value->FName)." ".ucfirst($value->LName)." / ".ucfirst($value->Company)?></td>
                    <td><?=date('M d, Y', strtotime($value->Book_date))?></td>
                    <td>
                        <?php foreach($value->items as $key => $items){
                            $total  = $items->Item_qty * $items->Item_unitprice;
                            echo $items->Item_name." x ".$items->Item_qty.'<br>';
                        }?>
                    </td>
                    <td><?=number_format($value->Total_amt,2)?></td>
                    <td> 
                      <?=number_format($value->paid,2)?>
                    </td>
                    <td><?=$value->List_name?></td>
                    <td>   
                        <?php
                            if(empty(@$value->proof->Proof_of_payment)){
                                echo "No uploaded image";
                            } else { ?>
                            <img src="<?php echo base_url(); ?>assets/uploaded/proofs/<?=@$value->proof->Proof_of_payment?>"class="img-fluid w-25 h-25">
                            
                           <?php }
                        ?>
                    </td>
                    <td><?=ucfirst($value->UFName)." ".ucfirst($value->ULName)?></td>
                    <td>
                    <?php
                        if($value->paid == 0){
                            echo '<b class="text-danger text-bold">UNPAID</b>';
                        } elseif($value->paid < $value->Total_amt){
                            echo '<b class="text-primary text-bold">DOWN</b>';
                        } elseif($value->paid >= $value->Total_amt){
                            echo '<b class="text-success text-bold">PAID</b>';
                        }
                    
                    ?>

                    </td>
                   <td>NONE</td>
                   <td><?=$value->List_name == "Cash" ? number_format($value->P_Amount_paid,2) : ''?></td>
                   <td><?=$value->List_name == "Online Payment" ? number_format($value->P_Amount_paid,2) : ''?></td>
                   <td <?=empty($session->Branch) ? '' : 'hidden'?>><button class="btn btn-sm btn-flat btn-danger btn_void" value="<?=$value->P_ID?>">Void</button></td>
                   <td <?=empty($session->Branch) && $value->List_name == "Online Payment" && $value->P_Verified == 0 ? '' : 'hidden'?>><button class="btn btn-sm btn-flat btn-success btn_veri" value="<?=$value->P_ID?>">Verify</button></td>
                    
                </tr>
                    
             <?php  
                 } ?>
                
                 <?php
            } else { ?>
                     <tr>
                            <td colspan="20">
                                <div><center><h6>No data available in table.</h6></center></div>
                            </td>
                        </tr>
            <?php }
            ?>
        </tbody>
        <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td class="text-danger text-bold"><?=@number_format($total_c,2)?></td>
                    <td class="text-danger text-bold"><?=@number_format($total_o,2)?></td>
                    <td></td>
             
                </tr>

    </table>
</div>
<!-- <?php load_table_css(); ?> -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
