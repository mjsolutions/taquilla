  <?php include('head.php') ?>
  <body>
    <?php include('nav.php') ?>

    <div class="container" style="min-height: 76.5vh;">
     <div class="card-panel">
      <div class="row">
       <div class="col push-s1 s10 center-align">
        <h4>Usuarios</h4>
      </div>
      <div class="col pull-s1 s1">
        <a class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="right" data-delay="50" data-tooltip="Nuevo Usuario" href="nuevo_usuario.php"><i class="material-icons">add</i></a>
      </div>
    </div>
    <div class="row">
     <div class="col s8 col-center divider"></div>
   </div>
   <div class="row">
     <form class="col s12" id="form1" action="usuarios.php" method="post" enctype="application/x-www-form-urlencoded" name="login_form">
       <div class="col l6 offset-l4 input-field mt-0">
        <i class="material-icons prefix">search</i>
        <input id="busqueda" type="text" class="validate" name="palabra_txt">
        <label for="busqueda">(Id, Nombre, Email)</label>
      </div>
      <div class="col l2">
        <button class="btn waves-effect waves-light" type="submit" style=" width: 100%;">Buscar<i class="mdi-action-lock-open right"></i></button>
      </div>
    </form>
    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    if($_GET["registro"]=="correcto"){echo "<span style='COLOR: GREEN;'>Se ha añadido el usuario de forma exitosa</span>";}
    if($_GET["cambio"]=="correcto"){echo "<span style='COLOR: GREEN;'>Se han actualizado los datos de forma exitosa</span>";}
    if($_GET["eliminar"]=="correcto"){echo "<span style='COLOR: GREEN;'>Se ha borrado el usuario de forma exitosa</span>";}
    if($_GET["error"]=="pass"){echo "<span style='COLOR: RED;'>Error: Las contraseñas no coinciden...</span>";}
    if($_GET["error"]=="passadmin"){echo "<span style='COLOR: RED;'>Error: La contraseña de administrador es errónea...</span>";}
    ?>
  </div>
  <table class="responsive-table centered">
   <thead>
    <tr>
     <th data-field="id">Id</th>
     <th data-field="name">Nombre</th>
     <th data-field="email">Email</th>
     <th data-field="option">Opciones</th>
   </tr>
 </thead>

 <?php 
 error_reporting(E_ALL ^ E_NOTICE);
 include 'conexion/datos.php';
 $con = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar: '.mysqli_error());

 $palabra=$_POST['palabra_txt'];

 $busqueda = trim($palabra, " \t.");

 $result = $con->query("SELECT id, name, email, type FROM users where status = 1 and (type = 'p_venta' or type = 'super') and (id like '%".$busqueda."%' or name like '%".$busqueda."%' or email like '%".$busqueda."%') ORDER BY name DESC");

 if ($row = mysqli_fetch_array($result)){
  echo "<tbody> \n";
  do {        
    echo "
    <tr>
     <td>".$row["id"]."</td>
     <td>".$row["name"]."</td>
     <td>".$row["email"]."</td>
     <td>
       <a href='editar_usuario.php?id=".$row["id"]."' class='btn-floating btn-small waves-effect waves-light amber accent-3 mr-5 tooltipped' data-position='right' data-delay='50' data-tooltip='Editar'><i class='material-icons'>edit</i></a>";

       if($_SESSION["email"] != $row["email"] && $_SESSION["type"] == "super"){
        echo "<a class='btn-floating btn-small waves-effect waves-light  red darken-1 mr-5 tooltipped' data-position='right' data-delay='50' data-tooltip='Eliminar' onclick='eliminar(".$row["id"].", \"".$row["name"]."\")'><i class='material-icons'>delete</i></a>";
      }
      echo "
      <a class='btn-floating btn-small waves-effect waves-light  grey darken-1 tooltipped' data-position='right' data-delay='50' data-tooltip='Cambiar Contraseña' onclick='change_password(".$row["id"].", \"".$row["name"]."\")'><i class='material-icons'>vpn_key</i></a>
    </td>
  </tr>";
} while ($row = mysqli_fetch_array($result));
echo "</tbody> \n";
} else { 
  echo "<span style='COLOR:red;'> ¡ No se ha encontrado ningun registro !</span>";
}
?>

</table>

<div id="change_password" class="modal plr-10">
  <div class="modal-content">
    <div class="row">
      <div class="col l5 center">
        <h5>Cambiar contraseña para <span id="cp_nombre"></span></h5>
        <div class="divider"></div>     
      </div>
      <div class="col l7">
        <form class="col s12" id="form_changep" action="conexion/change_password.php" method="post" enctype="application/x-www-form-urlencoded" name="form_changep">

          <div class="input-field">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password_admin" type="password" class="validate" name="password_administrador" required>
            <label for="password_admin">Contraseña de administrador</label>
          </div>

          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
            <input id="password" type="password" class="validate" name="password" required>
            <label for="password">Nueva contraseña</label>
          </div>

          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
            <input id="password_confirmation" type="password" class="validate" name="password_confirmation" required>
            <label for="password_confirmation">Confirme la nueva contraseña</label>
          </div>

          <input id="id" type="hidden" class="validate" name="id">

          <div class="input-field right-align">
            <button href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" type="reset">Cerrar</button>
            <button type="submit" class="btn waves-effect btn-block waves-light green">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="eliminar_usuario" class="modal plr-10">
  <div class="modal-content">
    <div class="row">
    <div class="col l12 center">
        <h5>Está seguro que desea eliminar el usuario <span id="eliminar_nombre"></span>?</h5>
        <div class="divider"></div>     
      </div>
      <div class="col l12">
        <form class="col s12" id="form_changep" action="conexion/usuario_eliminar.php" method="post" enctype="application/x-www-form-urlencoded" name="form_changep">

          <div class="input-field">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password_admin" type="password" class="validate" name="password_administrador" required>
            <label for="password_admin">Contraseña de administrador</label>
          </div>

          <input id="id_eliminar" type="hidden" class="validate" name="id_eliminar">

          <div class="input-field right-align">
            <button href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" type="reset">Cancelar</button>
            <button type="submit" class="btn waves-effect btn-block waves-light green">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

</div>
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
  
  function eliminar(id, nombre) {
    $("#eliminar_nombre").html(nombre);
    $('#id_eliminar').val(id);
    $("#eliminar_usuario").openModal();
  }
</script>
</body>
</html>
