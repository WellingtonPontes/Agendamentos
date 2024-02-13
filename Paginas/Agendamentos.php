<?php
function validasessao()
{
    // Inicializa a sessão
    session_start();

    // Verifica se a variável de sessão existe
    if (isset($_SESSION["usuario_login"])) {
        // Se a variável de sessão existir, retorna o nome de usuário
        return $_SESSION["usuario_login"];
    } else {
        // Se a variável de sessão não existir, redireciona o usuário para a página de login
        header("Location: ../login.html");
        exit(); // Certifique-se de sair após redirecionar
    }
}
validasessao();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>


</head>

<body>

    <!-- menu -->

    <nav class="w3-bar w3-border bg-color-principal txt-color-principal">
        <h1> <a href="./logoff.php" class="w3-bar-item w3-button w3-right">Logoff</a></h1>
        <h1> <a href="./Agendamentos.php" class="w3-bar-item w3-button w3-right">Agendamentos</a></h1>
        <h1><a href="./Agendar.php" class="w3-bar-item w3-button w3-right">Agendar</a></h1>
        <h1 class="w3-bar-item w3-button">Agendamentos</h1>
    </nav>


    <div class="row">
        <div class="w3-col m12">
            <section class="container ">
                <div class="w3-center ">
                    <h2 class="w3-padding w3-margin">Lista de Agendamentos</h2>
                </div>


                <!-- Tabela para exibir os agendamentos -->
                <table class="w3-table-all w3-card-4 w3-striped w3-bordered">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nome</th>
                            <th class="chamado">Chamado</th>
                            <th>Data do Agendamento</th>
                            <th>Horário</th>
                            <th class="Problema">Problema</th>
                            <th class="status">Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Inclua o arquivo de conexão e outras funções necessárias
                        require 'conexao.php';

                        $conn = conectarAoBanco();
                        // Faça a consulta SQL para recuperar os dados
                        $sql = "SELECT agendamento.*, Dados_do_Agendado.matricula, Dados_do_Agendado.nome 
                FROM agendamento 
                INNER JOIN Dados_do_Agendado ON agendamento.agendado_id = Dados_do_Agendado.id";
                        $result = $conn->query($sql);

                        // Verifique se há resultados
                        if ($result->num_rows > 0) {
                            // Loop através dos resultados e crie linhas da tabela
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['matricula'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td class='chamado'>" . $row['chamado'] . "</td>";
                                echo "<td>" . $row['data_agendamento'] . "</td>";
                                echo "<td>" . $row['horario'] . "</td>";
                                echo "<td class='Problema'>" . $row['descricao_problema'] . "</td>";
                                echo "<td class='status'>" . $row['status'] . "</td>";
                                echo "<td>";
                                echo "<button class='w3-btn w3-blue edit-btn' data-id='" . $row['id'] . "' onclick=\"document.getElementById('id01').style.display='block'\">Editar</button>";
                                echo "<button id='btn-excluir' data-id='" . $row['id'] . "' class='w3-btn w3-red btn-excluir'>Excluir</button>";
                                echo "<button class='w3-btn w3-yellow exibir'>Exibir</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Caso não haja resultados
                            echo "<tr><td colspan='8'>Nenhum agendamento encontrado</td></tr>";
                        }

                        // Feche a conexão
                        $conn->close();
                        ?>
                    </tbody>
                </table>



            </section>
        </div>
    </div>
    </div>


    <!-- modal -->

    <div id="id01" class="w3-modal ">
        <div class="w3-modal-content w3-card-4 card-color ">
            <header class="w3-container bg-color-principal txt-color-principal  ">
                <span onclick="document.getElementById('id01').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2>Agendamentos</h2>
            </header>
            <div class="w3-container">
            <form action="update.php" method="post">

<div class="w3-row w3-margin w3-padding-32">
    <!-- 1 -->
    <div class="w3-col m4 w3-padding w3-center">
        <label for="nome">Nome:</label>
        <input type="text" class="w3-input" id="nome" name="nome" required>
    </div>
    <!-- 2 -->
    <div class="w3-col m4 w3-padding  w3-center">
        <label for="matricula">Matrícula:</label>
        <input type="number" class="w3-input" id="matricula" name="matricula" required>
    </div>
    <!-- 3 -->
    <div class="w3-col m4 w3-padding  w3-center">
        <label for="data_agendamento">Data do Agendamento:</label>
        <input type="date" class="w3-input" id="data_agendamento" name="data_agendamento" required>

    </div>
</div>

<div class="w3-row w3-margin w3-padding-32">
    <!-- 1 -->
    <div class="w3-col m2  w3-padding w3-center">
        <label for="horario">Horário:</label>
        <select name="horario" class="w3-input" id="horario" required>
            <option value="" disabled selected>Selecione uma opção</option>
            <option value="09:00">09:00</option>
            <option value="09:30">09:30</option>
            <option value="10:00">10:00</option>
            <option value="10:30">10:30</option>
            <option value="11:00">11:00</option>
            <option value="11:30">11:30</option>
            <option value="14:00">14:00</option>
            <option value="14:30">14:30</option>
            <option value="15:00">15:00</option>
            <option value="15:30">15:30</option>
            <option value="16:00">16:00</option>
        </select>
        
    </div>
    <!-- 2 -->
    <div class="w3-col m2 w3-padding  w3-center">
        <label for="chamado">Chamado</label>
        <input type="text" class="w3-input" id="chamado" name="chamado" required>
    </div>
    <!-- 3 -->
    <div class="w3-col m4 w3-padding  w3-center">
        <label for="lider_imediato">Líder Imediato:</label>
        <input type="text" class="w3-input" id="lider_imediato" name="lider_imediato" required>
    </div>
    <!-- 4 -->
    <div class="w3-col m4 w3-padding  w3-center">
        <label for="email">E-mail:</label>
        <input type="email" class="w3-input" id="email" name="email" required>
    </div>

</div>

<div class="w3-row w3-margin w3-padding-32">
    <!-- 1 -->
    <div class="w3-col m4 w3-padding w3-center">
        <label for="contato">Contato</label>
        <input type="number" class="w3-input" id="contato" name="contato" required>
    </div>
    <!-- 2 -->
    <div class="w3-col m2 w3-padding  w3-center">
        <label for="operacao">Operação:</label>
        <input type="text" class="w3-input" id="operacao" name="operacao" required>
    </div>
    <!-- 3 -->
    <div class="w3-col m4 w3-padding  w3-center">
        <label for="categoria">Categoria (Headset, Hardware, Sistema Operacional):</label>
        <select id="categoria" class="w3-input" name="categoria" required>
            <option value="" disabled selected>Selecione uma opção</option>
            <option value="headset">headset</option>
            <option value="hardware">hardware</option>
            <option value="software">software</option>
        </select>
    </div>
</div>


<div class="w3-row w3-margin w3-padding-32">
    <!-- 1 -->
    <div class="w3-col m6 w3-padding w3-center">
        <label for="descricao_problema">Descrição do Problema:</label>
        <textarea id="descricao_problema" class="w3-input" name="descricao_problema" rows="4"
            required></textarea>
    </div>
    <!-- 2 -->
    <!-- No seu formulário HTML -->
    <div class="w3-col m6 w3-padding w3-center">
        <label for="status">Status</label>
        <input type="text" name="status" id="status" class="w3-input"  >
            
    </div>

    <input type="text" name="id" id="id"  class="w3-input"  style="display:none" >
    <input type="text" name="agendado_id" id="agendado_id"  class="w3-input"  style="display:none" >

    <div class="w3-row w3-margin w3-padding-32">
        <div class="w3-col m12">
            <button class="w3-btn w3-block bg-color-principal txt-color-principal"
                type="submit">ALTERAR</button>
        </div>
    </div>

</form>
            </div>
            <footer class="w3-container w3-center bg-color-principal txt-color-principal ">
                <p>CRIADO POR: WELLINGTON PONTES</p>
            </footer>
        </div>
    </div>
    </div>


</body>

</html>