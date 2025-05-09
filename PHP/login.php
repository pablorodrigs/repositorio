<?php
include("conexao.php");

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificando a existência do usuário no banco
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = pg_query($conn, $query);

    if (!$result) {
        die("Erro na consulta: " . pg_last_error($conn));
    }

    // Verifica se o usuário existe
    if (pg_num_rows($result) > 0) {
        // Recupera os dados do usuário
        $user = pg_fetch_assoc($result);

        // Verifica se a senha fornecida corresponde à senha do banco
        if (password_verify($senha, $user['senha'])) {
            // Senha correta, redireciona para a página de empréstimos
            header("Location: emprestimo.html");
            exit();  // Garante que o código após o redirecionamento não seja executado
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não existe.";
    }
} else {
    echo "Preencha e-mail e senha.";
}
?>
