<?php 
    class EventoM
    {
        private $coneccion;

        public function __construct()
        {
            require_once('../modelo/ConeccionBD.php');
            $coneccionBD = new ConeccionBD;
            $this->coneccion = $coneccionBD->conectar();
        }
    

    public function cantidad_eventos()
    {
        $sql = "SELECT COUNT(*) AS 'total' FROM events";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $row = $resultado -> fetch_assoc();

        return $row;
        mysqli_close($cn);
    }

    }

?>