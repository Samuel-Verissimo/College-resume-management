-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Maio-2022 às 02:55
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `job_project`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aux_area`
--

CREATE TABLE `aux_area` (
  `idArea` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aux_departments`
--

CREATE TABLE `aux_departments` (
  `idDepartments` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `idJob` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `salary` int(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs_people`
--

CREATE TABLE `jobs_people` (
  `idJobsPeople` int(11) NOT NULL,
  `idPerson` int(70) NOT NULL,
  `idJob` int(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `people`
--

CREATE TABLE `people` (
  `idPerson` int(11) NOT NULL,
  `fullName` varchar(70) COLLATE utf8_bin NOT NULL,
  `contact` varchar(70) COLLATE utf8_bin NOT NULL,
  `login` varchar(70) COLLATE utf8_bin NOT NULL,
  `password` varchar(70) COLLATE utf8_bin NOT NULL,
  `resume` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aux_area`
--
ALTER TABLE `aux_area`
  ADD PRIMARY KEY (`idArea`);

--
-- Índices para tabela `aux_departments`
--
ALTER TABLE `aux_departments`
  ADD PRIMARY KEY (`idDepartments`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`idJob`);

--
-- Índices para tabela `jobs_people`
--
ALTER TABLE `jobs_people`
  ADD PRIMARY KEY (`idJobsPeople`),
  ADD KEY `idPerson` (`idPerson`),
  ADD KEY `idJob` (`idJob`);

--
-- Índices para tabela `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPerson`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aux_area`
--
ALTER TABLE `aux_area`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aux_departments`
--
ALTER TABLE `aux_departments`
  MODIFY `idDepartments` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `idJob` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs_people`
--
ALTER TABLE `jobs_people`
  MODIFY `idJobsPeople` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `people`
--
ALTER TABLE `people`
  MODIFY `idPerson` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `jobs_people`
--
ALTER TABLE `jobs_people`
  ADD CONSTRAINT `jobs_people_ibfk_1` FOREIGN KEY (`idPerson`) REFERENCES `people` (`idPerson`),
  ADD CONSTRAINT `jobs_people_ibfk_2` FOREIGN KEY (`idJob`) REFERENCES `jobs` (`idJob`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
