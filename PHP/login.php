<?php
include("conexao.php");

if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Neste caso, 'email' está sendo usado para capturar o username
    $username = filter_var($_POST['email'], FILTER_SANITIZE_STRING); // O nome da variável será 'username' aqui
    $senha = $_POST['senha'];

    // Verifica se o username fornecido é válido
    if (empty($username)) {
        header("Location: login.html?erro=campo_vazio");
        exit();
    }

    // Usando prepared statement para evitar SQL Injection
    $query = "SELECT * FROM usuarios WHERE username = $1";  // Alterado de 'email' para 'username'
    $result = pg_query_params($conn, $query, array($username));

    if (!$result) {
        die("Erro na consulta: " . pg_last_error($conn));
    }

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        // Verifica se a senha fornecida corresponde à senha armazenada (aqui deveria ser feito password_verify se fosse senha hash)
        if ($senha === $user['senha']) {  // Senha sem hash (caso não tenha feito hash)
            // Senha correta, redireciona para a página de empréstimos
            header("Location: emprestimos.html");
            exit();
        } else {
            // Senha incorreta, redireciona de volta para login com erro
            header("Location: login.html?erro=senha_incorreta");
            exit();
        }
    } else {
        // Usuário não encontrado, redireciona para login com erro
        header("Location: login.html?erro=usuario_nao_encontrado");
        exit();
    }
} else {
    // Campos vazios, redireciona para login com erro
    header("Location: login.html?erro=campo_vazio");
    exit();
}
?>
