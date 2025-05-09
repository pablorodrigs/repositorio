<?php
include("PHP/conexao.php");

// Criação da tabela emprestimos
$createTableEmprestimos = "
CREATE TABLE IF NOT EXISTS emprestimos (
    id SERIAL PRIMARY KEY,
    descricao TEXT NOT NULL,
    patrimonio VARCHAR(50),
    service_tag VARCHAR(50),
    tipo VARCHAR(50),
    status VARCHAR(50)
);
";

$resultEmp = pg_query($conn, $createTableEmprestimos);
if (!$resultEmp) {
    die("Erro ao criar tabela emprestimos: " . pg_last_error($conn));
} else {
    echo "Tabela 'emprestimos' criada com sucesso.";
}
?>
