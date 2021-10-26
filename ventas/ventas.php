<?php

        
include ("connetion/conexiondb.php");

//Variables de Detalle Venta
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

$txtIDVENTA=(isset($_POST['txtIDVENTA']))?$_POST['txtIDVENTA']:"";
$txtIDPRODUCTO=(isset($_POST['txtIDPRODUCTO']))?$_POST['txtIDPRODUCTO']:"";
$txtCANTIDAD=(isset($_POST['txtCANTIDAD']))?$_POST['txtCANTIDAD']:"";

//Variables Venta
$txtIDEMPLEADO=(isset($_POST['txtIDEMPLEADO']))?$_POST['txtIDEMPLEADO']:"";
$txtIDCLIENTE=(isset($_POST['txtIDCLIENTE']))?$_POST['txtIDCLIENTE']:"";



//Convertir formato de Fecha para MySQL
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";

    if ($txtFecha!=""){
         $anio=date('Y', strtotime($_POST['txtFecha']));
            $mes=date('m', strtotime($_POST['txtFecha']));
            $dia=date('d', strtotime($_POST['txtFecha']));
          //generando fecha en formato 'yyyy-mm-dd' para ser almacenada en la base de datos
            $txtFechaNacimiento=$anio . "-" . $mes . "-" . $dia;  
    }
        
//Variables de Busqueda
$txtBuscqueda=(isset($_POST['txtBusqueda']))?$_POST['txtBusqueda']:"0";
$paramentro=(isset($_POST['paramentro']))?$_POST['paramentro']:"";


//Variables de botones

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$accionFinal="";
$error=array();
$mostrarModal=false;
    $accionBuscar="";
    $accionVenta="";
    $accionAgregar="";
        $accionCancelar="";
        $accionModificar=$accionEliminar="disabled";





   
   
switch($accion){
    case "btnAg":

        $accionAgregar="";
        $accionModificar=$accionEliminar=$accionCancelar="disabled";
        break;
    case "btnAgregar": 
        if($txtIDEMPLEADO!="" and $txtIDCLIENTE!="" and $txtIDPRODUCTO!="" and $txtCANTIDAD!=""){
            
            $txtIDVENTA=recuperaVenta();

        //agrego el producto a la última venta creada 
            $sentencia=$pdo->prepare("INSERT INTO `detalle_venta`(`IDVENTA`, `IDPRODUCTO`, `CANTIDAD`) 
            VALUES (:IDVENTA,:IDPRODUCTO,:CANTIDAD) ");

            $sentencia->bindParam(':IDVENTA',$txtIDVENTA);
            $sentencia->bindParam(':IDPRODUCTO',$txtIDPRODUCTO);
            $sentencia->bindParam(':CANTIDAD',$txtCANTIDAD);
            $sentencia->execute();
            
            $total= actualizaTotal($txtIDVENTA);
            
            echo "<h3>Total Venta: ".$total."</h3>";
            echo "<br>";
            echo "<h3>No. de Venta: ".$txtIDVENTA."</h3>";
                        
        $txtIDPRODUCTO="";
        $txtCANTIDAD="";
   
        } else if ($txtIDEMPLEADO!="" and $txtIDCLIENTE!=""){
            $txtIDVENTA=recuperaVenta();
            $total= actualizaTotal($txtIDVENTA);
            
            echo "<h3>Total Venta: ".$total."</h3>";
            echo "<br>";
            echo "<h3>No. de Venta: ".$txtIDVENTA."</h3>";
        }
        
        

    break;
    case "btnModificar": 
        
            $txtIDVENTA=recuperaVenta();
            $total= actualizaTotal($txtIDVENTA);
            
            echo $total;
        $sentencia=$pdo->prepare(" UPDATE detalle_venta SET 
        CANTIDAD=:CANTIDAD
        WHERE IDDETALLE = :IDDETALLE");
            $sentencia->bindParam(':CANTIDAD',$txtCANTIDAD);
            $sentencia->bindParam(':IDDETALLE',$txtID);
            $sentencia->execute();
       
                       echo "<h3>Total Venta: ".$total."</h3>";
            echo "<br>";
            echo "<h3>No. de Venta: ".$txtIDVENTA."</h3>";



    break;
    case "btnEliminar":
            $txtIDVENTA=recuperaVenta();
            $total= actualizaTotal($txtIDVENTA);
            
            
            $sentencia=$pdo->prepare("DELETE FROM `detalle_venta` WHERE IDDETALLE = :IDDETALLE");
            $sentencia->bindParam(':IDDETALLE',$txtID);
              
            $sentencia->execute();

$sentencia2=$pdo->prepare("SELECT * FROM venta ORDER by IDVENTA DESC LIMIT 1");
        $sentencia2->execute();
        $DATO=$sentencia2->fetch(PDO::FETCH_LAZY);
        $txtIDVENTA=$DATO['IDVENTA'];

            echo "<h3>Total Venta: ".$total."</h3>";
            echo "<br>";
            echo "<h3>No. de Venta: ".$txtIDVENTA."</h3>";

    break;
    case "btnCancelar": 

    break;
    case "Seleccionar": 

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;


        $sentencia=$pdo->prepare("SELECT * FROM `detalle_venta` WHERE IDDETALLE=:IDDETALLE");
        $sentencia->bindParam(':IDDETALLE',$txtID);
        $sentencia->execute();
        $DATO=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $txtID=$DATO['IDDETALLE'];
        $txtIDVENTA=$DATO['IDVENTA'];
        $txtIDPRODUCTO=$DATO['IDPRODUCTO'];
        $txtCANTIDAD=$DATO['CANTIDAD'];
        
             
    break;
    case "btnBuscar":
    
        break;
    case "btnVenta":
        if($txtIDEMPLEADO!="" and $txtIDCLIENTE!=""){
            
            
            $sentencia=$pdo->prepare("INSERT INTO `venta`(`IDEMPLEADO`, `IDCLIENTE`, `FECHA`) 
            VALUES (:IDEMPLEADO,:IDCLIENTE,SYSDATE()) ");

            $sentencia->bindParam(':IDEMPLEADO',$txtIDEMPLEADO);
            $sentencia->bindParam(':IDCLIENTE',$txtIDCLIENTE);
            
            $sentencia->execute();
            
            $txtIDVENTA=recuperaVenta();
            $total= actualizaTotal($txtIDVENTA);
            echo "<h3>Total Venta: Q.".$total."</h3>";
            echo "<br>";
            echo "<h3>No. de Venta: ".$txtIDVENTA."</h3>";
        
        }
                   
        break;
        case "btnFinalVenta":
             if($txtIDEMPLEADO!="" and $txtIDCLIENTE!=""){
            $txtIDVENTA=recuperaVenta();
            $total= actualizaTotal($txtIDVENTA);
            
            $sentencia=$pdo->prepare(" UPDATE venta SET 
        total=:total
        WHERE IDVENTA = :IDVENTA");
            $sentencia->bindParam(':total',$total);
            $sentencia->bindParam(':IDVENTA',$txtIDVENTA);
            $sentencia->execute();            
            $txtIDEMPLEADO ="";
            $txtIDCLIENTE ="";
            $txtIDVENTA ="";
            $txtIDPRODUCTO="";
            $txtCANTIDAD="";
            
             }
            break;
}

if($txtIDVENTA!="" and $txtIDEMPLEADO!=""){
       $sentencia= $pdo->prepare("SELECT IDDETALLE,PRODUCTO.DESCRIPCION, producto.PRECIOV, detalle_venta.CANTIDAD FROM detalle_venta,producto "
           . "WHERE detalle_venta.IDVENTA=:IDVENTA AND producto.IDPRODUCTO=detalle_venta.IDPRODUCTO");
   $sentencia->bindParam(':IDVENTA',$txtIDVENTA);
   $sentencia->execute();
   $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);  
}






// función de recuperar última venta y actualizar total de venta
function recuperaVenta() {
    include ("connetion/conexiondb.php");
         //Recupero la ultima venta creada
        $sentencia2=$pdo->prepare("SELECT * FROM venta ORDER by IDVENTA DESC LIMIT 1");
        $sentencia2->execute();
        $DATO=$sentencia2->fetch(PDO::FETCH_LAZY);
        $txtIDVENTA=$DATO['IDVENTA'];
        
        return $txtIDVENTA;
       
}

function actualizaTotal($txtIDVENTA){
    include ("connetion/conexiondb.php");
    //        SELECT SUM(Precios) FROM Productos

        $sentencia3=$pdo->prepare("SELECT SUM(detalle_venta.CANTIDAD*producto.PRECIOV) "
                . "total FROM detalle_venta,producto WHERE detalle_venta.IDVENTA= $txtIDVENTA AND producto.IDPRODUCTO=detalle_venta.IDPRODUCTO");
        $sentencia3->execute();
        $DATO1=$sentencia3->fetch(PDO::FETCH_LAZY);
        $total=$DATO1['total'];
        return $total;        
}
?>