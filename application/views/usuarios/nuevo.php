<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('usuarios/guardar');?>">

                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="nombre" id="nombre" class="form-control validate" >
                    <label for="nombre">Nombre y apellido</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="correo" id="correo" class="form-control validate" >
                    <label for="correo">Correo electronico</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="pregunta" id="pregunta" class="form-control validate" >
                    <label for="pregunta">Pregunta de seguridad</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="respuesta" id="respuesta" class="form-control validate" >
                    <label for="respuesta">Respuesta de seguridad</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="password" name="clave" id="clave" class="form-control validate" >
                    <label for="clave">Contraseña</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="password" name="repetir" id="repetir" class="form-control validate" >
                    <label for="repetir">Repetir contraseña</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>


                  <div class="col">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo base_url('usuarios');?>" class="btn btn-default">Cancelar</a>
                  </div>
                </form>
                
                
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
<!-- ./wrapper -->
