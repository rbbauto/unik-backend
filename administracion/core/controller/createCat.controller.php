<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['categoria'])) {

    require 'core/model/library.class.php';

    $categoria = (isset($data['categoria']) ? $data['categoria'] : NULL);
   
    // validación
    if ($categoria == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["El campo de nombre es obligatorio"]]);

    } else {

        // Add new product
        $crud = new Crud();

        echo $crud->CreateCat($categoria);
    }
}


?>