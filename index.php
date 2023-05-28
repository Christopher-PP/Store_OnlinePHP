<?php
session_start();
require 'Funciones.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BOMPZZ</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3CAFD9
!important;">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">BOMPZZ</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
          <li>
            <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print CantidadProd() ?></span></a>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <div class="row">
      <?php
      require 'vendor/autoload.php';
      $productos = new bompzz\producto;
      $info_prod = $productos->Mostrar();
      $cantidad = count($info_prod);
      if ($cantidad > 0) {
        for ($x = 0; $x < $cantidad; $x++) {
          $item = $info_prod[$x];
      ?>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h1 class="text-center titulo-producto"><?php print $item['TITULO'] ?></h1>
              </div>

              <div class="panel-body">
                <?php
                $foto = 'upload/' . $item['FOTO'];
                if (file_exists($foto)) {
                ?>
                  <center><img src="<?php print $foto; ?>" width="120" height="140"></center>
                <?php } else { ?>
                  <img src="assets/imagenes/not-found" width="120" height="140">
                <?php } ?>

              </div>
              <div class="panel-footer">
                <a href="carrito.php?ID=<?php print $item['ID'] ?>" class="btn btn-success btn-block"><samp class="glyphicon glyphicon-shopping-cart"> </samp> Comprar</a>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <h3>NO HAY REGISTROS</h3>
      <?php } ?>
    </div>


  </div> <!-- /container -->


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>