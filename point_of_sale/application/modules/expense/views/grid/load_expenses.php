
<?php

if(!empty($expenses)){
    foreach($expenses as $key => $value){ 
        // $d_date = date('Y-m-d',strtotime($value->Deadline));
        ?>
    <tr>
        <td><?=@$key+1?></td>
        <td><?= date('M d, Y',strtotime(@$value->Date))?></td>
        <td><?=@$value->Descr?></td>
        <td><?=number_format(@$value->Actual_Money,2)?></td>
        <td><?=@$value->FName." ".@$value->LName?></td>
        <td><?=number_format(@$value->expense,2)?></td>
        <td><?=number_format(@$value->Balance,2)?></td>
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