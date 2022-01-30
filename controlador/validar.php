<?php

require_once('../modelo/LoginM.php');

//instancia
$login = new LoginM();

// $administrador = $login->obtener_administrador();


// error_reporting(0);
// $user = $_POST['user'];
// $clave = $_POST['clave'];


// foreach ($administrador as $registro) {

//     if ($clave == $registro[0] && $user == $registro[1]) {

//         header('location: ../vista/index.php');
//     }
// }

if (!empty($_POST['user']) && !empty($_POST['clave'])) {
    error_reporting(0);
    $user = $_POST['user'];
    $clave = $_POST['clave'];


    $administrador = $login->obtener_administrador($user, $clave);

    if ($clave == $administrador[2] && $user == $administrador[1]) {
        session_start();
        $_SESSION['active'] = true;
        $_SESSION['idAdmin'] = $administrador[0];
        $_SESSION['usuario'] = $administrador[1];
        $_SESSION['nombres'] = $administrador[3];
        $_SESSION['apellidos'] = $administrador[4];

        echo $_SESSION['idAdmin'];
        header('location: ../vista/index.php');
    } else {
        session_destroy();
        header('location: ../index.php');
    }
} else {

    header('location: ../index.php');
}
