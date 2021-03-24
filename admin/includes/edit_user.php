<!-- verificar el post -->
<?php


    if(isset($_GET['u_id'])){

        $userID = $_GET['u_id'];

    }

    //Cargar datos del usuario:

    $query_user_data = "SELECT*FROM users WHERE user_id = $userID";
    $user_data_result = mysqli_fetch_assoc(mysqli_query($connection, $query_user_data));

    //Cargar los datos del usuario en variables:
    $userID = $_GET['u_id'];
    $user_nickname = $user_data_result['user_nickname'];
    $user_first_name = $user_data_result['user_first_name'];
    $user_last_name = $user_data_result['user_last_name'];
    $user_password = $user_data_result['user_password'];
    $user_email = $user_data_result['user_email'];
    

    if(isset($_POST['update_user'])){
        $user_id = $_GET['u_id'];
        //Recogemos datos del forumulario:
        
        $user_nickname = $_POST['user_nickname'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_avatar = $_POST['avatar'];
        $user_role = $_POST['user_role'];

        //Encripto password:

        $user_password = password_hash($user_password, PASSWORD_DEFAULT);


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

        //Ejecutar el QUERY.
        if(!mysqli_query($connection, $query)){
            echo "<h1>Error al ejectutar Query</h1>";
        }else{
            $sucess = "<div class='bg-success text-center'>Changes made successfully. Go to <a href='users.php'>users</a></div>";
            echo $sucess;
        }
        
    }
    


?>

<!-- Formulario para agregar usuario -->
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
        <input class="btn btn-primary" type="submit" value="Update user!" name="update_user">
    </div>


</form>