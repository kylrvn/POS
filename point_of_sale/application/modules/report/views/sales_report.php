<?php
main_header(['sales_report']);
$session = (object)get_userdata(USER);

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
                            <!-- BAGO NI SA -->
                            <select class="form-control form-control-sm mr-2" style="width: 10%;" id="branch_filter" <?=empty($session->Branch) ? '' : 'hidden'?>> 
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
                                <button type="submit" class="btn btn-default" id="submit_date">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="" id="load_daily_sales">
                <!-- KYLE 12-19-2023
                    Moved Entire table to grid -> load_daily_sales -->
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