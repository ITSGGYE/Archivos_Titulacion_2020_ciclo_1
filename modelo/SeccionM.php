<?php         
    class SeccionM{
        private $coneccion; 
        
        public function __construct(){
            require_once('../modelo/ConeccionBD.php');
            $coneccionBD = new ConeccionBD;
            $this->coneccion = $coneccionBD->conectar();
        }

        public function obtener_todos_secciones(){
            $sql = "SELECT * FROM seccion";     
            
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);

            while($row = $resultado->fetch_row()) {
                $secciones[] = $row;
            }                                          
            return $secciones;
            mysqli_close($cn);
        }

        public function obtener_limite_secciones($inicio)
    {
        $sql = "SELECT * FROM seccion LIMIT $inicio, 17";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_secciones()
    {
        $sql = "SELECT * FROM seccion";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function insertar_secciones($nombre, $descripcion)
    {
        $sql = "call registrar_seccion('$nombre', '$descripcion')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
        
    }

    public function actualizar_secciones($id, $nombre, $fecha, $hora, $descripcion)
    {
        $sql = "call actualizar_seccion($id, '$nombre', '$fecha', '$hora', '$descripcion')";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }

    public function eliminar_secciones($id)
    {
        $sql = "DELETE FROM seccion WHERE idCategoria = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
       
    }
?>   