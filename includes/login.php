<!-- Dado que no tenemos header, tenemos que traer la base de datos -->
<?php include "db.php" ?>

<!-- Inicio la sesión:
        Cuando el usuario introduzca sus datos, inciar la sesión me ayuda
        a poder recolectar los datos de manera única para ese usuario.
        Estos datos se podrán obtener EN TODA la web a través de $_SESSION. -->

<?php session_start(); ?>

<?php

    //Recupero los datos una vez que presionan en login.
    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        //Limpiar carácteres especiales:

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        //Query a la base de datos:

        $query = "SELECT * FROM users WHERE user_nickname = '{$username}'";

        //Ejecutar el QUERY y guardar los resultados en row:

        $user_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($user_query)) {

            $db_user_id = $row['user_id'];
            $db_user_nickname = $row['user_nickname'];
            $db_user_password = $row['user_password'];
            $db_user_first_name = $row['user_first_name'];
            $db_user_last_name = $row['user_last_name'];
            $db_user_email = $row['user_email'];
            $db_user_role = $row['user_role'];


        }

        if($username === $db_user_nickname && password_verify($password, $db_user_password)){
            //Correcta validación de usuario y contraseña.
            //Una vez hecha la validación mando todos los datos a la sesión: 
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['user_nickname'] = $db_user_nickname;
            $_SESSION['first_name'] = $db_user_first_name;
            $_SESSION['last_name'] = $db_user_last_name;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_email'] = $db_user_email;
            header("Location: ../admin");

        }else{
            header("Location: ../index.php");
        }



        

        
    }

?>