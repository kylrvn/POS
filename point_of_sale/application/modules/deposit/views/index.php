<?php
main_header(['deposit']);
$session = (object)get_userdata(USER);
@$proof = $_GET['proof']; 
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bank Deposit</h1>
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
            <div class="col-lg-4 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4 class="text-bold cards" id="total_deposit"><?=number_format(@$total_deposit-@$total_withdrawal,2)?></h4>

                        <p>Total Deposit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4 col-sm-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4 class="text-bold" id="total_withdrawal"><?=number_format(@$total_withdrawal,2)?></h4>

                        <p>Withdrawal</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-4 col-sm-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4 class="text-bold" id="total_undeposit"><?=number_format((@$profit - @$total_deposit)+@$total_withdrawal,2)?></h4>

                        <p>Un-deposit Money</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 class="text-bold" id="total_profit"><?=number_format(@$profit,2)?></h4>

                        <p>Total Running Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-4 cust_details" id="">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Bank Deposit</h3>
                </div>

                <form enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" id="date" class="form-control inpt_edit" value="<?=date('Y-m-d')?>" placeholder="Date">
                            <input type="text" id="ID"value="" hidden>
                        </div>

                        <div class="form-group">
                            <label for="">Mode</label>
                            <select class="form-control" id="Mode">
                                <option value="Withdrawal" selected>Withdrawal</option>
                                <option value="Deposit">Deposit</option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Cash</label>
                            <input type="number" id="cash" class="form-control inpt_edit" placeholder="Actual Money">
                        </div>

                        <div class="form-group act_image">
                            <label for="">Upload Proof</label>
                            <input type="file" name="image_input_name" id="image" class="form-control">
                            <input type="text" name="image_input_name" id="image_2" class="form-control" style="display:none">
                        </div>

                        <div class="form-group">
                            <label for="">Notes</label>
                            <textarea type="text" id="notes" class="form-control inpt_edit" placeholder="Enter some notes"></textarea>
                        </div>
                    </div>

                    
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="add">Add</button>
                        <!-- <button type="button" class="btn btn-warning" id="expedit" style="display: none">Update</button>
                        <button type="button" class="btn btn-primary" id="add_image" style="display: none">Add Image</button> -->
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-body table-responsive">
                    <table id="tbl_expense_search" class="table table-hover text-nowrap table-sm table-striped text-center" style="font-size: 10pt;">
                        <div class="input-group input-group-sm">
                            <select class="form-control form-control-sm mr-1" style="width: 10%;" id="branch_filter" <?=empty($session->Branch) ? '' : 'hidden'?>>
                                <option value="All">All Branch</option>
                                <?php 
                                    foreach($branch as $key => $x){ ?>
                                    <option value="<?=$x->List_name?>"><?=$x->List_name?></option>
                                <?php } ?>
                            </select>

                            <label class="mr-2"for="">From</label>
                            <input type="date" id="d_from" class="form-control form-control-sm">

                            <label class="ml-2 mr-2" for="">To</label>
                            <input type="date" id="d_to" class="form-control form-control-sm">


                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default" id="submit_filter_deposit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        
                        </div>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Deposit</th>
                                <th>Withdrawal</th>
                                <th>Notes</th>
                                <th>Incharge</th>
                            </tr>
                        </thead>
                        <tbody id="load_deposit">
                           
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
                        <span  class="close">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image-container"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/deposit/deposit.js"></script>