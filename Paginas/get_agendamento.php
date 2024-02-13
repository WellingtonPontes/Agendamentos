<?php
// Inclua o arquivo de conexão
require 'conexao.php';

// Estabeleça a conexão com o banco de dados
$conn = conectarAoBanco();

// Verifique se o ID foi fornecido na solicitação GET
if(isset($_GET['id'])) {
    // Obtém o ID do agendamento da solicitação
    $id = $_GET['id'];

    // Consulta SQL para recuperar os dados do agendamento com base no ID
    $sql = "SELECT agendamento.*, 
    Dados_do_Agendado.matricula, 
    Dados_do_Agendado.nome,
    Dados_do_Agendado.lider,
    Dados_do_Agendado.email_lider,
    Dados_do_Agendado.contato,
    Dados_do_Agendado.operacao
    FROM agendamento 
    INNER JOIN Dados_do_Agendado ON agendamento.agendado_id = Dados_do_Agendado.id
    WHERE agendamento.id = $id";

    // Executa a consulta
    $result = $conn->query($sql);

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Obtém os dados do agendamento
        $row = $result->fetch_assoc();

        // Retorna os dados do agendamento como JSON
        echo json_encode($row);
    } else {
        // Retorna uma mensagem de erro se o agendamento não for encontrado
        echo "Agendamento não encontrado";
    }
} else {
    // Retorna uma mensagem de erro se o ID não foi fornecido na solicitação
    echo "ID de agendamento não fornecido";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
