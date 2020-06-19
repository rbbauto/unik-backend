<?php 
    error_reporting(-1);
    session_start();
    if (isset($_POST['nombre']) && isset($_POST['contrasenia'])) {
        
        require_once"core/model/login.class.php";
        $login=new login();
        $check=$login->checkLogin($_POST['nombre'],md5($_POST['contrasenia']));
    }
    if(isset($_SESSION["conectado"]) == 0){
       header('Location: ../pedido.php');
    }else{
    	header('Location: ../pedido.php');
    }
    
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="se-pre-con"></div>
</body>
</html>
