CREATE DATABASE crud_leticia_lorenzo;

USE crud_leticia_lorenzo;

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_usuario VARCHAR(100),
    email_usuario VARCHAR(100),
    senha_usuario VARCHAR(50)
);

CREATE TABLE notas (
    id_notas INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titulo_notas VARCHAR(100),
    descricao_notas VARCHAR(2000),
    categoria_notas ENUM('Urgente', 'Médio', 'Não Urgente'),
    conteudo_notas VARCHAR(20000) NOT NULL,
    fk_usuario INT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES usuario(id_usuario)
);