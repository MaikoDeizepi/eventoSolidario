<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "model/Conexao.php";

// Verifique se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    // Se não estiver logado, redirecione para a página de login
    header('Location: inicio');
    exit();
}

$conn = Conexao::conectar();

// Busca os eventos
try {
    $sql = $conn->query("SELECT * FROM eventosolidario.evento");
    $eventos = $sql->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erro ao buscar eventos: " . $e->getMessage());
    echo "Erro ao buscar eventos. Tente novamente mais tarde.";
}

// Busca as empresas
try {
    $sql = $conn->query("SELECT * FROM eventosolidario.empresas");
    $empresas = $sql->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erro ao buscar empresas: " . $e->getMessage());
    echo "Erro ao buscar empresas. Tente novamente mais tarde.";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Eventos e Empresas</title>
    <?php include("view/static/css.php"); ?>
</head>

<body>
    <!-- Navbar -->
    <?php include("view/static/navbar.php"); ?>

    <div class="container-fluid">
        <h5 class="my-4">Eventos e Empresas</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td>Evento</td>
                        <td>
                            <strong>Organizador:</strong> <?= htmlspecialchars($evento['nome_organizador']) ?><br>
                            <strong>Telefone:</strong> <?= htmlspecialchars($evento['telefone_organizador']) ?><br>
                            <strong>Email:</strong> <?= htmlspecialchars($evento['email']) ?><br>
                            <strong>Tipo de Evento:</strong> <?= htmlspecialchars($evento['tipo_Evento']) ?><br>
                            <strong>Data:</strong> <?= htmlspecialchars($evento['data_evento']) ?><br>
                            <strong>Local:</strong> <?= htmlspecialchars($evento['local_evento']) ?><br>
                            <strong>Limite:</strong> <?= htmlspecialchars($evento['limite_evento']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php foreach ($empresas as $empresa): ?>
                    <tr>
                        <td>Empresa</td>
                        <td>
                            <strong>Razão Social:</strong> <?= htmlspecialchars($empresa['razao_social']) ?><br>
                            <strong>Nome Fantasia:</strong> <?= htmlspecialchars($empresa['nome_fantasia']) ?><br>
                            <strong>CNPJ:</strong> <?= htmlspecialchars($empresa['cnpj']) ?><br>
                            <strong>Telefone:</strong> <?= htmlspecialchars($empresa['telefone']) ?><br>
                            <strong>Endereço:</strong> <?= htmlspecialchars($empresa['endereco']) ?><br>
                            <strong>Email:</strong> <?= htmlspecialchars($empresa['email']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Inclua o script do Bootstrap (incluindo o Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</body>

</html>
