<?php

// Inicializa $url como uma string vazia para evitar problemas se $_GET['url'] não estiver definido
$url = '';

if (isset($_GET['url'])) {
    $url = strtoupper($_GET['url']);
}

switch ($url) {
    case 'INICIO':
        require_once 'view/index.php';
        break;
    case 'CADASTRO':
        require_once 'view/cadastro.php';
        break;
    case 'CRIARCONTA':
        require_once 'view/criar_conta.php';
        break;
    case 'ESQUECEUSENHA':
        require_once 'view/esqueceu_senha.php';
        break;
    case 'SOBRENOS':
        require_once 'view/sobrenos.php';
        break;
    case 'TELACADASTRO':
        require_once 'view/tela_cadastro.php';
        break;
    case 'TELAINICIAL':
        require_once 'view/tela_inicial.php';
        break;
    case 'TELAPERFIL':
        require_once 'view/tela_perfil.php';
        break;
    case 'CADEMPRESA':
        require_once 'view/cad_empresa.php';
        break;
    case 'CADASTRAREVENTO':
        require_once 'view/cad_evento.php';
        break;
    case 'CADEVENTO':
        require_once 'view/cadastro_evento.php';
        break;
    case 'CRUDEMPRESA':
        require_once 'view/tela_crud.php';
        break;
    case 'CRUDEVENTO':
        require_once 'view/tela_crud_evento.php';
        break;
    case 'CRIAEVENTO':
        require_once 'view/gerenciar_evento.php';
        break;
    case 'CONSULTAEVENTO':
        require_once 'view/consulta_evento.php';
        break;
    default:
        // Trate o caso em que a URL não é reconhecida
        echo 'Página não encontrada';
        // ou redirecione para uma página padrão:
        // header('Location: /eventosolidario/view/index.php');
        // exit();
        break;
}
?>