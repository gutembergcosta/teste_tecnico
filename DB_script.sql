-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Abr-2021 às 20:02
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bernoulli`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `times`
--

CREATE TABLE `times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pontos` int(11) NOT NULL,
  `jogos` int(11) NOT NULL,
  `vitorias` int(11) NOT NULL,
  `empates` int(11) NOT NULL,
  `derrotas` int(11) NOT NULL,
  `gols_feitos` int(11) NOT NULL,
  `gols_sofridos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `times`
--

INSERT INTO `times` (`id`, `nome`, `pontos`, `jogos`, `vitorias`, `empates`, `derrotas`, `gols_feitos`, `gols_sofridos`, `created_at`, `updated_at`) VALUES
(1, 'América Mineiro - MG', 36, 24, 8, 12, 4, 31, 16, '2021-04-03 03:28:54', '2021-04-05 19:59:06'),
(2, 'Athletico Paranaense - PR', 14, 11, 2, 8, 1, 2, 8, '2021-04-03 03:28:50', '2021-04-05 20:01:16'),
(3, 'Atlético Goianiense - GO', 19, 15, 5, 4, 6, 23, 34, '2021-04-03 03:28:37', '2021-04-05 20:04:27'),
(4, 'Atlético Mineiro - MG', 16, 9, 5, 1, 3, 23, 25, NULL, '2021-04-05 20:00:36'),
(5, 'Bahia - BA', 21, 18, 4, 9, 5, 21, 31, NULL, '2021-04-05 20:04:27'),
(6, 'Chapecoense	- SC', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(7, 'Corinthians	- SP', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(10, 'Cuiabá - MT', 1, 1, 0, 1, 0, 0, 0, NULL, '2021-04-05 20:01:16'),
(12, 'Flamengo - RJ', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(13, 'Fluminense - RJ', 3, 1, 1, 0, 0, 1, 0, NULL, '2021-04-05 13:43:47'),
(14, 'Fortaleza - CE', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(15, 'Grêmio- RS', 5, 3, 1, 2, 0, 1, 0, NULL, '2021-04-05 08:51:34'),
(16, 'Internacional - RS', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(17, 'Juventude - RS', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(18, 'Palmeiras - SP', 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(19, 'Red Bull - SP', 3, 1, 1, 0, 0, 3, 0, NULL, '2021-04-05 14:08:57'),
(20, 'Santos - SP', 11, 11, 3, 2, 6, 17, 23, NULL, '2021-04-05 14:01:51'),
(21, 'São Paulo - SP', 4, 2, 1, 1, 0, 4, 3, NULL, '2021-04-05 13:55:29'),
(22, 'Sport - PE', 12, 8, 4, 0, 4, 18, 16, NULL, '2021-04-05 19:57:35');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `times`
--
ALTER TABLE `times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
