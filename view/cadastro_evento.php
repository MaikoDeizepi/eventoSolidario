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
    

    <div class="conteiner-fluid p-4 text-center">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <a class="nav-link" href="CADASTRAREVENTO">Realizar Cadastro Evento</a>
          <a class="nav-link" href="CRUDEVENTO">Crud Cadastro Evento</a>
          <a class="nav-link" href="CRIAEVENTO">Criar Evento Empresa</a>
          <a class="nav-link" href="CONSULTAEVENTO">Consultar Eventos Criados</a>


      </ul>
  </div>
  
  <!-- Footer -->  
  <?php include("view/static/footer.php") ?>
</body>

</html>
    