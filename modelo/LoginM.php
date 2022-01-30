<?php
class LoginM
{
    private $coneccion;

    public function __construct()
    {
        require_once('ConeccionBD.php');
        $coneccionBD = new ConeccionBD;
        $this->coneccion = $coneccionBD->conectar();
    }

    // public function obtener_administrador()
    // {
    //     $sql = "SELECT Usuario, Constraseña, Nombres, Apellidos, idAdministrador FROM administrador";

    //     $cn = $this->coneccion;
    //     $resultado = $cn->query($sql);

    //     while ($row = $resultado->fetch_row()) {
    //         $administrador[] = $row;
    //     }

    //     return $administrador;
    //     mysqli_close($cn);
    // }
    public function obtener_administrador($user, $clave)
    {
        // $sql = "SELECT * FROM administrador WHERE Usuario = '$user'";
        $sql = "SELECT idAdministrador, Usuario, Constraseña, Nombres, Apellidos FROM administrador WHERE Usuario = '$user' AND Constraseña = '$clave'";
        $cn = $this->coneccion;
        $resultado = $cn->query($sql);
        $dato = '';
        if ($row = $resultado->fetch_row()) {
            $dato = $row;
        }

        return $dato;
        mysqli_close($cn);
    }
}
