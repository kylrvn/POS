<?php
main_header(['sales_report']);
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">List Management</h1> -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Sales Report</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <h3 class="text-bold">OVERALL SALES</h3>
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4 class="text-bold"><?=number_format($sales,2)?></h4>

                        <p>Sales</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4 class="text-bold">0</h4>

                        <p>Expenses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 class="text-bold"><?=number_format($sales - 0,2)?></h4>

                        <p>Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4 class="text-bold"><?=number_format($cash,2)?></h4>

                        <p>Cash</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4 class="text-bold"><?=number_format($online,2)?></h4>

                        <p>Online Payment</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>

            <div class="divider bg-primary"><hr></div>

            <h3 class="text-bold">MONTHLY SALES</h3>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div class="card-header">
                                <select class="form-control select2" style="width: 25%;">
                                    <?php $date = date('Y');?>
                                    <option selected="selected" value="<?=$date?>"><?=$date?></option>
                                    <option value="<?=$date-1?>"><?=$date-1?></option>
                                    <option value="<?=$date-2?>"><?=$date-2?></option>
                                    <option value="<?=$date-3?>"><?=$date-3?></option>
                                </select>
                            </div>
                            <table class="table table-hover text-nowrap table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>MONTH</th>
                                        <th>SALES</th>
                                        <th>EXPENSES</th>
                                        <th>PROFIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($monthly as $key => $value){ ?>
                                        <tr>
                                            <td><?=date('F',strtotime($value->Date_paid))?></td>
                                            <td>&#8369 <?=number_format($value->total,2)?></td>
                                            <td>&#8369 </td>
                                            <td>&#8369 <?=number_format($value->total,2)?></td>
                                        </tr>
                                   <?php }?>
                                </tbody>
                            </table>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    <!-- /.card -->
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
            </div>
        </div>
</section>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<!-- <script src="<?php echo base_url() ?>/assets/js/list/list.js"></script> -->