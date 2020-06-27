<?php 
error_reporting(-1);
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
	
    $data=json_decode(file_get_contents('php://input'),true);
    
    require_once"../classes/crud.class.php";
    $crud=new Crud();
    
    $productos=$data['Productos'];
    $pedido=$data['Pedido'];
    $envio=$data['Envio'];
    
    if($crud->addTocart($productos)){
        echo json_encode(array("status" => "success","error" => null),true);
    }else{
        echo json_encode(array("status" => "fail","error" => "error en insert"),true);
    }
    
    
?>