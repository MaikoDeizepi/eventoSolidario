<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "model/Conexao.php";
require_once "model/Evento.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegue os dados do formulário
    $nome_organizador = $_POST['nome_organizador'];
    $telefone_organizador = $_POST['telefone_organizador'];
    $email = $_POST['email'];
    $tipo_evento = $_POST['tipo_evento'];
    $data_evento = $_POST['data_evento'];
    $local_evento = $_POST['local_evento'];
    $limite_evento = $_POST['limite_evento'];

    // Crie uma nova instância da classe Evento
    $gerencia_evento = new Evento();
    $gerencia_evento->setNome_organizador($nome_organizador);
    $gerencia_evento->setTelefone_organizador($telefone_organizador);
    $gerencia_evento->setEmail($email);
    $gerencia_evento->settipo_evento($tipo_evento);
    $gerencia_evento->setdata_evento($data_evento);
    $gerencia_evento->setlocal_evento($local_evento);
    $gerencia_evento->setLimite_evento($limite_evento);

    // Tente cadastrar o evento
    try {
        $gerencia_evento->cadastraEvento();
        // Redirecione para o índice após o cadastro bem-sucedido
        header("Location: CADEVENTO");
        exit();
    } catch (Exception $e) {
        echo "Erro ao cadastrar o evento: " . $e->getMessage();
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
    <title>Criar Cadastros</title>
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
                    <label for="razaosocial">Nome Organizador:</label>
                    <input type="text" class="form-control" id="nome_organizador" name="nome_organizador" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone do Organizador:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+55</span>
                        </div>
                        <input type="tel" class="form-control" id="telefone_organizador" name="telefone_organizador"
                            placeholder="Digite o número de Contato do Organizador" required>
                    </div>
                </div>
                <div class="card-header">
                    <div class="form-group">
                        <label for="email">Endereço de E-mail:</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Digite seu endereço de e-mail" required>
                    </div>
                    <!-- alterar para tipo de evento -->
                    <label for="selectPais">Tipo do Evento:</label>
                    <select class="form-control" id="tipo_evento" name="tipo_evento">
                        <option value="DoacaodeComida">Doação de Comida </option>
                        <option value="DoacaodeRoupas">Doação de Roupas </option>
                        <option value="EventoPET">Doação de Pets</option>
                        <option value="assistencialismo">Evento Assistencial</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <!-- alterar para data de evento -->
                <div class="form-group">
                    <label for="data_evento">Data do Evento:</label>
                    <input type="date" class="form-control" id="data_evento" name="data_evento">
                </div>
                <div class="form-group">
                    <label for="endereco">Local do Evento</label>
                    <input type="text" class="form-control" id="local_evento" name="local_evento"
                        placeholder="Digite o endereço completo do evento" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Limite do Evento</label>
                    <input type="text" class="form-control" id="limite_evento" name="limite_evento"
                        placeholder="Digite o numero máximo de participantes" required>
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