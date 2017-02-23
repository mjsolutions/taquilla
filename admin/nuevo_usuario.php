  <?php include('head.php') ?>
  <body>
    <?php include('nav.php') ?>
    <div class="container" style="min-height: 76.5vh;">
      <form class="col s12" id="form1" action="conexion/usuario_nuevo.php" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
        <div class="container">
          <div class="card-panel">
            <div class="center-align">
              <h3>Nuevo Usuario</h3>
            </div>

            <div class="row">
              <div class="col s8 col-center divider"></div>
            </div>
            <div class="row left-align">
              <div class="col l12">
                <h5>Datos Generales</h5>
              </div>
            </div>

            <div class="row">
              <div class="col l6">
                <div class="input-field">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="nombre" type="text" class="validate" name="nombre" required>
                  <label for="nombre"> Nombre Completo </label>
                </div>      
              </div>

              <div class="col l6">
                <div class="input-field">
                  <i class="material-icons prefix">email</i>
                  <input id="email" type="email" class="validate" name="email" required>
                  <label for="email"> E-mail </label>
                </div>
              </div>


              <div class="col l6">
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <input id="password" type="password" class="validate" name="password" required>
                  <label for="password"> Contraseña </label>
                </div>
              </div>

              <div class="col l6">
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <input id="password_confirmation" type="password" class="validate" name="password_confirmation" required>
                  <label for="password_confirmation"> Verifique la contraseña </label>
                </div>
              </div>

            </div>

            <div class="input-field center-align">
              <button type="submit" class="btn btn-large btn-block btn-block-large waves-effect waves-light">Guardar</button>
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