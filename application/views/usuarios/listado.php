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

                <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NOMBRE Y APELLIDO</th>
                  <th>CORREO ELECTRONICO</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($usuarios as $usuario): if($usuario->id_usuario <> $_SESSION['login']['id']):?>
                  <tr>
                    <td><?php echo $usuario->nombre;?></td>
                    <td><?php echo $usuario->correo;?></td>
                    <td>
                      <div class="btn-group">
                        <a href="<?php echo base_url('usuarios/eliminar/'.$usuario->id_usuario);?>" class="btn btn-block btn-danger">Eliminar</a>
                      </div>
                      <div class="btn-group">
                        <a href="<?php echo base_url('usuarios/editar/'.$usuario->id_usuario);?>" class="btn btn-block btn-secondary">Editar</a>
                      </div>
                    </td>
                  </tr>
                  <?php endif; endforeach;?>
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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
                    "lengthMenu": '<div class="col">'+
                      '<div class="form-group">'+
                        '<a href="<?php echo base_url('usuarios/nuevo');?>" class="btn btn-primary">Nuevo Usuario</a> <select class="form-control">'+
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
