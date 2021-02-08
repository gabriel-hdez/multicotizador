<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>  

<style type="text/css">.fileinput-upload-button{display: none;}</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('aseguradoras/actualizar');?>">
                  <input type="hidden" name="token" value="eliminar">
                  <input type="hidden" name="id" value="<?php echo $aseguradora->id_aseguradora; ?>">
                  <input type="hidden" name="estado" value="<?php echo $aseguradora->estado_aseguradora; ?>">

                  <div class="col-lg-12" align="center" style="margin-bottom: 2rem;">
                     <img alt="logo"  src="<?php echo base_url('app/files/aseguradoras/'.$aseguradora->img);?>" style="width: 250px; height: 250px; ">
                  </div>

                  <!-- <div class="form-group col-lg-12">
                      <input type="hidden" id="imagen-actual" name="imagenActual" value="">
                      <input id="file-es" name="imagen" type="file" class="file file-preview-thumbnails" data-browse-on-zone-click="true" >
                  </div> -->
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="aseguradora" id="aseguradora" class="form-control validate" value="<?php echo $aseguradora->aseguradora;?>" disabled>
                    <label for="aseguradora">Nombre de aseguradora</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="rif" id="rif" class="form-control validate" value="<?php echo $aseguradora->rif;?>" disabled>
                    <label for="rif">RIF</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="tlf" id="tlf" class="form-control validate" value="<?php echo $aseguradora->tlf;?>" disabled>
                    <label for="tlf">Telefono</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="correo" id="correo" class="form-control validate" value="<?php echo $aseguradora->correo;?>" disabled>
                    <label for="correo">Correo electronico</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>

                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><?php echo $estado; ?></button>
                    <a href="<?php echo base_url('aseguradoras');?>" class="btn btn-default">Cancelar</a>
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

