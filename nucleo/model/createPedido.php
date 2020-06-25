<?php 
error_reporting(-1);
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE,OPTIONS');
	print_r(file_get_contents('php://input'));
 ?>