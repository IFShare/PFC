-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/11/2024 às 14:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifshare`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `dataComentario` datetime DEFAULT current_timestamp(),
  `idPostagem` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtida`
--

CREATE TABLE `curtida` (
  `id` int(11) NOT NULL,
  `idPostagem` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
);

--
-- Despejando dados para a tabela `curtida`
--
-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `status` enum('NAOVERIFICADO','VERIFICADO') NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPostagem` int(11) NOT NULL
);


-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
--

CREATE TABLE `postagem` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `legenda` text DEFAULT NULL,
  `dataPostagem` datetime DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL
);


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nomeCompleto` varchar(100) NOT NULL,
  `nomeUsuario` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `fotoPerfil` varchar(255) DEFAULT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `tipoUsuario` enum('ADM','USUARIO','ESTUDANTE') NOT NULL,
  `dataCriacao` datetime DEFAULT current_timestamp(),
  `compMatricula` varchar(100) DEFAULT NULL,
  `isEstudante` enum('SIM','NAO') NOT NULL,
  `status` enum('ATIVO','INATIVO','NAOVERIFICADO','ATIVOVERIFICADO') NOT NULL
);

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nomeCompleto`, `nomeUsuario`, `email`, `senha`, `fotoPerfil`, `bio`, `tipoUsuario`, `dataCriacao`, `compMatricula`, `isEstudante`, `status`) VALUES
(72, 'Matheus Cardoso', 'MathU', 'mathcardoso792@gmail.com', '$2y$10$ds0r6xmBcA9fqhKxZItnvuK44XWFL4ipR8YgB4jITHdscL8flqwbq', NULL, NULL, 'ADM', '2024-11-06 00:00:00', NULL, 'SIM', 'ATIVOVERIFICADO'),
(86, 'Julia Vitória', 'taegvils', 'julia.vitoria07@gmail.com', '$2y$10$vw5.GgwLa7U0pQGaeF1PSuU/wNySEceC9c/GY22e99tQoRe2dIGNC', NULL, NULL, 'ADM', '2024-11-12 00:00:00', 'compMatricula_tagevils.pdf', 'SIM', 'ATIVOVERIFICADO');
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPostagem` (`idPostagem`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `curtida`
--
ALTER TABLE `curtida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPostagem` (`idPostagem`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPostagem` (`idPostagem`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomeUsuario` (`nomeUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de tabela `curtida`
--
ALTER TABLE `curtida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `postagem`
--
ALTER TABLE `postagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idPostagem`) REFERENCES `postagem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentaris_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`idPostagem`) REFERENCES `postagem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `denuncia`
--
ALTER TABLE `denuncia`
  ADD CONSTRAINT `denuncia_ibfk_1` FOREIGN KEY (`idPostagem`) REFERENCES `postagem` (`id`),
  ADD CONSTRAINT `denuncia_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
