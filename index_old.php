<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>

    <!-- Contenido de la página  -->
    <div class="container">
        <div class="row">
            <!-- Columna de artículos 8/12 -->
            <div class="col-md-8">
            <h1 class="page-header">Blog:</h1>
            <?php
                    
                    $query = "SELECT * FROM posts";
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

<?php include "includes/footer.php" ?>