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
                                <input type="text" id="cust_id" hidden value="<?=$cust_details->ID?>">
                            </span>
                            <span class="description">Customer Name</span>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col-sm-6">
                           <div class="card card-primary">
                                <div class="card-body">

                                        <div class="input-group-prepend">
                                                <h5>Order Details | </h5>
                                        </div>
                                    <div class="row">
                                       <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><small>Book date</small></span>
                                                    </div>
                                                    <input type="text" id="b_date" value="<?=date('M d, Y', strtotime($order_dets->Book_date)); ?>" class="form-control form-control-sm" >
                                                </div>
                                            </div>
                                       </div>
                                       <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><small>Deadline</small></span>
                                                    </div>
                                                    <input type="text" id="d_date" value="<?=date('M d, Y', strtotime($order_dets->Deadline)); ?>" class="form-control form-control-sm" >

                                                </div>
                                            </div>
                                       </div>
                                       <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control form-control-sm" placeholder="Deadline Notes" id="d_notes" ><?=$order_dets->Deadline_notes?></textarea>
                                            </div>
                                       </div>
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
                                                            foreach($items as $key => $value){ ?>
                                                             <tr>
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
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="" class="text-center" >Subtotal</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-sm" value="<?=$order_dets->Subtotal?>" id="all_subtotal" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <label for="" class="text-center" >Total Qty</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-sm" value="<?=$order_dets->Act_qty?>"disabled id="t_qty">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <label for="" class="text-center" >Discount</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-sm" value="<?=number_format($order_dets->Discount,2)?>"id="discount">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <label for="" class="text-center" >Notes</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control form-control-sm" id="b_notes"><?=$order_dets->Order_note?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <label for="" class="text-center" >Freebies</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control form-control-sm" value="<?=$order_dets->Freebies?>"id="freebies"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <h5>Total:</h5>
                                        </div>
                                        <div class="col-sm-4 text-left">
                                            <span id="total_amount"><?=number_format($order_dets->Total_amt,2)?></span>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="card card-primary">
                               
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
                <h5 class="modal-title">Are you sure you want to save order?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_items">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/payment/payment.js"></script>