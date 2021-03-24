<?php 
//========================================================================
/*
    Se hace un include a db.php para tener scope a la variable $connection,
    la cual es responsable de conectar con la base de datos y la cual es
    requerida para ejecutar mysqli_query().
*/

    include "db.php";
//=======================================================================
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">[DIGITAL] WORLD</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/cms/admin">Admin</a></li>
                <li><a href="/cms/admin">Blog</a></li>
                <li><a href="/cms/admin">Store</a></li>
                <li><a href="/cms/admin">About</a></li>
                <li><a href="registration.php">Register</a></li>
                <?php
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $query);

                    //================================================================
                    /*
                        Se utiliza unbucle while para iterar sobre $select_categories,
                        la intención es alojar un array asociativo a través de 
                        mysqli_fetch_assoc();
                    */
                    //================================================================
                    
                    while ($row = mysqli_fetch_assoc($select_categories)) {
                        
                        //================================================================
                        /*
                        Se declara una variable $category_title en la que se almacena
                        la llave cuyo nombr es igual a la columna en la tabla de la 
                        base de datos, en este caso 'category_title' es la columna
                        que se seleccionó. 
                        */
                        //================================================================
                        $category_title = $row['category_title'];
                        //================================================================
                        /*
                            Se crea otra variable más donde se espera concaternar el
                            resultado con las etiqueras HTML adecuadas para leuego
                            mostrarlas en el DOM.
                        */
                        //================================================================
                        //$category_result = "<li><a href='#'>{$category_title}</a></li>";
                        //echo $category_result;  
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>