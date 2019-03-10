<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>AutoMonitor.io - <?php echo $titre ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta name="theme-color" content="#23b195">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon-180x180.png" />
<!-- Custom fonts for this template-->
<link href="http://localhost:8888/Automonitor_2/docs/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="<?php echo css_url('sbadmin');?>" rel="stylesheet">
<link href="<?php echo plugin_url('sweet-alert2/sweetalert2.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo plugin_url('datatables/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo plugin_url('datatables/responsive.bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://checkout.stripe.com/v3/checkout/button.css" />
<link disabled rel="alternate stylesheet" title="night" href="<?php echo css_url('night');?>">
<script src="https://checkout.stripe.com/checkout.js"></script>
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="far fa-check-circle"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Aut<i class="far fa-check-circle"></i>Monitor<sup>.io</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
    Automatic monitoring
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('Monitor/addMonitor');?>">
          <span><i class="fas fa-fw fa-plus-circle"></i> <?php echo $this->lang->line('add_monitor'); ?></span>
      </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-clipboard-check"></i>
        <span>Overview</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Overview</h6>
        <a class="collapse-item" href="buttons.html">Dashboard</a>
        <a class="collapse-item" href="cards.html">Monitors</a>
        </div>
    </div>
    </li>
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-clipboard-check"></i>
        <span>Settings</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Settings</h6>
        <a class="collapse-item" href="buttons.html">Profile</a>
        <a class="collapse-item" href="cards.html">Payments</a>
        </div>
    </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>
    <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-globe"></i>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="<?php echo site_url('Dashboard/French')?>">
        <i class="fas fa-flag fa-sm fa-fw mr-2 text-gray-400"></i>
        French
      </a>
      <a class="dropdown-item" href="<?php echo site_url('Dashboard/English')?>">
        <i class="fas fa-flag-usa fa-sm fa-fw mr-2 text-gray-400"></i>
        English
      </a>
    </div>
  </li>

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('user_profile_name');?>
      <?php if($this->session->userdata('user_profile_premium')){?>
          <i class="fas fa-star text-warning"></i>
      <?php }else{ ?>
          <a href="<?php echo site_url('Payment');?>" class="label label-primary"><?php echo $this->lang->line('upgrade'); ?> <i class="fa fa-arrow-circle-up"></i></a>
      <?php } ?>
      </span>
      <i class="far fa-user-circle fa-2x"> </i>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <?php if(!$_SESSION['user_profile_premium']){ ?>  
        <a class="dropdown-item" href="<?php echo site_url('Payment')?>">
            <i class="fas fa-arrow-circle-up fa-sm fa-fw mr-2 text-gray-400"></i>
            <?php echo $this->lang->line('upgrade'); ?>
        </a>
    <?php } ?>
      <a class="dropdown-item" href="#">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        <?php echo $this->lang->line('settings'); ?>
      </a>
      <a class="dropdown-item" href="#" id="btn-night">
        <i class="fas fa-lightbulb fa-sm fa-fw mr-2 text-gray-400"></i>
        <?php echo $this->lang->line('night_mode'); ?>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo site_url('Hauth/Logout');?>">
        <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
        <?php echo $this->lang->line('logout'); ?>
      </a>
    </div>
  </li>
</ul>
</nav>
    <!-- Begin Page Content -->
    <div class="container-fluid" style="margin-top:20px;">
                    <?php echo $output; ?>
                    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>Copyright &copy; METI 2019</span>
        </div>
    </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Bootstrap core JavaScript-->
<script src="http://localhost:8888/Automonitor_2/docs/vendor/jquery/jquery.min.js"></script>
<script src="http://localhost:8888/Automonitor_2/docs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="http://localhost:8888/Automonitor_2/docs/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="http://localhost:8888/Automonitor_2/docs/js/sb-admin-2.min.js"></script>
<script src="<?php echo plugin_url('jquery-knob/jquery.knob.js');?>"></script>
<script>
    $('#btn-night').click(function(){
        if($('link[title="night"]').prop('disabled') == true){
            $('link[title="night"]').prop('disabled', false);
            setActiveStyleSheet('night');
        }else{
            $('link[title="night"]').prop('disabled', true); 
            setActiveStyleSheet();
        }
    });
</script>
<script type="text/javascript">
            $('[data-plugin="knob"]').each(function(idx, obj) {
                $(this).knob();
            });
        </script>
</body>
</html>