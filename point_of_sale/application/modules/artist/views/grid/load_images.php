<?php 
    foreach($images as $key => $value){ ?>

    <div class="col-sm-3" >
        <select class="custom-select custom-select-sm rounded-0 select_update" id="order_status" data-order="<?=$value->Order_ID?>">
            <option value="<?=$value->Status_ID?>" selected><?=ucfirst($value->Status)?></option>

            <?php
                foreach($status as $x){ ?>
                    <option value="<?=$x->ID?>" <?=$value->Status_ID == $x->ID ? 'disabled class="text-bold text-danger"' : ''?>><?=ucfirst($x->List_name)?><?=$value->ID == $x->ID ? " (Selected)" : ''?></option>
                <?php }
            ?>
        </select>
        <a href="<?=base_url()?>assets/uploaded/proofs/<?=@$value->Mockup_design?>"  data-toggle="lightbox" data-title="<?=ucfirst(@$value->FName)." ".ucfirst(@$value->LName)." / ".ucfirst(@$value->Company)?>" data-gallery="gallery">
        <img src="<?=base_url()?>assets/uploaded/proofs/<?=@$value->Mockup_design?>" class="img-fluid mb-2" alt="white sample"/>
        </a>
    </div>

  <?php  }



?>



