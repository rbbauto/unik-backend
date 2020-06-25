<?php
header("Access-Control-Allow-Origin: *");
 
require_once"../classes/crud.class.php";
$crud=new Crud();

echo $crud->getList();

?>