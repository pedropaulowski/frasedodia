<?php
require "classes/frases.class.php";
$f = new Frases();
$id = addslashes($_GET['id']);

if(isset($_GET['id'])) $f->pegarFraseJson($id);
?>
