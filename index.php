<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bolematico | Compra</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
</head>
<body>
  <header>
   <?php include('nav.php') ?>
 </header>
 <main>
  <section>
    <div class="container">
      <div class="card-panel">
        <div class="row">
          <div class="col push-s1 s10 center-align">
            <h4>Boletos - Mike Salazar</h4>
          </div>
          <div class="col pull-s1 s1">
            <a class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="right" data-delay="50" data-tooltip="Nueva Venta" href="form_compra.php"><i class="material-icons">add</i></a>
          </div>
        </div>
        <div class="row">
         <div class="col s8 col-center divider"></div>
       </div>
       <div class="row">
         <form class="col s12" id="form1" action="index.php" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
           <div class="col l6 offset-l4 input-field mt-0">
            <i class="material-icons prefix">search</i>
            <input id="icon_prefix" type="text" class="validate" name="palabra_txt">
            <label for="icon_prefix2">(Seccion, Fila, Asiento, Forma de pago)</label>
          </div>
          <div class="col l2">
            <button class="btn waves-effect waves-light" type="submit" style=" width: 100%;">Buscar<i class="mdi-action-lock-open right"></i></button>
          </div>
        </form>
      </div>
      <table class="responsive-table centered">
       <thead>
        <tr>
         <th data-field="id">Id</th>
         <th data-field="seccion">Seccion</th>
         <th data-field="fila">Fila</th>
         <th data-field="asiento">Asiento</th>
         <th data-field="folio">Folio</th>
         <th data-field="forma_pago">Forma de Pago</th>
       </tr>
     </thead>

     <?php 
     error_reporting(E_ALL ^ E_NOTICE);
     include 'conexion/datos.php';
     $con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

     $result = $con->query("SELECT id, seccion, fila, asiento, status, folio, forma_pago FROM morelos where status = 1 and confirmacion = 1 and forma_pago != 'null' ORDER BY folio DESC");

     if ($row = mysqli_fetch_array($result)){
      echo "<tbody> \n";

      do {                            
        echo "<tr><td class='text-center'>".$row["id"]."</td><td class='text-center'>".$row["seccion"]."</td><td class='text-center'>".$row["fila"]."</td><td class='text-center'>".$row["asiento"]."</td><td class='text-center'>".$row["folio"]."</td><td class='text-center'>".$row["forma_pago"]."</td></tr> \n";   
      } while ($row = mysqli_fetch_array($result));

      echo "</tbody> \n";

    } else { 
      echo "<span style='COLOR:red;'> ¡ No se ha encontrado ningun registro !</span>";
    } 
    ?> 
  </table>
</div>
</div>
</section>
</main>
<footer class="page-footer grey darken-4">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Bolematico.com.mx</h5>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col l6">Todos los derechos reservados.            </div>
        <div class="col l6 right-align">© 2017</div>
      </div>
    </div>
  </div>
</footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script>
  $(document).ready(function(){
    $('select').material_select();
  });
</script>
</body>
</html>