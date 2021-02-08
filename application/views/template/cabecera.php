<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(APP_LOGO);?>">
  <title><?php echo APP_NAME; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('app/assets/dist/css/adminlte.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('app/assets/css/custom.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('app/assets/css/glyphicon.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/sweetalert2/sweetalert2.min.css');?>">
  <!-- Google Font: Source Sans Pro 
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
  <?php echo $this->resources->css();?>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?php echo base_url('app/assets/js/jquery-3.3.1.min.js');?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('app/assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <!-- AdminLTE -->
  <script src="<?php echo base_url('app/assets/dist/js/adminlte.js');?>"></script>
  <script src="<?php echo base_url('app/assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
  <?php echo $this->resources->js();?>
  <!-- OPTIONAL SCRIPTS -->
  <script src="<?php echo base_url('app/assets/plugins/chart.js/Chart.min.js');?>"></script>
  <script src="<?php echo base_url('app/assets/dist/js/demo.js');?>"></script>
  <script src="<?php //echo base_url('app/assets/dist/js/pages/dashboard3.js');?>"></script>
  <script src="<?php echo base_url('app/assets/js/materialize.min.js');?>"></script>
</head>