<?php
class Usuarios {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:dbname=frasedodia", "root", "");
    }

    public function logIn($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>