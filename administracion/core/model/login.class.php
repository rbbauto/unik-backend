<?php

    require_once("core/model/connect_db.class.php");
    
    class Login extends ConectDB{
        
        public function __construct(){
            
            parent::__construct();
            
            
        }
        
        public function CheckLogin($user, $pass){
            
            $sql=$this->base->query("SELECT * FROM login WHERE username = '$user' AND password = '$pass'");
            
            if($sql->rowCount() >= 1){
                
                while($row=$sql->fetchObject()){
                    
                    $_SESSION["conectado"]  =   true;
                    
                    $_SESSION["nombre"]     =   $row->username;
                    
                }
                
            }else{
                echo "error de login";
            }
            
            
            
            
        }
    }
?>