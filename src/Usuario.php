<?php

namespace bompzz;

class Usuario
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
  public function login($NOMBRE, $PASS)
  {
    $sql = "SELECT NOMBRE_USUARIO  FROM USUARIOS WHERE NOMBRE_USUARIO = :NOMBRE AND CLAVE=:PASS";
    $resultado = $this->cn->prepare($sql);
    $_array = array(
      ":NOMBRE" => $NOMBRE,
      ":PASS" => $PASS
    );
    if ($resultado->execute($_array))
      return $resultado->fetch();

    return false;
  }
}
