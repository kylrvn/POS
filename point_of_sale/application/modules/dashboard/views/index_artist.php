<?php
main_header(['dashboard']);
?>
<!-- ############ PAGE START-->
<div class="wrapper">
    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-6">
                    <h1>Kanban Board</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kanban Board</li>
                    </ol>
                </div>
                </div>
            </div>
        </section>

        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                        Backlog
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Create Labels</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/dashboard/dashboard.js"></script>