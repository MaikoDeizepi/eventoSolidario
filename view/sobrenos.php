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


<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }
    </style>

<body>
    <!-- Navbar -->
    <?php include("view/static/navbar.php") ?>
    

    <div class="container">
        <h1>Sobre Nós</h1>


O setor não lucrativo desempenha um papel crucial na promoção do bem-estar social e na construção de comunidades mais inclusivas e equitativas. Organizações do terceiro setor, incluindo ONGs, fundações e associações comunitárias, são frequentemente responsáveis por promover eventos que visam arrecadar fundos, conscientizar sobre questões sociais e culturais, além de mobilizar recursos e voluntários para causas importantes.

No entanto, a gestão eficiente desses eventos apresenta desafios significativos. A falta de recursos financeiros e tecnológicos, juntamente com a complexidade da organização logística, muitas vezes dificulta a realização bem-sucedida de eventos pelo terceiro setor. Além disso, a comunicação entre diferentes organizações pode ser fragmentada, levando a conflitos de datas e recursos subutilizados.

Diante desse contexto, surge a necessidade de desenvolver soluções inovadoras que ajudem as organizações do terceiro setor a superar esses desafios e maximizar o impacto de seus eventos. Nesse sentido, propomos a criação de um site de gestão de eventos específico para esse setor.

O objetivo deste projeto é desenvolver uma plataforma online que facilite o planejamento, divulgação e organização de eventos sociais, culturais e de captação de recursos por parte das organizações do terceiro setor. Reconhecemos a importância vital dessas organizações para o desenvolvimento social e cultural, e acreditamos que fornecer ferramentas eficazes para a gestão de eventos pode ampliar seu alcance e impacto positivo na comunidade.

Este projeto se concentrará especificamente no desenvolvimento de um site de gestão de eventos, abordando questões relacionadas à usabilidade, customização, integração com mídias sociais, segurança de dados, acessibilidade e gestão de conteúdo. Esses aspectos foram selecionados devido à sua relevância para o sucesso e eficiência das operações das organizações do terceiro setor.

Ao longo deste trabalho, exploraremos detalhadamente cada um desses aspectos, identificando desafios específicos e propondo soluções práticas e inovadoras. Acreditamos que este projeto integrador contribuirá significativamente para o avanço do conhecimento na área de gestão de eventos no terceiro setor e, ao mesmo tempo, fornecerá uma ferramenta prática e útil para as organizações envolvidas.
</div>

    <!-- End your project here-->
    <!-- Footer -->  
<?php include("view/static/footer.php") ?>

   
</body>

</html>