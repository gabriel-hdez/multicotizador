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
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('usuarios/actualizar');?>">
                  <input type="hidden" name="token" value="eliminar">
                  <input type="hidden" name="id" value="<?php echo $usuario->id_usuario; ?>">


                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="nombre" id="nombre" class="form-control validate" value="<?php echo $usuario->nombre ;?>" disabled >
                    <label for="nombre">Nombre y apellido</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="correo" id="correo" class="form-control validate" value="<?php echo $usuario->correo ;?>" disabled >
                    <label for="correo">Correo electronico</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="pregunta" id="pregunta" class="form-control validate" value="<?php echo $this->encryption->decrypt($usuario->pregunta) ;?>" disabled >
                    <label for="pregunta">Pregunta de seguridad</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="respuesta" id="respuesta" class="form-control validate" value="<?php echo $this->encryption->decrypt($usuario->respuesta) ;?>" disabled >
                    <label for="respuesta">Respuesta de seguridad</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  
                  


                  <div class="col">
                    <button type="submit" class="btn btn-primary">Eliminar</button>
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
