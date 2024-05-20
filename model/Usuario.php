<?php

require_once "model/Conexao.php";

class Usuario{

    private $nomeUsuario;
    private $email;
    private $dtaNasc;
    private $sexo;
    private $numTel;
    
    private $senha;
    private $idUsuario;

    public function cadastraUsuario(){
        try{
            $conn = Conexao::conectar();
            $sql = $conn->prepare("INSERT INTO eventosolidario.tabelausuario 
                                   (nomeUsuario, email, dtaNasc, numTel , senha, sexo)
                                   VALUES (:nome, :emailUsuario, :nascUsuario, :numTelUsuario,  :senha, :sexoUsuario)");
            $sql->bindParam(":nome", $this->nomeUsuario);
            $sql->bindParam(":emailUsuario", $this->email);
            $sql->bindParam(":nascUsuario", $this->dtaNasc);
            $sql->bindParam(":numTelUsuario", $this->numTel);
            $sql->bindParam(":senha", $this->senha);
            $sql->bindParam(":sexoUsuario", $this->sexo);
            $sql->execute();

        } catch (PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
        }
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nomeUsuario): self {
        $this->nomeUsuario = $nomeUsuario;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    public function getDtaNasc() {
        return $this->dtaNasc;
    }

    public function setDtaNasc($dtaNasc): self {
        $this->dtaNasc = $dtaNasc;
        return $this;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo): self {
        $this->sexo = $sexo;
        return $this;
    }


    public function getNumTel() {
        return $this->numTel;
    }

    public function setNumTel($numTel): self {
        $this->numTel = $numTel;
        return $this;
    }


    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha): self {
        $this->senha = $senha;
        return $this;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): self {
        $this->idUsuario = $idUsuario;
        return $this;
    }
}

?>
