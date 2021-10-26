<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtIDCLIENTE=(isset($_POST['txtIDCLIENTE']))?$_POST['txtIDCLIENTE']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";

$txtBuscqueda=(isset($_POST['txtBusqueda']))?$_POST['txtBusqueda']:"0";
$paramentro=(isset($_POST['paramentro']))?$_POST['paramentro']:"";
//
//        //echo $_POST['fechanac'];
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";

    if ($txtFecha!=""){
         $anio=date('Y', strtotime($_POST['txtFecha']));
            $mes=date('m', strtotime($_POST['txtFecha']));
            $dia=date('d', strtotime($_POST['txtFecha']));
          //generando fecha en formato 'yyyy-mm-dd' para ser almacenada en la base de datos
            $txtFecha=$anio . "-" . $mes . "-" . $dia;  
    }
        

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$error=array();
$mostrarModal=false;
    $accionBuscar="";
        $accionAgregar="";
        $accionCancelar="";
        $accionModificar=$accionEliminar="disabled";
        
include ("connetion/conexiondb.php");

//Valida las acciones del boton y realiza las acciones

switch($accion){
    case "btnAg":
        $accionAgregar="";
        $accionModificar=$accionEliminar="disabled";
        break;
    case "btnAgregar": 
        
        
          if($txtIDCLIENTE==""){
              $error[ 'IDCLIENTE']="Digite ID Cliente";
          }
         if($txtDireccion==""){
            $error['Direccion']="Escribe la Dirección";
         }
         if($txtFecha==""){
            $error['Fecha']="Seleccione la Fecha";
         }


          if(count($error)>0){
              $mostrarModal=true;
              break;

          }
                     
            $sentencia=$pdo->prepare("INSERT INTO cita_soporte(IDCLIENTE,DIRECCION,FECHA) 
            VALUES (:IDCLIENTE,:DIRECCION,:FECHA) ");

            $sentencia->bindParam('IDCLIENTE',$txtIDCLIENTE);
            $sentencia->bindParam(':DIRECCION',$txtDireccion);
            $sentencia->bindParam(':FECHA',$txtFecha);
                   
            $sentencia->execute();

    break;
    case "btnModificar": 

        $sentencia=$pdo->prepare(" UPDATE `cita_soporte` SET 
        IDCLIENTE=:IDCLIENTE,
        DIRECCION=:DIRECCION,
        FECHA=:FECHA
        WHERE IDCITA=:IDCITA");

            $sentencia->bindParam(':IDCLIENTE',$txtIDCLIENTE);
            $sentencia->bindParam(':DIRECCION',$txtDireccion);
            $sentencia->bindParam(':FECHA',$txtFecha);
            $sentencia->bindParam(':IDCITA',$txtID);

            $sentencia->execute();
       
    break;
    case "btnEliminar":


            $sentencia=$pdo->prepare("DELETE FROM `cita_soporte` WHERE IDCITA = :IDCITA");
            $sentencia->bindParam(':IDCITA',$txtID);
            
            $sentencia->execute();



    break;
    case "btnCancelar": 
//         header('Location: empleados/index.php');
//        $op=1;
    break;
    case "Seleccionar": 

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;


        $sentencia=$pdo->prepare("SELECT * FROM cita_soporte WHERE IDCITA= :IDCITA");
        $sentencia->bindParam(':IDCITA',$txtID);
        $sentencia->execute();
        $DATO=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $txtID=$DATO['IDCITA'];
        $txtIDCLIENTE=$DATO['IDCLIENTE'];
        $txtDireccion=$DATO['DIRECCION'];
        $txtFecha=$DATO['FECHA'];

        

             
    break;
    case "btnBuscar":

        if($paramentro!="" AND $txtBuscqueda!="0"){
            if($paramentro== "IDCITA"){
             $sentencia= $pdo->prepare("SELECT * FROM `cita_soporte` WHERE IDCITA=:IDCITA");
            $sentencia->bindParam(':IDCITA',$txtBuscqueda);
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }
            if($paramentro== "DIRECCION"){

                $likeKeyWord = "'%$txtBuscqueda%'";
             $sentencia= $pdo->prepare("SELECT * FROM `cita_soporte` WHERE DIRECCION LIKE $likeKeyWord");

            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }


        }

 
    
        break;
}
   if($paramentro == "" or $txtBuscqueda=="0" ){
   $sentencia= $pdo->prepare("SELECT * FROM `cita_soporte` WHERE 1");
   $sentencia->execute();
   $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);      
   }


//    print_r($listaEmpleados);
?>