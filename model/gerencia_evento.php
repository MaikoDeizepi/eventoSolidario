<?php

require_once"Conexao.php";

class Gerencia_evento{

    private $idempresa;

    private $idevento;


    public function cadastraGerenciaEvento() {
        // Validação de dados (exemplo)
        if (empty($this->idempresa) || empty($this->idevento)) {
            throw new InvalidArgumentException("Os campos idEmpresa e idEvento são obrigatórios.");
        }

        try {
            $conn = Conexao::conectar();
            $sql = $conn->prepare("INSERT INTO eventoempresa (idEmpresa, idEvento) VALUES (:idempresa, :idevento)");
            $sql->bindParam(":idempresa", $this->idempresa);
            $sql->bindParam(":idevento", $this->idevento);
            $sql->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao cadastrar o relacionamento entre empresa (ID: $this->idempresa) e evento (ID: $this->idevento): " . $e->getMessage());
        }
    }


	/**
	 * @return mixed
	 */
	public function getIdempresa() {
		return $this->idempresa;
	}
	
	/**
	 * @param mixed $idempresa 
	 * @return self
	 */
	public function setIdempresa($idempresa): self {
		$this->idempresa = $idempresa;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdevento() {
		return $this->idevento;
	}
	
	/**
	 * @param mixed $idevento 
	 * @return self
	 */
	public function setIdevento($idevento): self {
		$this->idevento = $idevento;
		return $this;
	}
}


  


?>