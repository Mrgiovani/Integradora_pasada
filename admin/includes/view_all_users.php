
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nickname</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Email</td>
            <td>Role</td>
            <td colspan="2">Actions</td>
        </tr>
    </thead>
    <tbody>

    <!-- Consultar users -->
    <?php

        $query_users = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query_users);
        
        while ($row = mysqli_fetch_assoc($select_users)) {
            //Declaro todas las variables:

            $user_id = $row['user_id'];
            $user_nickname = $row['user_nickname'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];


            $user_row = "
                <tr>
                    <td>$user_id</td>
                    <td>$user_nickname</td>
                    <td>$user_first_name</td>
                    <td>$user_last_name</td>
                    <td>$user_email</td>
                    <td>$user_role</td>
                    <td><a class='btn btn-danger' href='users.php?delete=$user_id' onClick=\"javascript: return confirm('Are you sure you want to delete this user?'); \"><i class='fas fa-fw fa-trash'></i> Delete</a></td>
                    <td><a class='btn btn-success' href='users.php?source=edit_user&u_id=$user_id'><i class='fas fa-fw fa-edit'></i> Edit</a></td>
                </tr>
            ";

            echo $user_row;
        }


    ?>


    </tbody> 
</table>


<!-- ELIMINAR USUARIO -->
<?php

        if(isset($_GET['delete'])){

            $user_id = $_GET['delete'];
            $query = "CALL deleteUser('{$user_id}')";

            if(!mysqli_query($connection, $query)){
                echo "<h2>Error deleting user</h2>";
            }

            header("Location: users.php");

        }

?>
