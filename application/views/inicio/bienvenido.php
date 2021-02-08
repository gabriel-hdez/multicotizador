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
                <p><?php echo 'Bienvenido '.$_SESSION['login']['rol'].', '.$_SESSION['login']['usuario']?></p>
              </div>
             <!--  <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">EMPRESAS</h3>
                  <a href="javascript:void(0);" class="no-imprimir" onclick="imprimir();">Ver reporte</a>
                </div>
              </div> -->
              <!-- <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column"> -->
                   <!--  <span class="text-bold text-lg">$18,230.00</span> -->
                    <!-- <span>Sales Over Time</span> -->
                  <!-- </p>
                  <p class="ml-auto d-flex flex-column text-right"> -->
                    <!-- <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span> -->
                  <!-- </p>
                </div> -->
                <!-- /.d-flex -->

               <!--  <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div> -->

               <!--  <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div> -->
              <!-- </div> -->
              
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
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : [
      <?php foreach ($empresas as $empresa): ?>

            <?php echo '"EMPRESA '.$empresa->id.'" ,'; ?>
           
      <?php endforeach; ?>
      ],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [
          <?php foreach ($empresas as $empresa): ?>

            <?php echo $empresa->cantidad.' ,'; ?>
           
          <?php endforeach; ?>
          ]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return  value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
});

function imprimir() {
  $('.no-imprimir').addClass('hide');
  print();
  $('.no-imprimir').removeClass('hide');
}

</script>