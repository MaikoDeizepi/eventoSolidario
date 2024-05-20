<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    require_once('./model/Conexao.php');
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        $conn = Conexao::conectar();
        $sql = "SELECT * FROM tabelausuario WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) < 1) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: inicio');
            exit();
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: telaperfil');
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
} else if (isset($_POST['submit'])) {
    // Caso os campos estejam vazios e o formulário seja submetido
    header('Location: /eventosolidario/view/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include("view/static/css.php") ?>
</head>
<body>
  <!-- Start your project here-->
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    
                    <img src="./view/img/ES_bk.png" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Bem Vindo ao "Evento Solidario"</h4>
                  </div>
                  
                  <form method="post" action="">

                    <p>Entre com a sua conta</p>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="email" name="email" id="form2Example11" class="form-control"
                        placeholder="E-mail" />
                      <label class="form-label" for="form2Example11">E-mail</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="senha" id="form2Example22" class="form-control" />
                      <label class="form-label" for="form2Example22">Senha</label>
                    </div>

                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="submit" type="submit">Log in</button>

                  </form>
                  
                  <div class="text-center pt-1 mb-5 pb-1">
                    <a class="text-muted" href="esqueceusenha">Esqueceu a sua Senha?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Você não possui uma conta?</p>
                    <a class="btn btn-outline-danger" data-mdb-ripple-init
                      data-ripple-color="primary" href="criarconta" role="button">Criar Conta</a>
                  </div>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Gestão Eficiente de Eventos para Organizações do Terceiro Setor</h4>
                  <p class="small mb-0">Nosso objetivo é desenvolver um site de gestão de eventos direcionado para
                    organizações do terceiro setor. Este site visa aprimorar o planejamento, divulgação e organização de
                    eventos entre essas organizações, com o intuito de evitar conflitos de datas e facilitar a
                    mobilização de voluntários, parcerias e doações.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->

  <!-- Inclua o script do Bootstrap (incluindo o Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</body>
</html>
