<?php
main_header(['create_order']);
?>
<!-- ############ PAGE START-->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Order Details / Payment</h1> -->
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
        <!-- NEW CUSTOMER -->
        <div class="card card-primary">
            <div class="card-header">
                <!-- <h3 class="card-title">New Customer Details</h3> -->
            </div>

            <form>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center user-block">
                            <span class="username">
                                <h3><?=strtoupper($cust_details->FName." ".$cust_details->LName." / ".$cust_details->Company)?></h3>
                                <input type="text" id="cust_id"  hidden value="<?=$cust_details->ID?>">
                            </span>
                            <span class="description">Customer Name</span>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col-sm-6">
                           <div class="card card-primary">
                                <div class="card-body">

                                    <div class="input-group-prepend">
                                            <h5>Payment Status | </h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Items</label>
                                            <table class="table table-bordered" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Item</th>
                                                        <th style="width: 10px">Qty</th>
                                                        <th style="width: 15px">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                        <?php
                                                            foreach($order_items as $key => $value){ ?>
                                                             <tr class="lh-1">
                                                                <td><?=$key+1?></td>
                                                                <td><?=$value->List_name?></td>
                                                                <td><?=$value->Item_qty?></td>
                                                                <td><?=number_format($value->Item_unitprice,2)?></td>
                                                            </tr>
                                                         <?php   }
                                                        
                                                        ?>
                                                </tbody>
                                            </table>
                                       </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row text-center">
                                        <div class="col-sm-6">
                                           <h6>Subtotal: <b>&#8369 <?=number_format($order_dets->Subtotal,2)?></b></h6>
                                           <h6>Discount: <b>&#8369 <?=number_format($order_dets->Discount,2)?></b></h6>

                                        </div>
                                        <div class="col-sm-6">
                                           <h6>Total</h6>
                                           <b>&#8369 <?=number_format($order_dets->Total_amt,2)?></b>
                                        </div>
                                    </div>

                                    <div class="row text-center mt-2" style="border-top: 1px solid black">
                                        <div class="col-sm-6">
                                            <h6>Amount Paid</h6>
                                            <b class="text-success">&#8369 <?=number_format($last_paid,2)?></b>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php
                                                $balance = $order_dets->Total_amt - $last_paid;
                                            ?>
                                           <h6>Balance</h6>
                                           <b class="text-danger">&#8369 <?=number_format($balance,2)?></b>
                                           <input type="number" id="Balance" value="<?=number_format($balance,2)?>" hidden>
                                        </div>
                                    </div>

                                    <div class="row text-center mt-2" style="border-top: 1px solid black">
                                        <div class="col-sm-10 mt-2">
                                            <form action="" class="form-horizontal">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><small>Payment Mode</small></label>
                                                    <div class="col-sm-8">
                                                        <select class="custom-select custom-select-sm rounded-0" id="Payment_mode" <?= $balance == 0 ? 'disabled' : ''?>>
                                                            <?php
                                                                foreach($p_mode as $value){ ?>
                                                                    <option value="<?=$value->ID?>"><?=$value->List_name?></option>
                                                                <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><small>Amount</small></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control form-control-sm"  id="Amount_paid" placeholder="Amount" <?= $balance == 0 ? 'disabled' : ''?>>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><small>Change</small></label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control form-control-sm text-danger text-bold" id="change" placeholder="Change" disabled>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                   <div class="text-right">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" <?= $balance == 0 ? 'disabled' : ''?>>Submit Payment</button>

                                   </div>
                                </div>
                           </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card card-primary">
                                <div class="card-body">

                                    <div class="input-group-prepend">
                                        <h5>Order Details</h5>
                                        <!-- <h6>Subtotal: <b>&#8369 <?=number_format($order_dets->Subtotal,2)?></b></h6> -->
                                        
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <h6>Book Date: <b><?=date('M d, Y', strtotime($order_dets->Book_date))?></b></h6>
                                                <label for="">Note</label>
                                                <p class="<?=empty($order_dets->Order_note) ? 'text-danger text-bold' : ''?>"><?=empty($order_dets->Order_note) ? 'No note' : $order_dets->Order_note ?></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>Deadline: <b><?=date('M d, Y', strtotime($order_dets->Deadline))?></b></h6>
                                                <label for="">Note</label>
                                                <p class="<?=empty($order_dets->Deadline_notes) ? 'text-danger text-bold' : ''?>"><?=empty($order_dets->Deadline_notes) ? 'No note' : $order_dets->Deadline_notes ?></p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- CONFIRMATION MODAL -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to save payment?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-oid="<?=$order_dets->ID?>" id="save_payment">Pay</button>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/payment/payment.js"></script>