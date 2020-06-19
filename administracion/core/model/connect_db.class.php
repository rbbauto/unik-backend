<?php


    require_once("core/model/config.php");
    
    class ConectDB{
        
        protected $base;
        
        public function __construct(){
            
            try{
                
                $this->base=new PDO("mysql:dbname=" . DB_NAME . ";host:" . DB_HOST, DB_USER, DB_PASS);
                
                $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            }
            catch (PDOException $e) {
                
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
                    
            }   
            
            
            return $this->base;
        }
        
    }


?>