<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light no-imprimir">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul> 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user" style="font-size: 2rem;"></i>
          <!-- <span class="badge badge-danger navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $_SESSION['login']['usuario'];?></span>
         <!--  <span class="dropdown-item dropdown-header"><?php //echo $_SESSION['login']['rol'];?></span> -->
          <div class="dropdown-divider"></div>
         <!--  <a href="#" class="dropdown-item">
            <i class="fas fa-bell mr-2"></i> 4 Notificaciones
            <span class="float-right text-muted text-sm">3 min</span>
          </a> -->
          <div class="dropdown-divider"></div>
         <a href="<?php echo base_url('usuario');?>" class="dropdown-item">
            <i class="fas fa-user-edit mr-2"></i>Editar mis datos
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('inicio/logout');?>" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i>Cerrar sesion
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a> -->
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 no-imprimir">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('inicio/bienvenido');?>" class="brand-link">
      <h5 class="brand-text font-weight-light text-center"><?php echo APP_NAME;?></h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar no-imprimir">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open"> -->
          <li class="nav-item has-treeview">
            <?php if($_SESSION['login']['rol'] == 'Administrador'): ?>
            <a class="nav-link" href="<?php echo base_url('usuarios');?>">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Usuarios
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            <?php endif; ?>
            <!--<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="<?php //echo base_url('roles');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul> -->
          </li>

          <li class="nav-item has-treeview">
            <?php if($_SESSION['login']['rol'] == 'Administrador'): ?>
            <a class="nav-link" href="<?php echo base_url('aseguradoras');?>">
              <i class="nav-icon fas fa-archway"></i>
              <p>
                Aseguradoras
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          <?php endif; ?>
           <!--  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo base_url('aseguradoras'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aseguradoras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Planes</p>
                </a>
              </li>
            </ul> -->
          </li>

          <li class="nav-item has-treeview">
            <?php if($_SESSION['login']['rol'] == 'Administrador'): ?>
            <a class="nav-link" href="<?php echo base_url('planes');?>">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Planes
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          <?php endif; ?>
           <!--  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo base_url('aseguradoras'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aseguradoras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Planes</p>
                </a>
              </li>
            </ul> -->
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('cotizaciones');?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Cotizaciones
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           <!--  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PEP x SO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nacionalidad</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes por riesgo</p>
                </a>
              </li>
            </ul> -->
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header no-imprimir">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $titulo;?></h1>
          </div><!-- /.col -->
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a class="breadcrumb-item" href="<?php //echo base_url('inicio/bienvenido');?>" >
                <span style="font-weight: 300;">Inicio</span>
              </a>
              <?php //if(isset($breadcrumbs) && $breadcrumbs != NULL) foreach ($breadcrumbs as $key => $value): ?>
                <a href="<?php //echo base_url($value);?>" class="breadcrumb-item"><?php //echo $key;?></a>
              <?php //endforeach;?>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->