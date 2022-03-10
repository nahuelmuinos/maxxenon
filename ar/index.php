

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../header/stylesheader.css">
    <link rel="stylesheet" href="../stylesgeneral.css">
    <title>Maxxenon</title>
    <style>
        #banner{
            background: url("banner.png");
            width: 90%;
            height: 400px;
            margin: auto;
            background-position: center;
            background-size: 100% auto;
            background-repeat: no-repeat;
        }

        main{
            color: white;
            font-family: sans-serif;
            display: flex;
            flex-flow: wrap;
            padding: 20px;
        }
        
        #map{
            width: 90%;
        }

        #productos{
            display: grid;
            grid-template-columns: 260px 260px 260px 260px;
            color: black;
            margin: auto;
        }

        @media only screen and (max-width: 768px){
            #productos{
                grid-template-columns: 260px 260px;
            }
        }
            
        .producto{
            width: 250px;
            height: 380px;
            text-decoration: none;
            color: black;
            display: flex;
            flex-flow: wrap column;
            justify-content: space-around;
            font-size: 15px;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 30px;
            margin-left: 15px;
            padding-bottom: 10px;
        }

        .imgproducto{
            height: 65%;
            width: 100%;
            margin: auto;
            image-rendering: auto;
            margin-top: 0;
            background-color: #D1D1D1;
            display: flex;
            justify-content: center;
            
        }

        .textproducto{
            display: flex;
            flex-flow: wrap column;
            justify-content: space-around;
            max-width: 230px;
            height: 22%;
            padding: 5px;
            padding-left: 15px;
            
        }

        .edit{
            height: 25px;
            width: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2px auto;
            padding: 0px 2px;
            background: #28B463;
            border-radius: 5px;
            border-style: none;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }

        h1{
            margin: 30px;
            color: white;
            font-family: sans-serif;
        }
    </style>
</head>
<body bgcolor="black">
    <?php include("../header/index.php") ?>
    <div id="banner"></div>
    <main>
        <h1>Ultimos productos agregados</h1>
        <div id="productos">
        <?php 
        
        $con = mysqli_connect('localhost', 'root', '', 'maxxenon');
        $consulta=mysqli_query ($con, "SELECT MAX(id) FROM productos");
        $cantproductos = mysqli_fetch_array($consulta);
        $cant = intval($cantproductos[0]);
        $exit = false;
        $mostrar = 6;
        do {
            if ($cant-$mostrar <= 0) {
                $mostrar = $mostrar-1;
            }
            else{ $exit = true; }
        } while ($exit == false);

        for ($i=$cant; $i > $cant-$mostrar-1; $i--) { 
            $consulta=mysqli_query ($con, " SELECT nombre_img FROM productos WHERE id = $i"); 
            $row = mysqli_fetch_array($consulta);
            if($row != null){
            $img = $row[0];

            $consulta=mysqli_query ($con, " SELECT descripcion FROM productos WHERE id = $i"); 
            $row = mysqli_fetch_array($consulta);
            $descripcion = $row[0];

            $consulta=mysqli_query ($con, " SELECT precio FROM productos WHERE id = $i"); 
            $row = mysqli_fetch_array($consulta);
            $precio = $row[0];
            
        ?>
            <div class='producto'>
                <div class="imgproducto"><img style='object-fit: contain;background-color: white;' src='products/<?= $img ?>' alt='producto'></div>
                <div class='textproducto'>
                    <p class='titleproducto'><?= $descripcion ?></p>
                    <p class='priceproducto'><br><?= $precio ?> $ARS</p>
                    
                </div>
                <?php if (!empty($_SESSION['rol']) && $_SESSION['rol'] == "Admin") {

                       echo '
                        <div style="display: flex; justify-content: space-around; width: 50%; margin: auto;" class="actions">
                        <form method="post" action="../admin/index.php">
                            <input type="hidden" name="idproduct" value='.$i.'>
                            <input type="submit" value="Editar" class="edit">
                        </form>
                        <form method="post" action="../admin/deleteproduct.php">
                            <input type="hidden" name="idproduct" value='.$i.'>
                            <input type="submit" style="background: #FF3C3C;" value="Borrar" class="edit">
                        </form>
                        </div>';
                    }?>
                <a href="" class="edit">Detalles</a>
            </div>
        <?php } }?>
        </div>
    </main>
</body>
</html>

