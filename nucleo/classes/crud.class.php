<?php
    error_reporting(-1);

	require_once"db.class.php";
	
	class Crud extends ConectDB{
		 
         public function __construct(){
			parent::__construct();        
		}

		public function getList()
		{
			$sql=$this->base->query("SElECT * FROM productos WHERE activa ='1'"); 
            if($sql->rowCount() > 0){
                return json_encode($sql->fetchAll(PDO::FETCH_ASSOC),true);    
            }else{
                http_response_code(400);
                
            }
			
		}
		public function checkLogin($user,$pass)
		{
			$sql=$this->base->query("SElECT * FROM logincliente WHERE email ='$user' AND contrasenia = '" . md5($pass) ."'");
			if($sql->rowCount() == 1){
			     http_response_code(200);
                 return $sql;
			}
            
		}
		
	}
	
?>