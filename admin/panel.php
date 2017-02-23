  <?php include('head.php') ?>
  <body>
  	<?php include('nav.php') ?>
  	<main>
  		<section>
  			<div class="row">
  				<div class="valign-wrapper center minh-400 col m12">
  					<h1 style="width: 100%">BIENVENIDO</h1>
  				</div>
  			</div>

  			</section>
  		</main>

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
	</script>
</body>
</html>