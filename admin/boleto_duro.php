  <?php include('head.php') ?>
  <body>
    <?php include('nav.php') ?>
    <div class="container" style="min-height: 76.5vh;">
      <form class="col s12" id="form1" target="_blank" action="conexion/boleto_duro.php" method="post" enctype="multipart/form-data" name="login_form">
        <div class="container">
          <div class="card-panel">
            <div class="center-align">
              <h3>Boleto Duro</h3>
            </div>

            <div class="row">
              <div class="col s8 col-center divider"></div>
            </div>

            <div class="row left-align">
              <div class="col l12">
                <h5>Datos del evento</h5>
              </div>
            </div>

            <div class="row">
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="artista" type="text" class="validate" name="artista" required>
                  <label for="artista">Nombre del Artista</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="lugar" type="text" class="validate" name="lugar" required>
                  <label for="lugar">Lugar</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="file-field input-field">
                  <div class="btn">
                  <span>Archivo</span>
                    <input id='uploadedfile' name='uploadedfile' type="file" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Imagen del evento">
                  </div>
                </div>
              </div>
              <div class="col l3">
                <div class="input-field">
                  <i class="material-icons prefix">today</i>
                  <input id="fecha_evento" type="text" class="validate" name="fecha_evento" required>
                  <label for="fecha_evento">Fecha del Evento</label>
                </div>      
              </div>
              <div class="col l3">
                <div class="input-field">
                  <i class="material-icons prefix">query_builder</i>
                  <input id="hora_evento" type="text" class="validate" name="hora_evento" required>
                  <label for="hora_evento">Hora del Evento</label>
                </div>      
              </div>

              <div class="col l3">
                <div class="input-field">
                  <i class="material-icons prefix">today</i>
                  <input id="fecha_impresion" type="text" class="validate" name="fecha_impresion">
                  <label for="fecha_impresion">Fecha de Impresión</label>
                </div>      
              </div>
              <div class="col l3">
                <div class="input-field">
                  <i class="material-icons prefix">query_builder</i>
                  <input id="hora_impresion" type="text" class="validate" name="hora_impresion">
                  <label for="hora_impresion">Hora de Impresión</label>
                </div>      
              </div>
            </div>

            <div class="row left-align">
              <div class="col l12">
                <h5>Asientos</h5>
              </div>
            </div>

            <div class="row">
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">room</i>
                  <input id="zona" type="text" class="validate" name="zona" required>
                  <label for="zona">Zona / Sección</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">room</i>
                  <input id="fila" type="text" class="validate" name="fila">
                  <label for="fila">Fila / Mesa</label>
                </div>      
              </div>
              <div class="col l2">
                <div class="input-field">
                  <i class="material-icons prefix">room</i>
                  <input id="no_boletos" type="text" min="1" class="validate" name="no_boletos">
                  <label for="no_boletos">Cantidad de boletos</label>
                </div>      
              </div>
              <div class="col l2">
                <div class="input-field">
                  <i class="material-icons prefix">room</i>
                  <input id="asiento_inicial" type="text" class="validate" name="asiento_inicial">
                  <label for="asiento_inicial">Asiento Inicial</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">payment</i>
                  <input id="precio" type="number" min="0" class="validate" name="precio" value="0" required>
                  <label for="precio">Precio</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">payment</i>
                  <input id="servicio" type="number" min="0" class="validate" name="servicio" value="0" required>
                  <label for="servicio">Servicio</label>
                </div>      
              </div>
              <div class="col l4">
                <div class="input-field">
                  <i class="material-icons prefix">list</i>
                  <input id="folio_inicial" type="number" min="0" class="validate" name="folio_inicial" value="0" required>
                  <label for="folio_inicial">Folio Inicial</label>
                </div>      
              </div>
            </div>

            <div class="input-field center-align">
              <button type="submit" class="btn btn-large btn-block btn-block-large waves-effect waves-light">Generar boletos</button>
            </div>
          </div>

        </div>
      </form>
      <?php
      error_reporting(E_ALL ^ E_NOTICE);
      if($_GET["error"]=="pass"){echo "<span style='COLOR: RED;'>Las contraseñas no coinciden, intentar de nuevo...</span>";}
      ?>
    </div>

    <?php include('footer.php') ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.js"></script>

    <script>
      $(document).ready(function(){
        $(".button-collapse").sideNav({
       edge: 'right', // Choose the horizontal origin
       closeOnClick: true
     });
        $('.modal-trigger').leanModal();
        $('select').material_select();
      $(".dropdown-button").dropdown(); //puede funcionar sin esta declaracion
    });

      function change_password(id, nombre) {
        $("#cp_nombre").html(nombre);
        $('#id').val(id);
        $("#change_password").openModal();
      }
    </script>
  </body>
  </html>