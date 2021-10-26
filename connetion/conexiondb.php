<?php 

$servidor="mysql:id17788761_riverapc;databases.000webhost.com";
$usuario="id17788761_root";
$password="Jutiapa1232020@";

try{
    $pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

//    echo "Conectado..";

}catch(PDOException $e){

    echo "Conexión mala :( ".$e->getMessage();

}


?>