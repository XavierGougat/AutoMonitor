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
        <style>
            body{
                margin: 0;
                padding: 0;
                background: url(<?php echo img_url('visitor_cover_2.jpg')?>) no-repeat center fixed;
                -webkit-background-size: cover;
                /* pour anciens Chrome et Safari */
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <?php echo $output; ?>
    </body>
</html>