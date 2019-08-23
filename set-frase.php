<?php
session_start();

if(!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}

require "classes/frases.class.php";

$f = new Frases();

if(isset($_POST['frase']) && !empty($_POST['frase'])) {
    $frase = $_POST['frase'];

    $f->setFrase($frase);
}
?>
<center>
    <form method="POST">
        Frase:<br/>
        <input type="text" name="frase" required/><br/><br/> 
        <input type="submit" value="Enviar"/>
    </form>
</center>