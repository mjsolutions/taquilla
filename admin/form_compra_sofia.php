  <?php include('head.php') ?>
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
                <h4>Boletos - Sofia Niño de Rivera</h4>
              </div>
            </div>
            <div class="row">
             <div class="col s8 col-center divider"></div>
             <?php
             error_reporting(E_ALL ^ E_NOTICE);
             if($_GET["error"]=="ocupado"){echo "<span style='COLOR: RED;'>Error: 1 o más asientos ya han sido ocupados mientras ejecutaba su compra, intente de nuevo.</span>";}
             ?>
             
           </div>
           <div class="row">
             <form class="col s12" id="form1" action="compra_sofia.php" target="_blank" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
               <div class="row">
                 <div class="input-field col s3">
                  <select name="zona" id="zona">
                    <option value="" disabled selected>Seleccione una zona</option>
                    <option value="Diamante">Diamante</option>
                    <option value="Oro">Oro</option>
                    <option value="Plata">Plata</option>
                  </select>
                  <label>Zona</label>
                </div>
                <div class="input-field col s3">
                  <select name="fila" id="fila">
                    <option value="" disabled selected>Primero seleccione una zona</option>
                  </select>
                  <label>Fila</label>
                </div>
                <div class="input-field col s3">
                  <select name="asiento[]" id="asiento" multiple>
                    <option value="" disabled selected>Primero seleccione una fila</option>
                  </select>
                  <label>Asientos</label>
                </div>
                <div class="input-field col s3">
                  <select name="forma_pago" id="forma_pago">
                    <option value="1" selected>Efectivo</option>
                    <option value="2">Tarjeta</option>
                    <option value="3">Cortesía</option>
                  </select>
                  <label>Forma de pago</label>
                </div>
              </div>
              <div class="input-field center-align">
                <input class="btn btn-large btn-block btn-block-large waves-effect waves-light" type="submit" value="Efectuar compra">
              </div>
            </form>
          </div>

          <div class="row">
           <div class="col s8 col-center divider"></div>
         </div>
         <div class="row">
           <form class="col s12" id="form2" action="form_compra_sofia.php" method="post" enctype="application/x-www-form-urlencoded" name="form_busqueda">
             <div class="col l6 offset-l4 input-field mt-0">
              <i class="material-icons prefix">search</i>
              <input id="busqueda" type="text" class="validate" name="palabra_txt">
              <label for="busqueda">(Forma de pago, folio, asiento, etc.)</label>
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
           <th data-field="seccion">Sección</th>
           <th data-field="fila">Fila</th>
           <th data-field="asiento">Asiento</th>
           <th data-field="forma_pago">Forma de Pago</th>
           <th data-field="folio">Folio</th>
           <th data-field="updated_at">Hora de venta</th>
           <th data-field="option">Opciones</th>
         </tr>
       </thead>

       <?php 
       error_reporting(E_ALL ^ E_NOTICE);
       include 'conexion/datos.php';
       $con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

       $palabra=$_POST['palabra_txt'];

       $busqueda = trim($palabra, " \t.");

       $result = $con->query("SELECT id, seccion, fila, asiento, forma_pago, folio, updated_at FROM sofia where status = 1 and confirmacion = 1 and (user = ".$_SESSION["id"]." or forma_pago = 'PayPal') and (id like '%".$busqueda."%' or seccion like '%".$busqueda."%' or fila like '%".$busqueda."%' or forma_pago like '%".$busqueda."%' or folio like '%".$busqueda."%') ORDER BY folio DESC");

       if ($row = mysqli_fetch_array($result)){
        echo "<tbody> \n";
        do {        
          echo "
          <tr>
           <td>".$row["id"]."</td>
           <td>".$row["seccion"]."</td>
           <td>".$row["fila"]."</td>
           <td>".$row["asiento"]."</td>
           <td>".$row["forma_pago"]."</td>
           <td>".$row["folio"]."</td>
           <td>".$row["updated_at"]."</td>
           <td>";
             if($_SESSION["type"] == "super" || $_SESSION["id"] == "35"){
              echo "<a class='btn-floating btn-small waves-effect waves-light  red darken-1 mr-5 tooltipped disabled' data-position='right' data-delay='50' data-tooltip='Re-imprimir'><i class='material-icons'>print</i></a>";
            }
            echo "
          </td>
        </tr>";
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


<?php include('footer.php') ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>
<script>
  $(document).ready(function(){
    $('select').material_select();
  });
</script>
<script>
  $("#zona").on("change", buscarFilas);
  $("#fila").on("change", buscarAsientos);

  function buscarFilas(){
    $("#asiento").html("<option value='' disabled selected>Primero seleccione una fila</option>");

    $zona = $("#zona").val();

    if($zona == ""){
      $("#fila").html("<option value='' disabled selected>Primero seleccione una zona</option>");
    }
    else {
      $.ajax({
      // dataType: "json",
      data: {"zona": $zona},
      url:   'buscar_sofia.php',
      type:  'post',
      beforeSend: function(){
        //Lo que se hace antes de enviar el formulario
      },
      success: function(respuesta){
        //lo que se si el destino devuelve algo
        // $("#fila").html(respuesta.html);
        $("#fila").html('');
        $("#fila").append(respuesta);
        $("#fila").material_select();
      },
      error:  function(xhr,err){ 
        alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
      }
    });
    }
  }

  function buscarAsientos(){
    $fila = $("#fila").val();

    $.ajax({
    // dataType: "json",
    data: {"fila": $fila},
    url:   'buscar_sofia.php',
    type:  'post',
    beforeSend: function(){
      //Lo que se hace antes de enviar el formulario
    },
    success: function(respuesta){
      //lo que se si el destino devuelve algo
      // $("#asiento").html(respuesta.html);
      $("#asiento").html('');
      $("#asiento").append(respuesta);
      $("#asiento").material_select();
    },
    error:  function(xhr,err){ 
      alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
    }
  }); 
  }
</script>
</body>
</html>