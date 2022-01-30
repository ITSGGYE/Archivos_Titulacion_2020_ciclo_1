<?php 
session_start();
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<?php
include "../conexion.php";

$nit = '';
$nombreEmpresa= '';
$razonSocial= '';
$telEmpresa= '';
$emailEmpresa= '';
$dirEmpresa= '';
$iva= '';

$query_empresa = mysqli_query($conection,"SELECT * FROM configuracion");
$row_empresa = mysqli_num_rows($query_empresa);
if ($row_empresa > 0)
{
  while ($arrInfoEmpresa = mysqli_fetch_assoc($query_empresa)) {
    $nit = $arrInfoEmpresa['nit'];
    $nombreEmpresa= $arrInfoEmpresa['nombre'];
    $razonSocial= $arrInfoEmpresa['razon_social'];
    $telEmpresa= $arrInfoEmpresa['telefono'];
    $emailEmpresa= $arrInfoEmpresa['email'];
    $dirEmpresa= $arrInfoEmpresa['direccion'];
    $iva= $arrInfoEmpresa['iva'];
  }
}

?>

<main class="app-content">
  
  <div class="divInfoSistema">
   
   <div class="containerPerfil"> 
     <div class="containerDataUser">
      <div class="logoUser">
        <img src="../view/factura/img/icono.png">
      </div>
      <div class="divDataUser">
       <h4>Información Personal</h4>
       <div>
         <label>Nombre:</label>   <span><?php echo $_SESSION['nombre']; ?></span>
       </div>
       <div>
         <label>Correo:</label>  <span><?php echo $_SESSION['email']; ?></span>
       </div>
       <h4>Información de Usuario</h4>
       <div>
         <label>Rol:</label>  <span><?php echo $_SESSION['rol_name']; ?></span>
       </div>
       <div>
         <label>Usuario:</label>  <span><?php echo $_SESSION['user']; ?></span>
       </div>

       <h4>Cambiar Contraseña</h4>
       <form action="" method="post" name="frmChangePass" id="frmChangePass">
        <div>
          <input type="password" name="txtPassUser" id="txtPassUser" placeholder="Contraseña actual">
        </div>
        <div>
          <input class="newPass" type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="Nueva Contraseña" required>
        </div>
        <div>
         <input class="newPass" type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="Confirmar Contraseña
         " required>
       </div>
       <div class="alertChangePass" style="display:none;">
       </div>
       <div>
         <button type="submit" class="btn_save btnChangePass"><i class="fa fa-key fa-lg"></i> Guardar</button>
       </button>
     </div>
   </form>
 </div>
</div>

<?php if ($_SESSION['rol'] == 1) { ?>
  <div class="containerDataEmpresa">
    <div class="logoEmpresa">
      <img src="../view/factura/img/icono2.png">
    </div>
    <h4>Datos de la Farmacia</h4>
    <form action="" method="post" name="frmEmpresa" id="frmEmpresa">
      <input type="hidden" name="action" value="updateDataEmpresa">
      <div>
       <label>Ruc:</label>
       <input type="text" name="txtNit" id="txtNit"
       placeholder="Ruc de la Empresa" value="<?= $nit; ?>" required>
     </div>
     <div>Nombre:</div>
     <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la Empresa" value="<?= $nombreEmpresa; ?>" required>
     <div>
       <label>Razón Social:</label>
       <input type="text" name="txtRSocial" id="txtRSocial" placeholder="Razón Social" value="<?= $razonSocial; ?>" required>
     </div>
     <div>
       <label>Telefono:</label>
       <input type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Núnmero de Telefono" value="<?= $telEmpresa; ?>" required>
     </div>
     <div>
       <label>Correo:</label>
       <input type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholder="Correo Electrónico" value="<?= $emailEmpresa; ?>" required>
     </div>
     <div>
       <label>Dirección:</label>
       <input type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholder="Dirección de la Empresa" value="<?= $dirEmpresa ?>" required>
     </div>
     <div>
       <label>Iva (%):</label>
       <input type="text" name="txtIva" id="txtIva" placeholder="Valor del Iva" value="<?= $iva; ?>" required>
     </div>
     <div class="alertFormEmpresa" style="display: none;"></div>
     <div>
       <button type="submit" class="btn_save btnChangePass"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
     </div>
   </form>
 </div>
<?php } ?>
</div> 
</div>


</main>


<?php
include_once 'layouts/footer.php';
?> 

