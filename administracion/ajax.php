<?php 
	 header("Access-Control-Allow-Origin: *");
	try {

		switch ($_SERVER['QUERY_STRING']) {
			case 'list':
				require_once"core/controller/list.controller.php";
			break;
			
			case 'listCat':
				require_once"core/controller/getCat.controller.php";
			break;
			
			case 'update':
				require_once"core/controller/update.controller.php";
			break;

			case 'create':
				require_once"core/controller/create.controller.php";
			break;
			
			case 'delete':
				require_once"core/controller/delete.controller.php";
			break;

			case 'imagen':
				require_once"core/controller/imagen.controller.php";
			break;

			case 'imagen2':
				require_once"core/controller/imagen2.controller.php";
			break;

			case 'addCat':
				require_once"core/controller/createCat.controller.php";
			break;

			default:
				exit;
			break;
		}
		
	} catch (Exception $e) {
		exit;
	}


		
 ?>