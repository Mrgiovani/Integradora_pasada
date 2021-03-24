
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>Done at:</td>
            <td>Author</td>
            <td>Email</td>
            <td>Content</td>
            <td>Status</td>
            <td>Date</td>
            <td colspan="3">Actions</td>
        </tr>
    </thead>
    <tbody>

    <!-- Consultar posts -->
    <?php

        $query = "SELECT*FROM comments ORDER BY comment_id DESC";
        $select_comments = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($select_comments)) {
            //Declaro todas las variables:

            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];


            //Realizar consulta para actualizar el título.  
            $query = "SELECT*FROM posts WHERE post_id={$comment_post_id} ORDER BY post_id DESC";
            $category_results = mysqli_query($connection, $query);
            $row_title = mysqli_fetch_assoc($category_results);
            $post_ID = $row_title['post_id'];


            //Crear elemento HTML.
            $post_row = "
            <tr>
                <td>{$comment_id}</td>
                <td>
                    <a href='../post.php?p_id=$post_ID'>{$row_title['post_title']}</a>
                </td>
                <td>{$comment_author}</td>
                <td>{$comment_email}</td>
                <td>{$comment_content}</td>
                <td>{$comment_status}</td>
                <td>{$comment_date}</td>
                <td>
                <a href='comments.php?approve=$comment_id' class='btn btn-primary'><i class='fas fa-fw fa-thumbs-up'></i> Approve</a>
                </td>
                <td>
                <a href='comments.php?unapprove=$comment_id' class='btn btn-warning'><i class='fas fa-fw fa-thumbs-down'></i> Unapprove</a>
                </td>
                <td>
                <a href='comments.php?delete=$comment_id' class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this comment?'); \"><i class='fas fa-fw fa-trash'></i> Delete</a>
                </td>
            </tr>

            ";

            echo $post_row;
        }


    ?>

    

    </tbody> 
</table>


<!-- ELIMINAR COMENTARIO -->
<?php

        if(isset($_GET['delete'])){

            $comment_id = $_GET['delete'];
            $query = "CALL deleteComment('{$comment_id}')";

            $updateComment = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id=$comment_id";

            if(!mysqli_query($connection, $updateComment)){
                echo "<h1>Error al actualizar comentarios.</h1>";
            }

            //En caso de error en la consulta:
            if(!mysqli_query($connection, $query)){
                echo "<h1>ERROR!</h1>";
            }
            header("Location: comments.php");

        }

?>


<!-- APROBAR/DESAPROBAR COMENTARIOS -->

<?php

//APROBAR COMENTARIO:

        if(isset($_GET['unapprove'])){

            //Recolectar el ID:
            $post_id = $_GET['unapprove'];

            $queryApprove = "CALL unapproveStatus('{$post_id}')";

            if(!mysqli_query($connection, $queryApprove)){
                echo "<h2>Error in QUERY!</h2>";
            }

            header("Location: comments.php");
            

        }

//NO APROBAR COMENTARIO.


if(isset($_GET['approve'])){

    //Recolectar el ID:
    $post_id = $_GET['approve'];

    $queryUnapprove = "CALL approveStatus('{$post_id}')";

    if(!mysqli_query($connection, $queryUnapprove)){
        echo "<h2>Error in QUERY!</h2>";
    }

    header("Location: comments.php");
    

}

?>