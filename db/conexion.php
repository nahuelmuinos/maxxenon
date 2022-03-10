<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'maxxenon';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Error de conexion: ' . $e->getMessage());
}
?>