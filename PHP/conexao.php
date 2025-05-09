<?php
if (!function_exists('pg_connect')) {
    die("Erro: A extensão PostgreSQL (pgsql) não está habilitada no PHP. Edite o php.ini e ative extension=pgsql.");
}

$host = "localhost";
$dbname = "Emprestimos";
$user = "postgres";
$password = "P@blo2712";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Falha na conexão com o PostgreSQL.");
}
?>
