<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtIDEMPLEADO=(isset($_POST['txtIDEMPLEADO']))?$_POST['txtIDEMPLEADO']:"";
$txtSALDOI=(isset($_POST['txtSALDOI']))?$_POST['txtSALDOI']:"";
$txtSALDOF=(isset($_POST['txtSALDOF']))?$_POST['txtSALDOF']:"";

$txtBuscqueda=(isset($_POST['txtBusqueda']))?$_POST['txtBusqueda']:"0";
$paramentro=(isset($_POST['paramentro']))?$_POST['paramentro']:"";

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
        
        
          if($txtIDEMPLEADO==""){
              $error[ 'IDEMPLEADO']="Digite ID Empleado";
          }
         if($txtSALDOI==""){
            $error['SALDOI']="Digite Saldo Inicial";
            
         }
         if($txtSALDOF==""){
            $error['SALDOF']="Digite Saldo Final";
         }
         if($txtFecha==""){
            $error['Fecha']="Seleccione la Fecha";
         }


          if(count($error)>0){
              $mostrarModal=true;
              break;

          }
                     
            $sentencia=$pdo->prepare("INSERT INTO cortediario(IDEMPLEADO,SALDOI,SALDOF,FECHA) 
            VALUES (:IDEMPLEADO,:SALDOI,:SALDOF,:FECHA) ");

            $sentencia->bindParam('IDEMPLEADO',$txtIDEMPLEADO);
            $sentencia->bindParam('SALDOI',$txtSALDOI);
            $sentencia->bindParam('SALDOF',$txtSALDOF);
            $sentencia->bindParam(':FECHA',$txtFecha);
                   
            $sentencia->execute();

    break;
    case "btnModificar": 

        $sentencia=$pdo->prepare(" UPDATE `cortediario` SET 
        IDEMPLEADO=:IDEMPLEADO,
        SALDOI = :SALDOI,
        SALDOF = :SALDOF,
        FECHA=:FECHA
        WHERE IDCORTE=:IDCORTE");

            $sentencia->bindParam('IDEMPLEADO',$txtIDEMPLEADO);
            $sentencia->bindParam('SALDOI',$txtSALDOI);
            $sentencia->bindParam('SALDOF',$txtSALDOF);
            $sentencia->bindParam(':FECHA',$txtFecha);
            $sentencia->bindParam(':IDCORTE',$txtID);

            $sentencia->execute();
       
    break;
    case "btnEliminar":


            $sentencia=$pdo->prepare("DELETE FROM `cortediario` WHERE IDCORTE = :IDCORTE");
            $sentencia->bindParam(':IDCORTE',$txtID);
            
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


        $sentencia=$pdo->prepare("SELECT * FROM `cortediario` WHERE IDCORTE=:IDCORTE");
        $sentencia->bindParam(':IDCORTE',$txtID);
        $sentencia->execute();
        $DATO=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $txtID=$DATO['IDCORTE'];
        $txtIDEMPLEADO=$DATO['IDEMPLEADO'];
        $txtSALDOI=$DATO['SALDOI'];
        $txtSALDOF=$DATO['SALDOF'];
        $txtFecha=$DATO['FECHA'];

        

             
    break;
    case "btnBuscar":

        if($paramentro!="" AND $txtBuscqueda!="0"){
            if($paramentro== "ID"){
             $sentencia= $pdo->prepare("SELECT * FROM `cortediario` WHERE IDCORTE=:IDCORTE");
            $sentencia->bindParam(':IDCORTE',$txtBuscqueda);
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }
            if($paramentro== "IDEMPLEADO"){

             $sentencia= $pdo->prepare("SELECT * FROM `cortediario` WHERE IDEMPLEADO = :IDEMPLEADO");
             $sentencia->bindParam(':IDEMPLEADO',$txtBuscqueda);
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }


        }

 
    
        break;
}
   if($paramentro == "" or $txtBuscqueda=="0" ){
   $sentencia= $pdo->prepare("SELECT * FROM `cortediario` WHERE 1");
   $sentencia->execute();
   $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);      
   }


//    print_r($listaEmpleados);
?>