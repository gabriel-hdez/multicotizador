<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/select2/css/select2.min.css');?>">
<script src="<?php echo base_url('app/assets/plugins/select2/js/select2.full.min.js');?>"></script>

<style>.select2-container--default .select2-selection--single .select2-selection__rendered { margin-top: -10px; } .input-group-text { height: 2.4rem; }</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('planes/guardar');?>">
                  <input type="hidden" name="token" value="editar">
                  <input type="hidden" name="id" value="<?php echo $plan->id_plan; ?>">

                  <div class="form-group col-lg-6">
                    <select class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="aseguradora">
                      <?php foreach($aseguradoras as $aseguradora): ?>
                      <option value="<?php echo $aseguradora->id_aseguradora; ?>"><?php echo $aseguradora->aseguradora.' : '.$aseguradora->rif; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group col-lg-6">
                    <input type="text" name="plan" id="plan" class="form-control" placeholder="Nombre del plan" >
                    <span id="plan-error" class="error invalid-feedback helper-text"></span>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="text" name="suma" id="suma" class="form-control" placeholder="Suma asegurada (Ej. 1000.00)" >
                    <span id="suma-error" class="error invalid-feedback helper-text"></span>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="text" name="Dnacional" id="Dnacional" class="form-control" placeholder="Deducible nacional (Ej. 1000.00)" >
                    <span id="Dnacional-error" class="error invalid-feedback helper-text"></span>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="text" name="Dexterior" id="Dexterior" class="form-control" placeholder="Deducible exterior (Ej. 1000.00)" >
                    <span id="Dexterior-error" class="error invalid-feedback helper-text"></span>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="text" name="plazo" id="plazo" class="form-control" placeholder="Plazo en meses" >
                    <span id="plazo-error" class="error invalid-feedback helper-text"></span>
                  </div>

                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo base_url('planes');?>" class="btn btn-default">Cancelar</a>
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
$(document).ready(function() {
    $('.select2').select2();
     $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
});
</script>

