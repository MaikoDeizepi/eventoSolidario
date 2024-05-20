<?php
session_start();

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

<?php include("view/static/css.php") ?>

<body>
    <!-- Navbar -->
    <?php include("view/static/navbar.php") ?>
    


<p> Tela Cadastro</p>


    <!-- End your project here-->
    <!-- Footer -->  
<?php include("view/static/footer.php") ?>

   
</body>

</html>