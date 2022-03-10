<?php

session_start();
require '../db/conexion.php';

if (!empty($_POST['txtusuario']) && !empty($_POST['txtpassword'])) {
    $rol = 'Usuario';
    if ( !empty($_SESSION['rol']) && $_SESSION['rol'] == 'Admin') {
      $rol = $_POST['rol'];
    }
    $sql = "INSERT INTO users (name, pass, rol) VALUES (:usu, :pass, :rol)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usu', $_POST['txtusuario']);
    $password = password_hash($_POST['txtpassword'], PASSWORD_BCRYPT);
    $stmt->bindParam(':pass', $password);
    $stmt->bindParam(':rol', $rol);

    if ($stmt->execute()) {
      $message = 'Nuevo usuario creado';
    } else {
      $message = 'Error al crear usuario';
    }
  }
?>

<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">	
  </head>
  <body>
    <?php if(!empty($message)): ?>
      <center><p style="font-family: sans-serif; font-size: 2em;"> <?= $message ?></p></center>
    <?php endif; ?>
    <?php if(!empty($_SESSION['rol']) && $_SESSION['rol'] == 'Admin'): ?>
      <center><p style="font-family: sans-serif; font-size: 2em;">Modo administrador</p></center>
    <?php endif; ?>
    <div class="caja1">
      <form method="post" action="crearuser.php">
        <div class="formtlo">Crear Usuario</div>
        <div class="ub1">Ingresar usuario</div>
        <input type="text" name="txtusuario">
        <div class="ub1">Ingresar password</div>

        <input type="password" name="txtpassword" id="txtpassword">

        <?php if(!empty($_SESSION['rol']) && $_SESSION['rol'] == 'Admin'): ?>

        <div class="ub1">Rol</div>
        <select name="rol">
        <option value="0" style="display:none;"><label>Seleccionar</label></option>
        <option value="Usuario">Usuario</option>
        <option value="Admin">Administrador</option>
        </select>

        <?php endif ?>

        <div align="center">
        <input type="submit" value="Crear">
        <input type="reset" value="Cancelar">
        </div>
        <p>¿Ya está registrado?<a href="./">Inicie sesión</a></p>
        <a href="../ar/">volver</a>
      </form>
    </div>
  </body>
</html>
