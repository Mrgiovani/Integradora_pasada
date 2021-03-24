<!-- verificar el post -->
<?php

    if(isset($_POST['create_user'])){

        //Ingresar datos:
        $user_nickname = $_POST['user_nickname'];
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_password = $_POST['user_password'];
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_email = $_POST['user_email'];
        $user_avatar = $_POST['avatar'];
        $user_role = $_POST['user_role'];


        //llamar al procedimiento para agregar usuario:
        $query = "CALL addUser(
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
            $user_created = "<div class='bg-success text-center'>User created! <a href='users.php'>See users</a></div>";
            echo $user_created;
        }

    }


?>

<!-- Formulario para agregar usuario -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nickname">User nickname:</label>
        <input id="nickname" class="form-control" type="text" name="user_nickname">
    </div>

    
    <div class="form-group">
        <label for="first_name">First name:</label>
        <input id="first_name" class="form-control" type="text" name="user_first_name">
    </div>
    
    <div class="form-group">
        <label for="last_name">Last name:</label>
        <input id="last_name" class="form-control" type="text" name="user_last_name">
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" class="form-control" type="password" name="user_password">
    </div>
    
    <div class="form-group">
        <label for="user_email">Email:</label>
        <input id="user_email" class="form-control" type="email" name="user_email">
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
        <input class="btn btn-primary" type="submit" value="Add user!" name="create_user">
    </div>


</form>