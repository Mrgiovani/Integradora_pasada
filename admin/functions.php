<?php

    function insertCategories(){
        global $connection;
        if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

            if($cat_title=="" || empty($cat_title)){

                //agregar algo visual para el campo vacío.
                
            }else{
                $query = "CALL insertCategory('{$cat_title}')";
                $result_query = mysqli_query($connection, $query);

               if(!$result_query){
                   die("EROR" . mysqli_error($connection));
               }
            }
        }
    }


    function listCategories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $results = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($results)) {
            $category_ID = $row['category_id'];
            $category_title = $row['category_title'];
            $add_arrow = "<tr>
                            <td>{$category_ID}</td>
                            <td>{$category_title}</td>
                            <td>
                                <a href='categories.php?delete={$category_ID}' class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this category?'); \">Delete</a>
                                <a href='categories.php?edit={$category_ID}' class='btn btn-success'>Edit</a>
                                </td>
                          </tr>";
            echo $add_arrow;
        }
    }

    function deleteCategories(){
        global $connection;
        if(isset($_GET['delete'])){
            $cat_delete_id = $_GET['delete'];
            $query = "CALL deleteCategory('{$cat_delete_id}')";
            $result_query = mysqli_query($connection, $query);
            header("Location: categories.php");

            if(!$result_query){
                echo "<h1>¡WTF?</h1>";
            }
        }

    }

    function updateCategories(){
        global $connection;
        if(isset($_POST['submit-update'])){
            $cat_update_id = $_GET['edit'];
            $cat_title = $_POST['cat_title'];
            $query = "CALL updateCategory('{$cat_update_id}', '{$cat_title}')";
            $result_query = mysqli_query($connection, $query);
            header("Location: categories.php");
        }
    }



?>