<?php
    error_reporting(-1);
	define("DB_HOST","localhost");
	define("DB_USER","rbbautor");
	define("DB_PASS","ABRIL28042015");
	define("DB_NAME","tienda");
	define("DB_CHARSET","utf8");
    

    $dir= preg_match_all('/[\/{2}]/', $_SERVER['REQUEST_URI']) == 0 ? "" : preg_split('/[\/{2}]/', $_SERVER['REQUEST_URI'])[1];

    define("DIR_NAME",$dir);
    define("SERVER_URL", "http://" . $_SERVER['SERVER_NAME']);
    
    $meses  =   array(  1 => "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril" ,
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre");
	
?>