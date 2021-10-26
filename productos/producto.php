<?php
//variables que se reciben del form
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtPRECIOV=(isset($_POST['txtPRECIOV']))?$_POST['txtPRECIOV']:"";
$txtPRECIOC=(isset($_POST['txtPRECIOC']))?$_POST['txtPRECIOC']:"";

//variables de busqueda
$txtBuscqueda=(isset($_POST['txtBusqueda']))?$_POST['txtBusqueda']:"0";
$paramentro=(isset($_POST['paramentro']))?$_POST['paramentro']:"";


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

        
          if($txtDescripcion==""){
              $error[ 'Descripcion']="Escribe la Descripcion";
          }
          if($txtCantidad==""){
            $error['Cantidad']="Escribe la Cantidad";
         }
         if($txtPRECIOC==""){
            $error['PRECIOC']="Escribe el Precio de Compra";
         }
         if($txtPRECIOV==""){
            $error['PRECIOV']="Escribe el Precio de Venta";
         }

         if(count($error)>0){
              $mostrarModal=true;
              break;

          }
           
          
            $sentencia=$pdo->prepare("INSERT INTO producto(DESCRIPCION,CANTIDAD,PRECIOC,PRECIOV) 
            VALUES (:DESCRIPCION,:CANTIDAD,:PRECIOC,:PRECIOV) ");

            $sentencia->bindParam(':DESCRIPCION',$txtDescripcion);
            $sentencia->bindParam(':CANTIDAD',$txtCantidad);
            $sentencia->bindParam(':PRECIOC',$txtPRECIOC);
            $sentencia->bindParam(':PRECIOV',$txtPRECIOV);
            
            
            $sentencia->execute();

       

    break;
    case "btnModificar": 

        $sentencia=$pdo->prepare(" UPDATE PRODUCTO SET 
        DESCRIPCION=:DESCRIPCION,
        CANTIDAD=:CANTIDAD,
        PRECIOC=:PRECIOC,
        PRECIOV=:PRECIOV
        WHERE IDPRODUCTO= :IDPRODCUTO");

            $sentencia->bindParam(':DESCRIPCION',$txtDescripcion);
            $sentencia->bindParam(':CANTIDAD',$txtCantidad);
            $sentencia->bindParam(':PRECIOC',$txtPRECIOC);
            $sentencia->bindParam(':PRECIOV',$txtPRECIOV);
            $sentencia->bindParam(':IDPRODCUTO',$txtID);
  
            $sentencia->execute();
       
    break;
    case "btnEliminar":

            $sentencia=$pdo->prepare("DELETE FROM `PRODUCTO` WHERE IDPRODUCTO = :IDPRODUCTO");
            $sentencia->bindParam(':IDPRODUCTO',$txtID);
            
            $sentencia->execute();

    break;
    case "btnCancelar": 
//         headeSZr('Location: empleados/index.php');
//        $op=1;
    break;
    case "Seleccionar": 

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;


        $sentencia=$pdo->prepare("SELECT * FROM producto WHERE IDPRODUCTO= :IDPRODUCTO");
        $sentencia->bindParam(':IDPRODUCTO',$txtID);
        $sentencia->execute();
        $DATO=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $txtID=$DATO['IDPRODUCTO'];
        $txtDescripcion=$DATO['DESCRIPCION'];
        $txtCantidad=$DATO['CANTIDAD'];
        $txtPRECIOC=$DATO['PRECIOC'];
        $txtPRECIOV=$DATO['PRECIOV'];

             
    break;
    case "btnBuscar":

        if($paramentro!="" AND $txtBuscqueda!="0"){
            if($paramentro== "ID"){
             $sentencia= $pdo->prepare("SELECT * FROM `PRODUCTO` WHERE IDPRODUCTO=:IDPRODUCTO");
            $sentencia->bindParam(':IDPRODUCTO',$txtBuscqueda);
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }
            if($paramentro== "DESCRIPCION"){

                $likeKeyWord = "'%$txtBuscqueda%'";
             $sentencia= $pdo->prepare("SELECT * FROM `PRODUCTO` WHERE DESCRIPCION LIKE $likeKeyWord");

            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }


        }

 
    
        break;
}
   if($paramentro == "" or $txtBuscqueda=="0" ){
   $sentencia= $pdo->prepare("SELECT * FROM `producto` WHERE 1");
   $sentencia->execute();
   $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);      
   }


//    print_r($listaEmpleados);
?>