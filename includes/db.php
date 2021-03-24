<?php

//=============================
//  CONEXIÓN A LA BASE DE DATOS
//=============================

//Declaración de datos para la conexión, se crea un array para mayor seguridad.
//Se pretende cambiar los datos a constantes en tiempo de ejecución. 

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_password'] = '';
$db['db_name'] = 'cms';

//Se itera con un foreach para obtener los datos de conexión.
//La función define($nombre, $valor) crea contantes, $nombre es el nombre de la constante y $valor el valor asignado.
//Se cambia a mayúsculas con strtoupper() para hacer coincidir $key con los parámetros esperados en la conexión.
foreach($db as $key => $value){

    define(strtoupper($key), $value);
    //La salida de esta función genera lo siguiente:
    //DB_HOST = localhost;

}

//Salidas de constantes => DB_HOST, DB_USER, DB_PASSWORD, DB_NAME;
//Las constantes se definen en tiempo de ejecución.
//El warning es debido a que el IDE o editor no encontrará las constantes.
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Se comprueba la conexión, en caso de éxito conecta, de no ser así arroja error, die() para ahorro de recursos.
if(!$connection){
    echo "No se pudo conectar a la base de datos.";
    die($connection);
}

?>
