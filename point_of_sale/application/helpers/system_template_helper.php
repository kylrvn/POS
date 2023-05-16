<?php
function main_header($menubar = [])
{
  defined('BASEPATH') or exit('No direct script access allowed');
  $session = (object)get_userdata(USER);
  $ci = &get_instance();
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SYSTEM_MODULE?></title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/dist/css/adminlte.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/toastr/toastr.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/Logo/logo.jpg">

  </head>
  <body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
  <!-- <img class="animation__wobble" src="<?= base_url()?>assets/images/Logo/logo.jpg"  height="200" width="200"> -->
    <h1 class="animation__wobble" height="200" width="200">Printmaxs</h1>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <h5 class="text-white"><b><?=date('M d, Y - h:i A');?></b></h5>
      </li> 
      <li class="nav-item">
        <a class="nav-link"  id="signout" role="button">
          <i class="fas fa-power-off"></i>
        </a>
      </li> 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url()?>assets/images/Logo/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= SYSTEM_MODULE?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="<?= base_url()?>assets/theme/adminlte/adminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info text-wrap">
          <a href="<?= base_url()?>/user_profile/index/<?=$session->U_ID?>" class="d-block"><?='<b>'.ucfirst($session->Role).":</b> ".ucfirst($session->FName)." ".ucfirst($session->LName)?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Primary Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url()?>customer" class="nav-link <?= (sidebar($menubar, ['customer'])) ? 'active' : '' ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?= base_url()?>create_order" class="nav-link <?= (sidebar($menubar, ['create_order'])) ? 'active' : '' ?>">
                  <i class="fas fa-pen nav-icon"></i>
                  <p>Create Order</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url()?>management" class="nav-link <?= (sidebar($menubar, ['list_management'])) ? 'active' : '' ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>List Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url()?>management/user_management" class="nav-link <?= (sidebar($menubar, ['user_management'])) ? 'active' : '' ?>">
                  <i class="fas fa-user nav-icon"></i>
                  <p>User Management</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
    }

    function main_footer()
    {
      $ci = &get_instance();
      ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://gelomorancil.github.io/">Gelo</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sweetalert -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/toastr/toastr.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="<?= base_url()?>assets/theme/adminlte/AdminLTE/plugins/select2/js/select2.full.min.js"></script>

 <!-- load global js -->
 <script src="<?= base_url() ?>assets/js/global.js"></script>
 <!-- <script src="<?= base_url() ?>assets/theme/html-version/scripts/app.js"></script> -->
<script src="<?= base_url() ?>assets/js/noPostBack.js"></script>
<script>
  var base_url = '<?=base_url()?>';

     //Initialize Select2 Elements
     $('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})
var base_url = <?php echo json_encode(base_url())?>;

$('#signout').on('click',function(){
    window.location = base_url;
  })
</script>
</body>
</html>
<?php
      }
?>