
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>Author</td>
            <td>Title</td>
            <td>Category</td>
            <td>Date</td>
            <td>Image</td>
            <td>Tags</td>
            <td>Comments count</td>
            <td>Views</td>
            <td>Status</td>
            <td colspan="2">Actions</td>
        </tr>
    </thead>
    <tbody>

    <!-- Consultar usuarios -->
    <?php

        $query = "SELECT*FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($select_posts)) {
            //Declaro todas las variables:
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_views = $row['post_views'];
            $post_status = $row['post_status'];

            //Insertar elemento html

            //Realizar consulta para actualizar categoría.  
            $query = "SELECT*FROM categories WHERE category_id={$post_category_id}";
            $category_results = mysqli_query($connection, $query);
            $row_category = mysqli_fetch_assoc($category_results);

            $post_row = "
            <tr>
                <td>{$post_id}</td>
                <td>{$post_author}</td>
                <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
                <td>{$row_category['category_title']}</td>
                <td>{$post_date}</td>
                <td class='text-center'> <img width='200' src='../images/{$post_image}'></td>
                <td>{$post_tags}</td>
                <td>{$post_comment_count}</td>
                <td>{$post_views}</td>
                <td>{$post_status}</td>
                <td>
                    <a class='btn btn-danger' href='posts.php?delete={$post_id}' onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \"><i class='fas fa-fw fa-trash'></i> Delete</a>
                </td>
                <td>
                    <a class='btn btn-success' href='posts.php?source=edit_post&p_id={$post_id}'><i class='fas fa-fw fa-edit'></i> Edit</a>
                </td>
            </tr>

            ";

            echo $post_row;
        }


    ?>
    </tbody>
</table>


<!-- ELIMINAR POST -->
<?php

        if(isset($_GET['delete'])){

            $post_id = $_GET['delete'];
            $query = "CALL deletePOST('{$post_id}')";
            mysqli_query($connection, $query);
            header("Location: posts.php");

        }

?>