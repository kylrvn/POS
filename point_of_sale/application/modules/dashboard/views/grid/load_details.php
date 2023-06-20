
<?php

if(!empty($details)){
    $curr_date = date('Y-m-d');
    foreach($details as $key => $value){ 
        $d_date = date('Y-m-d',strtotime($value->Deadline));
        ?>
    <tr  onClick="myFunction(<?=$value->Order_ID?>, <?=$value->Customer_ID?>)" >
        <td><?=$key+1?></td>
        <td><?=ucfirst($value->FName)." ".ucfirst($value->LName)." / ".ucfirst($value->Company)?></td>
        <td><?=$value->CNumber?></td>
        <td>
            <?php foreach($value->items as $key => $items){
                $total  = $items->Item_qty * $items->Item_unitprice;
                echo $items->Item_name." x ".$items->Item_qty." = ".number_format($total).'<br>';
            }?>
        </td>
        <td><?=$value->Status?></td>
        <td><?=date('M d, Y', strtotime($value->Book_date))?></td>
        <td class="<?= $curr_date >= $d_date ? 'text-danger text-bold':''?>"><?=date('M d, Y',strtotime($value->Deadline))?></td>
        <td> 
            <?php foreach($value->sewer as $key => $sewer){
                echo ucfirst($sewer->FName)." ".ucfirst($sewer->LName);
            }?>
        </td>
        <td> 
            <?php foreach($value->layout as $key => $layout){
                echo ucfirst($layout->FName)." ".ucfirst($layout->LName);
            }?>
        </td> 
        <td> 
            <?php foreach($value->setup as $key => $setup){
                echo ucfirst($setup->FName)." ".ucfirst($setup->LName);
            }?>
        </td>
        <td><?=number_format($value->Total_amt,2)?></td>
        <td> 
          <?=number_format($value->paid,2)?>
        </td>
        <td> 
          <?=number_format($value->Total_amt - $value->paid,2)?>
        </td>
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
                <td colspan="8">
                    <div><center><h6>No data available in table.</h6></center></div>
                </td>
            </tr>
<?php }


?>
<?php load_table_css(); ?>
