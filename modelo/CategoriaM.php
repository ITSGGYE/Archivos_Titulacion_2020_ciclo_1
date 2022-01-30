<?php
class CategoriaM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_categorias($inicio)
    {
        $sql = "SELECT * FROM categoria LIMIT $inicio, 17";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_categorias()
    {
        $sql = "SELECT * FROM categoria";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function obtener_todos_categorias()
    {
        $sql = "SELECT * FROM categoria";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function insertar_categorias($nombre, $descripcion)
    {
        $sql = "call registrar_categoria('$nombre', '$descripcion')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
        
    }

    public function actualizar_categorias($id, $nombre, $fecha, $hora, $descripcion)
    {
        $sql = "call actualizar_categoria($id, '$nombre', '$fecha', '$hora', '$descripcion')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }

    public function eliminar_categorias($id)
    {
        $sql = "DELETE FROM categoria WHERE idCategoria = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
}

?>