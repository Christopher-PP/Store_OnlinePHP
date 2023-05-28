<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require 'funciones.php';
  require 'vendor/autoload.php';
  if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $cliente = new bompzz\Cliente;

    $_params = array(
      "NOMBRE" => $_POST['nombre'],
      "APELLIDOS" => $_POST['apellidos'],
      "EMAIL" => $_POST['correo'],
      "TELEFONO" => $_POST['telefono'],
      "COMENTARIO" => $_POST['comentario']
    );
    $CLIENTE_ID = $cliente->registrar_cl($_params);

    $pedido = new bompzz\Pedido;

    $_params = array(
      "CLIENTE_ID" => $CLIENTE_ID,
      "TOTAL" => Total(),
      "FECHA" => date('Y-m-d'),
    );

    $pedido_id = $pedido->registrar_pd($_params);
    foreach ($_SESSION['carrito'] as $indice => $value) {
      $_params = array(
        "PEDIDO_ID" => $pedido_id,
        "PRODUCTO_ID" => $value['ID'],
        "PRECIO" => $value['PRECIO'],
        "CANTIDAD" => $value['CANTIDAD']
      );
      $pedido->registrar_detalle($_params);
      $_SESSION['carrito'] = array();

      header('Location:  Gracias.php');
    }
  }
}
