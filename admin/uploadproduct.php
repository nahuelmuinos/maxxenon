<?php 
    if(isset($_POST['productdesc']) && isset($_FILES['img_uploaded']) && isset($_POST['price'])){

        if($_POST['productdesc'] != '' && $_POST['price'] != ''){
            $img = $_FILES['img_uploaded']['tmp_name'];
            $productdesc = $_POST['productdesc'];
            $price = $_POST['price'];
            include("./redimensionar.php");
            $img2 = redimensionarImagen($img, 250, 350);
            if (file_exists("../ar/products/".$img2)){
                $con = mysqli_connect('localhost', 'root', '', 'maxxenon');
                mysqli_query($con, "INSERT INTO `productos`(`nombre_img`, `descripcion`, `precio`) VALUES ('$img2','$productdesc','$price')");
            }
        }
    }
    header('location:../ar/');
?>