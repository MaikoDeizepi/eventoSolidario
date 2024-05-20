<?php

require_once "model/Conexao.php";

class Empresas {
    private $razao_social;
    private $nome_fantasia;
    private $cnpj;
    private $telefone;
    private $endereco;
    private $email;

    public function cadastraEmpresa() {
        try {
            $conn = Conexao::conectar();
            $sql = $conn->prepare("INSERT INTO eventosolidario.empresas 
                                   (razao_social, nome_fantasia, cnpj, telefone, endereco, email)
                                   VALUES (:razaosocial, :nomefantasia, :cnpj, :telefone, :endereco, :email)");
            $sql->bindParam(":razaosocial", $this->razao_social);
            $sql->bindParam(":nomefantasia", $this->nome_fantasia);
            $sql->bindParam(":cnpj", $this->cnpj);
            $sql->bindParam(":endereco", $this->endereco);
            $sql->bindParam(":telefone", $this->telefone);
            $sql->bindParam(":email", $this->email);
            $sql->execute();

        } catch (PDOException $e) {
            error_log("Erro no banco de dados: " . $e->getMessage());
            echo "Erro ao conectar ao banco de dados. Tente novamente mais tarde.";
        } catch (InvalidArgumentException $e) {
            error_log("Erro de validação: " . $e->getMessage());
            echo "Erro nos dados fornecidos. Verifique os campos e tente novamente.";
        } catch (Exception $e) {
            error_log("Erro geral: " . $e->getMessage());
            echo "Ocorreu um erro inesperado. Tente novamente mais tarde.";
        }
    }

    // Getters e setters

    public function getRazaoSocial() {
        return $this->razao_social;
    }

    public function setRazaoSocial($razao_social): self {
        $this->razao_social = $razao_social;
        return $this;
    }

    public function getNomeFantasia() {
        return $this->nome_fantasia;
    }

    public function setNomeFantasia($nome_fantasia): self {
        $this->nome_fantasia = $nome_fantasia;
        return $this;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj): self {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone): self {
        $this->telefone = $telefone;
        return $this;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco): self {
        $this->endereco = $endereco;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }
}
?>
