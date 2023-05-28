<?php
require '../vendor/autoload.php';
$pelicula = new bompzz\producto;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['accion'] === 'Registrar') {
    if (empty($_POST['titulo'])) {
      exit('completar titulo');
    }
    if (empty($_POST['descripcion'])) {
      exit('completar descripción');
    }
    if (!is_numeric($_POST['categoria_id'])) {
      exit('seleccionar una categoria');
    }
    $_params = array(
      "TITULO" => $_POST['titulo'],
      "DESCRIPCION" => $_POST['descripcion'],
      "FOTO" => subirFoto(),
      "PRECIO" => $_POST['precio'],
      "CATEGORIA_ID" => $_POST['categoria_id'],
      "FECHA" => date('y-m-d'),
    );
    $rpt = $pelicula->registrar($_params);
    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al registrar el producto';
  }
  if ($_POST['accion'] === 'Actualizar') {
    if (empty($_POST['titulo'])) {
      exit('completar titulo');
    }
    if (empty($_POST['descripcion'])) {
      exit('completar descripción');
    }
    if (!is_numeric($_POST['categoria_id'])) {
      exit('seleccionar una categoria');
    }
    $_paramsupd = array(
      "TITULO" => $_POST['titulo'],
      "DESCRIPCION" => $_POST['descripcion'],
      "FOTO" => subirFoto(),
      "PRECIO" => $_POST['precio'],
      "CATEGORIA_ID" => $_POST['categoria_id'],
      "FECHA" => date('y-m-d'),
      "ID" => $_POST['ID'],
    );
    if (!empty($_POST['foto']))
      $_paramsupd['FOTO'] = $_POST['foto_temp'];
    if (empty($_POST['foto_temp']))
      $_paramsupd['FOTO'] = $_POST['foto'];
    if (!empty($_FILES['FOTO']['name']))
      $_paramsupd['FOTO'] = subirFoto();


    $rpt = $pelicula->Actualizar($_paramsupd);
    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al Actualizar el producto';
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $id = $_GET['ID'];
  $rpt = $pelicula->Eliminar($id);
  if ($rpt)
    header('Location: productos/index.php');
  else
    print 'Error al eliminar el producto';
}
function subirFoto()
{
  $carpeta = __DIR__ . '/../upload/';
  $archivo = $carpeta . $_FILES['foto']['name'];
  move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
  return $_FILES['foto']['name'];
}
