$(document).ready(function() {
    console.log('Script carregado com sucesso.');

    // Adiciona um evento de clique ao botão "Editar"
    $('.edit-btn').click(function() {
        console.log('Botão "Editar" clicado.');

        // Obtém o valor do atributo "data-id" do botão clicado
        var id = $(this).data('id');

        // Envia uma solicitação AJAX para o servidor para recuperar os dados do agendamento com base no ID
        $.ajax({
            url: 'get_agendamento.php',
            type: 'GET',
            dataType: 'json', // Define o tipo de dados esperados como JSON
            data: { id: id },
            success: function(response) {
                console.log('Dados do agendamento recebidos:', response);

                // Agora você pode acessar os dados como um objeto JSON e atualizar os campos do modal conforme necessário
                $('#data_agendamento').val(response.data_agendamento);
                $('#horario').val(response.horario);
                $('#chamado').val(response.chamado);
                $('#descricao_problema').val(response.descricao_problema);
                $('#nome').val(response.nome);
                $('#matricula').val(response.matricula);
                $('#categoria').val(response.categoria);
                $('#chamado').val(response.chamado);
                $('#status').val(response.status);
                $('#horario').val(response.horario);
                $('#data_agendamento').val(response.data_agendamento);
                $('#email').val(response.email_lider);
                $('#lider_imediato').val(response.lider);
                $('#contato').val(response.contato);
                $('#operacao').val(response.operacao);
                $('#id').val(response.id);
                $('#agendado_id').val(response.agendado_id);

            },
            error: function(xhr, status, error) {
                console.error('Erro ao recuperar os dados do agendamento:', error);
            }
        });
    });
});


$(document).ready(function() {
    // Adiciona um evento de clique ao botão de exclusão
    $('.btn-excluir').click(function() {
        // Obtém o ID do agendamento a ser excluído
        var id = $(this).data('id');
        console.log("teste");

        // Confirmação de exclusão
        if (confirm("Tem certeza que deseja excluir este agendamento?")) {
            // Envia uma solicitação AJAX para excluir o agendamento
            $.ajax({
                url: 'excluir_agendamento.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    // Atualiza a página ou realiza outras ações conforme necessário
                    alert(response); // Exibe mensagem de sucesso
                    location.reload(); // Recarrega a página após exclusão
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao excluir o agendamento:', error);
                    alert("Erro ao excluir o agendamento. Por favor, tente novamente.");
                }
            });
        }
    });
});