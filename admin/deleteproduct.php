<?php
session_start();
if (!empty($_SESSION['rol']) && $_SESSION['rol'] == "Admin") {
    if(isset($_POST['idproduct']) && $_POST['idproduct'] != ''){
        $con = mysqli_connect('localhost', 'root', '', 'maxxenon');
        mysqli_query($con, "DELETE FROM `productos` WHERE `productos`.`id` =".$_POST['idproduct']);
        mysqli_query($con, "ALTER TABLE `productos` CHANGE `id` `id` INT(11) NOT NULL");
        mysqli_query($con, "ALTER TABLE `productos` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT");
    }
}
header('location:../ar/')
?>