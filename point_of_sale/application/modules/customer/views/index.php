<?php
main_header(['customer']);
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
            <div class="col-12 col-sm-6 col-md-3">
                <button class="btn btn-app bg-success" id="n_customer">
                    <i class="fas fa-users"></i> New Customer
                </button>
                <button class="btn btn-app bg-primary" id="s_customer">
                    <i class="fas fa-search"></i> Search Customer
                </button>
            </div>
        </div>

        <!-- NEW CUSTOMER -->
        <div class="card card-primary" id="n_customer_form">
            <div class="card-header">
                <h3 class="card-title">New Customer Details</h3>
            </div>

            <form>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" id="FName" class="form-control inpt" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" id="LName" class="form-control inpt" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Company</label>
                                <input type="text" id="Company" class="form-control inpt" placeholder="Company">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input type="number" id="CNumber" class="form-control inpt" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select class="form-control" style="width: 100%;" id="Branch">
                                    <option value="Bacolod" selected>Bacolod</option>
                                    <option value="Cebu">Cebu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" id="submit_customer">Submit</button>
                    <button type="button" class="btn btn-primary" id="c_order">Create Order</button>
                </div>
            </form>
        </div>

        <!-- SEARCH CUSTOMER -->
            <form id="s_customer_form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Customer Name / Company</label>
                            <select class="form-control select2bs4" style="width: 100%;" data-placeholder="Search Customer" id="search_customer">
                            <option value="" selected></option>
                                <?php 
                                    foreach(@$customers as $key => $value){ 
                                    ?>
                                        <option value="<?=$value->ID?>"><?=ucfirst(@$value->FName)." ".ucfirst(@$value->LName)." / ".ucfirst(@$value->Company)?></option>
                                    <?php 
                                    }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </form>

        <div class="row">
            <!-- SEARCHED CUSTOMER DEAILS -->
            <div class="col-md-4 cust_details" id="">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Details</h3>
                    </div>

                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" id="FName_v" class="form-control inpt_edit" placeholder="First Name" disabled>
                                <input type="text" id="ID_v" hidden>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" id="LName_v" class="form-control inpt_edit" placeholder="Last Name" disabled>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="">Company</label>
                                <input type="text" id="Company_v" class="form-control inpt_edit" placeholder="Company" disabled>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="">Contact Number</label>
                                <input type="number" id="CNumber_v" class="form-control inpt_edit" placeholder="Contact Number" disabled>
                            </div>
                        
                        
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select class="form-control inpt_edit" style="width: 100%;" id="Branch_v" disabled>
                                    <option value="Bacolod" selected>Bacolod</option>
                                    <option value="Cebu">Cebu</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-warning" id="edit_customer">Update</button>
                            <button type="button" class="btn btn-primary" id="c_order_2">Create Order</button>
                            <button type="button" class="btn btn-danger" id="cancel_edit_customer">Cancel</button>
                            <button type="button" class="btn btn-primary" id="save_edit_customer">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- CUSTOMERS ORDER HISTORY -->
            <div class="col-md-8 cust_details">
                <div class="card card-primary">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Order History</h3>
                    </div> -->
                    <div class="card-body">
                        <table id="tableformat1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking Date</th>
                                    <th>Deadline</th>
                                </tr>
                            </thead>
                            <tbody id="load_orders">
                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</section>

<!-- CONFIRMATION MODAL -->
<div class="modal fade" id="modal-default">
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
                <button type="button" class="btn btn-primary" id="save_customer">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/customer/customer.js"></script>