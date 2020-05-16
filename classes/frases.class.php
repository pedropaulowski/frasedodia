<?php
class Frases {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:dbname=frasedodia;host=localhost", "root", "");
    }

    public function setFrase($frase) {
        if($this->existeFrase($frase) == false) {
            
            $sql = "INSERT INTO frases SET frase = :frase";  
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":frase", $frase);
            $sql->execute();

        } else {
            return false;
        }
    }

    public function pegarFraseJson($id) {
        $sql = "SELECT * FROM frases WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {  
            $sql = $sql->fetch();
            $id = intval($sql['id']);
            $frase = utf8_encode($sql['frase']);

            $array = array('id' => $id, 'frase' => $frase);

            echo json_encode($array);
        } else {
            return false;
        }
    } 

    public function quantidadeFrases() {
        $sql = "SELECT * FROM frase";
        $sql = $this->pdo->query($sql);
        
        if($sql->rowCount() > 0) {
            return $sql->rowCount();
        } else {
            return false;
        }
        
    }

    private function existeFrase($frase) {
        $sql = "SELECT * FROM frases WHERE frase = :frase";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":frase", $frase);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


}

?>