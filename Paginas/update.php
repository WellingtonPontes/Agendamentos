<?php
// Incluir o arquivo de conexão
require 'conexao.php';

// Estabelecer a conexão com o banco de dados
$conn = conectarAoBanco();

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extrair os dados do formulário de edição (substitua os nomes dos campos pelos seus)
    $idAgendamento = $_POST['id'];
    $dataAgendamento = $_POST['data_agendamento'];
    $horario = $_POST['horario'];
    $chamado = $_POST['chamado'];
    $descricaoProblema = $_POST['descricao_problema'];
    $categoria = $_POST['categoria'];
    $status = $_POST['status'];
    $idAgendado = $_POST['agendado_id'];
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $lider = $_POST['lider_imediato'];
    $emailLider = $_POST['email'];
    $contato = $_POST['contato'];
    $operacao = $_POST['operacao'];

    // Atualizar os dados na tabela agendamento
    $sqlAgendamento = "UPDATE agendamento SET 
                        data_agendamento = '$dataAgendamento',
                        horario = '$horario',
                        chamado = '$chamado',
                        descricao_problema = '$descricaoProblema',
                        categoria = '$categoria',
                        status = '$status'
                        WHERE id = $idAgendamento";

    if ($conn->query($sqlAgendamento) === TRUE) {
        // Atualizar os dados na tabela Dados_do_Agendado
        $sqlAgendado = "UPDATE Dados_do_Agendado SET 
                        nome = '$nome',
                        matricula = '$matricula',
                        lider = '$lider',
                        email_lider = '$emailLider',
                        contato = '$contato',
                        operacao = '$operacao'
                        WHERE id = $idAgendado";

        if ($conn->query($sqlAgendado) === TRUE) {
            $conn->close();
            header("Location: Agendamentos.php");
            exit();
        } else {
            echo "Erro ao atualizar os dados do agendamento: " . $conn->error;
        }
    } else {
        echo "Erro ao atualizar os dados do agendamento: " . $conn->error;
    }
} else {
    echo "Os dados do formulário não foram recebidos.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
