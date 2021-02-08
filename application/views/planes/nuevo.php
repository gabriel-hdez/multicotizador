<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/select2/css/select2.min.css');?>">
<script src="<?php echo base_url('app/assets/plugins/select2/js/select2.full.min.js');?>"></script>

<style>.select2-container--default .select2-selection--single .select2-selection__rendered { margin-top: -10px; } .input-group-text { height: 2.4rem; } .select2-search__field{height: 2rem!important;  border-bottom: none!important; -webkit-box-shadow: none!important; box-shadow: none!important;} .select2-container--default .select2-selection--single {margin-top: 1.5rem!important;} .select2-container--default .select2-selection--single .select2-selection__arrow b{margin-top: 1.5rem;}</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('planes/guardar');?>">

                  <div class="form-group col-lg-6">
                    <select class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="aseguradora">
                      <?php foreach($aseguradoras as $aseguradora): ?>
                      <option value="<?php echo $aseguradora->id_aseguradora; ?>"><?php echo $aseguradora->aseguradora.' : '.$aseguradora->rif; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="plan" id="plan" class="form-control validate" >
                    <label for="plan">Nombre del plan</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="plazo" id="plazo" class="form-control validate" >
                    <label for="plazo">Plazo de espera</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Cantidad de meses</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="suma" id="suma" class="form-control validate" >
                    <label for="suma">Suma asegurada</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="Dnacional" id="Dnacional" class="form-control validate" >
                    <label for="Dnacional">Deducible nacional</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="Dexterior" id="Dexterior" class="form-control validate" >
                    <label for="Dexterior">Deducible exterior</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>

                  <h4 class="col-lg-12" style="margin: 1rem 0rem 2rem 0rem;">Primas por titular</h4>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular9" id="titular9" class="form-control validate" >
                    <label for="titular9">Monto para edades entre 0-9 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular19" id="titular19" class="form-control validate" >
                    <label for="titular19">Monto para edades entre 10-19 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular29" id="titular29" class="form-control validate" >
                    <label for="titular29">Monto para edades entre 20-29 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular39" id="titular39" class="form-control validate" >
                    <label for="titular39">Monto para edades entre 30-39 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular49" id="titular49" class="form-control validate" >
                    <label for="titular49">Monto para edades entre 40-49 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular54" id="titular54" class="form-control validate" >
                    <label for="titular54">Monto para edades entre 50-54 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular59" id="titular59" class="form-control validate" >
                    <label for="titular59">Monto para edades entre 55-59 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular69" id="titular69" class="form-control validate" >
                    <label for="titular69">Monto para edades entre 60-69 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="titular75" id="titular75" class="form-control validate" >
                    <label for="titular75">Monto para edades mayores de 70 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>

                  <h4 class="col-lg-12" style="margin: 1rem 0rem 2rem 0rem;">Primas por beneficiario</h4>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario9" id="beneficiario9" class="form-control validate" >
                    <label for="beneficiario9">Monto para edades entre 0-9 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario19" id="beneficiario19" class="form-control validate" >
                    <label for="beneficiario19">Monto para edades entre 10-19 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario29" id="beneficiario29" class="form-control validate" >
                    <label for="beneficiario29">Monto para edades entre 20-29 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario39" id="beneficiario39" class="form-control validate" >
                    <label for="beneficiario39">Monto para edades entre 30-39 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario49" id="beneficiario49" class="form-control validate" >
                    <label for="beneficiario49">Monto para edades entre 40-49 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario54" id="beneficiario54" class="form-control validate" >
                    <label for="beneficiario54">Monto para edades entre 50-54 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario59" id="beneficiario59" class="form-control validate" >
                    <label for="beneficiario59">Monto para edades entre 55-59 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario69" id="beneficiario69" class="form-control validate" >
                    <label for="beneficiario69">Monto para edades entre 60-69 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="beneficiario75" id="beneficiario75" class="form-control validate" >
                    <label for="beneficiario75">Monto para edades mayores de 70 años</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>

                  <h4 class="col-lg-12" style="margin: 1rem 0rem 2rem 0rem;">Condiciones generales</h4>

                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="tipo" id="tipo" class="form-control validate">
                    <label for="tipo">Tipo de servicio en el exterior</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="maternidad" id="maternidad" class="form-control validate" >
                    <label for="maternidad">Gastos por maternidad</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="viaje" id="viaje" class="form-control validate" >
                    <label for="viaje">Asistencia en viaje internacional</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>
                  <div class="form-group input-field col-lg-6">
                    <input type="text" name="funerario" id="funerario" class="form-control validate" >
                    <label for="funerario">Gastos funerarios</label>
                    <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1000.0</span>
                  </div>

                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="atencion" name="atencion" value="1">
                      <label class="custom-control-label" for="atencion">Atencion primaria</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="vida" name="vida" value="1">
                      <label class="custom-control-label" for="vida">Vida</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="ambulancia" name="ambulancia" value="1">
                      <label class="custom-control-label" for="ambulancia">Atencion domiciliaria y ambulancia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="odontologia" name="odontologia" value="1">
                      <label class="custom-control-label" for="odontologia">Odontologia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="oftalmologia" name="oftalmologia" value="1">
                      <label class="custom-control-label" for="oftalmologia">Oftalmologia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="psicologia" name="psicologia" value="1">
                      <label class="custom-control-label" for="psicologia">Psicologia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="nutricion" name="nutricion" value="1">
                      <label class="custom-control-label" for="nutricion">Nutricion</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="fisioterapia" name="fisioterapia" value="1">
                      <label class="custom-control-label" for="fisioterapia">Fisioterapia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="dermatologia" name="dermatologia" value="1">
                      <label class="custom-control-label" for="dermatologia">Dermatologia</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="muerte" name="muerte" value="1">
                      <label class="custom-control-label" for="muerte">Muerte accidental</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="invalidez" name="invalidez" value="1">
                      <label class="custom-control-label" for="invalidez">Invalidez permanente</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="orientacion" name="orientacion" value="1">
                      <label class="custom-control-label" for="orientacion">Orientacion medica telefonica</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="bariatica" name="bariatica" value="1">
                      <label class="custom-control-label" for="bariatica">Cirugia bariatica</label>
                    </div>
                  </div> 
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="profilactia" name="profilactica" value="1">
                      <label class="custom-control-label" for="profilactia">Cirugia profilactica cancer</label>
                    </div>
                  </div> 
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="congenita" name="congenita" value="1">
                      <label class="custom-control-label" for="congenita">Condicion congenita</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="vih" name="vih" value="1">
                      <label class="custom-control-label" for="vih">Tratamiento de VIH Sida</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="transplante" name="transplante" value="1">
                      <label class="custom-control-label" for="transplante">Transplante de organo</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="complicacionN" name="complicacionN" value="1">
                      <label class="custom-control-label" for="complicacionN">Complicaciones de nacimiento</label>
                    </div>
                  </div>
                  <div class="form-group col-lg-6">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="complicacionM" name="complicacionM" value="1">
                      <label class="custom-control-label" for="complicacionM">Complicaciones de maternidad</label>
                    </div>
                  </div>

                 
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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

