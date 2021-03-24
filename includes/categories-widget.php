<!-- Widget para listar categorías  -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row categories-column">
    
    <?php

        //=============================================================
        /*
            Se realiza una consulta a la base de datos en categorías,
            después se procede a insertar dichos resultados en la lista
            de categorías en el widget.
        */
        //=============================================================
        $MAX_SEARCH = 12;
        $query = "SELECT * FROM categories LIMIT $MAX_SEARCH";
        $categories_sidebar = mysqli_query($connection, $query);

    ?>

        <div class="col-lg-6">
            <ul class="list-unstyled">

            <?php

                while ($row = mysqli_fetch_assoc($categories_sidebar)) {
                    $category_title = $row['category_title'];
                    $category_ID = $row['category_id'];
                    $category_result = "<li><a href='category.php?category={$category_ID}'>{$category_title}</a></li>";
                    echo $category_result;  
                    
                }
            ?>
            </ul>
        </div>


    </div>
    <!-- /.row -->
</div>