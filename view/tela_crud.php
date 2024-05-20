<?php
require_once "model/Conexao.php";
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: /eventosolidario/view/index.php');
    exit();
}

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

        $sql = $conn->prepare("DELETE FROM eventosolidario.empresas WHERE idEmpresa = :id");
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            header("Location: CADASTRO");
            exit();
        } else {
            throw new Exception("Nenhum registro encontrado com o ID especificado.");
        }
    } catch (Exception $e) {
        error_log("Erro ao excluir empresa: " . $e->getMessage());
        echo "Erro ao excluir empresa. " . $e->getMessage();
    }
}

// Manipulação de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $razao_social = $_POST['razao_social'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];

    try {
        $sql = $conn->prepare("UPDATE eventosolidario.empresas 
                               SET razao_social = :razao_social, nome_fantasia = :nome_fantasia, cnpj = :cnpj, telefone = :telefone, endereco = :endereco, email = :email
                               WHERE idEmpresa = :id");
        $sql->bindParam(":razao_social", $razao_social);
        $sql->bindParam(":nome_fantasia", $nome_fantasia);
        $sql->bindParam(":cnpj", $cnpj);
        $sql->bindParam(":telefone", $telefone);
        $sql->bindParam(":endereco", $endereco);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":id", $id, PDO::PARAM_INT);
        $sql->execute();
        header("Location: CADASTRO");
        exit();
    } catch (PDOException $e) {
        error_log("Erro ao editar empresa: " . $e->getMessage());
        echo "Erro ao editar empresa. Tente novamente mais tarde.";
    }
}

// Buscar todos os registros
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
<?php include("view/static/css.php") ?>
<?php include("view/static/navbar.php") ?>

<body>
    <div class="container-fluid">
        <h1 class="my-4">Lista de Empresas</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresas as $empresa): ?>
                    <tr>
                        <form method="post" action="">
                            <td><input type="text" class="form-control" name="razao_social"
                                    value="<?= htmlspecialchars($empresa['razao_social']) ?>"></td>
                            <td><input type="text" class="form-control" name="nome_fantasia"
                                    value="<?= htmlspecialchars($empresa['nome_fantasia']) ?>"></td>
                            <td><input type="text" class="form-control" name="cnpj"
                                    value="<?= htmlspecialchars($empresa['cnpj']) ?>"></td>
                            <td><input type="text" class="form-control" name="telefone"
                                    value="<?= htmlspecialchars($empresa['telefone']) ?>"></td>
                            <td><input type="text" class="form-control" name="endereco"
                                    value="<?= htmlspecialchars($empresa['endereco']) ?>"></td>
                            <td><input type="email" class="form-control" name="email"
                                    value="<?= htmlspecialchars($empresa['email']) ?>"></td>
                            <td>
                                <input type="hidden" name="id" value="<?= $empresa['idEmpresa'] ?>">
                                <input type="hidden" name="edit" value="true">
                                <button type="submit" class="btn btn-warning btn-sm">Salvar</button>
                            </td>
                        </form>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?= $empresa['idEmpresa'] ?>">
                                <input type="hidden" name="delete" value="true">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja excluir esta empresa?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("view/static/footer.php") ?>
</body>

</html>
