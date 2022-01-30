<!-- <?php require_once('../controlador/validar.php'); ?> -->
<div class="row pie">
    <div class="col-3" style="text-align: left;">
    </div>

    <div class="col-6" style="text-align: center;">
        FERRETERIA SANTOS<br />Coop Nueva Prosperina Mz.1055 Sl.2
        <!-- habilitar tiempo -->
        <div id="recargar_hora"></div>
    </div>



    <script>
        // actualizar hora
        setInterval(
            function() {
                $('#recargar_hora').load('../controlador/HoraC.php');
            }, 1000
        );
    </script>


</div>