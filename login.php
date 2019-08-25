<?php
session_start();

if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
    header("Location:set-frase.php");
}

require "classes/usuarios.class.php";

$u = new Usuarios();

if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes(md5($_POST['senha']));

    if($u->logIn($email, $senha) == true) {
        $_SESSION['login'] = md5($email.$senha);
        header("Location:set-frase.php");
    } else {
        return false;
    }
}

?>
<form method="POST">
    
    E-mail:<br/>
    <input type="text" name="email" required/><br/><br/> 
    Senha:<br/>
    <input type="password" name="senha" required/><br/><br/> 

    <input type="submit" value="Login"/>
</form>