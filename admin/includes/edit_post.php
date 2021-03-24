<?php

if(isset($_GET['p_id'])){

    $postID = $_GET['p_id'];

}

$query = "SELECT*FROM posts WHERE post_id='{$postID}'";
$select_post_byID = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_post_byID)) {

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_status = $row['post_status'];

}

//Actualizar el post cuando se presiona el botón.
if(isset($_POST['update_post'])){

    //Guardo el ID de lo que editaré:
    $postIDUpdate = $_GET['p_id'];

    //Recogemos los datos ingresados en el formulario.
    //Una vez que presionan "update" todos estos valores
    //pasan en el POST y son recuperados con $_POST['name']
    $post_title = $_POST['title'];
    $post_category = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    //Primero movemos imagen:
    move_uploaded_file($post_image_temp, "../images/$post_image");

    //Hacemos el update en en la base de datos:

    $query = "CALL updatePost(
        '{$postIDUpdate}',
        '{$post_category}',
        '{$post_title}',
        '{$post_author}',
        '{$post_image}',
        '{$post_content}',
        '{$post_tags}',
        '{$post_status}'
    )";

    if(!mysqli_query($connection, $query)){
        echo "<h1>QUERY FAILED</h1>";
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title:</label>  
        <input value=<?php echo "'$post_title'"; ?> id="title" class="form-control" type="text" name="title">
    </div>

    <!-- Mostrar dinámicamente las categorías -->

    <div class="form-group">
        <label for="post_category">Select the category:</label><br>
        <select name="post_category" id="post_category">

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
        <input value=<?php echo "'$post_author'"; ?> id="tite" class="form-control" type="text" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post status:</label>
        <input value=<?php echo $post_status; ?> id="post_status" class="form-control" type="text" name="post_status">
    </div>

    <div class="form-group">
        <img width="300" src="../images/<?php echo $post_image?>" alt="">
        <input type="file" name="image" id="">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post tags:</label>
        <input value=<?php echo "'$post_tags'"; ?> id="post_tags" class="form-control" type="text" name="post_tags">
        <small>Comma-separated values</small>
    </div>

    <div class="form-group">
        <label for="post_content">Text</label>
        <textarea id="" class="form-control" name="post_content" rows="10" cols="30"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-success" type="submit" value="Update post!" name="update_post">
    </div>
</form>

