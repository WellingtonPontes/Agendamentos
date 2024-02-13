<?php

function validasessao(){
    // Inicializa a sessão
    if (session_status() == PHP_SESSION_NONE) {
        // Inicia a sessão apenas se ainda não estiver ativa
        session_start();
    }

    // Verifica se a variável de sessão existe
    if(isset($_SESSION["usuario_login"])){
        // Se a variável de sessão existir, retorna o nome de usuário
        return $_SESSION["usuario_login"];
    }else{
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
</head>

<body>

    <!-- menu -->

    <nav class="w3-bar w3-border bg-color-principal txt-color-principal">
        <h1> <a href="./logoff.php" class="w3-bar-item w3-button w3-right">Logoff</a></h1>
        <h1> <a href="./Agendamentos.php" class="w3-bar-item w3-button w3-right">Agendamentos</a></h1>
        <h1><a href="./Agendar.php" class="w3-bar-item w3-button w3-right">Agendar</a></h1>
        <h1 class="w3-bar-item w3-button">Agendamentos</h1>
    </nav>

    <!-- formulario -->
    <!-- card -->
    <div class="w3-card-4 card-color  w3-margin">

        <section class="w3-container">
            <div class="w3-center">
                <h2>AGENDAMENTO</h2>
            </div>
            <form action="processaDados.php" method="post">

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
                        <input type="text" name="status" id="status" class="w3-input" value="Em andamento" disabled required>
                            
                    </div>

                    <div class="w3-row w3-margin w3-padding-32">
                        <div class="w3-col m12">
                            <button class="w3-btn w3-block bg-color-principal txt-color-principal"
                                type="submit">Agendar</button>
                        </div>
                    </div>

            </form>
        </section>
    </div>
</body>

</html>