<div class="card-body table-responsive p-0" style="margin-top:1rem;">
    <table id="example1" class="table table-hover text-nowrap table-sm table-striped text-center" style="font-size: 10pt;">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Customer Details</th>
                <!-- <th>Contact Number</th> -->
                <th>Mockup Design</th>
                <th>Status</th>
                <th>Dates</th>
                <!-- <th>Deadline</th> -->
                <th>Assignee</th>
                <!-- <th>Layout Artist</th>
                <th>Setup Artist</th> -->
                <th>In-Charge</th>
                <th>Items</th>
                <!-- <th>Total Amount</th>
                <th>Received Payment</th>
                <th>Balance</th> -->
                <th>Payment Status</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $session = (object)get_userdata(USER);
            
            if(!empty($details)){
                $curr_date = date('Y-m-d');
                foreach($details as $key => $value){ 
                    $d_date = date('Y-m-d',strtotime($value->Deadline));
                    $fivedays = date("Y-m-d", strtotime("-5 days", strtotime($curr_date)));
                    ?>
            
                    <?php 
                        if($session->Role == "Production Manager"){ ?>
                            <tr>
                     <?php } else { ?>
                        <tr  onClick="myFunction(<?=$value->Order_ID?>, <?=$value->Customer_ID?>)" >
                    <?php } ?>
                    
                    <!-- <td><?=$key+1?></td> -->
                    <td><?=$value->Jo_num?></td>
                    <td><?=ucfirst($value->FName)." ".ucfirst($value->LName)." / ".ucfirst($value->Company)?></br><?=$value->CNumber?></td>
                    <td>   
                        <?php
                            if(empty(@$value->mock_up->Mockup_design)){
                                echo "File Not Found";
                            } else { ?>
                            <img src="<?php echo base_url(); ?>assets/uploaded/proofs/<?=@$value->mock_up->Mockup_design?>"class="img-fluid">
                            
                           <?php }
                        ?>
                    </td>
                    <td class="text-wrap"><?=$value->Status?></td>
                    <td>
                        Book date: <?=date('M d, Y', strtotime($value->Book_date))?>
                            </br>
                        <p class="
                            <?php
                                    if($value->paid >= $value->Total_amt){
                                        echo 'text-bold';
                                    } else if($curr_date >= $d_date){
                                        echo 'text-indigo text-bold';
                                    }
                                    else if($fivedays <= $d_date){
                                        echo "text-danger text-bold";
                                    }
                                ?>
                                ">
                            Deadline: <?=date('M d, Y',strtotime($value->Deadline))?>
                        </p>
                    </td>
                    <td> 
                        <?php foreach($value->sewer as $key => $sewer){
                            echo "Sewer: ".ucfirst($sewer->FName)." ".ucfirst($sewer->LName);
                        }?>
                        <br>
                        <?php foreach($value->layout as $key => $layout){
                            echo "Layout: ".ucfirst($layout->FName)." ".ucfirst($layout->LName);
                        }?>
                        <br>
                        <?php foreach($value->setup as $key => $setup){
                            echo "Setup: ".ucfirst($setup->FName)." ".ucfirst($setup->LName);
                        }?>
                    </td>
                    <td><?= $value->SA_Fname . " " . $value->SA_Lname?></td>
                    <td>
                        <?php foreach($value->items as $key => $items){
                            $total  = $items->Item_qty * $items->Item_unitprice;
                            echo $items->Item_name." x ".$items->Item_qty." x ".number_format($items->Item_unitprice,2).'<br>';
                        }?>
                    </td>
                    <!-- <td><?=number_format($value->Total_amt,2)?></td>
                    <td> 
                      <?=number_format($value->paid,2)?>
                    </td>
                    <td> 
                      <?=number_format($value->Total_amt - $value->paid,2)?>
                    </td> -->
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
                    
                </tr>
                    
             <?php  
                 }
            } else { ?>
                     <tr>
                            <td colspan="20">
                                <div><center><h6>No data available in table.</h6></center></div>
                            </td>
                        </tr>
            <?php }
            
            
            ?>
            <!-- <?php load_table_css(); ?> -->
        </tbody>
    </table>
</div>

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
