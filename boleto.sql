-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 15-Set-2017 às 16:56
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
  `desconto` float DEFAULT NULL,
  `cidade` varchar(30) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `apelido`, `celular`, `cpf`, `plano`, `desconto`, `cidade`, `cep`, `rua`, `numero`, `bairro`, `created_at`) VALUES
(1, 'wedson', 'apelido', '88888888888', '99999999999', 1, 10, 'Agrestina', '55495000', 'rua', 79, 'bairro', '2017-09-13 20:23:00'),
(2, 'nome', 'app', '99999999999', '00000009999', 1, 78, 'Agrestina', '55495000', 'rua', 89, 'bairro', '2017-09-13 20:26:27'),
(3, 'teste', 'app', '88888888888', '99999999999', 1, 12, 'Agrestina', '55495000', 'rua', 90, 'centro', '2017-09-13 20:29:18'),
(4, 'wedsib', 'apelido3', '88888888888', '99999999999', 4, 89, 'Agrestina', '55495000', 'kyc', 89, 'bairro', '2017-09-13 20:59:46'),
(5, 'noe', 'aple', '99999999999', '00099999999', 3, 78, 'Agrestina', '55495000', 'rua', 8, 'centro', '2017-09-13 21:07:45'),
(6, 'nome', 'aplelido', '77777777777', '88888888888', 1, 12, 'Agrestina', '55495000', 'lucas', 89, 'centro', '2017-09-13 21:08:24'),
(7, 'nome', 'apelido', '23233333333', '88888888888', 1, 12, 'Agrestina', '55495000', 'rua', 8, 'centro', '2017-09-13 21:09:15'),
(8, 'pro', 'ap', '88888888888', '99999999999', 2, 38, 'Agrestina', '55495000', 'rua', 89, 'centro', '2017-09-13 21:23:29'),
(9, 'wedson', 'app', '99999999999', '88888888888', 1, 100, 'Agrestina', '55495000', 'rua', 89, 'centro', '2017-09-13 21:23:58'),
(10, 'wedson', 'apleiidsfisdoif', '88888888888', '99999999999', 2, 60, 'Agrestina', '55495000', 'rua', 90, 'centro', '2017-09-14 12:59:35'),
(11, 'teste', 'teste', '99999999999', '00000999999', 1, 12, 'Agrestina', '55495000', 'ra', 8, 'sdf', '2017-09-14 15:15:56'),
(12, 'teste', 'teste', '88888888888', '99999999999', 2, 12, 'Agrestina', '55495000', 'rua', 78, 'centro', '2017-09-14 15:16:28'),
(13, 'teste', 'teste', '88888888888', '99999999999', 1, 12, 'Agrestina', '55495000', 'rua', 89, 'centro', '2017-09-14 15:16:55');

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
  `nome` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `planos`
--

INSERT INTO `planos` (`id`, `nome`, `valor`) VALUES
(1, 'Plano 1 mega', 35),
(2, 'Plano 2 megas', 50),
(3, 'Plano 4 megas', 60),
(4, 'Plano 10 gigas', 100),
(5, 'teste', 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
