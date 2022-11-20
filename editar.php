<?php
include_once('conexion.php');
$id = $_GET['id'];
$consulta = "SELECT * FROM datos WHERE $id = id";