<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>

    <!-- Contenido de la página  -->
    <div class="container">
        <div class="row">
            <!-- Columna de artículos 8/12 -->
            <div class="col-md-8">
                
                                    
            <?php
                    
                    //Comprobamos que el usuario haya dado click y recupero el GET value:

                    if(isset($_GET['p_id'])){

                        $post_ID = $_GET['p_id'];

                        //agregamos conteo all post

                        $query = "CALL viewsCounter($post_ID)";

                        //comprobar el conteo:

                        if(!mysqli_query($connection, $query)){
                            echo "Error al contar vistas";
                        }


                    }else{
                        header("Location: index.php");
                    }

                    $query = "SELECT * FROM posts WHERE post_id = $post_ID";
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
                        $post_ID = $row['post_id'];
                        $post_title     =$row['post_title'];
                        $post_author    =$row['post_author'];
                        $post_date      =$row['post_date'];
                        $post_image     =$row['post_image'];
                        $post_content   =$row['post_content'];

            ?>


                        <!-- Mostrar artículos  -->
                        <h2>
                            <a href="#"><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content?></p>
                        <hr>


                        <?php } ?>

                         <!-- Formaulario de comentarios -->

                <?php

                    if(isset($_POST['create_comment'])){

                        //Ingresar comentario a la base de datos:
                        
                        //1.- Recupero el ID del post en el que me encuentro(GET):
                        $post_ID = $_GET['p_id'];
                        //2.- Recupero el resto de las varaibles:
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        //Query al proceso en la BD:

                        $query = "CALL insertComment('{$post_ID}','{$comment_author}','{$comment_email}','{$comment_content}', now())";
                        
                        //Sumar comentario:

                        $queryComment = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id=$post_ID";
                        if(!mysqli_query($connection, $queryComment)){
                            echo "<h1>Error al actualizar el conteo!</h1>";
                        }

                        if(!mysqli_query($connection, $query)){
                            echo "<h1>Error insterting comment in the DB.</h1>";
                        }

                    }

                ?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">

                        <div class="form-group">
                            <label for="comment_author">Author:</label>
                            <input id="comment_author" class="form-control" type="text" name="comment_author" required>
                        </div>

                        <div class="form-group">
                            <label for="comment_email">Email:</label>
                            <input id="comment_email" class="form-control" type="email" name="comment_email" required>
                            <small>Your email will not be published.</small>
                        </div>

                        <div class="form-group">
                            <label for="comment_content">Give us your comment!</label>
                            <textarea id="comment_content" class="form-control" name="comment_content" rows="10" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>


                <hr>
                <!-- Postear comentarios: -->
                <h2>Comments section:</h2>
                <hr>
                <?php
                    //Recupero el ID actual:
                    $postID = $_GET['p_id'];



                    //Recuperar todos los comentarios aprobados:
                    $query = "SELECT*FROM comments WHERE comment_status='approved' AND comment_post_id = $postID ORDER BY comment_id";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        //Guardo en variables los resultados de la consulta:
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];

                ?>

                    <!-- Corto bucle e inyecto el comentario de turno -->

                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="images/default_avatar.png" alt="user avatar">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <p>
                                    <?php echo $comment_content; ?>
                                </p>
                            </div>
                        </div>

                   <?php } ?>


            </div>

                    
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>
    </div>

<?php include "includes/footer.php" ?>