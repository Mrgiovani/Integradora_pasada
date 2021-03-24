<!-- verificar el post -->
<?php

    if(isset($_POST['create_post'])){

        $category_id = $_POST['post_category_id'];
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'];

        //Recuperando la imagen:
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        //mover el archivo a la carpeta imágenes:
        move_uploaded_file($post_image_temp, "../images/{$post_image}");

        //llamar al procedimiento para almacenar:
        $query = "CALL insertPosts(
            '{$category_id}', 
            '{$post_title}', 
            '{$post_author}', 
            now(), 
            '{$post_image}', 
            '{$post_content}', 
            '{$post_tags}', 
            '{$post_status}')";
         
        //ejecutar el query.
        if(!mysqli_query($connection, $query)){
            echo "error";
        }else{
            $post_created = "<div class='bg-success text-center'>Post created! <a href='posts.php'>See posts</a></div>";
            echo $post_created;
        }

    }


?>

<!-- Formulario para agregar contenido -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title:</label>
        <input id="title" class="form-control" type="text" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Select the category:</label><br>
        <select class="form-control" name="post_category_id" id="post_category">

            <?php

                $query = "SELECT * FROM categories";
                $categoriesResults = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($categoriesResults)) {

                    echo "<option value='{$row['category_id']}'>{$row['category_title']}</option>";

                }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="tite">Author:</label>
        <input id="tite" class="form-control" type="text" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post status:</label>
        <select id="post_status" class="form-control" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post image:</label>
        <input id="post_image" class="form-control" type="file" name="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post tags:</label>
        <input id="post_tags" class="form-control" type="text" name="post_tags">
        <small>Comma-separated values</small>
    </div>


    <div class="form-group">
        <label for="post_content">Text</label>
        <textarea id="" class="form-control" name="post_content" rows="10" cols="30"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Publish post!" name="create_post">
    </div>


</form>

