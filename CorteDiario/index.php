<?php 
require "CorteDiario.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scale=no initial-scale=1.0, shrink-to-fit=no maximum-scale=1.0 minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Corte Diario</title>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>
<body>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" >



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
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
    
    
    <div class="form-group col-md-7">
    <label for="">ID EMPLEADO:</label>
    <input type="text" class="form-control <?php echo (isset($error['IDEMPLEADO']))?"is-invalid":"";?>" name="txtIDEMPLEADO"  value="<?php echo $txtIDEMPLEADO;?>" placeholder="" id="txtIDEMPLEADO" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['IDEMPLEADO']))?$error['IDEMPLEADO']:"";?>
    </div>
    <br>
    </div>
          

     
    <div class="form-group col-md-4">
    <label for="">SALDO INICIAL:</label>
    <input type="number"  class="form-control <?php echo (isset($error['SALDOI']))?"is-invalid":"";?>" name="txtSALDOI"  value="<?php echo $txtSALDOI;?>" placeholder="" id="txtSALDOI" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['SALDOI']))?$error['SALDOI']:"";?>
    </div>
    <br>
    </div>
    
    <div class="form-group col-md-4">
    <label for="">SALDO FINAL:</label>
    <input type="number"  class="form-control <?php echo (isset($error['SALDOF']))?"is-invalid":"";?>" name="txtSALDOF"  value="<?php echo $txtSALDOF;?>" placeholder="" id="txtSALDOF" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['SALDOF']))?$error['SALDOF']:"";?>
    </div>
    <br>
    </div>

    <div class="form-group col-md-4">
    <label for="">FECHA:</label>
    <input type="date" class="form-control <?php echo (isset($error['Fecha']))?"is-invalid":"";?>" name="txtFecha"  value="<?php echo $txtFecha;?>" placeholder="" id="txtFecha" require="">
    <div class="invalid-feedback">
    <?php echo (isset($error['Fecha']))?$error['Fecha']:"";?>
    </div>
    <br>
    </div>
    


    

      </div>
      </div>
      <div class="modal-footer">
        <button value="btnAgregar" <?php echo $accionAgregar;?> class="btn btn-success " type="submit" name="accion">Agregar  </button>
        <button value="btnModificar"  <?php echo $accionModificar;?>  class="btn btn-warning " type="submit" name="accion">Modificar</button>
        <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" <?php echo $accionEliminar;?> class="btn btn-danger " type="submit" name="accion">Eliminar</button>
        <button value="btnCancelar" <?php echo $accionCancelar;?>  class="close" type="submit" name="accion">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</div>
<br/>
<br/>
<!-- Button trigger modal -->
<button type="button"  value="btnAg" onclick="resetModal()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Agregar registro + 
</button>

    
<br>
<br>

    </form>
<!--Busqueda-->
     <form action="" method="post" enctype="multipart/form-data" >
      <div class="input-group">
<button value="btnBuscar" <?php echo $accionBuscar;?> class="btn btn-primary" type="submit" name="accion"> <?php echo (empty($txtBuscqueda and $paramentro))?"Buscar":"Finalizar";?> </button>

          

<select class="selectpicker"  aria-label="Default select example" name="paramentro">
  <option selected></option>  
  <option value="ID">ID</option>
  <option value="IDEMPLEADO">IDEMPLEADO</option>
</select>        


          <input type="text"  class="form-control" name="txtBusqueda"  value="" placeholder="Escriba Paramentros de búsqueda" id="txtBusqueda" require="">
    <div class="invalid-feedback"></div>
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
                    <th>IDEMPLEADO</th>
                    <th>SALDO INICIAL</th>
                    <th>SALDO FINAL</th>
                    <th>FECHA</th>

                    <th>Acciones</th>
                </tr>
            </thead>
        <?php foreach($listaProductos as $DATO){ ?>
                <tr>
                    <td><?php echo $DATO['IDCORTE'] ?></td>
                    <td><?php echo  $DATO['IDEMPLEADO']; ?>  </td>
                    <td><?php echo  $DATO['SALDOI']; ?> </td>
                    <td><?php echo  $DATO['SALDOF']; ?> </td>
                    <td><?php echo  $DATO['FECHA']; ?> </td>
                    <td>
                    
                    <form action="" method="post">

                    <input type="hidden" name="txtID" value="<?php echo  $DATO['IDCORTE']; ?>" >
                    <input type="hidden" name="txtIDEMPLEADO" value="<?php echo  $DATO['IDEMPLEADO']; ?>" >
                    <input type="hidden" name="txtSALDOI" value="<?php echo  $DATO['SALDOI']; ?>" >
                    <input type="hidden" name="txtSALDOF" value="<?php echo  $DATO['SALDOF']; ?>" >
                    <input type="hidden" name="txtFecha" value="<?php echo  $DATO['FECHA']; ?>" >
                    
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

        <?php } ?>

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