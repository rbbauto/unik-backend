<?php
error_reporting(-1);
ini_set('upload_max_filesize', '4M');

if(preg_match("%\.(gif|jpe?g|png|jpg)$%i", $_FILES['fiche2']['name'])){

	if(move_uploaded_file($_FILES['fiche2']['tmp_name'], "assets/img/" . $_FILES['fiche2']['name'])){

		//require __DIR__ . '/library.php';

		//$crud = new Crud();

       // $crud->Image($_FILES['fiche']['name'], $description);

        header('Content-Type: application/json');
		echo json_encode(['errors' => [""], 'status' => 'ok', 'file' => $_FILES['fiche2']['name']]);

	}else{
		header('Content-Type: application/json');
		echo json_encode(['errors' => ["Hubo un error al subir el archivo!"], 'status' => 'fail']);
	}
}else{
	header('Content-Type: application/json');
	echo json_encode(['errors' => ["El formato de archivo no corresponde a una imagen!"], 'status' => 'fail']);
}
?>