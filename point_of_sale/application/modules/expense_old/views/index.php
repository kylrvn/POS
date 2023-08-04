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

                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" id="date_exp" class="form-control inpt_edit" placeholder="Date" value="<?=date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" id="desc" class="form-control inpt_edit" placeholder="Description" >
                        </div>


                        <div class="form-group">
                            <label for="">Actual Money</label>
                            <input type="nubmer" id="aamount" class="form-control inpt_edit" placeholder="Actual Money" >
                        </div>


                        <!-- <div class="form-group">
                            <label for="">Incharge</label>
                            <input type="text" id="incharge" class="form-control inpt_edit" placeholder="Incharge" >
                        </div> -->

                        <div class="form-group">
                            <label for="">Actual Expenses</label>
                            <input type="number" id="aexp" class="form-control inpt_edit" placeholder="Actual Expenses" >
                        </div>

                        <div class="form-group">
                            <label for="">Balance</label>
                            <input type="number" id="balance" class="form-control inpt_edit" placeholder="--.--" disabled>
                        </div>

                        <!-- <div class="form-group">
                            <label for="">Branch</label>
                            <select class="form-control inpt_edit" style="width: 100%;" id="Branch">
                                <option value="Bacolod" selected>Bacolod</option>
                                <option value="Cebu">Cebu</option>
                            </select>
                        </div> -->
                        
                        <div class="form-group">
                            <label for="">Upload Image</label>
                            <input type="file" name="image_input_name" id="image" class="form-control">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="expbtn">Add</button>
                        <!-- <button type="button" class="btn btn-danger" id="cancel_edit_customer">Cancel</button> -->
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
                <div class="card-body">
                    <table id="tableformat1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Actual Money</th>
                                <th>Incharge</th>
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
                                    <tr class="clickable-row" data-toggle="modal" data-target="#paymentProofModal" data-img="<?= $value->Image ?>">
                                        <td><?= @$key + 1 ?></td>
                                        <td><?= date('M d, Y', strtotime(@$value->Date)) ?></td>
                                        <td><?= @$value->Descr ?></td>
                                        <td><?= @$value->Actual_Money ?></td>
                                        <td><?= @$value->Incharge ?></td>
                                        <td><?= @$value->expense ?></td>
                                        <td><?= @$value->Balance ?></td>
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