<?php
$session = (object)get_userdata(USER);

if (!empty($expenses)) {
    $total_act = 0;
    $total_exp = 0;
    foreach ($expenses as $key => $value) {
            // $d_date = date('Y-m-d',strtotime($value->Deadline));
            // $clickableClass = ($value->Mode == 'online payment') ? 'clickable-row' : '';
            $total_act += $value->Actual_Money;
            $total_exp += $value->expense;
        ?>
            <tr>
                <td><?= $key+1 ?></td>
                <td><?= date('M d, Y', strtotime(@$value->Date)) ?></td>
                <td class="text-wrap"><?= ucfirst(@$value->Descr) ?></td>
                <td class="text-wrap"><?= @$value->FName." ".@$value->LName ?></td>
                <td class="text-wrap"><?=empty($value->e_Branch) ? $value->u_branch : $value->e_Branch?></td>
                <td><?= number_format(@$value->Actual_Money,2) ?></td>
                <td><?= number_format(@$value->expense,2) ?></td>
                <td><?= number_format(@$value->Balance,2) ?></td>
                <td>
                    <button class=" btn-primary btn-xs edit_exp" value="<?=$value->ID?>"><i class="fa fa-pencil-alt"></i></button>
                    <button class=" btn-success btn-xs clickable-row"  data-toggle="modal" data-target="#paymentProofModal" data-img="<?= $value->Image ?>"><i class="fa fa-eye"></i></button>
                    <button <?=empty($session->Branch) ? '' : 'hidden'?> class="btn btn-xs btn-danger btn_void_exp" value="<?=$value->ID?>">Void</button></td>
                </td>
            </tr>

        <?php
    } ?>

    <tr>                     
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-bold text-danger"><?= number_format(@$total_act,2)?></td>
        <td class="text-bold text-danger"><?= number_format(@$total_exp,2)?></td>
        <td class="text-bold text-danger"><?= number_format(@$total_act - $total_exp,2)?></td>
        <td></td>
    </tr>
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