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
        <link rel="stylesheet" href="<?php echo plugin_url('morris/morris.css');?>">
        <link href="<?php echo plugin_url('sweet-alert2/sweetalert2.min.css');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo css_url('bootstrap.min');?>" rel="stylesheet">
        <link href="<?php echo css_url('style');?>" rel="stylesheet">
        <link href="<?php echo css_url('font-awesome.min');?>" rel="stylesheet">
        <link href="<?php echo plugin_url('switchery/switchery.min.css');?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo plugin_url('datatables/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo plugin_url('datatables/responsive.bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo plugin_url('ion-rangeslider/ion.rangeSlider.css');?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo plugin_url('ion-rangeslider/ion.rangeSlider.skinModern.css');?>" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://checkout.stripe.com/v3/checkout/button.css" />
        <link disabled rel="alternate stylesheet" title="night" href="<?php echo css_url('night');?>">
        <script src="https://checkout.stripe.com/checkout.js"></script>
    </head>
    <body>
        <div id="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="hidden-xs">
                        <a href="<?php echo site_url('Dashboard');?>" class="logo">
                            Aut<i class="fa fa-check-circle-o text-custom"></i>Monitor<span style="font-size:10px;">.io</span>
                        </a>
                    </div>
                </div>
                <!-- Top navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <!-- Mobile menu button -->
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile visible-xs">
                                    <i class="fa fa-bars"></i>
                                    <span class="logo">
                                        Aut<i class="fa fa-check-circle-o text-custom"></i>monitor<span style="font-size:10px;">.io</span>
                                    </span>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <!-- Top nav left menu -->
                            <ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
                                <li><a href="index.html#"><?php echo $this->lang->line('about'); ?></a></li>
                                <li><a href="<?php echo site_url('Dashboard/Pricing');?>"><?php echo $this->lang->line('pricing'); ?></a></li>
                                <li><a href="index.html#"><?php echo $this->lang->line('help'); ?></a></li>
                                <li><a href="index.html#"><?php echo $this->lang->line('contact'); ?></a></li>
                            </ul>
                            <!-- Top nav Right menu -->
                            <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle menu-right-item" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-globe text-default"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo site_url('Dashboard/English')?>">
                                                <img width="18" src="<?php echo img_url('en-flag.png')?>" alt="en-en" /> - English
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('Dashboard/French')?>">
                                                <img width="18" src="<?php echo img_url('fr-flag.png')?>" alt="fr-fr" /> - French
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user-circle-o text-default"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?phpif(!$_SESSION['user_profile_premium']){?>
                                        <li><a href="<?php echo site_url('Payment')?>"><i class="fa fa-arrow-circle-up text-primary"></i> <?php echo $this->lang->line('upgrade'); ?></a></li>
                                        <?php } ?>
                                        <li><a href="<?php echo site_url('Settings');?>"><i class="fa fa-sliders"></i> <?php echo $this->lang->line('settings'); ?></a></li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#" id="btn-night">
                                                <i class="fa fa-lightbulb-o"></i> <?php echo $this->lang->line('night_mode'); ?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo site_url('HAuth/Logout');?>"><i class="fa fa-power-off"></i> <?php echo $this->lang->line('logout'); ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end container -->
                </div> <!-- end navbar -->
            </div>
            <!-- Top Bar End -->
            <!-- Page content start -->
            <div class="page-contentbar">
                <!-- START PAGE CONTENT -->
                <div id="page-right-content">
                    <div class="container">
                        <div class="row">
                            <?php if(isset($_SESSION['messageOK'])){ ?>
                            <div class="alert alert-success" id="alert" role="alert">
                                <a href="#" style="float:right;" onclick="document.getElementById('alert').style.display='none';">X</a>
                                <?php echo '<center>'.$_SESSION['messageOK'].'</center>'; ?>
                            </div>
                            <?php } ?>
                            <?php if(isset($_SESSION['messageKO'])){ ?>
                            <div class="alert alert-danger" id="alert" role="alert">
                                <a href="#" style="float:right;" onclick="document.getElementById('alert').style.display='none';">X</a>
                                <?php echo '<center>'.$_SESSION['messageKO'].'</center>'; ?>
                            </div>
                            <?php } ?>
                            <div class="col-sm-12">
                                <h4 class="header-title m-t-0 m-b-20"><?php echo $titre ;?></h4>
                            </div>
                        </div> <!-- end row -->
                        <?php echo $output; ?>
                    </div>
                    <!-- end container -->
                    <div class="footer">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong>Automonitor</strong>.io - Copyright &copy; <?php echo date('Y');?>
                            </div>
                        </div>
                    </div> <!-- end footer -->
                </div>
                <!-- End #page-right-content -->
            </div>
            <!-- end .page-contentbar -->
        </div>
        <script src="<?php echo js_url('jquery-2.1.4.min');?>"></script>
        <script src="<?php echo js_url('bootstrap.min');?>"></script>
        <script src="<?php echo plugin_url('morris/morris.min.js');?>"></script>
        <script src="<?php echo plugin_url('raphael/raphael-min.js');?>"></script>
        <script src="<?php echo plugin_url('jquery-knob/jquery.knob.js');?>"></script>		
        <script src="<?php echo plugin_url('sweet-alert2/sweetalert2.min.js');?>"></script>
        <script src="<?php echo page_url('jquery.sweet-alert.init.js');?>"></script>
        <script src="<?php echo plugin_url('switchery/switchery.min.js');?>"></script>
        <script src="<?php echo plugin_url('datatables/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo plugin_url('datatables/dataTables.bootstrap.min.js');?>"></script>
        <script src="<?php echo plugin_url('datatables/dataTables.responsive.min.js');?>"></script>
        <script src="<?php echo plugin_url('datatables/responsive.bootstrap.min.js');?>"></script>
        <script src="<?php echo plugin_url('ion-rangeslider/ion.rangeSlider.min.js');?>"></script>
        <script src="<?php echo page_url('jquery.range-sliders.js');?>"></script>
        <script src="<?php echo page_url('jquery.datatables.init.js');?>"></script>
        <script src="<?php echo js_url('jquery.app');?>"></script>
    </body>
</html>