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
              <a href="../view/cliente.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</a>
            </div>
            <table class="table" id="sampleTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Cédula</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Dirección</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conection, "SELECT * FROM cliente WHERE estatus= 1");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                  while ($data = mysqli_fetch_array($query)) {
                    if($data["nit"] == 0)
                    {
                      $nit = 'C/F';
                    }else{
                      $nit = $data["nit"];
                    }
                    ?>
                    <tr>
                      <td><?php echo $data['idcliente']; ?></td>
                      <td><?php echo $data['nit']; ?></td>
                      <td><?php echo $data['nombre']; ?></td>
                      <td><?php echo $data['telefono']; ?></td>
                      <td><?php echo $data['direccion']; ?></td>
                      <td>
                       <?php if($_SESSION['rol'] == 1) { ?>
                        <a href="editarCliente.php?id=<?php echo $data['idcliente']; ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                        
                        <form action="eliminarCliente.php?id=<?php echo $data['idcliente']; ?>" method="post" class="confirmar d-inline">
                          <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
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
