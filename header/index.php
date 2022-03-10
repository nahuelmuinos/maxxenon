<?php
session_start()



?>
<header>
    <div id="leftheader">
        <div id="logo"></div>
    </div>
    
    <div id="rightheader">
        <div>
            <form action="" method="post" id="searchbox">
                <input type="radio" name="showsearch" id="showsearch" hidden>
                <input type="search" name="search" id="search">
                <label for="showsearch" id="showsearchicon"><div id="searchicon"></div></label>
                <input type="submit" value="" id="sendsearch" hidden>
                <label for="sendsearch" id="hiddenbuttonsearch"><div id="searchicon"></div></label>
            </form>
        </div>

        <div id="log">
            <?php 
                if (!empty($_SESSION['user'])) {
                    echo '<div style="display: flex;align-items:center;color: white; flex-flow: wrap column;"><p>Bienvenido '.$_SESSION['user'].'</p>';
                    if ($_SESSION['rol'] == 'Admin') {
                        echo '<a href="../admin/" style="color: white;">Ir a panel de control<a>';
                    }
                    echo '</div>';
                    echo '<a class="linkbutton" href="../close.php" style="margin-left: 10px;background-color: #33B5FF;">cerrar sesión</a>';
                }
                else {
                
            ?>
            <a class="linkbutton" href="../log/index.html" style="background-color: #33B5FF;">Iniciar sesión</a>
            <?php 
            }
            ?>
        </div>
    </div>
</header>