CREATE DATABASE ifshare;

use ifshare;

CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    nome_usuario VARCHAR(70) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL,
    foto_perfil VARCHAR(255),
    bio VARCHAR(250),
    tipoUsuario ENUM('ADM', 'USUARIO', 'ESTUDANTE') NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    matricula VARCHAR(75)
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
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_postagem INT,
    id_usuario INT,
    data_curtida DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postagem) REFERENCES postagem(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE denuncia (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    motivo TEXT NOT NULL,
    id_usuario INT NOT NULL,
    id_postagem INT NOT NULL,
    FOREIGN KEY (id_postagem) REFERENCES postagem(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);