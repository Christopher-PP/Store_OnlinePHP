<?php

namespace bompzz;

class producto
{
  private $config;
  private $cn = null;
  public function __construct()
  {
    $this->config = parse_ini_file(__DIR__ . '/../config.ini');
    $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
  }
  public function registrar($_params)
  {
    $sql = "INSERT INTO PRODUCTOS SET TITULO=:TITULO, DESCRIPCION=:DESCRIPCION,FOTO=:FOTO, PRECIO=:PRECIO, CATEGORIA_ID=:CATEGORIA_ID, FECHA=:FECHA";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":TITULO" => $_params['TITULO'],
      ":DESCRIPCION" => $_params['DESCRIPCION'],
      ":FOTO" => $_params['FOTO'],
      ":PRECIO" => $_params['PRECIO'],
      ":CATEGORIA_ID" => $_params['CATEGORIA_ID'],
      ":FECHA" => $_params['FECHA']
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function Actualizar($_params)
  {
    $sql = "UPDATE PRODUCTOS SET TITULO=:TITULO, DESCRIPCION=:DESCRIPCION,FOTO=:FOTO, PRECIO=:PRECIO, CATEGORIA_ID=:CATEGORIA_ID, FECHA=:FECHA WHERE ID=:ID";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":TITULO" => $_params['TITULO'],
      ":DESCRIPCION" => $_params['DESCRIPCION'],
      ":FOTO" => $_params['FOTO'],
      ":PRECIO" => $_params['PRECIO'],
      ":CATEGORIA_ID" => $_params['CATEGORIA_ID'],
      ":FECHA" => $_params['FECHA'],
      ":ID" => $_params['ID']
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function Eliminar($id)
  {
    $sql = "DELETE FROM PRODUCTOS WHERE ID=:ID";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":ID" => $id
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function Mostrar()
  {
    $sql = "SELECT P.ID, TITULO, DESCRIPCION, FOTO, CATEGORIA,PRECIO,FECHA,ESTADO FROM PRODUCTOS AS P INNER JOIN CATEGORIAS AS C ON P.CATEGORIA_ID=C.ID ORDER BY P.ID DESC";
    $resultado = $this->cn->prepare($sql);
    if ($resultado->execute())
      return $resultado->fetchAll();

    return false;
  }
  public function Mostrar_id($id)
  {
    $sql = "SELECT * FROM PRODUCTOS WHERE ID=:ID";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":ID" => $id
    );
    if ($resultado->execute($_array))
      return $resultado->fetch();

    return false;
  }
}
