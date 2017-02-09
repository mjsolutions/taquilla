<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bolematico | Taquilla</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="css/materialize.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
  <script>
    function draw(scale, translatePos){
      var canvas = document.getElementById("myCanvas");
      var context = canvas.getContext("2d");

        // clear canvas
        context.clearRect(0, 0, canvas.width, canvas.height);

        context.save();
        var mapa = new Image();
        mapa.src = "img/teatro-morelos.svg";

        mapa.addEventListener('load', mostrar_imagen, false);

        function mostrar_imagen() {
          context.drawImage(mapa, translatePos.x-375, translatePos.y-250, 750*scale, 500*scale);  
        }       
      }

      window.onload = function(){
        var canvas = document.getElementById("myCanvas");

        var translatePos = {
          x: canvas.width / 2,
          y: canvas.height / 2
        };

        var scale = 1.0;
        var scaleMultiplier = 0.8;
        var startDragOffset = {};
        var mouseDown = false;

        // add button event listeners
        document.getElementById("plus").addEventListener("click", function(){
          scale /= scaleMultiplier;
          draw(scale, translatePos);
        }, false);

        document.getElementById("minus").addEventListener("click", function(){
          scale *= scaleMultiplier;
          draw(scale, translatePos);
        }, false);

        // add event listeners to handle screen drag
        canvas.addEventListener("mousedown", function(evt){
          mouseDown = true;
          startDragOffset.x = evt.clientX - translatePos.x;
          startDragOffset.y = evt.clientY - translatePos.y;
        });

        canvas.addEventListener("mouseup", function(evt){
          mouseDown = false;
        });

        canvas.addEventListener("mouseover", function(evt){
          mouseDown = false;
        });

        canvas.addEventListener("mouseout", function(evt){
          mouseDown = false;
        });

        canvas.addEventListener("mousemove", function(evt){
          if (mouseDown) {
            translatePos.x = evt.clientX - startDragOffset.x;
            translatePos.y = evt.clientY - startDragOffset.y;
            draw(scale, translatePos);
          }
        });

        draw(scale, translatePos);
      };
    </script>
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
            </div>
            <div class="row">
             <div class="col s8 col-center divider"></div>
           </div>
           <div class="row">
             <form class="col s12" id="form1" action="compra.php" target="_blank" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
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
            <div class="col s12 center">
              <div id="canvas-wrapper" style="margin: 0 auto;">
                <canvas id="myCanvas" width="750" height="500"></canvas>
                <div id="button-canvas-wrapper">
                  <input type="button" id="plus" value="+"><input type="button" id="minus" value="-">
                </div>
              </div>
            </div>
          </div>
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
          <div class="col l6">Todos los derechos reservados.</div>
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
      url:   'buscar.php',
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
    url:   'buscar.php',
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