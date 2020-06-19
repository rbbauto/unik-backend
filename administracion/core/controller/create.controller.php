<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['producto'])) {

    require 'core/model/library.class.php';

    $name = (isset($data['producto']['nombre']) ? $data['producto']['nombre'] : NULL);
    $description = (isset($data['producto']['descripcion']) ? $data['producto']['descripcion'] : NULL);
    $imagen = (isset($data['producto']['imagen']) ? $data['producto']['imagen'] : NULL);
    $color = (isset($data['producto']['color']) ? $data['producto']['color'] : NULL);
    $categoria = (isset($data['producto']['categoria']) ? $data['producto']['categoria'] : NULL);
    $stock = (isset($data['producto']['stock']) ? $data['producto']['stock'] : NULL);
    $activa = (isset($data['producto']['activa']) ? $data['producto']['activa'] : NULL);
    $precio = (isset($data['producto']['precio']) ? $data['producto']['precio'] : NULL);

    // validación
    if ($name == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["El campo de nombre es obligatorio"]]);

    } else {

        // Add new product
        $crud = new Crud();

        echo $crud->Create($name, $description,$imagen,$color,$categoria,$stock,$activa,$precio);
    }
}


?>