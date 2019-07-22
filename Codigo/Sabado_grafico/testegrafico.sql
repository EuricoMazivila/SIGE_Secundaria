-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 11:13 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
select count(*) from alunos where classe = 10;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `conta` (`_classe` INT(11)) RETURNS INT(11) begin
declare x int(5);
select count(*) into x from alunos where classe=_classe;
return x;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `conta_Sexo` (`_classe` INT(11), `_sexo` ENUM('M','F')) RETURNS INT(11) begin
declare x int(5);
select count(*) into x from alunos where classe=_classe and alunos.sexo=_sexo;
return x;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `conta_Vinculo` (`_vinculo` VARCHAR(20)) RETURNS INT(11) begin
declare x int(5);
select count(*) into x from professores WHERE vinculo=_vinculo;
return x;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alunos`
--

CREATE TABLE `alunos` (
  `nome` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `classe` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alunos`
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
('Carlos', 'M', 8),
('fdfd', 'f', 9),
('dasdasd', 'm', 8),
('tetet', 'M', 9),
('tetete', 'M', 9),
('', 'F', 8),
('', 'F', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `estatistica_alunos`
-- (See below for the actual view)
--
CREATE TABLE `estatistica_alunos` (
`classe` int(1)
,`Total_Alunos` int(11)
,`Total_Masculino` int(11)
,`Total_Femenino` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `estatitica_vnculo_professor`
-- (See below for the actual view)
--
CREATE TABLE `estatitica_vnculo_professor` (
`vinculo` varchar(20)
,`Total_Professores` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `professores`
--

CREATE TABLE `professores` (
  `nome` varchar(45) NOT NULL,
  `vinculo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professores`
--

INSERT INTO `professores` (`nome`, `vinculo`) VALUES
('Issufo Vali', 'Contratado'),
('Ruben Manhica', 'Contratado'),
('Leila Omar', 'Efectivo'),
('Marcelo Munguanaze', 'Efectivo'),
('Tatia Kovalenko', 'Falta'),
('Celso Chiconela', 'Contratado');

-- --------------------------------------------------------

--
-- Structure for view `estatistica_alunos`
--
DROP TABLE IF EXISTS `estatistica_alunos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estatistica_alunos`  AS  select distinct `alunos`.`classe` AS `classe`,`conta`(`alunos`.`classe`) AS `Total_Alunos`,`conta_sexo`(`alunos`.`classe`,'M') AS `Total_Masculino`,`conta_sexo`(`alunos`.`classe`,'F') AS `Total_Femenino` from `alunos` order by `alunos`.`classe` ;

-- --------------------------------------------------------

--
-- Structure for view `estatitica_vnculo_professor`
--
DROP TABLE IF EXISTS `estatitica_vnculo_professor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `estatitica_vnculo_professor`  AS  select distinct `professores`.`vinculo` AS `vinculo`,`conta_Vinculo`(`professores`.`vinculo`) AS `Total_Professores` from `professores` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
