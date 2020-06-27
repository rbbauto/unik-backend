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
        
        public function setPedido($email,$contrasenia,$nombre,$apellido,$telefono,$direccion,$numero,$ciudad,$provincia,
                                                     $pais,$empresa,$cuitCuilDni,$codigoPostal,$esDireccionParaFacturacion)
        {   
            $pass= $contrasenia != "" ? ",  contrasenia = '" . md5($contrasenia) ."'" : "";
            $host= gethostname();
            if($this->checkDuplicate($host)){
                $sql2=$this->base->query("UPDATE logincliente SET
                                                       email = '$email' $pass,
                                                        nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', 
                                                        direccion = '$direccion', numero = '$numero', 
                                                        ciudad = '$ciudad', provincia = '$provincia',
                                                         pais = '$pais', empresa = '$empresa', 
                                                         cuitCuilDni = '$cuitCuilDni', codigoPostal = '$codigoPostal', 
                                                         esDireccionParaFacturacion = 'true', hostname = '$host' 
                                                         WHERE logincliente.hostname = '$host'");
                return true;
            }else{
                $sql=$this->base->query("INSERT INTO logincliente (id,email,contrasenia,nombre,apellido,telefono,direccion,numero,ciudad,provincia,
                                                                 pais,empresa,cuitCuilDni,codigoPostal,esDireccionParaFacturacion,hostname)
                                    VALUES (NULL, '$email', '$contrasenia', '$nombre', '$apellido', '$telefono', '$direccion', '$numero',
                                   '$ciudad', '$provincia', '$pais', '$empresa', '$cuitCuilDni', '$codigoPostal', '$esDireccionParaFacturacion', '$host')");
                
            }
            
           
        }
        
        function addTocart($productos){
            $last=(count($productos)-1);
            $host=gethostname();
            $insert="";
            foreach($productos as $key => $item)
            {   
                $coma=$key != $last ? "," : "";
                $insert.="(null,$item[id],'$item[nombre]','$host','$item[precio]',$item[cantidad],$item[subtotal])$coma";
                
                
            }
            $this->base->query("DELETE FROM carrito WHERE hostname = '$host' ");
            $sql=$this->base->query("INSERT INTO carrito
                                         (id, id_producto, nombre, hostname, precio, cantidad, subtotal)
                                          VALUES $insert");
            if($sql){
                    return true;
                }
        }
        
        function checkDuplicate($host){
            $sql=$this->base->query("SElECT * FROM logincliente WHERE hostname ='$host'");
			if($sql->rowCount() == 1){
			     return true;
			}
            
        }
		
	}
	
?>