<?php 
class OpinionPublicaM
{
    private $coneccion;

    public function __construct()
    {
        require_once('../modelo/ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    public function obtener_limite_opinionPublica($inicio)
    {
        $sql = "SELECT * FROM opinion_publica LIMIT $inicio, 8";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }

    public function obtener_filas_opinionPublica()
    {
        $sql = "SELECT * FROM opinion_publica";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        $canitdad_filas = $resultado->num_rows;
        return  $canitdad_filas;
        mysqli_close($cn);
    }

    public function obtener_todos_opinionPublica()
    {
        $sql = "SELECT * FROM opinion_publica";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);

        while ($row = $resultado->fetch_row()) {
            $categorias[] = $row;
        }
        return $categorias;
        mysqli_close($cn);
    }   

    public function eliminar_opinionPublica($id)
    {
        $sql = "DELETE FROM opinion_publica WHERE idOpinion_publica = $id";

        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
    }
}
