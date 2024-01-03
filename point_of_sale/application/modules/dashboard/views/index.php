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
                    
                    <div class="card-tools">
                        <select class="form-control form-control-sm" style="width: 100%; display:none" id="Branch_filter">
                            <option value="" disabled selected>Select Branch</option>
                            <option value="All">All</option>
                            <?php
                                foreach($branch as $key => $value){ ?>
                                    <option value="<?=$value->List_name?>"><?=$value->List_name?></option>
                                <?php }
                            ?>
                        </select>
                    </div>

                    <!-- Added by KYLE 12-19-2023 -->
                    <div class="card-tools">
                        <select class="form-control form-control-sm" style="width: 100%; display:none" id="staff_filter">
                            <option value="" disabled selected>Select Staff</option>
                            <option value="All">All</option>
                            <?php
                                foreach($staff_assigned as $key => $value){ ?>
                                    <option value="<?=$value->FName ."-". $value->LName?>" > <?=$value->FName ." ". $value->LName?> </option>
                                <?php }
                            ?>
                        </select>
                    </div>

                    <div class="card-tools ml-5 mr-5">
                        <select class="form-control form-control-sm" style="width: 100%;" id="Filter_by">
                            <option value="" disabled selected>-- Filter By --</option>
                            <option value="Customer">Customer</option>
                            <option value="Staff_Assigned">Staff Assigned</option>
                            <option value="Payment Status">Payment Status</option>
                            <option value="Order Status">Order Status</option>
                            <!-- <option value="Book Date">Book Date</option> -->
                            <option value="Branch" <?=empty($session->Branch) ? '' : 'hidden'?>>Branch</option>
                        </select>
                    </div>

                    <div class="card-tools">
                        <div class="input-group"  id="Book_date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right Book_date_filter" id="reservation">
                        </div>
                    </div>

                </div>
                <!-- Edited By KYLE 12-19-2023 Moved Entire table to grid -> load_details -->
                <!-- /.card-header -->
                <div class="" id="load_details">
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