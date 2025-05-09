<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html"); // volta para login se não estiver logado
    exit();
}
?>

<!-- Conteúdo da página de empréstimos -->
<h1>Bem-vindo ao sistema de empréstimos!</h1>
