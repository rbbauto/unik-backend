<?php 
require_once"../classes/crud.class.php";
$crud=new Crud();

header("Access-Control-Allow-Origin: *");
echo $crud->list();
?>