
<?php
if(!empty($orders)){

    foreach($orders as $key => $value){ ?>
    <tr  onClick="myFunction(<?=$value->ID?>, <?=$value->Cust_ID?>)" >
        <td><?=$key+1?></td>
        <td><?=date('M d, Y', strtotime($value->Book_date))?></td>
        <td><?=date('M d, Y',strtotime($value->Deadline))?></td>
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
