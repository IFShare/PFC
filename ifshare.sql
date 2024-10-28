-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/10/2024 às 17:43
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id`, `conteudo`, `dataComentario`, `idPostagem`, `idUsuario`) VALUES
(1, 'Esse mosquito aí é muito top', '2024-10-20 15:02:15', 12, 7),
(2, 'Nossa mas que banner legal!', '2024-10-20 15:04:21', 13, 7),
(3, 'ah não kkkkkkkkkkk', '2024-10-20 15:10:45', 24, 7),
(40, 'luvas legais', '2024-10-21 13:54:29', 22, 7),
(66, 'vagabundo', '2024-10-21 15:38:44', 30, 7),
(67, 'cred', '2024-10-21 15:43:38', 30, 27),
(70, 'que gatinha', '2024-10-21 21:09:43', 37, 27),
(71, 'cacetada', '2024-10-21 21:41:23', 21, 27),
(72, 'dorminhoco KKKKKKKKKKKKK', '2024-10-21 21:54:26', 30, 27),
(73, 'meu deus nicollas', '2024-10-21 21:54:57', 30, 7),
(74, 'vagabundo', '2024-10-21 22:00:58', 30, 7),
(78, 'que legal!', '2024-10-21 23:04:19', 16, 27),
(83, 'bahhh', '2024-10-21 23:16:18', 30, 27);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtida`
--

CREATE TABLE `curtida` (
  `id` int(11) NOT NULL,
  `idPostagem` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curtida`
--

INSERT INTO `curtida` (`id`, `idPostagem`, `idUsuario`) VALUES
(20, 23, 7),
(26, 23, 27),
(30, 37, 7),
(31, 16, 7),
(118, 21, 7),
(188, 34, 7),
(193, 47, 7),
(194, 12, 7),
(199, 13, 7),
(207, 15, 7),
(211, 48, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPostagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `postagem`
--

INSERT INTO `postagem` (`id`, `imagem`, `legenda`, `dataPostagem`, `idUsuario`) VALUES
(12, 'arquivo_200bce31-ec25-5c22-33ef-e43b3e8d72cf.jfif', 'Mosquitooo', '2024-10-20 15:02:00', 7),
(13, 'arquivo_0b016e24-4455-5b28-77ca-50dd6f303911.jpeg', 'Nosso banner legal', '2024-10-20 15:03:58', 7),
(14, 'arquivo_3f793d6e-ff53-69f2-e9a3-ecaa1ae45fe2.jpeg', 'Luis fazendo pose kakakakaka', '2024-10-20 15:04:50', 7),
(15, 'arquivo_62055320-6d64-c7ba-fbdc-f8959de15bad.jpeg', 'Aulinha rendendo😅', '2024-10-20 15:05:15', 7),
(16, 'arquivo_60deb08d-841b-ec86-e96a-eea165fcea9d.jpeg', 'Minhas colegas de trabalho na frente do nosso banner legal', '2024-10-20 15:06:04', 7),
(17, 'arquivo_9e5a0c34-6efe-a44e-a70b-de348335f19b.jfif', 'a moça ficou triste', '2024-10-20 15:06:40', 7),
(18, 'arquivo_d38779b2-2958-9221-9006-01be8fb56010.jpeg', 'julia i nicolly', '2024-10-20 15:06:59', 7),
(19, 'arquivo_e64cb7cb-9732-e888-85a2-a9f78eb3aff9.jfif', 'dorminhoca', '2024-10-20 15:07:19', 7),
(20, 'arquivo_e2b34ecf-5899-88d3-e31e-0369ac1fb15a.jfif', 'dando esmola pros pobre', '2024-10-20 15:07:36', 7),
(21, 'arquivo_4fc96da4-297a-d4a2-923f-7367c1572cdc.jpeg', 'luis bocó', '2024-10-20 15:08:08', 7),
(22, 'arquivo_a7ec06de-02a8-ac46-1d4f-6de5196c36b7.jpeg', 'luvas.', '2024-10-20 15:08:27', 7),
(23, 'arquivo_9d9c1915-d19c-12be-d767-480832c4b5e2.jpeg', 'na função', '2024-10-20 15:08:48', 7),
(24, 'arquivo_cba38dfe-e3ba-1a36-23c0-7aee52cff489.jpeg', 'A MAÇÃ FUJIU KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK', '2024-10-20 15:09:13', 7),
(25, 'arquivo_baa29739-9098-845e-7de7-e1cd9b5588fe.jpg', 'nicollas fingindo que tá estudando', '2024-10-20 16:01:50', 7),
(26, 'arquivo_19673f2d-2398-8d15-60f6-59741cfa2111.jpg', 'a pose do mano', '2024-10-20 16:02:02', 7),
(27, 'arquivo_9b9c3679-6bff-9ed3-f7f4-d81163d149ef.jpg', 'estudando pro Enem', '2024-10-20 16:02:13', 7),
(28, 'arquivo_767d2bba-2162-14c9-005d-b18facdddd21.jpg', 'credo', '2024-10-20 16:02:28', 7),
(30, 'arquivo_114dab6e-c77f-e89c-2415-bcba436b909a.jpg', 'dormindo no meio da aula', '2024-10-20 19:24:17', 7),
(34, 'arquivo_b14b73ab-d52a-5b45-eb92-0d5aafcdcfb5.jfif', 'nicolly bonita', '2024-10-20 23:00:58', 7),
(35, 'arquivo_ba792172-8f53-6a22-6eac-119eb815c505.jpg', 'dorminhoco', '2024-10-21 13:38:07', 7),
(37, 'arquivo_876fc898-1a39-bc48-7fa1-12889f1f11da.jpeg', 'miau', '2024-10-21 15:23:38', 7),
(47, 'arquivo_9ad23570-aa70-85b2-91c0-39d17b58d2fd.jpg', 'nicolly mimindo', '2024-10-25 22:51:17', 7),
(48, 'arquivo_a3337291-6d89-03e3-a412-de2c1d83369a.jpg', 'de cria', '2024-10-25 22:51:55', 7),
(54, 'arquivo_55f82510-faf4-1a02-952d-fa1b656e4f6b.jpeg', NULL, '2024-10-27 13:48:56', 7);

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
  `compMatricula` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nomeCompleto`, `nomeUsuario`, `email`, `senha`, `fotoPerfil`, `bio`, `tipoUsuario`, `dataCriacao`, `compMatricula`) VALUES
(7, 'Matheus de Souza Cardoso', 'MathU', 'mathcardoso792@gmail.com', '$2y$10$GKixarBnfrEH404Lm7n6/e.VhUjiL..USvfQ7ye063vrMQ9fFvsFa', NULL, NULL, 'ADM', NULL, NULL),
(27, 'Julia Vitória', 'taegvils', 'juliavitoria@gmail.com', '$2y$10$666weVJY13tkIjDgZOm6KuKknrYDCWtjknylY/Ca7MbxCr2VLC7b2', NULL, NULL, 'ADM', '2024-10-21 00:00:00', NULL),
(29, 'Junin do pneu', 'juninPneu', 'juninPneu@gmail.com', '$2y$10$qd6z3TzGAJyTZBOF1wkRE.Q5q4AG.G4.8w/LGoAhE8m.oRygKJtJG', NULL, NULL, 'USUARIO', '2024-10-26 00:00:00', NULL);

--
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de tabela `curtida`
--
ALTER TABLE `curtida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagem`
--
ALTER TABLE `postagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idPostagem`) REFERENCES `postagem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentaris_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`idPostagem`) REFERENCES `postagem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

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
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
