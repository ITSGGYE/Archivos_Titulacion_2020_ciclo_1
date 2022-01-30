<?php
try {
        $bdd = new PDO('mysql:host=localhost;port=3306;dbname=ferreteria_santos;charset=utf8', 'root', '',);
} catch (Exception $e) {
        die('Error : ' . $e->getMessage());
}
