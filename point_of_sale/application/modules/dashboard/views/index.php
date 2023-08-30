<?php
main_header(['dashboard']);
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
                    <h3 class="card-title">Dashboard</h3>

                    <!-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                        </div>
                    </div> -->

                    <div class="card-tools">
                        <select class="form-control form-control-sm" style="width: 100%;  display:none;" id="Status_filter">
                            <option value="All">All Status</option>
                           <?php 
                            foreach($status as $key => $x){ ?>
                            <option value="<?=$x->ID?>"><?=$x->List_name?></option>
                           <?php } ?>
                        </select>
                    </div>

                    <div class="card-tools mr-5">
                       <input type="text" class="form-control form-control-sm" style="width: 100%;  display:none;"  id="search_customer" placeholder="Search by Customer">
                    </div>

                    <div class="card-tools">
                        <select class="form-control form-control-sm" style="width: 100%;  display:none;" id="Payment_filter">
                            <option value="All">All Status</option>
                            <option value="Unpaid">Unpaid</option>
                            <option value="Paid">Paid</option>
                            <option value="Down">Down</option>
                        </select>
                    </div>

                    <div class="card-tools mr-5">
                        <select class="form-control form-control-sm" style="width: 100%;" id="Filter_by">
                            <option value="" disabled selected>-- Filter By --</option>
                            <option value="Customer">Customer</option>
                            <option value="Payment Status">Payment Status</option>
                            <option value="Order Status">Order Status</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-hover text-nowrap table-sm table-striped text-center">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Customer</th>
                                <th>Contact Number</th>
                                <th>Mockup Design</th>
                                <th>Status</th>
                                <th>Book Date</th>
                                <th>Deadline</th>
                                <th>Sewer</th>
                                <th>Layout Artist</th>
                                <th>Setup Artist</th>
                                <th>Items</th>
                                <!-- <th>Total Amount</th>
                                <th>Received Payment</th>
                                <th>Balance</th> -->
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody id="load_details">
                            
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

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/dashboard/dashboard.js"></script>