

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scale=no initial-scale=1.0, shrink-to-fit=no maximum-scale=1.0 minimum-scale=1.0">

    <link href="sidebar//style.css" rel="stylesheet" type="text/css">
    <!-- FONTAWESOME : https://kit.fontawesome.com/a23e6feb03.js -->
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.  5/jquery.mCustomScrollbar.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="sidebar/icons.js"></script>

    <title>Sitio Administrativo</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light blue fixed-top">
    <button id="sidebarCollapse" class="btn navbar-btn">
      <i class="fas fa-lg fa-bars"></i>
    </button>
    <a class="navbar-brand" href="">
      <h3 id="logo">RIVERA PC</h3>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" id="link" href="#">
          <i class="fas fa-sign-out-alt"></i>
          LogOut<span class="sr-only">(current) </span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="link" href="#">
          <i class="fas fa-id-card"></i>Contact Us</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="wrapper fixed-left">
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3><i class="fas fa-chevron-circle-down"></i>Menú</h3>
      </div>

      <ul class="list-unstyled components">
        <li>
            <a href="?op=0" ><i class="fas fa-home"></i></i>Inicio</a>
        </li>
        <li>
            <a href="?op=1" ><i class="fas fa-user-friends"></i>Empleados</a>
        </li>
        <li>
            <a href="?op=2" ><i class="fas fa-user-friends"></i>Clientes</a>
        </li>
        <li>
        <li>
            <a href="?op=3" ><i class="fas fa-tag"></i>Productos</a>
        </li>
        <li>
          <a href="?op=4"><i class="fas fa-table"></i></i>Cita Soporte</a>
        </li>
        <li>
             
          <a href="?op=5"><i class="fas fa-clock"></i>Corte Diario</a>
        </li>
        <li>
            <a href="?op=6" ><i class="fas fa-dollar-sign"></i>Ventas</a>
        </li>
        <li>
            <a href="" ><i class="fas fa-info-circle"></i>Informe Ventas</a>
        </li>
      </ul>

    </nav>

    <div id="content">
        <?php  
        
  if(isset($_GET['op'])){
      switch ($op=$_GET['op']){
     case 1:
         require_once("empleados/index.php");
         break;
     case 2:
         require_once("clientes/index.php");
         break;  
     case 3:
         require_once("productos/index.php");
         break;
     case 0:
         require_once("welcome.php");
         break;
     case 4:
         require_once ('CitaSoporte/index.php');
         break;
     case 5:
         require_once ('CorteDiario/index.php');
         break;
     case 6:
         require_once ('ventas/index.php');
         break;
         
         
      }
      
  }else
  {
     require_once("welcome.php"); 
  }
    
        
 


        
  ?>
    </div>

  </div >

              
      
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="sidebar/script.js"></script>

    
  </body>
</html>