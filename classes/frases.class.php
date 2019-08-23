<?php
class Frases {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:dbname=frasedodia", "root", "");
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

    public function getFraseById($id) {
        $sql = "SELECT * FROM frases WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            
            return $sql['frase'];
        } else {
            return false;
        }
    }

    public function pegarJsonFrases() {
        $sql = "SELECT * FROM frases";
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0) {  
            echo "<pre>";
            echo "{<br/>";
            $sql = $sql->fetchAll();
            foreach ($sql as $lista) {
                $id = $lista['id'];
                $frase = $lista['frase'];

                echo utf8_encode('  "'.$id.'"'.":".' "'.$frase.'"'.","."<br/>");
            }
            echo "}";
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