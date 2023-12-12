<?php
$session = (object)get_userdata(USER);

if (!empty($result)) {
    foreach ($result as $key => $value) {
        ?>
            <tr>
                <td><?= $key+1 ?></td>
                <td><?= date('M d, Y', strtotime(@$value->Date)) ?></td>
                <td class="text-wrap"><?= number_format(@$value->Cash,2)?></td>
                <td class="text-wrap"><?= ucfirst(@$value->Notes) ?></td>
                <td>
                    <button class=" btn-primary btn-xs edit_exp" value="<?=$value->ID?>"><i class="fa fa-pencil-alt"></i></button>
                </td>
            </tr>

        <?php
    } ?>

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