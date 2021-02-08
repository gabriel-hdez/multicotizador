<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<link rel="stylesheet" href="<?php echo base_url('app/assets/plugins/select2/css/select2.min.css');?>">
<script src="<?php echo base_url('app/assets/plugins/select2/js/select2.full.min.js');?>"></script>
<script src="<?php echo base_url('app/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js');?>"></script>

<style>

  .titulo{
    font-weight: bold;
  }
  .tabla{
    width: 100%;
  }
  th,td{
    text-align: center;
    vertical-align: top;
    border: 1px solid #000;
    border-spacing: 0;
  }

</style>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                
                  <?php 
                  if ($cotizacion->estado == "1") {
                    $estado = 'Anular';
                  } else {
                    $estado = 'Restaurar';
                  }
                  ?>
                <div class="col-lg-12 no-imprimir" style="margin-bottom: 2rem;">
                  <form id="myForm" method="POST" action="<?php echo base_url('cotizaciones/actualizar');?>">
                    <input type="hidden" name="id" value="<?php echo $cotizacion->id_cotizacion; ?>">
                    <input type="hidden" name="estado" value="<?php echo $cotizacion->estado; ?>">
                    <button type="submit" class="btn btn-primary"><?php echo $estado.' cotizacion'?></button>
                    <a href="<?php echo base_url('cotizaciones');?>" class="btn btn-default">Listado de cotizaciones</a>
                  </form>
                </div>
                <div class="row">
                  <h4>Cotizacion <?php echo '#'.$cotizacion->id_cotizacion;?></h4>
                  <table class="tabla">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="3" style="border: none;"></td>
                        <td style="border: none;"></td>
                        <?php 
                          foreach($aseguradoras as $aseguradora):
                        ?>
                          <td <?php echo 'colspan="'.$aseguradora->contador.'"'; ?> style="border: none;">
                            <img alt="logo" src="<?php echo base_url('app/files/aseguradoras/'.$aseguradora->img);?>" style="width: 80px; height: 80px; padding: 2px;">
                          </td>
                        <?php  
                          endforeach; 
                        ?>
                      </tr>
                      <!------------------------------------------------------------------- ASEGURADORAS -->
                      <tr>
                        <td colspan="3" rowspan="3" class="titulo" style="border: none;">
                          <img alt="multicotizador" src="<?php echo base_url('app/files/root/reporte.jpeg');?>" style="width: 180px; padding: 2px;">
                        </td>
                        <td rowspan="2" class="titulo" >PLANES</td>
                      </tr>
                      <!------------------------------------------------------------------- PLANES -->
                      <tr>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo $plan->plan; ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                          <td class="titulo">SUMAS ASEGURADAS</td>
                          <?php foreach ($planes as $plan): ?>
                            <td><?php echo number_format($plan->suma_asegurada ,2,',','.'); ?></td>                       
                          <?php endforeach; ?>
                      </tr>
                     <tr>
                          <td class="titulo">BENEFICIARIOS</td>
                          <td class="titulo">EDAD</td>
                          <td class="titulo">PARENTESCO</td>
                          <td class="titulo">DEDUCIBLE EXTERIOR</td>
                          <?php foreach ($planes as $plan): ?>
                            <td><?php echo number_format($plan->deducible_exterior ,2,',','.'); ?></td> 
                          <?php endforeach; ?>
                      </tr>
                      <!------------------------------------------------------------------- TITULAR -->
                      <tr>
                        <td><?php echo $titular->nombres.' '.$titular->apellidos; ?></td>
                        <td>
                          <?php
                            $nacimiento = new DateTime($titular->nacimiento);
                            $actual = new DateTime();
                            $calculo = $actual->diff($nacimiento); 
                            $edad = $calculo->y;
                            echo $edad;
                          ?>
                        </td>
                        <td>TITULAR</td>
                        <td >Prima Anual</td>
                        <?php 
                          $pos = count($planes);
                          for ($i=1; $i <= $pos ; $i++) { 
                            $total[$i] = NULL; 
                          }
                          $i = 1; 
                          foreach ($planes as $plan):
                            if (in_array($edad, explode(",", "0,1,2,3,4,5,6,7,8,9") ) ){ $prima = 'titular_9';}
                            if (in_array($edad, explode(",", "10,11,12,13,14,15,16,17,18,19") ) ){ $prima = 'titular_19';}
                            if (in_array($edad, explode(",", "20,21,22,23,24,25,26,27,28,29") ) ){ $prima = 'titular_29';}
                            if (in_array($edad, explode(",", "30,31,32,33,34,35,36,37,38,39") ) ){ $prima = 'titular_39';}
                            if (in_array($edad, explode(",", "40,41,42,43,44,45,46,47,48,49") ) ){ $prima = 'titular_49';}
                            if (in_array($edad, explode(",", "50,51,52,53,54") ) ){ $prima = 'titular_54';}
                            if (in_array($edad, explode(",", "55,56,57,58,59") ) ){ $prima = 'titular_59';}
                            if (in_array($edad, explode(",", "60,61,62,63,64,65,66,67,68,69") ) ){ $prima = 'titular_69';}
                            if ($edad > 70){ $prima = 'titular_75';}

                            $total[$i] = $total[$i] + $plan->$prima;
                        ?>
                          <td><?php echo number_format($plan->$prima ,2,',','.'); ?></td> 
                        <?php $i++; endforeach; ?>                                           
                      </tr>
                      <!------------------------------------------------------------------- BENEFICIARIOS -->
                      <?php 
                        //$j=2; 
                        foreach($beneficiarios as $beneficiario): 
                      ?>
                      <tr>
                        <td><?php echo $beneficiario->nombres.' '.$beneficiario->apellidos; ?></td>
                        <td>
                          <?php 
                              $nacimiento = new DateTime($beneficiario->nacimiento);
                              $actual = new DateTime();
                              $calculo = $actual->diff($nacimiento); 
                              $edad = $calculo->y;
                              echo $edad;
                          ?>
                        </td>
                        <td><?php echo strtoupper($beneficiario->parentesco); ?></td>
                        <td >Prima Anual</td>
                        <?php 
                          $i=1;
                            $nacimiento = new DateTime($beneficiario->nacimiento);
                            $actual = new DateTime();
                            $calculo = $actual->diff($nacimiento); 
                            $edad = $calculo->y;
                          foreach ($planes as $plan):
                            
                            if (in_array($edad, explode(",", "0,1,2,3,4,5,6,7,8,9") ) ){ $prima = 'beneficiario_9';}
                            if (in_array($edad, explode(",", "10,11,12,13,14,15,16,17,18,19") ) ){ $prima = 'beneficiario_19';}
                            if (in_array($edad, explode(",", "20,21,22,23,24,25,26,27,28,29") ) ){ $prima = 'beneficiario_29';}
                            if (in_array($edad, explode(",", "30,31,32,33,34,35,36,37,38,39") ) ){ $prima = 'beneficiario_39';}
                            if (in_array($edad, explode(",", "40,41,42,43,44,45,46,47,48,49") ) ){ $prima = 'beneficiario_49';}
                            if (in_array($edad, explode(",", "50,51,52,53,54") ) ){ $prima = 'beneficiario_54';}
                            if (in_array($edad, explode(",", "55,56,57,58,59") ) ){ $prima = 'beneficiario_59';}
                            if (in_array($edad, explode(",", "60,61,62,63,64,65,66,67,68,69") ) ){ $prima = 'beneficiario_69';}
                            if ($edad > 70){ $prima = 'beneficiario_75';}

                            //$valores[$i][$j] = $plan->$prima;
                            $total[$i] = $total[$i] + $plan->$prima;
                        ?>
                          <td><?php echo number_format($plan->$prima ,2,',','.'); ?></td> 
                        <?php $i++; endforeach; ?>                                           
                      </tr>
                      <?php //$j++; 
                        endforeach; ?>
                      <!------------------------------------------------------------------- TOTAL PRIMA -->
                      <tr>
                        <td style="border: none;" colspan="3" rowspan="3" width="30%" >
                          Pagos fraccionados no se cobra intereses 
                          ni gastos administrativos. 
                          Pagos por financiamiento se cobra un interes
                          en la inicial solo de 6%
                        </td>
                        <td class="titulo">TOTAL PRIMA</td>
                        <?php foreach ($total as $valor ): ?>
                          <td><?php echo number_format($valor ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td>Semestral</td>
                        <?php foreach ($total as $valor ): ?>
                          <td><?php echo number_format(($valor/2) ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td>Trimestral</td>
                        <?php foreach ($total as $valor ): ?>
                          <td><?php echo number_format(($valor/4) ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <!------------------------------------------------------------------- CONDICIONES -->
                      <tr>
                        <td style="border:none; height: 2rem;"></td>
                        <td style="border:none; height: 2rem;"></td>
                        <td style="border:none; height: 2rem;"></td>
                        <td style="border:none; height: 2rem;"></td>
                        <?php foreach ($total as $valor ): ?>
                          <td style="border:none; height: 2rem;"></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td style="border: none !important;" colspan="4" class="titulo">CONDICIONES GENERALES</td>
                        <?php foreach ($planes as $plan): ?>
                          <td style="border: none !important;"></td>
                        <?php endforeach; ?>
                      </tr>

                      <tr>
                        <td colspan="4" class="titulo">Plazos de espera</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo $plan->plazo.' meses'; ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Deducible nacional</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo number_format($plan->deducible_nacional ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Deducible exterior</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo number_format($plan->deducible_exterior ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Tipo de servicio en el exterior</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo $plan->tipo_servicio; ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Asistencia en viaje internacional</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo number_format($plan->viaje_internacional ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Maternidad</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo number_format($plan->maternidad ,2,',','.'); ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Vida</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->vida == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Atencion primaria</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->atencion_primaria == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Atencion domiciliaria y ambulancia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->ambulancia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Odontologia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->odontologia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Oftalmologia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->oftalmologia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Psicologia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->psicologia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Nutricion</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->nutricion == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Fisioterapia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->fisioterapia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Dermatologia</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->dermatologia == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Gastos funerarios</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php echo number_format($plan->gastos_funerarios ,2,',','.');  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Muerte accidental</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->muerte_accidental == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Invalidez permanente</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->invalidez_permanente == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Orientacion medica telefonica</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->orientacion_medica_tlf == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Cirugia bariatica</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->cirugia_bariatica == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Cirugia profilactica cancer</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->cirugia_profilactica_cancer == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Condiciones congenitas</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->condicion_congenita == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Tratamiento de VIH o SIDA</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->tratamiento_vih_sida == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Transplante de organos</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->transplante == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Complicaciones de nacimiento</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->complicacion_nacimiento == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <tr>
                        <td colspan="4" class="titulo">Complicaciones de maternidad</td>
                        <?php foreach ($planes as $plan): ?>
                          <td><?php if($plan->complicacion_maternidad == 1){echo "SI"; }else{echo "NO";}  ?></td>
                        <?php endforeach; ?>
                      </tr>



                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
<!-- ./wrapper -->

