<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user = $_POST['nombre_usuario'];
  $pass = $_POST['clave'];

  require '../vendor/autoload.php';
  $usuario = new bompzz\Usuario;
  $resultado = $usuario->login($user, $pass);
  if ($resultado) {
    session_start();
    $_SESSION['usuario_info'] = array(
      'USUARIO' => $resultado['NOMBRE_USUARIO'],
      'ESTADO' => 1

    );
    header('Location:  dashboard.php');
  } else {
    exit(json_encode(array('estado' => FALSE, 'mensaje' => 'Error al iniciar sesión')));
  }
}
