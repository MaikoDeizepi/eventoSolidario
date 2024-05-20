<!DOCTYPE html>
<html lang="pt-br">

<?php include ("view/static/css.php") ?>



<?php
// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar a sessão se necessário
session_start();

// Incluir a classe Usuario e a conexão com o banco de dados
require_once "model/Conexao.php";
require_once "model/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegue os dados do formulário
    $nomeUsuario = $_POST['nomeUsuario'];
    $dataNasc = $_POST['dataNasc'];
    $numeroCelular = $_POST['numeroCelular'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Crie uma nova instância da classe Usuario
    $gerencia_evento = new Usuario();
    $gerencia_evento->setNomeUsuario($nomeUsuario);
    $gerencia_evento->setDtaNasc($dataNasc);
    $gerencia_evento->setNumTel($numeroCelular);
    $gerencia_evento->setSexo($sexo);
    $gerencia_evento->setEmail($email);
    $gerencia_evento->setSenha($senha);

    // Tente cadastrar o usuário
    try {
        $gerencia_evento->cadastraUsuario();
        // Redirecione para o índice após o cadastro bem-sucedido
        header("Location: inicio");
        exit();
    } catch (Exception $e) {
        echo "Erro ao cadastrar o usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include ("view/static/css.php") ?>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to right, #8c52ff, #5ce1e6);">
        <div class="container-fluid">
            <a class="navbar-brand mt-2 mt-lg-0" href="../index.html">ES</a>
        </div>
    </nav>
    <!-- Navbar -->

    <div class="container">
        <div class="card-header text-white" style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Criar conta</div>
        <br>
        <div class="card-header text-white" style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Dados pessoais</div>
        <div class="card-header">
            <!--Cadastro Sucesso-->
            <form method="post" action="">
                <div class="form-group">
                    <!-- NOME COMPLETO -->
                    <div class="form-group">
                        <label for="name">Nome completo:</label>
                        <input type="text" class="form-control" id="nome" name="nomeUsuario" required>
                    </div>

                    <!-- Data Nascimento -->
                    <div class="form-group">
                        <label for="dataNasc">Data de nascimento:</label>
                        <input type="date" class="form-control" id="dataNasc" name="dataNasc" required>
                    </div>

                    <!-- Numero Celular -->
                    <div class="form-group">
                        <label for="numeroCelular">Número de Celular:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+55</span>
                            </div>
                            <input type="tel" class="form-control" id="numeroCelular" name="numeroCelular" placeholder="Digite o número do celular" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Sexo -->
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outros</option>
                        </select>
                    </div>

                    <!-- Dados de login -->
                    <div class="card-header text-white" style="background: linear-gradient(to right, #8c52ff, #5ce1e6); text-align: center;">Dados Conta</div>
                    <div class="card-header">
                        <!-- email -->
                        <div class="form-group">
                            <label for="email">Endereço de E-mail:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu endereço de e-mail" required>
                        </div>

                        <!-- senha -->
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
                        </div>

                        <!-- cadastre-se -->
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-success active btn-custom" style="background: linear-gradient(to right, #8c52ff, #5ce1e6);">Cadastrar-se</button>
                        </div>
                    </div>

                    <div class="card-footer" style="border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;">
                        <div class="text-center">
                            Já possui uma conta? <a href="inicio" style="color: #026773;">Faça login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Inclua o script do Bootstrap (incluindo o Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</body>
</html>
