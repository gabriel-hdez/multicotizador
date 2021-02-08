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

                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>FECHA CREACION</th>
                    <?php if($_SESSION['login']['rol'] == 'Administrador'):?>
                      <th>COTIZADOR</th>
                    <?php endif;?>
                    <th>CEDULA TITULAR</th>
                    <th>NOMBRES Y APELLIDOS TITULAR</th>
                    <th>ACCIONES</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($cotizaciones as $cotizacion):

                      if ($cotizacion->estado == "1") { $estado = 'Anular'; } else { $estado = 'Restaurar'; }
                      
                    ?>
                    <tr>
                      <td><?php echo $cotizacion->fecha_creacion;?></td>
                      <?php if($_SESSION['login']['rol'] == 'Administrador'):?>
                        <td><?php echo $cotizacion->nombre;?></td>
                      <?php endif;?>
                      <td><?php echo $cotizacion->dni;?></td>
                      <td><?php echo $cotizacion->nombres.' '.$cotizacion->apellidos;?></td>
                      <!-- <td><?php //echo number_format($cotizacion->suma_asegurada ,2,',','.');?></td> -->
                      <td>
                         <div class="btn-group">
                          <a href="<?php echo base_url('cotizaciones/estado/'.$cotizacion->id_cotizacion);?>" class="btn btn-block btn-danger"><?php echo $estado;?></a>
                        </div>

                       <div class="btn-group">
                          <a href="<?php echo base_url('cotizaciones/visualizar/'.$cotizacion->id_cotizacion);?>" class="btn btn-block btn-secondary">Ver</a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>              
                
                
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
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css');?>">
<script src="<?php echo base_url('app/assets/plugins/datatables/jquery.dataTables.js');?>"></script>
<script src="<?php echo base_url('app/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js');?>"></script>
<script>
  $(function () {
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
                    "lengthMenu": '<div class="col">'+
                      '<div class="form-group">'+
                        '<a href="<?php echo base_url('cotizaciones/nuevo');?>" class="btn btn-primary">Nueva cotizacion</a> <select class="form-control">'+
                          '<option value="5">5 resultados</option>'+
                          '<option value="10">10 resultados</option>'+
                          '<option value="20">20 resultados</option>'+
                          '<option value="-1">Todos los resultados</option>'+
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
          
        "pageLength": 5,
        "order": []
    });
  });
</script>
