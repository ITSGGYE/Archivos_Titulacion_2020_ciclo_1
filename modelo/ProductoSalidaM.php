<?php 
class ProductoSalidaM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_productoSalida($inicio)
    {
        $sql = "SELECT * FROM producto_salida LIMIT $inicio, 8";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_productoSalida()
    {
        $sql = "SELECT * FROM producto_salida";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function obtener_todos_productoSalida()
    {
        $sql = "SELECT * FROM producto_salida";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }   

    public function obtener_todos_productoSalida_assoc()
    {
        $sql = "SELECT * FROM producto_salida";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }   

    public function eliminar_productoSalida($id)
    {
        $sql = "DELETE FROM producto_salida WHERE idproducto_salida = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }

    public function total_ventas_unitarias()
    {
        $sql = "SELECT SUM(Total) AS 'total' FROM producto_salida";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $row = $resultado -> fetch_assoc();

        return $row;
        mysqli_close($cn);
    }
}