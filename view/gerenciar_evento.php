<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "model/Conexao.php";
require_once "model/gerencia_evento.php";

$conn = Conexao::conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegue os dados do formulário
    $idempresa = $_POST['id_empresa'];
    $idevento = $_POST['id_evento'];
  

    // Crie uma nova instância da classe Evento
    $gerencia_evento = new Gerencia_evento();
    $gerencia_evento->setidempresa($idempresa);
    $gerencia_evento->setIdevento($idevento);

    // Tente cadastrar o evento
    try {
        // Validação de dados (exemplo básico)
        if (!is_numeric($idempresa) || !is_numeric($idevento)) {
            throw new InvalidArgumentException("Os IDs da empresa e do evento devem ser numéricos.");
        }

        $gerencia_evento->cadastraGerenciaEvento();
        // Redirecionar para página de sucesso ou exibir mensagem
        header("Location: CADEVENTO"); // Corrigido
        exit();
    } catch (PDOException $e) {
        error_log("Erro no banco de dados: " . $e->getMessage());
        echo "Ocorreu um erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.";
    } catch (InvalidArgumentException $e) {
        error_log("Erro de validação: " . $e->getMessage());
        echo $e->getMessage(); // Exibe a mensagem de erro específica
    } 
}

// Verifique se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    // Se não estiver logado, redirecione para a página de login
    header('Location: inicio');
    exit();
}

// Aqui você pode acessar os dados da sessão
$email = $_SESSION['email'];
$senha = $_SESSION['senha'];


try {
    $sql = $conn->query("SELECT * FROM eventosolidario.evento");
    $eventos = $sql->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erro ao buscar eventos: " . $e->getMessage());
    echo "Erro ao buscar eventos. Tente novamente mais tarde.";
}try {
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
    <title>Evento Solidario</title>
    <?php include ("view/static/css.php"); ?>
</head>

<body>
    <!-- Navbar -->
    <?php include ("view/static/navbar.php"); ?>

    <div class="container-fluid">
        <h5 class="my-4">Lista de Eventos</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Organizador</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Tipo de Evento</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th>Limite</th>
                    <th>Selecionar</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= htmlspecialchars($evento['nome_organizador']) ?></td>
                        <td><?= htmlspecialchars($evento['telefone_organizador']) ?></td>
                        <td><?= htmlspecialchars($evento['email']) ?></td>
                        <td><?= htmlspecialchars($evento['tipo_Evento']) ?></td>
                        <td><?= htmlspecialchars($evento['data_evento']) ?></td>
                        <td><?= htmlspecialchars($evento['local_evento']) ?></td>
                        <td><?= htmlspecialchars($evento['limite_evento']) ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm selecionar-evento" 
                                    data-evento-id="<?= $evento['idEvento'] ?>">
                                Selecionar
                            </button>
                        </td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container-fluid">
        <h5 class="my-4">Lista de Empresas</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Email</th>
              
                </tr>
            </thead>
            </thead>
        <tbody>
            <?php foreach ($empresas as $empresa): ?>
                <tr>
                    <td><?= htmlspecialchars($empresa['razao_social']) ?></td>
                    <td><?= htmlspecialchars($empresa['nome_fantasia']) ?></td>
                    <td><?= htmlspecialchars($empresa['cnpj']) ?></td>
                    <td><?= htmlspecialchars($empresa['telefone']) ?></td>
                    <td><?= htmlspecialchars($empresa['endereco']) ?></td>
                    <td><?= htmlspecialchars($empresa['email']) ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm selecionar-empresa" 
                                data-empresa-id="<?= $empresa['idEmpresa'] ?>">
                            Selecionar
                        </button>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>

    <div class="container">
        
        <div class="card-header text-white" style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Dados Cadastro</div>
        <div class="card-header">
            <form method="post" action="">
                <div class="form-group">
                    <label for="id_empresa">ID Empresa:</label>
                    <input type="text" class="form-control" id="id_empresa" name="id_empresa" required readonly> 
                </div>
                <div class="form-group">
                    <label for="id_evento">ID Evento:</label>
                    <input type="text" class="form-control" id="id_evento" name="id_evento" required readonly> 
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success active btn-custom" style="background: linear-gradient(to right, #8c52ff, #5ce1e6);">Criar Cadastro</button>
                </div>
            </form>
        </div>
        <div class="card-footer" style="border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;"></div>
    </div>

    <script>
        const selecionarEventoBtns = document.querySelectorAll('.selecionar-evento');
        const selecionarEmpresaBtns = document.querySelectorAll('.selecionar-empresa');
        const idEmpresaInput = document.getElementById('id_empresa');
        const idEventoInput = document.getElementById('id_evento');

        selecionarEventoBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                idEventoInput.value = btn.dataset.eventoId;
            });
        });

        selecionarEmpresaBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                idEmpresaInput.value = btn.dataset.empresaId;
            });
        });
    </script>

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