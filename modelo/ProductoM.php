<?php
class ProductoM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_productos($inicio)
    {
        // $sql1 = "SELECT po.idProducto, po.Nombre, po.Marca, po.Precio, po.Stock, po.FechaRegistro, po.HoraRegistro,
        //         pr.Nombre, ca.Nombre, sn.Nombre, po.Descripcion, po.Imagen, po.idProveedor, po.idCategoria, po.idSeccion FROM producto po JOIN proveedor pr USING(idProveedor) JOIN categoria ca USING(idCategoria) JOIN seccion sn USING(idSeccion) LIMIT $inicio, 15";

        $sql1 = "SELECT po.idProducto, po.Nombre, po.Marca, po.Precio, po.Stock, po.FechaRegistro, po.HoraRegistro,
                pr.Nombre, ca.Nombre, sn.Nombre, po.Descripcion, po.Imagen, po.idProveedor, po.idCategoria, po.idSeccion FROM producto po JOIN proveedor pr USING(idProveedor) JOIN categoria ca USING(idCategoria) JOIN seccion sn USING(idSeccion) ORDER BY po.Stock ASC LIMIT $inicio, 15";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql1);

        while ($row = $resultado->fetch_row()) {
            $productos[] = $row;
        }


        return $productos;
        mysqli_close($cn);
    }

    public function obtener_todos_productos()
    {
        $sql1 = "SELECT po.idProducto, po.Nombre, po.Marca, po.Precio, po.Stock, po.FechaRegistro, po.HoraRegistro,
                pr.Nombre, ca.Nombre, sn.Nombre, po.Descripcion, po.Imagen FROM producto po JOIN proveedor pr USING(idProveedor) JOIN categoria ca USING(idCategoria) JOIN seccion sn USING(idSeccion) ";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql1);

        while ($row = $resultado->fetch_row()) {
            $productos[] = $row;
        }

        return $productos;
        mysqli_close($cn);
    }

    public function obtener_todos_productos_assoc()
    {
        $sql1 = "SELECT * FROM producto ";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql1);

        while ($row = $resultado->fetch_assoc()) {
            $productos[] = $row;
        }

        return $productos;
        mysqli_close($cn);
    }


    public function obtener_stock_producto()
    {
        $sql = "SELECT Stock FROM producto";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $productos[] = $row['Stock'];
        }

        foreach ($productos as $row) {
            $x = $row;
        }

        return $x;
    }

    public function obtener_filas_productos()
    {
        $sql = "SELECT * FROM producto";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }



    public function insertar_productos($nombre, $marca, $precio, $stock, $proveedor, $categoria, $seccion, $descripcion, $foto)
    {
        $sql = "call registrar_producto('$nombre', '$marca', '$precio', '$stock', '$proveedor', '$categoria', '$seccion', '$descripcion', '$foto')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        return $resultado;
    }

    public function actualizar_productos($id, $nombre, $marca, $precio, $stock, $fecha, $hora, $proveedor, $categoria, $seccion, $descripcion, $foto)
    {
        $sql = "call actualizar_producto($id, '$nombre', '$marca', $precio, $stock, '$fecha', '$hora', $proveedor, $categoria, $seccion, '$descripcion', '$foto')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }

    public function eliminar_productos($id)
    {
        $sql = "DELETE FROM producto WHERE idProducto = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
    //vender producto
    public function generar_salida($id, $nombre, $marca, $precio, $stock)
    {
        $sql = "call generar_salida($id, '$nombre', '$marca', $precio, $stock)";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }


    public function cantidad_producto()
    {
        $sql = "SELECT COUNT(*) AS 'total' FROM producto";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $row = $resultado->fetch_assoc();

        return $row;
        mysqli_close($cn);
    }
}
