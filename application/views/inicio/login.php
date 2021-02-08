<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(APP_LOGO);?>">
  <title><?php echo APP_NAME; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- IonIcons -->
  <link rel="stylesheet" href="<?php echo base_url('app/assets/dist/css/ionic.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('app/assets/dist/css/adminlte.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('app/assets/css/custom.css');?>">
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
  <script src="<?php echo base_url('app/assets/js/materialize.min.js');?>"></script>
  <?php echo $this->resources->js();?>
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <img src="<?php echo base_url(APP_LOGO);?>" alt="<?php echo APP_NAME; ?>" width="150px" >
      </div>
      <?php //echo $this->encryption->encrypt('1234') ; ?>
      <!-- <p class="login-box-msg">Inicio de sesion</p> -->

      <form id="myForm" enctype="multipart/form-data" method="post" action="<?php echo base_url('inicio/login');?>">
        
        <div class="form-group input-field">
          <input type="text" name="correo" id="correo" class="form-control validate" >
          <label for="correo">Correo electronico</label>
          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
        </div>

        <div class="form-group input-field">
          <input type="password" name="clave" id="clave" class="form-control validate" >
          <label for="clave">Contraseña</label>
          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
        </div>

        <div class="row">
          <!-- <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordar credenciales
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!--  <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1 text-center">
        <a href="#">Olvide mi contraseña</a>
      </p> -->
      <!-- <p class="mb-0 text-center">
        <a href="#" class="text-center">Registrar usuario</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  (function($){
    $(function(){ 

    /*Swal.fire({
      title: 'AdminLTE',
      text: "Autenticacion exitosa",
      type: 'success',
      //confirmButtonColor: '#3085d6',
      //confirmButtonText: 'OK!',
      showConfirmButton: false,
      timer: 2500,
      
    }).then(() => {
        console.log("Alerta cerrada");
        //window.location.href = "bienvenido.php";
    })*/

    /*const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      type: 'error',
      title: 'Signed in successfully'
    })*/

  });
})(jQuery);
</script>
</body>
</html>
