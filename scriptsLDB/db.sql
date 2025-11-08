CREATE DATABASE crud_kanban;
USE crud_kanban;

CREATE TABLE usuarios(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha varchar(128) NOT NULL
    );
    
CREATE TABLE tarefas(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    descricao VARCHAR(120) NOT NULL,
    nome_setor VARCHAR(120) NOT NULL,
    prioridade ENUM('baixa', 'media', 'alta') NOT NULL,
    data_cadastro DATE NOT NULL,
    status ENUM('a fazer', 'fazendo', 'pronto') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
    );