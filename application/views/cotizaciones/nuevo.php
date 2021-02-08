<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<style>.select2-container--default .select2-selection--single .select2-selection__rendered { margin-top: -10px; } .input-group-text { height: 2.4rem; }</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="titular-tab" data-toggle="tab" href="#titular" role="tab" aria-controls="titular" aria-selected="true">Datos del titular</a>
                    </div>
                  </nav>
                  <div class="tab-content col-lg-12 p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="titular" role="tabpanel" aria-labelledby="product-desc-tab">
                
                      <form id="myForm" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('cotizaciones/titular');?>">
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="dni" id="dni" class="form-control validate searchbar" data-url="<?php echo base_url('cotizaciones/titular_buscar');?>" placeholder="Buscar titular por cedula" autocomplete="off" value="<?php echo $_SESSION['titular']['dni']; ?>">
                          <label for="dni">Cedula</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Campo requerido, ingrese cedula del titular o rif de la institucion</span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="nombres" id="nombres" class="form-control validate" value="<?php echo $_SESSION['titular']['nombres']?>">
                          <label for="nombres">Nombres</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="apellidos" id="apellidos" class="form-control validate" value="<?php echo $_SESSION['titular']['apellidos']?>">
                          <label for="apellidos">Apellidos</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                         <div class="form-group col-lg-6">
                            <div class='form-group' >
                               <input type='text' class="form-control date" id='datepicker' name="nacimiento" placeholder="Fecha de nacimiento" value="<?php echo $_SESSION['titular']['nacimiento']?>" />
                               <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                            </div>
                         </div>
                        <div class="form-group  col-lg-6">
                          <select class="form-control select2" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="genero">
                            <option value="1">Femenino</option>
                            <option value="2">Masculino</option>
                            <option value="3">Genero indefinido</option>
                          </select>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="correo" id="correo" class="form-control validate" value="<?php echo $_SESSION['titular']['correo']?>">
                          <label for="correo">Correo electronico</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="tlf" id="tlf" class="form-control validate" value="<?php echo $_SESSION['titular']['tlf']?>">
                          <label for="tlf">Telefono</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>

                        <div class="col-lg-12 mt-4">
                          <button type="submit" class="btn btn-primary">Agregar titular</button>
                        </div>
                      </form>

                    </div>              
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#list" role="tab" aria-controls="product-desc" aria-selected="true">Listado de beneficiarios agregados</a>
                      <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#add" role="tab" aria-controls="product-comments" aria-selected="false">Agregar beneficiario</a>
                    </div>
                  </nav>
                  <div class="tab-content col-lg-12 p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="product-desc-tab">
                      

                      <table id="table" class="table table-bordered table-striped ">
                        <thead>
                        <tr>
                          <th>CEDULA</th>
                          <th>NOMBRES Y APELLIDOS</th>
                          <th>PARENTESCO</th>
                          <th>ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $j=1; if ($this->shop1->get_content() != NULL) {
                            foreach($this->shop1->get_content() as $beneficiario):   
                          ?>
                          <tr>
                            <td>
                              <?php
                                  echo strtoupper($beneficiario["options"]['Bdni']); 
                              ?>
                            </td>
                            <td><?php echo $beneficiario['name'];?></td>
                            <td>
                              <?php
                                  echo strtoupper($beneficiario["options"]['Bparentesco']); 
                              ?>
                            </td>
                            <td>
                              <div class="btn-group">
                                <form action="<?php echo base_url('beneficiarios/quitar');?>" method="POST" id="<?php echo 'quitar'.$j;?>">
                                    <input type="hidden" name="id" value="<?php echo $beneficiario['rowid']; ?>">
                                    <button type="submit" class="btn btn-block btn-danger">
                                      Quitar
                                    </button>
                                </form>
                              </div>
                              <!-- <div class="btn-group">
                                <a href="#" data-url="<?php //echo base_url('beneficiarios/editar/'.$beneficiario->id_beneficiario);?>"  class="detalles btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-xl">
                                  Editar
                                </a>
                              </div> -->                              
                            </td>
                          </tr>
                          <?php $j++; endforeach;}?>
                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="product-comments-tab"> 
                     
                      <form  id="FormBeneficiario" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('beneficiarios/guardar');?>">

                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="Bdni" id="Bdni" class="form-control validate searchbar" data-url="<?php echo base_url('beneficiarios/buscar');?>" placeholder="Buscar beneficiario por cedula" autocomplete="off" >
                          <label for="Bdni">Cedula</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!">Campo requerido, en caso de ser un menor de edad colocar la misma cedula que el titular, agregando un ultimo digito correspondiente a la cantidad de menores a registrar</span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="Bnombres" id="Bnombres" class="form-control validate" >
                          <label for="Bnombres">Nombres</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="Bapellidos" id="Bapellidos" class="form-control validate" >
                          <label for="Bapellidos">Apellidos</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                         <div class="form-group col-lg-6">
                            <div class='form-group' >
                               <input type='text' class="form-control date" id='Bdatepicker' name="Bnacimiento" placeholder="Fecha de nacimiento" />
                               <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                            </div>
                         </div>
                        <div class="form-group  col-lg-6">
                          <select class="form-control select2 genero" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="Bgenero">
                            <option value="1">Femenino</option>
                            <option value="2">Masculino</option>
                            <option value="3">Genero indefinido</option>
                          </select>
                        </div>
                        <div class="form-group  col-lg-6">
                          <select class="form-control select2 parentesco" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="Bparentesco">
                            <option>Seleccione parentesco</option disabled>
                              <option value="madre">Madre</option>
                              <option value="hija">Hija</option>
                              <option value="hermana">Hermana</option>
                              <option value="tia">Tia</option>
                              <option value="prima">Prima</option>
                              <option value="abuela">Abuela</option>
                              <option value="esposa">Esposa</option>        
                          </select>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="Bcorreo" id="Bcorreo" class="form-control validate" >
                          <label for="Bcorreo">Correo electronico</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>
                        <div class="form-group input-field col-lg-6">
                          <input type="text" name="Btlf" id="Btlf" class="form-control validate" >
                          <label for="Btlf">Telefono</label>
                          <span  class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                        </div>

                        <div class="col-lg-12 mt-4">
                          <button type="submit" class="btn btn-primary">Agregar beneficiario</button>
                        </div>
                      </form>

                    </div>
                  </div>            
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Listado de planes agregados</a>
                      <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Agregar plan</a>
                    </div>
                  </nav>
                  <div class="tab-content col-lg-12 p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                      
                      <?php $check = ''; if($this->cart->contents() == NULL) $check = 'disabled'; ?>
                      <form method="POST" action="<?php echo base_url('cotizaciones/carrito_eliminar'); ?>">
                        <table id="table" class="table table-bordered table-striped ">
                          <thead>
                          <tr>
                            <th>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckboxCart" <?php echo $check;?> >
                                <label for="customCheckboxCart" class="custom-control-label">PLANES</label>
                              </div>
                            </th>
                            <th>ASEGURADORAS</th>
                            <th>SUMAS ASEGURADAS</th>
                            <th>PREVISUALIZAR</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; foreach($this->cart->contents() as $items):   ?>
                            <tr>
                              <td>
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input checkboxCart" type="checkbox" id="<?php echo 'customCheckboxCart'.$items['id'];?>" name="IDplan[]" value="<?php echo $items['rowid']?>">
                                  <label for="<?php echo 'customCheckboxCart'.$items['id'];?>" class="custom-control-label"><?php echo $items['name'];?></label>
                                </div>
                              </td>
                              <td><?php echo $items['seguro'];?></td>
                              <td><?php echo number_format($items['price'] ,2,',','.');?></td>
                              <td>
                                <a href="#" data-url="<?php echo base_url('cotizaciones/detalles/'.$items['id']);?>"  class="detalles btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-xl">
                                  <?php echo $items['name'];?>
                                </a>
                              </td>
                            </tr>
                            <?php $i++; endforeach;?>
                          </tbody>
                        </table>

                        <div class="row">
                          <button type="submit" class="btn btn-danger" <?php echo $check;?> >Quitar planes</button>
                        </div>
                      </form>

                    </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                     
                      <form method="POST" action="<?php echo base_url('cotizaciones/carrito_agregar'); ?>">
                        <table id="table" class="table table-bordered table-striped ">
                          <thead>
                          <tr>
                            <th>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input checkbox" type="checkbox" id="customCheckbox" >
                                <label for="customCheckbox" class="custom-control-label">PLANES</label>
                              </div>
                            </th>
                           <!--  <th>LOGO</th>-->
                            <th>ASEGURADORAS</th> 
                            <th>SUMAS ASEGURADAS</th>
                            <th>PREVISUALIZAR</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php  foreach( $planes as $plan):  ?>
                            <tr>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input checkbox" type="checkbox" id="<?php echo 'customCheckbox'.$plan->id_plan;?>" name="IDplan[]" value="<?php echo $plan->id_plan; ?>">
                                    <label for="<?php echo 'customCheckbox'.$plan->id_plan;?>" class="custom-control-label"><?php echo $plan->plan;?></label>
                                  </div>
                              </td>
                              <td><?php echo $plan->aseguradora;?></td>
                              <td><?php echo number_format($plan->suma_asegurada ,2,',','.');?></td>
                              <td>
                                <a href="#" data-url="<?php echo base_url('cotizaciones/detalles/'.$plan->id_plan);?>"  class="detalles btn btn-block btn-secondary" data-toggle="modal" data-target="#modal-xl">
                                  <?php echo $plan->plan;?>
                                </a>
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>

                        <div class="row">
                          <button type="submit" class="btn btn-primary">Agregar planes</button>
                        </div>
                      </form>

                    </div>
                  </div>            
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body"> 
                <div class="row">
                  <form id="cotizacion" class="row" enctype="multipart/form-data" method="post" action="<?php echo base_url('cotizaciones/procesar');?>">
                    
                    <div class="col-lg-12 mt-4">
                      <button type="submit" class="btn btn-primary">Procesar cotizacion</button>
                      <a href="<?php echo base_url('cotizaciones');?>" class="btn btn-default">Cancelar cotizacion</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>

<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- ./wrapper -->
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css');?>">
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/select2/css/select2.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css');?>">

<script src="<?php echo base_url('app/assets/plugins/select2/js/select2.full.min.js');?>"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('app/assets/plugins/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.es.min.js');?>"></script>

<script src="<?php echo base_url('app/assets/plugins/datatables/jquery.dataTables.js');?>"></script>
<script src="<?php echo base_url('app/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js');?>"></script>
<script>
  $(function () {
    var table = $('.table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
                    "lengthMenu": '<div class="col">'+
                      '<div class="form-group">'+
                        '<select class="form-control">'+
                          '<option value="-1" selected>Todos los resultados</option>'+
                          '<option value="5">5 resultados</option>'+
                          '<option value="10">10 resultados</option>'+
                          '<option value="20">20 resultados</option>'+
                        '</select>'+
                      '</div>',
                   "sSearchPlaceholder": "Buscar...",
                    //"sLengthMenu":     "Mostrar _MENU_ registros",
                    "sProcessing":     "<p class='center teal-text'>Procesando...</p>",
                    "sLoadingRecords": "<p class='center teal-text'>Cargando...</p>",
                    "sZeroRecords":    "<p class='center red-text'>No se encontraron resultados</p>",
                    "sEmptyTable":     "<p class='center red-text'>Ningún dato disponible para mostrar</p>",
                    "sInfo":           "<p class='center grey-text'>Resultados desde _START_ hasta _END_ de _TOTAL_</p>",
                    "sInfoEmpty":      "<p class='center grey-text'>Mostrando registros del 0 al 0 de un total de 0 registros</p>",
                    "sInfoFiltered":   "<p class='center grey-text'>(filtrado de un total de _MAX_ registros)</p>",
                    "sInfoPostFix":    "",
                    "sSearch":         "",
                    "sUrl":            "",
                    "sInfoThousands":  ".",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                },
          
        "pageLength": -1,
        "order": []
    });

   /* $('.table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        var url = data[2];

        console.log(url);
    });*/
    $('.genero').on('change', function () {
        var genero = $(this).val();

        $('.parentesco').html('');
        
        if (genero == 1) {  $('.parentesco').append('<option value="madre">Madre</option>'+
                                            '<option value="hija">Hija</option>'+
                                            '<option value="hermana">Hermana</option>'+
                                            '<option value="tia">Tia</option>'+
                                            '<option value="prima">Prima</option>'+
                                            '<option value="abuela">Abuela</option>'+
                                            '<option value="esposa">Esposa</option>'); }
        if (genero == 2) {  $('.parentesco').append('<option value="padre">Padre</option>'+
                                            '<option value="hijo">Hijo</option>'+
                                            '<option value="hermano">Hermano</option>'+
                                            '<option value="tio">Tio</option>'+
                                            '<option value="primo">Primo</option>'+
                                            '<option value="abuelo">Abuelo</option>'+
                                            '<option value="esposo">Esposo</option>'); }
        if (genero == 3) {  $('.parentesco').append('<option value="indefinido">Indefinido</option>'); }
    });

$("#customCheckbox").on("click", function() {
  if ($("#customCheckbox").length == $("#customCheckbox:checked").length) {
    $(".checkbox").prop("checked", true);
  } else {
    $(".checkbox").prop("checked", false);
  }
});

$("#customCheckboxCart").on("click", function() {
  if ($("#customCheckboxCart").length == $("#customCheckboxCart:checked").length) {
    $(".checkboxCart").prop("checked", true);
  } else {
    $(".checkboxCart").prop("checked", false);
  }
});

$('.detalles').on('click', function () {
      $.ajax({
          url:$(this).attr('data-url'),
          type:'POST',
          //dataType: 'json',
          //data:formData,
          cache:false,
          contentType:false,
          processData:false,
      })
     .done(function(respuesta){
          $('.modal-content').html(respuesta);
      })
      .fail(function(respuesta) {
           const Toast = Swal.mixin({
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
            title: 'Ha ocurrido un error fatal, contacte un administrador'
          })
      })
      .always(function(respuesta) {
          console.log(respuesta);
      });
  });


 $(function () {
    var maximaFechaInicio = new Date();
  
     $('.date').datepicker( {
         language: 'es',
         startView: 'decade',
         autoclose: true,
         pickerPosition: 'top-right',
         format: 'yyyy-mm-dd',
         endDate: maximaFechaInicio
     });
 });



});
</script>
<?php if (isset($_SESSION['alert'] )): ?>
  <script>
    (function($){
        $(function(){
          const Toast = Swal.mixin({
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
              type: '<?php echo $tipo; ?>',
              title: '<?php echo $alert; ?>'
            })
        });
    })(jQuery);
  </script>
<?php endif;?>