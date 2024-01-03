<?php
main_header(['kanban']);

$statusCount = count((array)$status_list) + 1;
?>
<!-- ############ PAGE START-->

<style>
    .box {
        min-height: 780px;
        /* border: 2px solid red; */
        overflow: scroll;
    }

    .kanban-container {
        width: <?= $statusCount * 295 ?>px;
        overflow: hidden;
        /* max-height: 100px; */
        /* -webkit-box-shadow: 0px -1px 12px rgba(0, 0, 0, 0.48);
        -moz-box-shadow: 0px -1px 12px rgba(0, 0, 0, 0.48);
        box-shadow: 0px -1px 12px rgba(0, 0, 0, 0.48); */
        padding-bottom: 45px;
        padding-top: 5px;
        /* background: grey; */
        /* border-top: 1px solid #767676; */
        /* font-family: Verdana, Tahoma, Sans-Serif; */
        z-index: 100;
    }

    .kanban-container .kcol {
        border: 2px solid #353535;
        background-color: #353535;
        float: left;
        width: 272px;
        vertical-align: top;
        flex-direction: column;
        color: white;
        max-height: 100%;
        display: flex;
        border-radius: 12px;
        margin-left: 5px;
        margin: 15px;
        padding-bottom: 8px;

    }

    .kanban-container .kcol-header {
        min-height: 20px;
        padding: 8px 8px 0;
    }

    .kanban-container h2 {
        font-weight: 600;
        font-size: 14px;
        padding: 6px 8px 6px 12px;
        overflow: hidden;
    }

    .kanban-container .kcol-footer {
        padding: 8px 8px 0;
    }

    .kanban-container .btn-add-card {
        background-color: transparent;
        border-radius: 8px;
        color: var(--list-text-subtle);
        padding: 6px 12px 6px 8px;
        text-decoration: none;
        -webkit-user-select: none;
        user-select: none;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-grow: 1;
        margin: 0;
    }

    .kanban-container .card-inpt {
        border-radius: 8px;
        border: none;
        height: 54px;
        height: auto;
        margin: 0;
        max-height: 162px;
        min-height: 54px;
        overflow: hidden;
        overflow-wrap: break-word;
        overflow-y: auto;
        padding: 8px 12px;
        resize: none;
    }

    .kanban-container .card-holder {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        margin: 0 4px;
        padding: 2px 4px;
        height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        z-index: 1;
        list-style: none;
        -webkit-overflow-scrolling: touch;
        -webkit-transform: translate3d(0, 0, 0);
    }

    .kanban-container .div-card {
        background-color: var(--ds-surface-raised, #ffffff);
        border-radius: 8px;
        box-shadow: var(--ds-shadow-raised, 0px 1px 1px #091e4240, 0px 0px 1px #091e424f);
        color: var(--ds-text, #172b4d);
        cursor: pointer;
        min-height: 36px;
        position: relative;
        scroll-margin: 8px;
    }

    .kanban-container .div-card-task {
        display: flow-root;
        position: relative;
        padding: 8px 12px 4px;
        min-height: 24px;
        z-index: 10;
    }

    .kanban-container .card-task {
        display: flex;
        flex-direction: column;
        row-gap: 8px;
        scroll-margin: 80px;
        padding-bottom: 8px;
    }

    .kcol-body {
        overflow-y: scroll;
        max-height: 750px;
    }

    .kanban-container .kcol-body button {
        display: none;
        position: absolute;
        top: 2px;
        right: 2px;
        border-radius: 16px;
        padding: 6px 8px;
        background-color: var(--ds-surface-raised, #ffffff);
        z-index: 10;
    }

    .card-inpt:focus,
    .card-inpt:hover {
        background-color: var(--ds-surface-raised, #ffffff);
        box-shadow: var(--ds-shadow-raised, 0px 1px 1px #091e4240, 0px 0px 1px #091e424f);
        max-height: 162px;
        min-height: 54px;
    }

    .kanban-container a {
        display: block;
        margin-bottom: 4px;
        overflow: hidden;
        overflow-wrap: break-word;
        white-space: normal;
        color: var(--ds-text, #172b4d);
        text-decoration: none;
    }

    .card-holder .div-card {
        background-color: var(--ds-surface-raised, #ffffff);
        border-radius: 8px;
        box-shadow: var(--ds-shadow-raised, 0px 1px 1px #091e4240, 0px 0px 1px #091e424f);
        color: var(--ds-text, #172b4d);
        cursor: pointer;
        min-height: 36px;
        position: relative;
        scroll-margin: 8px;
    }

    .div-image-task {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        background-position: center;
        background-repeat: no-repeat;
        user-select: none;
    }

    .label-artist {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 4px;
        color: white;
    }

    .card-task.dragging {
        opacity: 0.5;
    }

    /* Default styling for modal-lg */
    .modal-lg {
        max-width: 60%;
        /* You can adjust this value as needed */
    }

    /* Responsive adjustment for smaller screens */
    @media (max-width: 768px) {
        .modal-lg {
            max-width: 95%;
            /* Adjust this value for smaller screens */
        }
    }

    .label-box {
        padding: 0.2rem;
        border-radius: 5px;
    }

    /* SCROLL CSS */

    /* width */
    .kcol-body::-webkit-scrollbar {
        width: 10px;
        background-color: #353535;
    }

    /* Track */
    .kcol-body::-webkit-scrollbar-track {
        background: #353535;
    }

    /* Handle */
    .kcol-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    /* Handle on hover */
    .kcol-body::-webkit-scrollbar-thumb:hover {
        background: #e2e2e2;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Trello Board</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="box">
        <div class="kanban-container">
            <?php
            if (!empty($status_list)) {
                foreach ($status_list as $x => $list) {
            ?>
                    <div class="kcol" data-stat="<?= $list->ID ?>">
                        <div class="kcol-header">
                            <h2><?= $list->List_name ?></h2>
                        </div>
                        <div class="kcol-body">
                            <ol class="card-holder" data-statID="<?= $list->ID ?>">
                                <?php
                                if (!empty($card_list)) {
                                    foreach ($card_list as $card) if ($card->Status == $list->ID) { { ?>
                                            <li class="card-task" data-card-id="<?= $card->ID ?>" draggable="true">
                                                <div class="div-card">
                                                    <div class="div-img-task" data-testid="card-front-cover" data-card-front-section="cover" style="height: 260px; max-height: 260px; background-color: rgb(252, 252, 252); background-image: url(<?= @$card->Mockup_Design ? base_url() . 'assets/uploaded/proofs/' . @$card->Mockup_Design : base_url() . 'assets/images/Logo/logo.jpg' ?>); background-size: contain;"></div>
                                                    <div class="div-card-task row">
                                                        <!-- <span class="order-number"><?= @$card->order_card ?></span> -->
                                                        <div class="Ln_WDlu2A5sGGO d-flex">
                                                            <?php
                                                            if (@$card->lf) { ?>
                                                                <div class="label-layout mr-1"><span class="label-box" style="background-color: green; color:white; font-size:0.75rem;"><strong><?= substr(@$card->lf, 0, 1) . '. ' . @$card->ll ?></strong></span></div>
                                                            <?php } ?>
                                                        </div>
                                                        <a class="task-name" style="font-weight: 800;" data-toggle="modal" data-target="#modal-info" data-orderid="<?= @$card->ID ?>">
                                                            <!-- Note: <?= @$card->Order_note ?> -->
                                                            <?= @$card->Jo_num ?>
                                                        </a>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <i class="fas fa-clock"></i> - <?= date('M d, Y', strtotime(@$card->Deadline)) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                <?php }
                                    }
                                } ?>
                            </ol>
                        </div>
                        <div class="kcol-footer">
                            <!-- <button type="button" class="btn btn-add-card"> <i class="fas fa-plus"></i> &nbsp;&nbsp;Add a Card</button> -->
                        </div>
                    </div>
            <?php
                }
            } else {
                echo 'No statuses have been set';
            }
            ?>
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_customer">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR OPENING CARDS -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">JOB ORDER DETAILS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="load_order">
            </div>
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
<script src="<?php echo base_url() ?>/assets/js/kanban/kanban.js" defer></script>