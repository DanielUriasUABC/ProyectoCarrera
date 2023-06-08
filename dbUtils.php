
<?php
//MODELO PDO (PHP Database Object)
/*
    ----GUIA BASICA----
        Existiran funciones que retornen querys multiregistros como getAlumnos, lo que se devuelve puede ser usado de la siguiente manera:

        $alumnos = getAlumnos($db);
        echo $alumnos[0]['nombre'];
                        ^      ^
                        |      |
            #elemento  #Atributo a accesar

        Se puede iterar con un for each:
            foreach ($alumnos as $registro) {
                echo $registro['nombre']."<br />\n";
            }

    https://phpdelusions.net/pdo_examples/
*/


/**
 * Realiza la conexion con la base de datos
 *
 * 
 * @author  Urias Vega Juan Daniel
 * @return $db Objeto para acceder a la BDD
 */ 
function db_open(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $db = "emociones";

    $db = new mysqli($dbhost, $dbuser, $dbpass, $db);

    if ($db->connect_errno) {
        echo "Error al conectarse a la base de datos.";
        exit();
    }

    return $db;


}





















/**
 * Cierra la conexion con la base de datos
 * @param PDO   $db  Base de datos "emociones"
 * @author  Urias Vega Juan Daniel
 */ 
function db_close($db){
    $db = null;
}














?>
