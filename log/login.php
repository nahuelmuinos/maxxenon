<?php
require '../db/conexion.php';

$usu 	= $_POST["txtusuario"];
$pass 	= $_POST['txtpassword'];
$rol 	= $_POST["rol"];
$sql = "SELECT * FROM users WHERE name = :usu AND rol = :rol";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':usu', $usu);
$stmt->bindParam(':rol', $rol);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if (!empty($result)) {
	if (count($result) && password_verify($pass, $result['pass'])) {
		session_start();
		$_SESSION['user'] = $result['name'];
		$_SESSION['rol'] = $result['rol'];
		if($result['rol'] == "Usuario"){	
			header("Location: ../ar/");
		}
		else if ($result['rol'] == "Admin"){
			header("Location: ../admin/");
		}
	}
}
else {
	?>
	<center>
		<br><br><br><br>
		<h1 style="font-family: sans-serif;">No se encontró su usuario. <a href="../log/"> Volver</a></h1>
	</center>
	<?php
	}
?>