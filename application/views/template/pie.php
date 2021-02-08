<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- /.content -->
  </div>

  <!-- Main Footer -->
  <footer class="main-footer no-imprimir">
    <!-- <strong>Copyright &copy; 2021. </strong>
    All rights reserved. -->
    <!-- gabriel.hdez1997@outlook.com -->
    <span class="right">Página renderizada en <strong id="rendered"></strong> segundos</span>
    <div class="float-right d-none d-sm-inline-block">
      <b>Multicotizador</b> V 1.0.0
    </div>
  </footer>
</div>
</body>
</html>
<script type="text/javascript">
  $(window).on('load', function(event) {
    var render = (event.timeStamp/1000).toFixed(2);
    $('#rendered').html(render);
  });
</script>