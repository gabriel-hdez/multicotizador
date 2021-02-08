<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>  
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/css/fileinput.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.css');?>">
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/js/plugins/piexif.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/js/plugins/sortable.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/js/fileinput.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/js/locales/es.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/themes/fas/theme.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.js')?>" type="text/javascript"></script>

<style type="text/css">.fileinput-upload-button{display: none;} .file-caption-name{height: 1rem !important; border-bottom: none!important; -webkit-box-shadow: none!important; box-shadow: none!important; }</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('aseguradoras/guardar');?>">

                  <div class="form-group col-lg-12">
                      <input id="file-es" name="imagen" type="file" class="file" data-browse-on-zone-click="true" >
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="aseguradora" id="aseguradora" class="form-control validate" >
                    <label for="aseguradora">Nombre de aseguradora</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="rif" id="rif" class="form-control validate" >
                    <label for="rif">RIF</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="tlf" id="tlf" class="form-control validate" >
                    <label for="tlf">Telefono</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="correo" id="correo" class="form-control validate" >
                    <label for="correo">Correo electronico</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>

                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
<script> 
  $('#file-es').fileinput({
        theme: 'fas',
        language: 'es',
        //uploadUrl: '#',
        //allowedFileExtensions: ['jpg', 'png', 'gif']
    });
</script>
