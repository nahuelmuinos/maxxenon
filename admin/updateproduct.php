<?php 
    if(isset($_POST['productdesc']) || isset($_FILES['img_uploaded']) || isset($_POST['price'])){
        $update = "UPDATE `productos` SET `id` = `id`";
        
        if($_POST['productdesc'] != ''){
            $update = $update.", `descripcion` = '".$_POST['productdesc']."'";
        }

        if($_POST['price'] != ''){
            $update = $update.", `precio` = '".$_POST['price']."'";
        }

        if ($_FILES['img_uploaded']['name'] != null) {
            $img = $_FILES['img_uploaded']['tmp_name'];
            include("./redimensionar.php");
            $img2 = redimensionarImagen($img, 250, 350);
            if (file_exists("../ar/products/".$img2)){
                $update = $update.", `nombre_img` = '".$img2."'";
            }
        }
        
        $update = $update." WHERE `productos`.`id` =".$_POST['idproduct'];

        $con = mysqli_connect('localhost', 'root', '', 'maxxenon');
        mysqli_query($con, $update);
    }
    header('location:../ar/')
?>