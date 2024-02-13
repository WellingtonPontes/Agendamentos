<?php
function conectarAoBanco() {
    $servername = "localhost"; // Servidor MySQL (geralmente "localhost")
    $username = "root"; // Nome de usuário do MySQL
    $password = "root"; // Senha do MySQL
    $dbname = "Agendamentos"; // Nome do banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }
    // Retorna a conexão para ser usada onde a função for chamada
    return $conn;
}

// Exemplo de uso da função
$conexao = conectarAoBanco();

// Aqui você pode executar consultas SQL e realizar outras operações no banco de dados

// Lembre-se de fechar a conexão quando não precisar mais dela


?>
