<?php 
error_reporting(-1);
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
	
    $data=json_decode(file_get_contents('php://input'),true);
    
    require_once"../classes/crud.class.php";
    $crud=new Crud();
    
    
    
    try{
        $query=$crud->setPedido($data['email'],$data['contrasenia'],$data['nombre'],$data['apellido'],$data['telefono'],$data['direccion'],
                            $data['numero'],$data['ciudad'],$data['provincia'],$data['pais'],$data['empresa'],$data['cuitCuilDni'],
                            $data['codigoPostal'],$data['esDireccionParaFacturacion']);
    
    }catch(PDOException $e ){
        echo json_encode(array("status" => "success","error" => $e->getMessage ()));
    }
    if($query){
        echo json_encode(array("status" => "success","error" => null),true);
    }
 ?>
