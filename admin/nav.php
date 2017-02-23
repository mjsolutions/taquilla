<header>
  <ul id="event_options" class="dropdown-content">
    <li>
      <a href="form_compra_mike.php">Mike Salazar</a>
    </li>
    <li>
      <a href="form_compra_sofia.php">Sofía Niño de Rivera</a>
    </li>
  </ul>

  <ul id="sales_options" class="dropdown-content">
    <li>
      <a href="#!">Corte de caja parcial</a>
    </li>
    <li>
      <a href="#!">Corte de salida</a>
    </li>
  </ul>

    <ul id="report_options" class="dropdown-content">
    <li>
      <a href="reporte_general.php">Reporte general</a>
    </li>
    <li>
      <a href="#!">Reporte específico</a>
    </li>
  </ul>

  <ul id="user_options" class="dropdown-content">
<!--   <li><a href="#!">Perfil</a></li>
  <li class="divider"></li> -->
  <li>
    <a href="conexion/salir.php">Salir</a>
  </li>
</ul>
<nav>
  <div class="nav-wrapper grey darken-3">
    <div class="container">
      <a href="" class="brand-logo mt-5"><img class="responsive-img" width="60px" src="../images/logotipo-nuevo-blanco.svg"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="panel.php">Inicio</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="event_options">Eventos<i class="material-icons right">arrow_drop_down</i></a></li>
        <?php 
        if($_SESSION["type"] == "super" || $_SESSION["id"] == "35"){
          echo "<li><a href='boleto_duro.php'>Boleto Duro</a></li>";
          echo "<li><a class='dropdown-button' href='#!' data-activates='report_options'>Reportes<i class='material-icons right'>arrow_drop_down</i></a></li>";
        }
        ?> 
        <li><a class="dropdown-button" href="#!" data-activates="sales_options">Corte de caja<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-button" href="#!" data-activates="user_options"><?php echo $_SESSION["nombre"] ?><i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
    <ul class="center-align side-nav" id="mobile-demo">
      <div class="row mb-0">
        <div class="col s10 col-center mt-30">
          <a href="">
            <img class="responsive-img" src="../images/logotipo-nuevo-negro.svg" style="height: 50px;">
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col s8 col-center divider"></div>
      </div>
      <li><a href="panel.php">Inicio</a></li>
      <li><a href="usuarios.php">Usuarios</a></li>
      <li><a href="form_compra_mike.php">Evento - Mike</a></li>
      <li><a href="form_compra_sofia.php">Evento - Sofia</a></li>
      <li><a href="conexion/salir.php">Salir de la sesión</a></li>
    </ul>
  </div>
</nav>
</header>