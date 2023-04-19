<?php
try {
    $con = new PDO('mysql:host=localhost:3305;dbname=stina_modas', 'root', 'senhafoda');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
    echo ("<br>" . "não conectado");
}
?>