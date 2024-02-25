-- Active: 1694899644536@@127.0.0.1@3306@ifshare
CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    nome_usuario VARCHAR(70) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    genero ENUM('Masculino', 'Feminino', 'Outro'),
    foto_perfil VARCHAR(255),
    bio VARCHAR(250),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    campus VARCHAR(70) NOT NULL
);

CREATE TABLE postagem (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imagem VARCHAR(255) NOT NULL,
    legenda TEXT,
    data_postagem DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE comentarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL,
    data_comentario DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_postagem INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_postagem) REFERENCES postagem(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE curtida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_postagem INT,
    id_usuario INT,
    data_curtida DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postagem) REFERENCES postagem(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE seguidor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_seguidor INT,
    data_seguindo DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    FOREIGN KEY (id_seguidor) REFERENCES usuario(id)
);