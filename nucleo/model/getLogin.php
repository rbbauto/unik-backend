<?php 
error_reporting(-1);
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
	
	
	require_once"../classes/crud.class.php";
	$crud=new Crud();
	
	$data=json_decode(file_get_contents('php://input'),true);
	
	$query=$crud->checkLogin($data['user'],$data['pass']);
    
    if($query){
        if($query->rowCount() > 0){
            http_response_code(200);
            $res=$query->fetchAll(PDO::FETCH_ASSOC);
            $res[0]['contrasenia']="";
            $res[0]['esDireccionParaFacturacion'] === 'true'? $res[0]['esDireccionParaFacturacion']=true : false;
            echo json_encode($res[0]); 
        }else if($query->rowCount() == 0){
            http_response_code(400);
            
        }
	
    }
 ?>