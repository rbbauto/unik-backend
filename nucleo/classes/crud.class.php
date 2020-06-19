<?php
	require_once"db.class.php";
	
	class Crud extends ConectDB{
		 public function __construct(){
			parent::__construct();        
		}

		public function list()
		{
			$sql=$this->base->query("SELECT * FROM productos WHERE activa ='1'");
			return json_encode($sql->fetchAll(PDO::FETCH_ASSOC),true);
		}
		public function addItemToCart()
		{
			$sql=$this->base->query("");	
		}
	}
	
?>