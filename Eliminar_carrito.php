<?php
session_start();
if (!isset($_GET['ID']) or !is_numeric($_GET['ID']))
  header('Location:  carrito.php');

$id = $_GET['ID'];
if (isset($_SESSION['carrito'])) {
  unset($_SESSION['carrito'][$id]);
  header('Location:  carrito.php');
} else {
  header('Location:  index.php');
}
