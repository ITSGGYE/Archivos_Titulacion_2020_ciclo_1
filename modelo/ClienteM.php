<?php
class ClienteM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_clientes($inicio)
    {
        $sql = "SELECT * FROM cliente LIMIT $inicio, 17";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_clientes()
    {
        $sql = "SELECT * FROM cliente";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function obtener_todos_clientes()
    {
        $sql = "SELECT * FROM cliente";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function insertar_clientes($nombre, $apellido, $telefono, $correo, $descripcion)
    {
        if($nombre != null){
            $sql = "call registrar_cliente('$nombre', '$apellido', '$telefono', '$correo', '$descripcion')";

            $cn = $this->coneccion;
            $resultado = $cn->query($sql);

        }
    }

    public function actualizar_clientes($id, $nombre, $apellido, $telefono, $correo, $fecha, $descripcion)
    {
        $sql = "call actualizar_cliente($id, '$nombre', '$apellido', '$telefono', '$correo', '$fecha', '$descripcion')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }

    public function eliminar_clientes($id)
    {
        $sql = "DELETE FROM cliente WHERE idCliente = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
}

?>