-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Out-2017 às 11:47
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boleto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carne`
--

DROP TABLE IF EXISTS `carne`;
CREATE TABLE IF NOT EXISTS `carne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `numero` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `plano` int(11) NOT NULL,
  `desconto` decimal(11,0) DEFAULT NULL,
  `cidade` varchar(30) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `token` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `senha`, `token`) VALUES
(1, 'jodsonet', '827ccb0eea8a706c4c34a16891f84e7b', '79198a8d7c6c6adf04b8863553b6274c');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos`
--

DROP TABLE IF EXISTS `planos`;
CREATE TABLE IF NOT EXISTS `planos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `plano` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  'desc' float NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
