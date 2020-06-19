<?php
require 'core/model/library.class.php';
 
$productos = new Crud();
 
echo $productos->ReadCat();
 
?>