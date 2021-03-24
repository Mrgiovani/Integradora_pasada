<form method="post">
    <div class="form-group">
        <label for="cat_title">Update category:</label>
        <input  type="text" 
                name="cat_title" 
                id="cat_title" 
                class="form-control" 
                value="<?php 
                        if(isset($_GET['edit'])){
                            $category_ID = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE category_id = $category_ID";
                            $result = mysqli_query($connection, $query);
                            $result_array = mysqli_fetch_assoc($result);
                            echo $result_array['category_title'];
                        }
                ?>"
                required>
    </div>
    <div class="form-group">
        <input type="submit" name="submit-update" id="" value="Update category" class="btn btn-success">
    </div>
</form>