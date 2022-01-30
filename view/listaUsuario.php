<?php 

session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}

include "../conexion.php";  
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<main class="app-content">
  
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div>
              <a href="../view/usuario.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</a>
            </div>
            <table class="table" id="sampleTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Usuario</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol 
                  FROM usuario u 
                  INNER JOIN rol r 
                  ON u.rol = r.idrol 
                  WHERE estatus =1");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                      <td><?php echo $data['idusuario']; ?></td>
                      <td><?php echo $data['nombre']; ?></td>
                      <td><?php echo $data['correo']; ?></td>
                      <td><?php echo $data['usuario']; ?></td>
                      <td><?php echo $data['rol']; ?></td>
                      <?php if ($_SESSION['rol'] == 1) { ?>
                       <td>
                        <a class="btn btn-warning" href="editarUsuario.php?id=<?php echo $data["idusuario"]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        <?php if($data["idusuario"] != 1){ ?>

                          <form action="eliminarUsuario.php?id=<?php echo $data["idusuario"]; ?>" method="post" class="confirmar d-inline">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> </button> 
                          <?php } ?>
                          
                        </td>
                      <?php } ?>
                    </tr>
                  <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include_once 'layouts/footer.php';
?> 

