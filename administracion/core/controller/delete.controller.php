<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['producto'])) {

    require 'core/model/library.class.php';

    $product_id = (isset($data['producto']['id']) ? $data['producto']['id'] : NULL);

    if ($product_id==NULL) {
    	http_response_code(400);
        echo json_encode(['errors' => ["No se pudo eliminar el producto"]]);
    }else{

	    // Delete
	    $crud = new Crud();

	    $crud->Delete($product_id);
	}
}

?>