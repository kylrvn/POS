
<?php

if(!empty($orders)){
    $curr_date = date('Y-m-d');
    foreach($orders as $key => $value){ 
        $d_date = date('Y-m-d',strtotime($value->Deadline));
        ?>
    <!-- <tr  onClick="myFunction(<?=$value->ID?>, <?=$value->Cust_ID?>)" > -->
    <tr>
        <!-- <td><?=$key+1?></td> -->
        <td><?=$value->Jo_num?></td>
        <td><?= date('M d, Y',strtotime($value->Book_date))?></td>
        <td class="<?= $curr_date >= $d_date ? 'text-danger text-bold':''?>"><?=date('M d, Y',strtotime($value->Deadline))?></td>
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
        <!-- <td><?=$value->Payment_status?></td> -->
        <td><button type="button" data-oid="<?=@$value->ID?>" id="view_mockup_customer" class="btn btn-xs btn-primary">View <i class="fa fa-eye"></i></button></td>
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
