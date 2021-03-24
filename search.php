<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>

    <!-- Contenido de la página  -->
    <div class="container">
        <div class="row">
            <!-- Columna de artículos 8/12 -->
            <div class="col-md-8">
                
            
            <?php

                    //Búsqueda

                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $search_result = mysqli_query($connection, $query);

                        //Cerrar conexión en caso de fallo:
                        if (!$search_result) {
                            echo "Fail.";
                            die(mysqli_error($connection));
                        }else{

                            $select_posts = $search_result;
                            /*
                                Se utiliza unbucle while para iterar sobre $row = search_result.
                            */
                            //================================================================
                            
                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                
                                //================================================================
                                /*
                                Se declaran todas las variables necesarias para recibir resultados.
                                */
                                //================================================================
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
        
                    ?>
            
                                <h1 class="page-header">
                                    Search results:
                                </h1>
        
                                <!-- Mostrar artículos  -->
                                <h2>
                                    <a href='post.php?p_id=<?php echo $post_id?>'><?php echo $post_title?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"><?php echo $post_author ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                                <hr>
                                <p><?php echo $post_content?></p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                                <hr>
        
        
                                <?php } 
                        }

                    } ?>
                

                    


            </div>

            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>