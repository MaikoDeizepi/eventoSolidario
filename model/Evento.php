<?php

require_once "Conexao.php";

class Evento {
    private $nome_organizador;
    private $telefone_organizador;
    private $email;
    private $tipo_evento;
    private $data_evento;
    private $local_evento;
    private $limite_evento;

    public function setNome_organizador($nome_organizador) {
        $this->nome_organizador = $nome_organizador;
    }

    public function setTelefone_organizador($telefone_organizador) {
        $this->telefone_organizador = $telefone_organizador;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function settipo_evento($tipo_evento) {
        $this->tipo_evento = $tipo_evento;
    }

    public function setdata_evento($data_evento) {
        $this->data_evento = $data_evento;
    }

    public function setlocal_evento($local_evento) {
        $this->local_evento = $local_evento;
    }

    public function setLimite_evento($limite_evento) {
        $this->limite_evento = $limite_evento;
    }

    public function cadastraEvento() {
        try {
            $conn = Conexao::conectar();
            $sql = $conn->prepare("INSERT INTO evento (nome_organizador, telefone_organizador, email, tipo_evento, data_evento, local_evento, limite_evento) VALUES (:nome_organizador, :telefone_organizador, :email, :tipo_evento, :data_evento, :local_evento, :limite_evento)");
            $sql->bindParam(":nome_organizador", $this->nome_organizador);
            $sql->bindParam(":telefone_organizador", $this->telefone_organizador);
            $sql->bindParam(":email", $this->email);
            $sql->bindParam(":tipo_evento", $this->tipo_evento);
            $sql->bindParam(":data_evento", $this->data_evento);
            $sql->bindParam(":local_evento", $this->local_evento);
            $sql->bindParam(":limite_evento", $this->limite_evento);
            $sql->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao cadastrar o evento: " . $e->getMessage());
        }
    }
}

?>
