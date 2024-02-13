<?php
// Incluir o arquivo de conexão
require 'conexao.php';

// Estabelecer a conexão com o banco de dados
$conn = conectarAoBanco();

// Verificar se o ID do agendamento foi fornecido via POST
if (isset($_POST['id'])) {
    // Extrair o ID do agendamento da solicitação POST
    $idAgendamento = $_POST['id'];

    // Deletar o agendamento da tabela agendamento
    $sqlDeleteAgendamento = "DELETE FROM agendamento WHERE id = $idAgendamento";

    if ($conn->query($sqlDeleteAgendamento) === TRUE) {
        // Deletar o registro correspondente na tabela Dados_do_Agendado
        $sqlDeleteAgendado = "DELETE FROM Dados_do_Agendado WHERE id = $idAgendamento";

        if ($conn->query($sqlDeleteAgendado) === TRUE) {
            echo "Agendamento e dados associados excluídos com sucesso.";
        } else {
            echo "Erro ao excluir os dados associados do agendamento: " . $conn->error;
        }
    } else {
        echo "Erro ao excluir o agendamento: " . $conn->error;
    }
} else {
    echo "ID do agendamento não fornecido via POST.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
git config --global user.email "seu_email@example.com"
git config --global user.name "wellignton.pontes"
