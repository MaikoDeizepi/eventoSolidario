<?php

session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: /eventosolidario/view/index.php');
    exit();
}

require_once "model/Conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados
$conn = Conexao::conectar();

// Manipulação de exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    try {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID inválido.");
        }

        $sql = $conn->prepare("DELETE FROM eventosolidario.evento WHERE idEvento = :id");
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            header("Location: CRUDEVENTO");
            exit();
        } else {
            throw new Exception("Nenhum registro encontrado com o ID especificado.");
        }
    } catch (Exception $e) {
        error_log("Erro ao excluir evento: " . $e->getMessage());
        echo "Erro ao excluir evento. " . $e->getMessage();
    }
}

// Manipulação de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nome_organizador = $_POST['nome_organizador'];
    $telefone_organizador = $_POST['telefone_organizador'];
    $email = $_POST['email'];
    $tipo_evento = $_POST['tipo_evento'];
    $data_evento = $_POST['data_evento'];
    $local_evento = $_POST['local_evento'];
    $limite_evento = $_POST['limite_evento'];

    try {
        $sql = $conn->prepare("UPDATE eventosolidario.evento 
                               SET nome_organizador = :nome_organizador, telefone_organizador = :telefone_organizador, email = :email,
                                   tipo_evento = :tipo_evento, data_evento = :data_evento, local_evento = :local_evento, limite_evento = :limite_evento
                               WHERE idEvento = :id");
        $sql->bindParam(":nome_organizador", $nome_organizador);
        $sql->bindParam(":telefone_organizador", $telefone_organizador);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":tipo_evento", $tipo_evento);
        $sql->bindParam(":data_evento", $data_evento);
        $sql->bindParam(":local_evento", $local_evento);
        $sql->bindParam(":limite_evento", $limite_evento);
        $sql->bindParam(":id", $id);
        $sql->execute();
        header("Location: CADEVENTO");
        exit();
    } catch (PDOException $e) {
        error_log("Erro ao editar evento: " . $e->getMessage());
        echo "Erro ao editar evento. Tente novamente mais tarde.";
    }
}

// Buscar todos os registros
try {
    $sql = $conn->query("SELECT * FROM eventosolidario.evento");
    $eventos = $sql->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erro ao buscar eventos: " . $e->getMessage());
    echo "Erro ao buscar eventos. Tente novamente mais tarde.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include ("view/static/css.php") ?>
<?php include ("view/static/navbar.php") ?>

<body>
    <div class="container-fluid">
        <h1 class="my-4">Lista de Eventos</h1>
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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $gerencia_evento): ?>
                    <tr>
                        <form method="post" action="">
                            <td><input type="text" class="form-control" name="nome_organizador"
                                    value="<?= htmlspecialchars($gerencia_evento['nome_organizador']) ?>"></td>
                            <td><input type="text" class="form-control" name="telefone_organizador"
                                    value="<?= htmlspecialchars($gerencia_evento['telefone_organizador']) ?>"></td>
                            <td><input type="email" class="form-control" name="email"
                                    value="<?= htmlspecialchars($gerencia_evento['email']) ?>"></td>
                            <td><input type="text" class="form-control" name="tipo_evento"
                                    value="<?= htmlspecialchars($gerencia_evento['tipo_Evento']) ?>"></td>
                            <td><input type="date" class="form-control" name="data_evento"
                                    value="<?= htmlspecialchars($gerencia_evento['data_evento']) ?>"></td>
                            <td><input type="text" class="form-control" name="local_evento"
                                    value="<?= htmlspecialchars($gerencia_evento['local_evento']) ?>"></td>
                            <td><input type="text" class="form-control" name="limite_evento"
                                    value="<?= htmlspecialchars($gerencia_evento['limite_evento']) ?>"></td>
                            <td>
                                <input type="hidden" name="id" value="<?= $gerencia_evento['idEvento'] ?>">
                                <input type="hidden" name="edit" value="true">
                                <button type="submit" class="btn btn-warning btn-sm">Salvar</button>
                            </td>
                        </form>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= $gerencia_evento['idEvento'] ?>">
                                <input type="hidden" name="delete" value="true">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este evento?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include ("view/static/footer.php") ?>
</body>

</html>
