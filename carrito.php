<?php

session_start();
require 'funciones.php';
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
  $id = $_GET['ID'];
  require 'vendor/autoload.php';
  $producto = new bompzz\producto;
  $resultado = $producto->Mostrar_id($id);


  if (!$resultado) {
    header('Location: index.php');
  }

  if (isset($_SESSION['carrito'])) { //si existe carrito
    // si existe producto en carrito
    if (array_key_exists($id, $_SESSION['carrito'])) {
      update($id);
      // si no existe producto en el carrito
    } else {
      Add($resultado, $id);
    }
  } else { // si no existe carrito
    Add($resultado, $id);
  }
}



require 'vendor/autoload.php';

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
            <a href="" class="btn">CARRITO <span class="badge"><?php print CantidadProd() ?></span></a>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container" id="main">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Imagen</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
          $c = 0;
          foreach ($_SESSION['carrito'] as $indice => $value) {
            $total = $value['PRECIO'] * $value['CANTIDAD'];
            //$c++;
        ?>
            <tr>
              <form action="actualizar_carrito.php" method="post">
                <td><?php print $c ?></td>
                <td><?php print $value['TITULO'] ?></td>
                <td>
                  <?php
                  $foto = 'upload/' . $value['FOTO'];
                  if (file_exists($foto)) {
                  ?>
                    <center><img src="<?php print $foto; ?>" width="35" height="35"></center>
                  <?php } else { ?>
                    <center><img src="assets/imagenes/not-found" width="35" height="35"></center>
                  <?php } ?>
                </td>
                <td>$ <?php print $value['PRECIO'] ?> MXN</td>
                <td>
                  <input type="hidden" name="id" value="<?php print $value['ID'] ?>">
                  <input type="text" name="cantidad" class="form-control u-size-100" value="<?php print $value['CANTIDAD'] ?>">
                </td>
                <td>$ <?php print $total ?> MXN</td>
                <td><button type="submit" class="btn btn-success btn-xs"><samp class="glyphicon glyphicon-refresh"></samp></button>
                  <a href="Eliminar_carrito.php?ID=<?php print $value['ID'] ?>" class="btn btn-danger btn-xs"><samp class="glyphicon glyphicon-trash"></samp>

                  </a>
                </td>
              </form>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr colspan="7">NO HAY PRODUCTOS SELECCIONADOS</tr>
        <?php }
        ?>
        <tr></tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="text-right">Total</td>
          <td>$ <?php print  Total();  ?> MXN</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <hr>
    <?php
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    ?>
      <div class="pull-left">
        <a href="index.php" class="btn btn-info">Seguir Comprando</a>

      </div>
      <div class="pull-right">
        <a href="Finalizar.php" class="btn btn-success">Comprar</a>
      </div>
    <?php
    }
    ?>
  </div>
  <!-- /container -->


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>