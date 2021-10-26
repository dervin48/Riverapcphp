<?php
//variables que se reciben del form
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombres=(isset($_POST['txtNombres']))?$_POST['txtNombres']:"";
$txtApellidos=(isset($_POST['txtApellidos']))?$_POST['txtApellidos']:"";
$txtNIT=(isset($_POST['txtNIT']))?$_POST['txtNIT']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";

//variables de busqueda
$txtBuscqueda=(isset($_POST['txtBusqueda']))?$_POST['txtBusqueda']:"0";
$paramentro=(isset($_POST['paramentro']))?$_POST['paramentro']:"";
//
//        //echo $_POST['fechanac'];
$txtFechaNacimiento=(isset($_POST['txtFechaNacimiento']))?$_POST['txtFechaNacimiento']:"";

    if ($txtFechaNacimiento!=""){
         $anio=date('Y', strtotime($_POST['txtFechaNacimiento']));
            $mes=date('m', strtotime($_POST['txtFechaNacimiento']));
            $dia=date('d', strtotime($_POST['txtFechaNacimiento']));
          //generando fecha en formato 'yyyy-mm-dd' para ser almacenada en la base de datos
            $txtFechaNacimiento=$anio . "-" . $mes . "-" . $dia;  
    }
        
        
$txtSueldo=(isset($_POST['txtSueldo']))?$_POST['txtSueldo']:"";

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
        $accionModificar=$accionEliminar=$accionCancelar="disabled";
        break;
    case "btnAgregar": 
        
        
          if($txtNombres==""){
              $error[ 'Nombres']="Escribe los nombres";
          }
          if($txtApellidos==""){
            $error['Apellidos']="Escribe el apellido";
         }
         if($txtNIT==""){
            $error['NIT']="Escribe el NIT";
         }
         if($txtDireccion==""){
            $error['Direccion']="Escribe la Dirección";
         }
         if($txtTelefono==""){
            $error['Telefono']="Escribe el Teléfono";
         }      
         if($txtCorreo==""){
            $error['Correo']="Escribe el correo";
         }
         if($txtFechaNacimiento==""){
            $error['FechaNacimiento']="Seleccione la Fecha";
         }


          if(count($error)>0){
              $mostrarModal=true;
              break;

          }
           
          
            $sentencia=$pdo->prepare("INSERT INTO cliente(NOMBRES,APELLIDOS,NIT,DIRECCION,TELEFONO,EMAIL,FECHA_NACIMIENTO) 
            VALUES (:NOMBRES,:APELLIDOS,:NIT,:DIRECCION,:TELEFONO,:EMAIL,:FECHA_NACIMIENTO) ");

            $sentencia->bindParam(':NOMBRES',$txtNombres);
            $sentencia->bindParam(':APELLIDOS',$txtApellidos);
            $sentencia->bindParam(':NIT',$txtNIT);
            $sentencia->bindParam(':DIRECCION',$txtDireccion);
            $sentencia->bindParam(':TELEFONO',$txtTelefono);
            $sentencia->bindParam(':EMAIL',$txtCorreo);
            $sentencia->bindParam(':FECHA_NACIMIENTO',$txtFechaNacimiento);
            
            
            $sentencia->execute();

       

    break;
    case "btnModificar": 
    
        $sentencia=$pdo->prepare(" UPDATE CLIENTE SET 
        NOMBRES=:NOMBRES,
        APELLIDOS=:APELLIDOS,
        NIT=:NIT,
        DIRECCION=:DIRECCION,
        TELEFONO=:TELEFONO,
        EMAIL=:EMAIL,
        FECHA_NACIMIENTO=:FECHA_NACIMIENTO
        WHERE IDCLIENTE=:IDCLIENTE");

//        
                        
            $sentencia->bindParam(':NOMBRES',$txtNombres);
            $sentencia->bindParam(':APELLIDOS',$txtApellidos);
            $sentencia->bindParam(':NIT',$txtNIT);
            $sentencia->bindParam(':DIRECCION',$txtDireccion);
            $sentencia->bindParam(':TELEFONO',$txtTelefono);
            $sentencia->bindParam(':EMAIL',$txtCorreo);
            $sentencia->bindParam(':FECHA_NACIMIENTO',$txtFechaNacimiento);
            $sentencia->bindParam(':IDCLIENTE',$txtID);
        
        
            $sentencia->execute();
       
           

//            header('Location: index.php');


    break;
    case "btnEliminar":


            $sentencia=$pdo->prepare("DELETE FROM `cliente` WHERE IDCLIENTE = :IDCLIENTE");
            $sentencia->bindParam(':IDCLIENTE',$txtID);
            
            $sentencia->execute();

//            header('Location: index.php');


    break;
    case "btnCancelar": 
//         header('Location: empleados/index.php');
//        $op=1;
    break;
    case "Seleccionar": 

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;


        $sentencia=$pdo->prepare("SELECT * FROM cliente WHERE IDCLIENTE= :IDCLIENTE");
        $sentencia->bindParam(':IDCLIENTE',$txtID);
        $sentencia->execute();
        $DATO=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $txtID=$DATO['IDCLIENTE'];
        $txtNombres=$DATO['NOMBRES'];
        $txtApellidos=$DATO['APELLIDOS'];
        $txtNIT=$DATO['NIT'];
        $txtDireccion=$DATO['DIRECCION'];
        $txtTelefono=$DATO['TELEFONO'];
        $txtCorreo=$DATO['EMAIL'];
        $txtFechaNacimiento=$DATO['FECHA_NACIMIENTO'];

        

             
    break;
    case "btnBuscar":

        if($paramentro!="" AND $txtBuscqueda!="0"){
            if($paramentro== "ID"){
             $sentencia= $pdo->prepare("SELECT * FROM `CLIENTE` WHERE IDCLIENTE=:IDCLIENTE");
            $sentencia->bindParam(':IDCLIENTE',$txtBuscqueda);
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }
            if($paramentro== "NOMBRES"){

                $likeKeyWord = "'%$txtBuscqueda%'";
             $sentencia= $pdo->prepare("SELECT * FROM `CLIENTE` WHERE NOMBRES LIKE $likeKeyWord");

            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);   
            }


        }

 
    
        break;
}
   if($paramentro == "" or $txtBuscqueda=="0" ){
   $sentencia= $pdo->prepare("SELECT * FROM `cliente` WHERE 1");
   $sentencia->execute();
   $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);      
   }


//    print_r($listaEmpleados);
?>