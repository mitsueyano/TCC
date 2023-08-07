-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Ago-2023 às 20:08
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `veterinario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dono` varchar(100) NOT NULL,
  `animal` varchar(20) NOT NULL,
  `situacao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`id`, `nome`, `dono`, `animal`, `situacao`) VALUES
(1, 'Bolinha', 'André José', 'Cachorro', 'Espera'),
(2, 'Bituca', 'José André', 'Gato', 'Consultório'),
(3, 'Mosquito', 'Jandré Aosé', 'Gato', 'Espera'),
(4, 'Fedido', 'Dréan Séjo', 'Cachorro', 'Consultório'),
(5, 'Balofo', 'Nadré Sojé', 'Gato', 'Espera'),
(6, 'Pimpolho', 'Jéso Dréan', 'Gato', 'Espera');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(50) NOT NULL,
  `loginusuario` varchar(20) NOT NULL,
  `senha` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `loginusuario`, `senha`) VALUES
(1, 'Luiza', 'luiza', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS'),
(2, 'Margarida', 'maga', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W'),
(3, 'Izaltino', 'tino', '$2y$10$YtS5vIFJIx6lAzJhS6Nzpe2zvdlCSyjiOr0DIFNZoArZAXQnjX0aq');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
