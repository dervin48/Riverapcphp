<?php 
require "ventas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scale=no initial-scale=1.0, shrink-to-fit=no maximum-scale=1.0 minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VENTAS</title>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>
<body>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" >

      

<!-- Modal -->
<div class="modal fullscreen-modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel  ">Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-row">
<!--      <input type="hidden" required name="txtID" value="<?php // echo $txtID;?>" placeh0older="" id="txtID" require="">
    -->
    <div class="form-group col-md-5">
    <label for="">ID:</label>
    <input type="text" readonly="readonly" class="form-control <?php echo (isset($error['ID']))?"is-invalid":"";?>" name="txtID"  value="<?php echo $txtID;?>" placeholder="" id="txtID" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['ID']))?$error['ID']:"";?>
    </div>
    <br>
    </div>
    
    
    <div class="form-group col-md-5">
    <label for="">ID VENTA:</label>
    <input type="text"  readonly="readonly" class="form-control <?php echo (isset($error['ID']))?"is-invalid":"";?>" name="txtIDVENTA'"  value="<?php echo $txtIDVENTA;?>" placeholder="" id="txtIDVENTA" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['IDVENTA']))?$error['IDVENTA']:"";?>
    </div>
    <br>
    </div>
          
    <div class="form-group col-md-5">
    <label for="">ID PRODUCTO:</label>
    <input type="text" readonly="readonly" class="form-control  <?php echo (isset($error['IDPRODUCTO']))?"is-invalid":"";?>" name="txtIDPRODUCTO"  value="<?php echo $txtIDPRODUCTO;?>" placeholder="" id="txtIDPRODUCTO" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['IDPRODUCTO']))?$error['IDPRODUCTO']:"";?>
    </div>
    <br>
    </div>
    
    <div class="form-group col-md-5">
    <label for="">CANTIDAD:</label>
    <input type="text"  class="form-control <?php echo (isset($error['CANTIDAD']))?"is-invalid":"";?>" name="txtCANTIDAD"  value="<?php echo $txtCANTIDAD;?>" placeholder="" id="txtCANTIDAD" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['CANTIDAD']))?$error['CANTIDAD']:"";?>
    </div>
    
    <br>
    </div> 
      </div>
      </div>
      <div class="modal-footer">
        <button value="btnModificar"  <?php echo $accionModificar;?>  class="btn btn-warning " type="submit" name="accion">Modificar</button>
        <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" <?php echo $accionEliminar;?> class="btn btn-danger " type="submit" name="accion">Eliminar</button>
        <button value="btnCancelar" <?php echo $accionCancelar;?>  class="close" type="submit" name="accion">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<br/>
<br/>

    
<br>
<br>

    </form>
    
<!--Crear Venta-->
<form action="" method="post" enctype="multipart/form-data" >
 <div class="input-group">
   <input type="hidden"  class="form-control" name="txtIDVENTA"  value="" placeholder="" id="txtIDVENTA" require="">

   <div class="form-group col-md-3"
    <label for="EMPLEADO">EMPLEADO</label>
    <input type="text"  class="form-control" name="txtIDEMPLEADO"  value="<?php echo $txtIDEMPLEADO;?>" placeholder="Digite ID de Empleado" id="txtIDEMPLEADO" require="">
    
   </div>    
   
   <div class="form-group col-md-3">
   <label for="CLIENTE">CLIENTE</label>    
   <input type="text"  class="form-control" name="txtIDCLIENTE"  value="<?php echo $txtIDCLIENTE;?>" placeholder="Digite ID de CLIENTE" id="txtIDCLIENTE" require="">
    </div>
   
   <div class="form-group col-md-3">
   <label for="CLIENTE">FECHA</label>
   <input type="datetype"  class="form-control" name="txtFecha"  value="<?php echo date("d-m-Y");?>" placeholder="" id="txtFecha" require="">
   </div>
<button value="btnVenta" <?php echo $accionVenta;?> class="btn btn-primary mr-2 btn-lg" type="submit" name="accion"> <?php echo (empty($txtID and $txtIDEMPLEADO and $txtIDCLIENTE and $txtFecha))?"Crear Venta":"Finalizar Venta";?> </button>
       </div>



<form action="" method="post" enctype="multipart/form-data" >
 <div class="input-group">
    <div class="form-group col-md-4">
      <label for="IDPRODUCTO">COD PRODUCTO</label>
      <input type="text"  class="form-control" name="txtIDPRODUCTO"  value="<?php echo $txtIDPRODUCTO;?>" placeholder="Digite producto" id="txtIDPRODUCTO" require="">
    </div>
    <div class="form-group col-md-4">
      <label for="CANTIDAD" >CANTIDAD: </label>
       <input type="text"  class="form-control" name="txtCANTIDAD"  value="<?php echo $txtCANTIDAD;?>" placeholder="Digite Cantidad" id="txtCANTIDAD" require="">    
       
    </div>
<button value="btnAgregar" <?php echo $accionAgregar;?> class="btn btn-success " type="submit" name="accion">Agregar  </button>
<button value="btnFinalVenta" <?php echo $accionFinal;?> class="btn btn-danger mr-1 btn-lg" type="submit" name="accion">Finalizar Venta</button> 

</div>
</form>

<br>
<br>

    </form>
<div class="table-responsive-sm">

        <table class="table">
            
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>SUB-TOTAL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        <?php if($txtIDVENTA!="" and $txtIDEMPLEADO!=""){foreach($listaProductos as $DATO){ ?>
                <tr>
                    <td><?php echo $DATO['IDDETALLE'] ?></td>
                    <td><?php echo  $DATO['DESCRIPCION']; ?> </td>
                    <td><?php echo  $DATO['CANTIDAD']; ?> </td>
                    <td><?php echo  $DATO['PRECIOV']; ?> </td>
                    <td><?php echo  ($DATO['PRECIOV'])*($DATO['CANTIDAD']); ?> </td>
                    <td>
                    
                    <form action="" method="post">
                    <input type="hidden" name="txtID" value="<?php echo  $DATO['IDDETALLE']; ?>" >
                    <input type="hidden" name="txtNombres" value="<?php echo  $DATO['DESCRIPCION']; ?>" >
                    <input type="hidden" name="txtApellidos" value="<?php echo  $DATO['CANTIDAD']; ?>" >
                    <input type="hidden" name="txtDPI" value="<?php echo  $DATO['PRECIOV']; ?>" >

                    <button value="Seleccionar"  type="submit" class="btn btn-info " name="accion">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
</svg> 
                    </button>

                    <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');"   type="submit" class="btn btn-danger " name="accion"
                            ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>
                    
                    
                    </form>

                    
                    
                    
                    </td>
                </tr>

        <?php }} ?>

        </table>


</div>
    <?php if($mostrarModal){?>
    <script>
        $('#exampleModal').modal('show');
        
        
	</script>
<?php }?>
        
        <script>
             function resetModal() {
          $("#exampleModal").find("input,textarea,select").val("");
          $("#exampleModal input[type='checkbox']").prop('checked', false).change();   
             }
                </script>
        
</div>    
</body>

</html>