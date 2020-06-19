
<?php
 
define('HOST', 'localhost'); // Host de la base de datos
define('USER', 'rbbautor'); // Usuario
define('PASSWORD', 'ABRIL28042015'); // Contraseña
define('DATABASE', 'tienda'); // Nombre de Base de Datos
 
 
function DB()
{
    static $instance;
    if ($instance === null) {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE;
        $instance = new PDO($dsn, USER, PASSWORD, $opt);
    }
    return $instance;
}
 
 
 
?>