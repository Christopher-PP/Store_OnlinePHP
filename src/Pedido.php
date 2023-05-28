<?php

namespace bompzz;

class Pedido
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
  public function registrar_pd($_params)
  {
    $sql = "INSERT INTO PEDIDOS SET CLIENTE_ID=:CLIENTE_ID, TOTAL=:TOTAL,FECHA=:FECHA";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":CLIENTE_ID" => $_params['CLIENTE_ID'],
      ":TOTAL" => $_params['TOTAL'],
      ":FECHA" => $_params['FECHA'],
    );
    if ($resultado->execute($_array))
      return $this->cn->lastInsertId();

    return false;
  }
  public function Actualizar($_params)
  {
    $sql = "UPDATE PEDIDOS SET CLIENTE_ID=:CLIENTE_ID, TOTAL=:TOTAL,FECHA=:FECHA, ESTADO=:ESTADO";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":CLIENTE_ID" => $_params['CLIENTE_ID'],
      ":TOTAL" => $_params['TOTAL'],
      ":FECHA" => $_params['FECHA'],
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function registrar_detalle($_params)
  {
    $sql = "INSERT INTO DETALLE_PEDIDO SET PEDIDOS_ID=:PEDIDOS_ID, PRODUCTOS_ID=:PRODUCTOS_ID,PRECIO=:PRECIO, CANTIDAD=:CANTIDAD";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":PEDIDOS_ID" => $_params['PEDIDO_ID'],
      ":PRODUCTOS_ID" => $_params['PRODUCTO_ID'],
      ":PRECIO" => $_params['PRECIO'],
      ":CANTIDAD" => $_params['CANTIDAD'],
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function update_detalle($_params)
  {
    $sql = "UPDATE DETALLE_PEDIDO SET PEDIDOS_ID=:PEDIDOS_ID, PRODUCTOS_ID=:PRODUCTOS_ID,PRECIO=:PRECIO, CANTIDAD=:CANTIDAD";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":PEDIDOS_ID" => $_params['PEDIDOS_ID'],
      ":PRODUCTOS_ID" => $_params['PRODUCTOS_ID'],
      ":PRECIO" => $_params['PRECIO'],
      ":CANTIDAD" => $_params['CANTIDAD'],
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
  public function Mostrar()
  {
    $sql = "SELECT P.ID, CONCAT(NOMBRE,' ', APELLIDOS) AS CLIENTE, EMAIL AS CORREO, TOTAL, FECHA  FROM PEDIDOS AS P INNER JOIN CLIENTES AS C ON P.CLIENTE_ID=C.ID ORDER BY P.ID DESC";
    $resultado = $this->cn->prepare($sql);
    if ($resultado->execute())
      return $resultado->fetchAll();

    return false;
  }
  public function MostrarPedidos()
  {
    $sql = "SELECT P.ID, CONCAT(NOMBRE,' ', APELLIDOS) AS CLIENTE, EMAIL AS CORREO, TOTAL, FECHA  FROM PEDIDOS AS P INNER JOIN CLIENTES AS C ON P.CLIENTE_ID=C.ID ORDER BY P.ID DESC LIMIT 10";
    $resultado = $this->cn->prepare($sql);
    if ($resultado->execute())
      return $resultado->fetchAll();

    return false;
  }
  public function Mostrar_id($id)
  {
    $sql = "SELECT P.ID, CONCAT(NOMBRE,' ', APELLIDOS) AS CLIENTE, EMAIL AS CORREO, TOTAL, FECHA  FROM PEDIDOS AS P INNER JOIN CLIENTES AS C ON P.CLIENTE_ID=C.ID WHERE P.ID=:ID";

    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ':ID' => $id
    );
    if ($resultado->execute($_array))
      return $resultado->fetch();

    return false;
  }
  public function Mostrar_detalle($id)
  {
    $sql = "SELECT DP.ID, P.TITULO, DP.PRECIO, DP.CANTIDAD, P.FOTO FROM DETALLE_PEDIDO AS DP INNER JOIN PRODUCTOS AS P ON DP.PRODUCTOS_ID=P.ID WHERE DP.PEDIDOS_ID=:ID";

    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ':ID' => $id
    );
    if ($resultado->execute($_array))
      return $resultado->fetchAll();

    return false;
  }
}
