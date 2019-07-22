-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jul-2019 às 11:25
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testegrafico`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `contar` ()  begin
DECLARE numero int;
select count(*) into numero from alunos where classe = 10;
SELECT numero;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `conta` () RETURNS INT(11) begin
declare x int(5);
select count(*) into x from alunos where classe=10;
return x;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `nome` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `classe` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`nome`, `sexo`, `classe`) VALUES
('Hamilton', 'M', 10),
('Titos Junior', 'M', 8),
('Claudia', 'F', 10),
('Roberta', 'F', 8),
('Paulo', 'M', 9),
('Titos', 'M', 9),
('Hortencia', 'F', 11),
('Brown', 'M', 11),
('Taison', 'M', 12),
('Leo', 'M', 12),
('Carla', 'F', 12),
('Carlos', 'M', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `nome` varchar(45) NOT NULL,
  `vinculo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`nome`, `vinculo`) VALUES
('Issufo Vali', 'Contratado'),
('Ruben Manhica', 'Contratado'),
('Leila Omar', 'Efectivo'),
('Marcelo Munguanaze', 'Efectivo'),
('Tatia Kovalenko', 'Falta'),
('Celso Chiconela', 'Contratado');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
