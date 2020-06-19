<?php
error_reporting(-1);
ini_set('upload_max_filesize', '4M'); 

if(preg_match("%\.(gif|jpe?g|png|jpg)$%i", $_FILES['fiche']['name'])){

	if(move_uploaded_file($_FILES['fiche']['tmp_name'], "assets/img/" . $_FILES['fiche']['name'])){

		header('Content-Type: application/json');
		echo json_encode(['errors' => [""], 'status' => 'ok', 'file' => $_FILES['fiche']['name']]);

	}else{
		header('Content-Type: application/json');
		echo json_encode(['errors' => ["Hubo un error al subir el archivo!"], 'status' => 'fail', 'file' => $_FILES['fiche']['name']]);
	}
}else{
	header('Content-Type: application/json');
	echo json_encode(['errors' => ["El formato de archivo no corresponde a una imagen!"], 'status' => 'fail']);
}
?>