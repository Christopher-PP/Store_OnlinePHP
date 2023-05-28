<?php

namespace bompzz;

class Cliente
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
  public function registrar_cl($_params)
  {
    $sql = "INSERT INTO CLIENTES SET NOMBRE=:NOMBRE, APELLIDOS=:APELLIDOS,EMAIL=:EMAIL, TELEFONO=:TELEFONO, COMENTARIO=:COMENTARIO";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":NOMBRE" => $_params['NOMBRE'],
      ":APELLIDOS" => $_params['APELLIDOS'],
      ":EMAIL" => $_params['EMAIL'],
      ":TELEFONO" => $_params['TELEFONO'],
      ":COMENTARIO" => $_params['COMENTARIO'],
    );
    if ($resultado->execute($_array))
      return $this->cn->lastInsertId();

    return false;
  }
  public function Actualizar($_params)
  {
    $sql = "UPDATE CLIENTES SET NOMBRE=:NOMBRE, APELLIDOS=:APELLIDOS,EMAIL=:EMAIL, TELEFONO=:TELEFONO, COMENTARIO=:COMENTARIO";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":NOMBRE" => $_params['NOMBRE'],
      ":APELLIDOS" => $_params['APELLIDOS'],
      ":EMAIL" => $_params['EMAIL'],
      ":TELEFONO" => $_params['TELEFONO'],
      ":COMENTARIO" => $_params['COMENTARIO'],
    );
    if ($resultado->execute($_array))
      return true;

    return false;
  }
}
