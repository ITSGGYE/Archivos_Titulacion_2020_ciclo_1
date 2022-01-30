<?php
session_start();
unset($_SESSION["active"]);
// unset($_SESSION["idAdmin"]);
unset($_SESSION["usuario"]);
unset($_SESSION['nombres']);
unset($_SESSION['apellidos']);
header("Location:../../index.php");
