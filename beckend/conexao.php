<?php
try {
    $con = new PDO('mysql:host=localhost:3306;dbname=stina_modas', 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
    echo ("<br>" . "não conectado");
}
?>