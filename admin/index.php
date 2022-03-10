<?php
    session_start();
    if (!empty($_SESSION['rol']) && $_SESSION['rol'] == "Admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../header/stylesheader.css">
    <link rel="stylesheet" href="../stylesgeneral.css">
    <title>Control Panel</title>
    <style>
        header{
            background-color: black;
            padding-right: 10px
        }

        h1{
            color: white;
        }

        #uploadupdateproducto{
            margin: auto;
            height: 500px;
            width: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: wrap column;
            background-color: #11102b;
            z-index: 10;
            border-radius: 10px;
            color: white;
        }

        #uploadupdateproducto form{
            font-family: sans-serif;
            padding-top: 20px;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: center;
        }



        #uploadupdateproducto input{
            font-family: sans-serif;
            font-size: 20px;
            margin: 10px 0;
            width: 300px;
            height: 50px;
            border: none;
            color: black;
            border-radius: 3px;
            padding-left: 6px;
        }

        #uploadupdateproducto #img_uploaded{
            height: 30px;
            background-color: azure;
            padding-left: 0px;
        }

        #uploadupdateproducto input[type="submit"]{
            width: 200px;
            height: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div id="leftheader">
            <a href="../ar/"><div id="logo"></div></a>
        </div>
        <h1>Panel de control</h1>
        <div id="rightheader">
            <div id="log">
                <a class="linkbutton" href="../log/crearuser.php" style="background-color: #4DDB7D;">Agregar usuario</a>
                <a class="linkbutton" href="../close.php" style="background-color: #3163FF;">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <?php if (isset($_POST['idproduct'])) {?>
        <div id="uploadupdateproducto">
        <form action="./updateproduct.php" method="post" enctype="multipart/form-data">
            <h1>Modificar producto id: <?= $_POST['idproduct']; ?></h1>
            <h2>Ingrese los datos a modificar</h2><br>
            <p>Cambiar imagen:</p>
            <input type="file" name="img_uploaded" id="img_uploaded">
            <input type="text" name="productdesc" placeholder="Titulo...">
            <input type="number" name="price" id="price" placeholder="precio...">
            <input type="hidden" name="idproduct" value="<?= $_POST['idproduct']; ?>">
            <input type="submit">
        </form>
        </div>
    <?php } else { ?>
    <div id="uploadupdateproducto">
        <form action="./uploadproduct.php" method="post" enctype="multipart/form-data">
            <h1>Publicar producto</h1>
            <h2>Ingrese los datos</h2><br>
            <p>Subir imagen:</p>
            <input type="file" name="img_uploaded" id="img_uploaded">
            <input type="text" name="productdesc" placeholder="Titulo...">
            <input type="number" name="price" id="price" placeholder="precio...">
            <input type="hidden" name="idproduct" value="<?= $_POST['idproduct']; ?>">
            <input type="submit">
        </form>
    </div>
    <?php } ?>


</body>
</html>

<?php }
else {
?>
<center>
    <br><br><br><br>
    <h1 style="font-family: sans-serif;">No tiene permisos para acceder a este sitio. <a href="../ar/"> Volver</a></h1>
</center>
<?php
}
?>