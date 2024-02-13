<?php

require 'conexao.php';

// Inicia a sessão
session_start();

function validasessao(){
    // Verifica se a variável de sessão existe
    if(isset($_SESSION["usuario_login"])){
        // Se a variável de sessão existir, retorna o nome de usuário
        return $_SESSION["usuario_login"];
    } else {
        // Se a variável de sessão não existir, redireciona o usuário para a página de login
        header("Location: ../login.html");
        exit(); // Certifique-se de sair após redirecionar
    }
}



function RecuperaDados() {
    global $dadosAgendamento, $dadosAgendado; // Definindo as variáveis como globais

    $conn = conectarAoBanco();

    $loginAnalista = validasessao();

    // Consulta o banco de dados para obter o ID do analista com base no login
    $sqlAnalista = "SELECT id FROM analista WHERE login = '$loginAnalista'";
    $resultAnalista = $conn->query($sqlAnalista);

    if ($resultAnalista->num_rows > 0) {
        // Se o analista for encontrado, obtém o ID
        $rowAnalista = $resultAnalista->fetch_assoc();
        $idAnalista = $rowAnalista['id'];
    } else {
        // Se o analista não for encontrado, exibe uma mensagem de erro
        echo "Erro: Analista não encontrado.";
        exit(); // Encerra a execução do script
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dadosAgendamento = [
            "data_agendamento" => $_POST["data_agendamento"] ?? "",
            "horario" => $_POST["horario"] ?? "",
            "chamado" => $_POST["chamado"] ?? "",
            "descricao_problema" => $_POST["descricao_problema"] ?? "",
            "categoria" => $_POST["categoria"] ?? "",
            "status" => $_POST['status'] ?? "Em andamento",
            "analista_agendou" => $idAnalista
        ];

        $dadosAgendado = [
            "nome" => $_POST["nome"] ?? "",
            "matricula" => $_POST["matricula"] ?? "",
            "lider" => $_POST["lider_imediato"] ?? "",
            "email_lider" => $_POST["email"] ?? "",
            "contato" => $_POST["contato"] ?? "",
            "operacao" => $_POST["operacao"] ?? ""
        ];
    } else {
        // Se não for enviado via POST, redireciona para a página de formulário
        header("Location: Agendar.php");
        exit();
    }
}

function ExibirDados() {
    global $dadosAgendamento, $dadosAgendado; // Definindo as variáveis como globais

    echo "Dados do Agendamento:<br>";
    foreach ($dadosAgendamento as $key => $value) {
        echo "$key: $value<br>";
    }

    echo "<br>";

    echo "Dados do Agendado:<br>";
    foreach ($dadosAgendado as $key => $value) {
        echo "$key: $value<br>";
    }
}

function IncluirDados($conn) {
    global $dadosAgendamento, $dadosAgendado;

    $sqlAgendado = "INSERT INTO Dados_do_Agendado (nome, matricula, lider, email_lider, contato, operacao)
                    VALUES ('{$dadosAgendado['nome']}', '{$dadosAgendado['matricula']}', '{$dadosAgendado['lider']}',
                            '{$dadosAgendado['email_lider']}', '{$dadosAgendado['contato']}', '{$dadosAgendado['operacao']}')";

    if ($conn->query($sqlAgendado) === TRUE) {
        $idAgendado = $conn->insert_id; // Obtém o ID do último registro inserido

        $sqlAgendamento = "INSERT INTO agendamento (data_agendamento, horario, chamado, descricao_problema, 
                            categoria, status, analista_id, agendado_id)
                           VALUES ('{$dadosAgendamento['data_agendamento']}', '{$dadosAgendamento['horario']}',
                                   '{$dadosAgendamento['chamado']}', '{$dadosAgendamento['descricao_problema']}',
                                   '{$dadosAgendamento['categoria']}', '{$dadosAgendamento['status']}',
                                   '{$dadosAgendamento['analista_agendou']}', $idAgendado)";

        if ($conn->query($sqlAgendamento) === TRUE) {
            $conn->close();
            header("Location: Agendamentos.php");
            exit();

        } else {
            $conn->close();
            echo "Erro ao inserir dados no agendamento: " . $conn->error;
        }
    } else {
        $conn->close();
        echo "Erro ao inserir dados no agendado: " . $conn->error;
    }

    // Lembre-se de fechar a conexão após as operações
    $conn->close();
}

// Chama a função para recuperar os dados do formulário
RecuperaDados();
// Exibe os dados recuperados
ExibirDados();
// Chama a função para incluir os dados no banco de dados

IncluirDados(conectarAoBanco());

?>
