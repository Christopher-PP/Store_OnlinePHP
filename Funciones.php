<?php

function Add($resultado, $id, $cantidad = 1)
{
  $_SESSION['carrito'][$id] = array(
    'ID' => $resultado['ID'],
    'TITULO' => $resultado['TITULO'],
    'FOTO' => $resultado['FOTO'],
    'PRECIO' => $resultado['PRECIO'],
    'CANTIDAD' => $cantidad,
  );
}
function update($id, $cantidad = FALSE)
{
  if ($cantidad)
    $_SESSION['carrito'][$id]['CANTIDAD'] = $cantidad;
  else
    $_SESSION['carrito'][$id]['CANTIDAD'] += 1;
}
function Total()
{
  $total = 0;
  if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $indice => $value) {
      $total += $value['PRECIO'] * $value['CANTIDAD'];
    }
  }
  return $total;
}
function CantidadProd()
{
  $cantidad = 0;
  if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $indice => $value) {
      $cantidad++;
    }
  }
  return $cantidad;
}
