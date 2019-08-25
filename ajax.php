<?php
require "classes/frases.class.php";

$f = new Frases();

if(isset($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $f->pegarFraseJson($id);
} 
?>
