<?php
header("Access-Control-Allow-Origin: *");
 
require_once"../classes/crud.class.php";
$crud=new Crud();

$data=json_decode(file_get_contents("php://input"),true);

echo $crud->addItemToCart($data)

?>
