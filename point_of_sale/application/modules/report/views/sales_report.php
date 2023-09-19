<?php
main_header(['sales_report']);
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Dashboard</h1> -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daily Sales</h3>

                   
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                        
                            <label class="mr-2"for="">From</label>
                            <input type="date" id="d_from" class="form-control form-control-sm">

                            <label class="ml-2 mr-2" for="">To</label>
                            <input type="date" id="d_to" class="form-control form-control-sm">


                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default" id="submit_date">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Book Date</th>
                                <th>Item</th>
                                <th>Amount to Pay</th>
                                <th>Payment</th>
                                <th>Payment Mode</th>
                                <th>Proof</th>
                                <th>Cashier</th>
                                <th>Status</th>
                                <th>Waybill Number</th>
                                <th>Cash</th>
                                <th>Online Payment</th>
                            </tr>
                        </thead>
                        <tbody id="load_daily_sales">
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<!-- CONFIRMATION MODAL -->
<div class="modal fade" id="modal-void">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to save details?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_user">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/report/report.js"></script>