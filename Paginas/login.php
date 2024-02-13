<?php
session_start();
require 'conexao.php';

function validaLogin()
{
    // Verifica se os dados foram enviados por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos de login e senha foram preenchidos
        if (isset($_POST["login"]) && isset($_POST["senha"])) {
            // Conecta-se ao banco de dados (substitua pelas suas credenciais)

            $conn = conectarAoBanco();
            // Escapa os valores do login e senha para evitar injeção de SQL
            $login = $conn->real_escape_string($_POST["login"]);
            $senha = $conn->real_escape_string($_POST["senha"]);

            // Consulta o banco de dados para encontrar o usuário com o login fornecido
            $sql = "SELECT * FROM analista WHERE login = '$login'";
            $result = $conn->query($sql);

            // Verifica se o usuário foi encontrado
            if ($result->num_rows > 0) {
                // Obtém os dados do usuário encontrado
                $row = $result->fetch_assoc();
                // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
                if ($senha == $row["senha"]) {
                    // Se a senha estiver correta, redireciona para a página principal
                    $_SESSION["usuario_login"] = $login;
                    header("Location: ./agendar.php");
                    exit();
                } else {
                    // Se a senha estiver incorreta, exibe uma mensagem de erro
                    echo "Senha incorreta.";
                    header("Location: ../login.html");
                    
                }
            } else {
                // Se o usuário não for encontrado, exibe uma mensagem de erro
                
                echo "Usuário não encontrado.";
                header("Location: ../login.html");
                
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        } else {
            // Se os campos de login e senha não foram preenchidos, redireciona para a página de login novamente
            header("Location: ../login.html");
            exit();
        }
    } else {
        // Se a requisição não foi feita por POST, redireciona para a página de login novamente
        header("Location: ../login.html");
        exit();
    }
}

// Chama a função para realizar a validação do login
validaLogin();

?>
