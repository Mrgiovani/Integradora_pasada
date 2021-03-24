<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
    <!-- Contenido de la página  -->
    <div class="container">
        <div class="row">
            <!-- Columna de artículos 8/12 -->
            <div class="col-md-8">
            <h1 class="page-header">Blog:</h1>
            <?php
                    //El número de páginas que quiero mostrar:
                    
                    $per_page = 5;

                    //Encontrar la cantidad total de posts que tenemos:
                    $query_post_count = "SELECT * FROM posts";
                    //Ejecutar la query:
                    $resultCount = mysqli_query($connection, $query_post_count);
                    //Contar los rows y asignar a una variable:
                    $totalPosts = mysqli_num_rows($resultCount);
                    //Divido los posts (mostrar de 5 en 5)
                    $totalPosts = ceil($totalPosts/$per_page);


                    //Comprobar si se presionó algún botón de la paginación.
                    //Recuperamos el valor de 'page' a través del protocolo GET.
                    
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "";
                    }

                    //Una vez recuperado hago algo con ese valor si no se presionó algo
                    //o si estamos en la primera página, genero una variable con valor 0.

                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        /*
                        La lógica es la siguiente:
                        Cuando estamos en la página 1 o simplemente no presionamos nada en la paginación,
                        la variable $page es igual a 0. Por lo tanto en la consulta el líimite empieza en la 0
                        y el offset sigue siendo de 5 (mostrando las primeras cinco páginas).

                        Si presionamos algo en la páginación, supogamos el botón 2, entonces $page es igual a 2.
                        Ahora multiplicamos por el número de artículos que vamos a mostrar, 5, lo que resulta en 10.
                        Dado que estamos en la página 2, iniciamos en la página 6 y necesitamos un offset de 5.
                        Para ello sólo necesitamos restar 5 al producto previamente calculado. 
                        La consulta quedaría: 
                        SELECT*FROM posts ORDER BY post_id LIMIT 5, $page_1;
                        */
                        $page_1 = ($page*$per_page)-$per_page;
                    }


                    $query = "SELECT * FROM posts ORDER BY 'post_id' DESC LIMIT $page_1, $per_page";
                    $select_posts = mysqli_query($connection, $query);

                    //================================================================
                    /*
                        Se utiliza unbucle while para iterar sobre $select_posts,
                        la intención es alojar un array asociativo a través de 
                        mysqli_fetch_assoc();
                    */
                    //================================================================
                    
                        while ($row = mysqli_fetch_assoc($select_posts)) {
                        
                        //================================================================
                        /*
                        Se declaran todas las variables necesarias para recibir resultados.
                        */
                        //================================================================
                        $post_id        =$row['post_id'];
                        $post_title     =$row['post_title'];
                        $post_author    =$row['post_author'];
                        $post_date      =$row['post_date'];
                        $post_image     =$row['post_image'];

                        //Para no mostrar todo el contenido del post hacemos una substring de 200 chars.
                        $post_content   = substr($row['post_content'], 0, 200) . "...";

                        

            ?>

                        <!-- Mostrar artículos  -->
                        <h2>
                            <!-- Hago un echo en el ID para mandarlo por GET -->
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                        <?php } ?>

            </div>

                    
            <?php include "includes/sidebar.php" ?>
        </div>

        <hr>
        <!-- PAGINACIÓN -->
        <ul class="pager">
            <?php
                for($i = 1; $i <= $totalPosts; $i++){

                    if($i == $page){
                        echo "<li><a class='active_link' href=index.php?page={$i}>{$i}</a></li>";
                    }else{
                        echo "<li><a href=index.php?page={$i}>{$i}</a></li>";
                    }
                }
            ?>
        </ul>

<?php include "includes/footer.php" ?>  
