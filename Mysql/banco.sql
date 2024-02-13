create database rpg_baba_yaga;
use rpg_baba_yaga;
show tables;


create database Agendamentos;
use Agendamentos;
show tables;
select * from agendamento;

CREATE TABLE agendamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_agendamento DATE,
    horario TIME,
    chamado VARCHAR(255),
    descricao_problema TEXT,
    categoria ENUM('headset', 'software', 'hardware'),
    status VARCHAR(50),
    analista_id INT, -- Chave estrangeira para o ID do analista
    agendado_id INT, -- Chave estrangeira para o ID do agendado
    FOREIGN KEY (analista_id) REFERENCES analista(id),
    FOREIGN KEY (agendado_id) REFERENCES Dados_do_Agendado(id)
);

CREATE TABLE Dados_do_Agendado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    matricula INT,
    lider VARCHAR(100),
    email_lider VARCHAR(255),
    contato VARCHAR(20), -- Alterado para VARCHAR para armazenar números de telefone
    operacao VARCHAR(100)
);

CREATE TABLE analista (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    senha VARCHAR(50)
);


SELECT * FROM agendamento;

drop database Agendamentos;


