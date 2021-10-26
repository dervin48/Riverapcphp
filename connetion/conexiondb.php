<?php 

$servidor="mysql:dbname=riverapc;localhost:3307";
$usuario="root";
$password="root";

try{
    $pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

//    echo "Conectado..";

}catch(PDOException $e){

    echo "Conexión mala :( ".$e->getMessage();

}


?>