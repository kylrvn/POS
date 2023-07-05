<?php
    if (!empty($ilist)) {
        foreach ($ilist as $key => $value) { ?>
          <tr class="item-row">
              <td><?= $key+1 ." . "?></td>
              <td><?= $value->item_name ?></td>
              <td><?= $value->Quantity?></td>
          </tr>
      <?php }
    } else {
        ?>
      <tr>
          <td colspan="3">NO DATA</td>
      </tr>
  <?php } ?>