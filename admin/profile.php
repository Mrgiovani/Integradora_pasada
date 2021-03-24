<?php include "includes/admin_header.php" ?>

<!-- 
Se realiza un QUERY a la base de datos con los datos de la sesión.
Los datos de la sesión se recuperaron del sesion_start() en el admin header 
!-->

<?php

$query = "SELECT * FROM users WHERE user_nickname = '{$_SESSION['user_nickname']}'";
$row = mysqli_fetch_assoc(mysqli_query($connection, $query));

$user_nickname = $row['user_nickname'];
$user_first_name = $row['user_first_name'];
$user_last_name = $row['user_last_name'];
$user_password = $row['user_password'];
$user_email = $row['user_email'];
$user_id = $row['user_id'];


?>

<div id="wrapper">
    
    <?php include "includes/admin_navigation.php" ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                        <h1 class="page-header">Edit profile</h1>
                        <!-- First column -->
                        <div class="col-lg-12">

                            <form action="" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label for="nickname">User nickname:</label>
                                    <input value=<?php echo "'$user_nickname'"; ?> id="nickname" class="form-control" type="text" name="user_nickname">
                                </div>


                                <div class="form-group">
                                    <label for="first_name">First name:</label>
                                    <input value=<?php echo "'$user_first_name'"; ?> id="first_name" class="form-control" type="text" name="user_first_name">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last name:</label>
                                    <input value=<?php echo "'$user_last_name'"; ?> id="last_name" class="form-control" type="text" name="user_last_name">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input value=<?php echo "'$user_password'"; ?> id="password" class="form-control" type="password" name="user_password">
                                </div>

                                <div class="form-group">
                                    <label for="user_email">Email:</label>
                                    <input value=<?php echo "'$user_email'"; ?> id="user_email" class="form-control" type="email" name="user_email">
                                </div>  

                                <div class="form-group">
                                    <label for="user_role">User role:</label>
                                    <select  id="user_role" class="form-control" name="user_role">
                                        <option value="admin">Administrator</option>
                                        <option value="normal_user">User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Select avatar</label>
                                    <select id="avatar" class="form-control" name="avatar">
                                        <option value="default_avatar.png">Default</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Save!" name="update_user">
                                </div>

                            </form>
                            
                        </div>
                </div>
            </div>
</div>

<!-- Mandar los datos a la BD -->

<?php

if(isset($_POST['update_user'])){


    //Recogemos datos del forumulario:
    
    $user_nickname = $_POST['user_nickname'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_avatar = $_POST['avatar'];
    $user_role = $_POST['user_role'];


    //llamar al procedimiento para agregar usuario:
    $query = "CALL updateUser(
        '{$user_id}',
        '{$user_nickname}', 
        '{$user_first_name}', 
        '{$user_last_name}', 
        '{$user_password}', 
        '{$user_email}',
        '{$user_role}',
        '{$user_avatar}')";


    //Realizar y comprbar el QUERY:

    if(!mysqli_query($connection, $query)){
        echo "<h1>ERROR IN QUERY</h1>";
    }


}

?>


<?php include "includes/admin_footer.php" ?>