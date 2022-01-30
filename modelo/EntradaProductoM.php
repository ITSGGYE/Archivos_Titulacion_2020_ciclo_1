<?php 
class EntradaProductoM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_productoEntrada($inicio)
    {
        $sql = "SELECT * FROM producto_entrada LIMIT $inicio, 8";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_productoEntrada()
    {
        $sql = "SELECT * FROM producto_entrada";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function obtener_todos_productoEntrada()
    {
        $sql = "SELECT * FROM producto_entrada";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }   

    public function obtener_todos_productoEntrada_assoc()
    {
        $sql = "SELECT * FROM producto_entrada";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }   


    public function eliminar_productoEntrada($id)
    {
        $sql = "DELETE FROM producto_entrada WHERE idproducto_entrada = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
}