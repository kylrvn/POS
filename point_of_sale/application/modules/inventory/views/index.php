<?php
main_header(['inventory']);
$session = (object)get_userdata(USER);
// var_dump($session->Branch);
?>
<!-- ############ PAGE START-->
<input hidden id="created_by" value="<?=$session->ID?>">
<input hidden id="branch" value="<?=$session->Branch?>">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inventory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Inventory</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <!-- INVENTORY STOCK IN & OUT -->
        <div class="col-md-3 cust_details" id="">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Stock Input</h3>
                </div>

                <form enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Item</label>
                            <div class="input-group">
                                <select class="form-control select2bs4"  id="item">
                                    <option value="" disabled selected>Select Item</option>
                                    <?php
                                    foreach ($inventory_items as $key => $value) { ?>
                                        <option value="<?= $value->ID."+". $value->List_name?>"><?= $value->List_name ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" id="add_item"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                            <input type="text" hidden class="form-control mt-3" id="new_item" placeholder="Enter Item Name Here"> 
                        </div>


                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="number" id="quantity" class="form-control inpt_edit" placeholder="Quantity">
                        </div>

                        <div class="form-group">
                            <label for="">Stock Type</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width:100%;">
                                <label class="btn bg-green" id="label_color1">
                                  <input type="radio" name="type" value="IN" id="stock_in" checked onclick="stock_type(this)"> IN
                                </label>
                                <label class="btn bg-green" id="label_color2">
                                  <input type="radio" name="type" value="OUT" id="stock_out" onclick="stock_type(this)"> OUT
                                </label>
                            </div>
                        </div>
                        <!-- <div class="form-group" <?=empty($session->Branch) ? '' : 'hidden'?>>
                            <label for="">Insert to Branch</label>
                            <select class="form-control" style="width: 100%;" id="Branch">
                                <option value=""></option>
                                <?php
                                    foreach($branch as $key => $value){ ?>
                                        <option value="<?=$value->List_name?>"><?=$value->List_name?></option>
                                    <?php }
                                ?>
                            </select>
                        </div> -->

                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="add_stock" style="width:100%;">Add to Inventory</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- INVENTORY TABLE -->
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="col-3 ml-auto mb-3">
                                <label for="inventory_table_type">Show:</label>
                                <select class="form-control" id="inventory_table_type">
                                    <option selected value="stocks">Current Inventory</option>
                                    <option value="history">Inventory History</option>
                                </select>
                            </div>
                        </div>
                        <div class="container" id="load_table">
                            <!-- content is loaded from grid -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/inventory/inventory.js"></script>



