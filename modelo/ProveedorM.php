<?php         
    class ProveedorM{
        private $coneccion; 
        
        public function __construct(){
            require_once('../modelo/ConeccionBD.php');
            $coneccionBD = new ConeccionBD;
            $this->coneccion = $coneccionBD->conectar();
        }

        public function obtener_todos_proveedores(){
            $sql = "SELECT * FROM proveedor";     
            
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);

            while($row = $resultado->fetch_row()) {
                $categorias[] = $row;
            }                                          
            return $categorias;
            mysqli_close($cn);
        }

        public function obtener_limite_proveedores($inicio)
        {
            $sql = "SELECT * FROM proveedor LIMIT $inicio, 17";
    
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);
    
            while ($row = $resultado->fetch_row()) {
                $categorias[] = $row;
            }
            return $categorias;
            mysqli_close($cn);
        }
    
        public function obtener_filas_proveedores()
        {
            $sql = "SELECT * FROM proveedor";
    
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);
    
            $canitdad_filas = $resultado->num_rows;
            return  $canitdad_filas;
            mysqli_close($cn);
        }
    
        public function insertar_proveedores($nombre, $correo, $Direccion, $Telefono, $Especialidad, $descripcion)
        {
            $sql = "call registrar_proveedor('$nombre', '$correo', '$Direccion', '$Telefono', '$Especialidad', '$descripcion')";
    
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);
            
        }
    
        public function actualizar_proveedor($id, $nombre, $correo, $Direccion, $Telefono, $Fecha, $Hora, $Especialidad, $descripcion)
        {
            $sql = "call actualizar_proveedor($id, '$nombre', '$correo', '$Direccion', '$Telefono', '$Fecha', '$Hora', '$Especialidad', '$descripcion')";
    
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);
        }
    
        public function eliminar_proveedor($id)
        {
            $sql = "DELETE FROM proveedor WHERE idProveedor = $id";
    
            $cn = $this->coneccion;
            $resultado = $cn->query($sql);
        }
       
    }
?>    
