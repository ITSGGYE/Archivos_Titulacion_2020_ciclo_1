<?php 

session_start();  
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
             <a href="../view/proveedor.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</a> 
            </div>
            <table class="table" id="sampleTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Contacto</th>
                  <th>Proveedor</th>
                  <th>Télefono</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conexion.php";
                $query = mysqli_query($conection, "SELECT * FROM proveedor WHERE estatus= 1");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                      <td><?php echo $data['codproveedor']; ?></td>
                      <td><?php echo $data['contacto']; ?></td>
                      <td><?php echo $data['proveedor']; ?></td>
                      <td><?php echo $data['telefono']; ?></td>
                      <td><?php echo $data['direccion']; ?></td>
                      <td>
                        <?php if ($_SESSION['rol'] == 1) { ?>
                          <a class="btn btn-warning" href="editarProveedor.php?id=<?php echo $data["codproveedor"]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          <form action="eliminarProveedor.php?id=<?php echo $data['codproveedor']; ?>" method="post" class="confirmar d-inline">
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> </button>
                          </form>
                        </form>
                      <?php } ?>
                    </td>
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
