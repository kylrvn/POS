  <?php
    if (!empty($monthly)) {
        foreach ($monthly as $key => $value) { ?>
          <tr class="custom-row">
              <td>
                  <div data-sales="<?= $value->total ?>"></div>
                  <div data-expenses=""></div>
                  <div data-profit=""></div>
                  <?= date('F', strtotime($value->Date_paid)) ?>
              </td>
              <td>&#8369 <?= number_format($value->total, 2) ?></td>
              <td>&#8369 
                <?php 
                $expense_total = 0;
                  foreach($expense as $key => $exp){
                    if(date('F', strtotime($value->Date_paid)) == date('F', strtotime($exp->Date))){
                      echo number_format($exp->totalexpense, 2);
                      $expense_total=$exp->totalexpense;
                    }
                  }
                ?>

              </td>
              <td>&#8369 <?= number_format($value->total - $expense_total, 2) ?></td>
          </tr>
      <?php }
    } else {
        ?>
      <tr>
          <td colspan="4">NO DATA</td>
      </tr>
  <?php } ?>
