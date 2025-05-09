<?php
include("PHP/conexao.php");

// Criação da tabela se não existir
$createTable = "
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(100) NOT NULL
);
";

$result = pg_query($conn, $createTable);
if (!$result) {
    die("Erro ao criar tabela: " . pg_last_error($conn));
}

// Inserção do usuário
$username = 'pablo.rodrigues'; // substitui o email pelo username
$senha = 'F@cens#25';  // Em produção, use hash com password_hash()

$insertUser = "
INSERT INTO usuarios (username, senha)
VALUES ('$username', '$senha')
ON CONFLICT (username) DO NOTHING;
";

$result = pg_query($conn, $insertUser);
if ($result) {
    echo "Usuário inserido com sucesso.";
} else {
    echo "Erro ao inserir usuário: " . pg_last_error($conn);
}
?>
