<?php
main_header(['expense']);
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Expenses</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Expenses</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <!-- SEARCHED CUSTOMER DEAILS -->
        <div class="col-md-4 cust_details" id="">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Expense</h3>
                </div>

                <form enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" id="date_exp" class="form-control inpt_edit" value="<?=date('Y-m-d')?>" placeholder="Date">
                            <input type="text" id="ID"value="" hidden>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" id="desc" class="form-control inpt_edit" placeholder="Description">
                        </div>


                        <div class="form-group">
                            <label for="">Actual Money</label>
                            <input type="number" id="aamount" class="form-control inpt_edit" placeholder="Actual Money">
                        </div>


                        <!-- <div class="form-group">
                            <label for="">Incharge</label>
                            <input type="text" id="incharge" class="form-control inpt_edit" placeholder="Incharge">
                        </div> -->

                        <div class="form-group act_exp" style="display: none;">
                            <label for="">Actual Expenses</label>
                            <input type="number" id="aexp" class="form-control inpt_edit" placeholder="Actual Expenses">
                        </div>

                        <div class="form-group act_balance" style="display: none;">
                            <label for="">Balance</label>
                            <input type="number" id="balance" class="form-control inpt_edit" placeholder="--.--" disabled>
                        </div>

                        <div class="form-group act_image" style="display: none;">
                            <label for="">Upload Image</label>
                            <input type="file" name="image_input_name" id="image" class="form-control">
                            <input type="text" name="image_input_name" id="image_2" class="form-control">
                        </div>

                        <!-- <div class="form-group">
                            <label for="">Branch</label>
                            <select class="form-control inpt_edit" style="width: 100%;" id="Branch">
                                <option value="Bacolod" selected>Bacolod</option>
                                <option value="Cebu">Cebu</option>
                            </select>
                        </div> -->
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="expbtn">Add</button>
                        <button type="button" class="btn btn-warning" id="expedit" style="display: none">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- CUSTOMERS ORDER HISTORY -->
        <div class="col-md-8">
            <div class="card card-primary">
                <!-- <div class="card-header">
                        <h3 class="card-title">Order History</h3>
                    </div> -->
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-hover text-nowrap table-sm table-striped text-center">
                        <!-- <span style="font-style:italic"><strong>Note: Click row to preview proof of payment</strong></span> -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Incharge</th>
                                <th>Actual Money</th>
                                <th>Actual Expenses</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody id="load_expenses">
                            <?php

                            if (!empty($expenses)) {
                                foreach ($expenses as $key => $value) {
                                    // $d_date = date('Y-m-d',strtotime($value->Deadline));
                                    // $clickableClass = ($value->Mode == 'online payment') ? 'clickable-row' : '';
                            ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= date('M d, Y', strtotime(@$value->Date)) ?></td>
                                        <td><?= ucfirst(@$value->Descr) ?></td>
                                        <td><?= @$value->FName." ".@$value->LName ?></td>
                                        <td><?= number_format(@$value->Actual_Money,2) ?></td>
                                        <td><?= number_format(@$value->expense,2) ?></td>
                                        <td><?= number_format(@$value->Balance,2) ?></td>
                                        <td>
                                            <button class=" btn-primary btn-xs edit_exp" value="<?=$value->ID?>"><i class="fa fa-pencil-alt"></i></button>
                                            <button class=" btn-success btn-xs clickable-row"  data-toggle="modal" data-target="#paymentProofModal" data-img="<?= $value->Image ?>"><i class="fa fa-eye"></i></button>
                                        </td>
                                    </tr>

                                <?php
                                }
                            } else { ?>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="paymentProofModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proof Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/expense/expense.js"></script>