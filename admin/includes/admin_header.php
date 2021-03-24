<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>
<?php ob_start(); ?>
<!-- Iniciamos la sesión para acceder a los datos del usuario -->
<?php session_start(); ?> 


<!-- Una vez que hemos recuperado los datos de la sesión, podemos redireccionar
al usuario al index principal en caso de que no sea admin -->

<?php

    if(!isset($_SESSION['user_role'])){
        header("Location: ../index.php");
    }else{
        if($_SESSION['user_role'] != "admin"){
            header("Location: ../index.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
    
<!-- Agregando el script para google charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>