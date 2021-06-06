<?php

try {
    $dsn ='mysql:host=localhost;dbname=scolarite';
    $db_username = 'root';
    $db_password = '';
    $db = new PDO($dsn,$db_username,$db_password);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
} catch (PDOException $error) {
    echo "Impossible de connecter a la basse de données";
    echo $error->getMessage();
    die();
}
?>