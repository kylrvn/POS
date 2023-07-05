<?php
    $ci = & get_instance();
    if(!empty($details)){
        $pat_fee = 0;
        foreach ($details as $key => $value) {
            $pat_fee = $value->NetAmount * (@$pat_percentage->Value/100);
            ?>

                <tr>
                    <td><?=(@$key+1)?></td>
                    <td><?=@$value->pFname." ".@$value->pLname?></td>
                    <td><?=date('M d, Y', strtotime(@$value->Daterequest))?></td>
                    <!-- <td>₱ <?=number_format(@$value->NetAmount,2)?></td> -->
                    <!-- <td>₱ <?=number_format(@$pat_fee,2)?></td> -->
                    <!-- <td><?=(@$value->SOAnum)?></td> -->
                    <!-- <td><?=(@$value->payStatus)?></td> -->
                    <?php
                        if(@$value->Result == ""){
                           ?><td><p style="color:red">No Result Found</p></td><?php
                        }
                        else{
                            if(($value->Result_viewed == "unseen")){
                                ?> <td><button class="btn btn-primary btn-sm" id="btn_viewresult" value="<?=@$value->ID?>" data-toggle="modal">View Result </button> <span><i class="fa fa-exclamation-circle fa-lg text-danger"></i></span></td><?php
                            }
                            else if(($value->Result_viewed == "seen")){
                                ?> <td><button class="btn btn-primary btn-sm" id="btn_viewresult"  value="<?=@$value->ID?>" data-toggle="modal">View Result </button></td><?php
                            }
                         }
                    ?>
                </tr>
            <?php  
        }        
    }else{
        ?>
            <tr>
                <td colspan="8">
                    <div><center><h6 style="color:red">No Data Found.</h6></center></div>
                </td>
            </tr>
        <?php
        
    }
?>

