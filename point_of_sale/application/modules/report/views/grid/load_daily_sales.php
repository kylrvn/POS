
<?php

if(!empty($details)){
    $total_c = 0;
    $total_o = 0;
    foreach($details as $key => $value){ 
        $value->List_name == "Cash" ? $total_c += $value->P_Amount_paid : $total_o += $value->P_Amount_paid;
        ?>
    <tr >
      <!-- <td><?=$value->P_ID?></td> -->
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
       <td><button class="btn btn-sm btn-flat btn-danger btn_void" value="<?=$value->P_ID?>">Void</button></td>
    </tr>

 <?php  
     } ?>
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
        <td><b>Total</b></td>
        <td class="text-danger text-bold"><?=number_format($total_c,2)?></td>
        <td class="text-danger text-bold"><?=number_format($total_o,2)?></td>
    </tr>
     <?php
} else { ?>
         <tr>
                <td colspan="20">
                    <div><center><h6>No data available in table.</h6></center></div>
                </td>
            </tr>
<?php }



?>
<?php load_table_css(); ?>
