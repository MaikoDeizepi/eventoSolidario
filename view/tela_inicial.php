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

<?php include ("view/static/css.php") ?>

<style>

.carousel-container {
  display: flex; /* Ativa o Flexbox */
  justify-content: center; /* Centraliza horizontalmente */
  width: 100%; /* Garante que o container ocupe a largura total da tela */
  padding-top: 1%;
}

.carousel {
  width: 70%; /* Define a largura do carrossel em 50% */
}
</style>

<body>
    <!-- Navbar -->
    <?php include ("view/static/navbar.php") ?>


    <div class="container-fluid">

    <h3 class="text-center" style="background: linear-gradient(to right, #8c52ff, #5ce1e6); color: white; padding: 10px;">EVENTO SOLIDARIO</h3>

    <div class="carousel-container">

    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./view/img/img1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./view/img/img2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./view/img/img3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    </div>



    <!-- End your project here-->
    <!-- Footer -->
    <?php include ("view/static/footer.php") ?>


</body>

</html>