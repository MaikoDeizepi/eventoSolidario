<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "model/Conexao.php";
require_once "model/Empresas.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegue os dados do formulário
    $razaosocial = $_POST['razaosocial'];
    $nomefantasia = $_POST['nomefantasia'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Crie uma nova instância da classe Usuario
    $gerencia_evento = new Empresas();
    $gerencia_evento->setRazaoSocial($razaosocial);
    $gerencia_evento->setNomeFantasia($nomefantasia);
    $gerencia_evento->setCnpj($cnpj);
    $gerencia_evento->setTelefone($telefone);
    $gerencia_evento->setEmail($email);
    $gerencia_evento->setEndereco($endereco);

    // Tente cadastrar a empresa
    try {
        $gerencia_evento->cadastraEmpresa();
        // Redirecione para o índice após o cadastro bem-sucedido
        header("Location: cadastro");
        exit();

    } catch (Exception $e) {
        echo "Erro ao cadastrar a empresa: " . $e->getMessage();
    }
}

// Verifique se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    // Se não estiver logado, redirecione para a página de login
    header('Location: /eventosolidario/view/index.php');
    exit();
}

// Aqui você pode acessar os dados da sessão
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Cadastro</title>
    <?php include ("view/static/css.php"); ?>
</head>

<body>
    <!-- Navbar -->
    <?php include ("view/static/navbar.php"); ?>

    <div class="container">
        <div class="card-header text-white"
            style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Criar conta</div>
        <br>
        <div class="card-header text-white"
            style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Dados Empresa</div>
        <div class="card-header">
            <!--Cadastro Sucesso-->
            <form method="post" action="">
                <!-- NOME COMPLETO -->
                <div class="form-group">
                    <label for="razaosocial">Razão Social:</label>
                    <input type="text" class="form-control" id="razaosocial" name="razaosocial" required>
                </div>
                <div class="form-group">
                    <label for="nomefantasia">Nome Fantasia:</label>
                    <input type="text" class="form-control" id="nomefantasia" name="nomefantasia" required>
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="tel" class="form-control" id="cnpj" name="cnpj"
                        placeholder="Digite o número do seu CNPJ" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone de Contato:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+55</span>
                        </div>
                        <input type="tel" class="form-control" id="telefone" name="telefone"
                            placeholder="Digite o número de Contato" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço da Empresa Completo</label>
                    <input type="text" class="form-control" id="endereco" name="endereco"
                        placeholder="Digite o endereço completo com CEP" required>
                </div>
                <!-- Dados de login -->
                <div class="card-header">
                    <div class="form-group">
                        <label for="email">Endereço de E-mail:</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Digite seu endereço de e-mail" required>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-success active btn-custom"
                            style="background: linear-gradient(to right, #8c52ff, #5ce1e6);">Criar Cadastro</button>
                    </div>
                </div>
                <div class="card-footer" style="border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;">
                </div>
              
                

            </form>
        </div>
    </div>

    <!-- Inclua o script do Bootstrap (incluindo o Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</body>

</html>