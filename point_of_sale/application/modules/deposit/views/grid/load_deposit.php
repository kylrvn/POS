<?php
$session = (object)get_userdata(USER);

if (!empty($result)) {
    $total_deposit = 0;
    $total_withdrawal = 0;
    foreach ($result as $key => $value) {
        $total_deposit += @$value->Mode == "Deposit" ? $value->Cash : 0;
        $total_withdrawal += @$value->Mode == "Withdrawal" ? @$value->Cash : 0;
        ?>
            <tr>
                <td><?= $key+1 ?></td>
                <td><?= date('M d, Y', strtotime(@$value->Date)) ?></td>
                <td class="text-wrap"><?= @$value->Mode == "Deposit" ? number_format(@$value->Cash,2) : "-"?></td>
                <td class="text-wrap"><?= @$value->Mode == "Withdrawal" ? number_format(@$value->Cash,2) : ""?></td>
                <td class="text-wrap"><?= ucfirst(@$value->Notes) ?></td>
                <td class="text-wrap"><?= ucfirst($value->FName." ".@$value->LName."(".@$value->Branch.")") ?></td>
                <td>
                    <button class=" btn-danger btn-xs delete" value="<?=$value->ID?>" <?=empty($session->Branch) ? '' : 'hidden'?>><i class="fa fa-trash-alt"></i></button>
                    <button class=" btn-primary btn-xs view_image" value="<?=$value->Proof?>"><i class="fa fa-eye"></i></button>
                </td>
            </tr>

        <?php
    } ?>
    <tr>
        <td></td>
        <td></td>
        <td class="text-danger text-bold"><?=number_format(@$total_deposit,2)?></td>
        <td class="text-danger text-bold"><?=number_format(@$total_withdrawal,2)?></td>
        <td></td>
        <td></td>
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