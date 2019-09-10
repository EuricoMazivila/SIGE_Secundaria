-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 10:10 AM
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
-- Database: `escola_secundaria`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `buscaDirEscola` (`Distrito` VARCHAR(40)) RETURNS INT(11) begin
declare codDistito int(11);
SELECT id_Distrito into codDistito FROM `direcao_distrital_educacao` WHERE Designacao LIKE `%Distrito%`;
return codDistito;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administradorescola`
--

CREATE TABLE `administradorescola` (
  `id_Escola` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `Data_Criacao` date NOT NULL,
  `Estado` enum('Ativo','Revogado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administradorescola`
--

INSERT INTO `administradorescola` (`id_Escola`, `id_Pessoa`, `Data_Criacao`, `Estado`) VALUES
(1, 2, '2019-09-10', 'Ativo'),
(2, 5, '2019-09-10', 'Ativo'),
(3, 4, '2019-09-04', 'Ativo');

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id_Aluno` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `id_Escola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id_Aluno`, `id_Pessoa`, `Classe`, `id_Escola`) VALUES
(1, 4, 0, 3),
(2, 5, 0, 3),
(3, 3, 8, 2);

--
-- Triggers `aluno`
--
DELIMITER $$
CREATE TRIGGER `AddAlunoEscola` AFTER INSERT ON `aluno` FOR EACH ROW INSERT INTO aluno_escola (id_Aluno,id_Escola,Data_Ingresso,aluno_escola.ClasseIngresso) VALUES (new.id_Aluno,new.id_Escola,CURRENT_DATE,new.Classe)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upDateAlunoEscola` AFTER UPDATE ON `aluno` FOR EACH ROW UPDATE `aluno_escola` SET `DataSaida` = CURRENT_DATE,  ClasseSaida=old.Classe WHERE `aluno_escola`.`id_Aluno` = old.id_aluno and aluno_escola.id_Escola=old.id_Escola
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aluno_escola`
--

CREATE TABLE `aluno_escola` (
  `id_Aluno` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Data_Ingresso` date NOT NULL,
  `ClasseIngresso` tinyint(4) NOT NULL,
  `DataSaida` date NOT NULL,
  `ClasseSaida` tinyint(4) NOT NULL,
  `Estado` enum('Ativo','Transferido','Expulso','Pendete') NOT NULL DEFAULT 'Pendete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluno_escola`
--

INSERT INTO `aluno_escola` (`id_Aluno`, `id_Escola`, `Data_Ingresso`, `ClasseIngresso`, `DataSaida`, `ClasseSaida`, `Estado`) VALUES
(1, 3, '2019-09-10', 0, '0000-00-00', 0, 'Pendete'),
(2, 3, '2019-09-10', 0, '0000-00-00', 0, 'Pendete'),
(3, 2, '2019-09-10', 8, '0000-00-00', 0, 'Pendete');

-- --------------------------------------------------------

--
-- Table structure for table `bairro`
--

CREATE TABLE `bairro` (
  `id_Bairro` int(11) NOT NULL,
  `id_Distriro` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bairro`
--

INSERT INTO `bairro` (`id_Bairro`, `id_Distriro`, `Nome`) VALUES
(4, 2, 'Xinavane'),
(3, 3, 'Mateque'),
(1, 8, 'Albazine'),
(2, 8, 'Laulane'),
(5, 10, 'Benfica'),
(6, 10, 'Zimpeto');

-- --------------------------------------------------------

--
-- Table structure for table `cargo_directivo`
--

CREATE TABLE `cargo_directivo` (
  `id_Cargo` tinyint(4) NOT NULL,
  `Descricao` varchar(40) NOT NULL,
  `Nivel` enum('Principal','Adjunto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cargo_directivo`
--

INSERT INTO `cargo_directivo` (`id_Cargo`, `Descricao`, `Nivel`) VALUES
(1, 'Director Geral', 'Principal'),
(2, 'Directo Pedagogico', 'Principal'),
(3, 'Director Financeiro', 'Principal'),
(4, 'Director do Recursos Humanos', 'Principal');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dadosalunoescola`
-- (See below for the actual view)
--
CREATE TABLE `dadosalunoescola` (
`id_Aluno` int(11)
,`id_Pessoa` int(11)
,`id_Escola` int(11)
,`Nome` varchar(40)
,`Apelido` varchar(40)
,`Sexo` enum('M','F')
,`Escola` varchar(60)
,`Nivel` enum('Primaria','Secundaria','Tecnico','Superio')
,`Classe` tinyint(4)
,`Data_Ingresso` date
,`ClasseIngresso` tinyint(4)
,`Estado` enum('Ativo','Transferido','Expulso','Pendete')
,`DataSaida` date
,`ClasseSaida` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_acesso_distrito`
-- (See below for the actual view)
--
CREATE TABLE `dados_acesso_distrito` (
`id_user` int(11)
,`id_Dir` int(11)
,`Estado` enum('Ativo','Rescendido')
,`Gestao_Escolas` enum('S','N')
,`Gestao_Operacoes` enum('S','N')
,`Gestao_Usuarios` enum('S','N')
,`id_Distrito` int(11)
,`Designacao` varchar(40)
,`Total_Escola` int(11)
,`Data_Criacao` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_user`
-- (See below for the actual view)
--
CREATE TABLE `dados_user` (
`id_User` int(11)
,`Username` varchar(40)
,`Senha` varchar(40)
,`Email` varchar(100)
,`Estado` enum('Ativo','Revogado','Pendente')
,`DataCriacao` date
,`Acesso_Distrital` enum('S','N')
,`Acesso_Escola` enum('S','N')
,`Acesso_Aluno` enum('S','N')
,`Acesso_Professor` enum('S','N')
,`Acesso_Secretaria` enum('S','N')
,`Acesso_Convidado` enum('S','N')
,`Acesso_Candidato` enum('S','N')
,`Acesso_Adminastrivo` enum('S','N')
,`id_Pessoa` int(11)
,`Nome` varchar(40)
,`Apelido` varchar(40)
,`Sexo` enum('M','F')
,`Estado_Civil` enum('Casado','Solteiro')
,`Data_Nasc` date
,`Email_Pessoal` varchar(100)
,`Nr_Tell` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_user_escola`
-- (See below for the actual view)
--
CREATE TABLE `dados_user_escola` (
`id_Escola` int(11)
,`Nome` varchar(60)
,`Nivel` enum('Primaria','Secundaria','Tecnico','Superio')
,`Pertenca` enum('Publica','Privada','Comunitaria')
,`id_dir` int(11)
,`id_user` int(11)
,`Estado` enum('Ativo','Rescendido')
,`Acesso_Ensino` enum('S','N')
,`Acesso_Avaliacoes` enum('S','N')
,`Acesso_Disciplina` enum('S','N')
);

-- --------------------------------------------------------

--
-- Table structure for table `direcao_distrital_educacao`
--

CREATE TABLE `direcao_distrital_educacao` (
  `id_Distrito` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL DEFAULT '0',
  `Data_Criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direcao_distrital_educacao`
--

INSERT INTO `direcao_distrital_educacao` (`id_Distrito`, `Designacao`, `Total_Escola`, `Data_Criacao`) VALUES
(3, 'Marracuene', 0, '2019-09-04'),
(10, 'KaMbucuana', 0, '2019-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `direcao_escola`
--

CREATE TABLE `direcao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Cargo` tinyint(4) NOT NULL,
  `id_Func` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL,
  `Data_Inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direcao_escola`
--

INSERT INTO `direcao_escola` (`id_Escola`, `id_Cargo`, `id_Func`, `Estado`, `Data_Inicio`) VALUES
(2, 1, 0, 'Ativo', '2019-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `direcao_provincial_educacao`
--

CREATE TABLE `direcao_provincial_educacao` (
  `id_Prov` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL,
  `Data_Criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `id_Prov` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `id_Prov`, `Nome`) VALUES
(1, 1, 'Boane'),
(2, 1, 'Manhica'),
(3, 1, 'Marracuene'),
(4, 1, 'Matutuine'),
(5, 1, 'Moamba'),
(6, 1, 'Namaacha'),
(7, 2, 'ka - Chamaculo'),
(8, 2, 'ka - Mahota'),
(9, 2, 'Ka - Maxaquene'),
(10, 2, 'Ka-Mubucuana');

-- --------------------------------------------------------

--
-- Table structure for table `escola`
--

CREATE TABLE `escola` (
  `id_Escola` int(11) NOT NULL,
  `id_dir` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `Nivel` enum('Primaria','Secundaria','Tecnico','Superio') NOT NULL DEFAULT 'Secundaria',
  `Pertenca` enum('Publica','Privada','Comunitaria') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `escola`
--

INSERT INTO `escola` (`id_Escola`, `id_dir`, `Nome`, `Nivel`, `Pertenca`) VALUES
(1, 3, 'Gwaza Muthine', 'Secundaria', 'Publica'),
(2, 3, 'Santa Montanha', 'Secundaria', 'Comunitaria'),
(3, 3, 'Malhazine', 'Secundaria', 'Privada'),
(4, 3, 'Eduado Mondlane', 'Secundaria', 'Publica'),
(6, 3, 'Bagamoio', 'Primaria', 'Publica'),
(13, 3, 'Heroes', 'Secundaria', 'Publica'),
(14, 10, 'Forca do Povo', 'Secundaria', 'Publica'),
(15, 10, 'Laulae', 'Secundaria', 'Comunitaria'),
(16, 10, 'Infulene', 'Secundaria', 'Publica'),
(17, 10, 'das Acacias', 'Secundaria', 'Privada'),
(18, 10, 'Sagrada Familia', 'Secundaria', 'Privada'),
(19, 10, 'Estrela Vermelha', 'Secundaria', 'Publica'),
(20, 10, 'Hitacula', 'Secundaria', 'Comunitaria'),
(21, 3, 'Habel Jafar', 'Primaria', 'Publica'),
(22, 3, 'Gwava Nr 1', 'Primaria', 'Publica'),
(23, 10, '1 de maio', 'Primaria', 'Publica');

-- --------------------------------------------------------

--
-- Table structure for table `localizacao_escola`
--

CREATE TABLE `localizacao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Bairro` int(11) NOT NULL,
  `Nr` int(11) NOT NULL DEFAULT '0',
  `Quarterao` int(11) NOT NULL DEFAULT '0',
  `Avenida` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `localizacao_escola`
--

INSERT INTO `localizacao_escola` (`id_Escola`, `id_Bairro`, `Nr`, `Quarterao`, `Avenida`) VALUES
(2, 3, 0, 0, 'Sebastiao Mabote');

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `id_Pais` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`id_Pais`, `Nome`) VALUES
(1, 'Mocambique');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa`
--

CREATE TABLE `pessoa` (
  `id_Pessoa` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Apelido` varchar(40) NOT NULL,
  `Sexo` enum('M','F') NOT NULL DEFAULT 'M',
  `Estado_Civil` enum('Casado','Solteiro') NOT NULL DEFAULT 'Solteiro',
  `Data_Nasc` date NOT NULL,
  `Email_Pessoal` varchar(100) NOT NULL,
  `Nr_Tell` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nasc`, `Email_Pessoal`, `Nr_Tell`) VALUES
(2, 'Candido', 'Barato', 'M', 'Solteiro', '2000-09-03', 'BaratoCandido@gmail.com', 0),
(3, 'Eurico', 'Mazivila', 'M', 'Solteiro', '2019-09-02', 'EuricoMazivila@gmail.com', 0),
(4, 'Paulo', 'Mondlane', 'M', 'Solteiro', '2000-09-01', 'MondlanePaulo@gmail.com', 0),
(5, 'Claudio', 'Bucene', 'M', 'Solteiro', '1999-09-10', 'BuceneCaludio@gmail.com', 0),
(6, 'Euclesia', 'Cadia', 'M', 'Solteiro', '1997-12-07', 'EuclesiaCadia@gmail.com', 0),
(7, 'Ricardo', 'Manhica', 'M', 'Solteiro', '1995-04-03', 'ManhicaRicardo@gmail.com', 0),
(8, 'Absao', 'Nhatumbo', 'M', 'Solteiro', '1998-06-01', 'AbsalaoNhatumbo', 0);

--
-- Triggers `pessoa`
--
DELIMITER $$
CREATE TRIGGER `AddUser` AFTER INSERT ON `pessoa` FOR EACH ROW INSERT INTO usuario(id_User,Username,senha,email,DataCriacao)VALUES(new.id_Pessoa,new.Nome ,new.Apelido,new.Email_Pessoal, CURRENT_DATE)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `provincia`
--

CREATE TABLE `provincia` (
  `id_Prov` int(11) NOT NULL,
  `id_Pais` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provincia`
--

INSERT INTO `provincia` (`id_Prov`, `id_Pais`, `Nome`) VALUES
(1, 1, 'Maputo'),
(2, 1, 'Maputo Cidade');

-- --------------------------------------------------------

--
-- Table structure for table `user_distrital_admin`
--

CREATE TABLE `user_distrital_admin` (
  `id_user` int(11) NOT NULL,
  `id_Dir` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL DEFAULT 'Ativo',
  `Gestao_Escolas` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Operacoes` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Usuarios` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_distrital_admin`
--

INSERT INTO `user_distrital_admin` (`id_user`, `id_Dir`, `Estado`, `Gestao_Escolas`, `Gestao_Operacoes`, `Gestao_Usuarios`) VALUES
(2, 3, 'Ativo', 'S', 'S', 'S'),
(3, 10, 'Ativo', 'N', 'N', 'S'),
(4, 3, 'Ativo', 'S', 'S', 'S');

--
-- Triggers `user_distrital_admin`
--
DELIMITER $$
CREATE TRIGGER `Actualizar_Usuario` AFTER INSERT ON `user_distrital_admin` FOR EACH ROW UPDATE `usuario` SET `Acesso_Distrital` = 'S' WHERE `usuario`.`id_User`=new.id_user
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_escola`
--

CREATE TABLE `user_escola` (
  `id_user` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL,
  `Acesso_Ensino` enum('S','N') NOT NULL DEFAULT 'N',
  `Acesso_Avaliacoes` enum('S','N') NOT NULL DEFAULT 'N',
  `Acesso_Disciplina` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_escola`
--

INSERT INTO `user_escola` (`id_user`, `id_Escola`, `Estado`, `Acesso_Ensino`, `Acesso_Avaliacoes`, `Acesso_Disciplina`) VALUES
(4, 2, 'Ativo', 'S', 'S', 'S'),
(5, 3, 'Ativo', 'S', 'S', 'S');

--
-- Triggers `user_escola`
--
DELIMITER $$
CREATE TRIGGER `Update_Usuario_AcessoEscola` AFTER INSERT ON `user_escola` FOR EACH ROW UPDATE `usuario` SET `Acesso_Escola` = 'S' WHERE `usuario`.`id_User` =new.id_user
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_User` int(11) NOT NULL,
  `Username` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Senha` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Estado` enum('Ativo','Revogado','Pendente') CHARACTER SET latin1 NOT NULL DEFAULT 'Ativo',
  `DataCriacao` date NOT NULL,
  `Acesso_Distrital` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Escola` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Aluno` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Professor` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Secretaria` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Convidado` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'S',
  `Acesso_Candidato` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Adminastrivo` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_User`, `Username`, `Senha`, `Email`, `Estado`, `DataCriacao`, `Acesso_Distrital`, `Acesso_Escola`, `Acesso_Aluno`, `Acesso_Professor`, `Acesso_Secretaria`, `Acesso_Convidado`, `Acesso_Candidato`, `Acesso_Adminastrivo`) VALUES
(2, 'Candido', 'Barato', NULL, 'Ativo', '2019-09-09', 'S', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(3, 'Eurico', 'Mazivila', 'EuricoMazivila@gmail.com', 'Ativo', '2019-09-09', 'S', 'S', 'N', 'N', 'N', 'S', 'N', 'N'),
(4, 'Paulo', 'Mondlane', 'MondlanePaulo@gmail.com', 'Ativo', '2019-09-10', 'S', 'S', 'N', 'N', 'N', 'S', 'N', 'N'),
(5, 'Claudio', 'Bucene', 'BuceneCaludio@gmail.com', 'Ativo', '2019-09-10', 'N', 'S', 'N', 'N', 'N', 'S', 'N', 'N'),
(6, 'Euclesia', 'Cadia', 'EuclesiaCadia@gmail.com', 'Ativo', '2019-09-10', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(7, 'Ricardo', 'Manhica', 'ManhicaRicardo@gmail.com', 'Ativo', '2019-09-10', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(8, 'Absao', 'Nhatumbo', 'AbsalaoNhatumbo', 'Ativo', '2019-09-10', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N');

-- --------------------------------------------------------

--
-- Stand-in structure for view `usuarioacessoescola`
-- (See below for the actual view)
--
CREATE TABLE `usuarioacessoescola` (
);

-- --------------------------------------------------------

--
-- Structure for view `dadosalunoescola`
--
DROP TABLE IF EXISTS `dadosalunoescola`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dadosalunoescola`  AS  select `aluno`.`id_Aluno` AS `id_Aluno`,`pessoa`.`id_Pessoa` AS `id_Pessoa`,`escola`.`id_Escola` AS `id_Escola`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`escola`.`Nome` AS `Escola`,`escola`.`Nivel` AS `Nivel`,`aluno`.`Classe` AS `Classe`,`aluno_escola`.`Data_Ingresso` AS `Data_Ingresso`,`aluno_escola`.`ClasseIngresso` AS `ClasseIngresso`,`aluno_escola`.`Estado` AS `Estado`,`aluno_escola`.`DataSaida` AS `DataSaida`,`aluno_escola`.`ClasseSaida` AS `ClasseSaida` from (((`aluno` join `pessoa`) join `escola`) join `aluno_escola`) where ((`aluno`.`id_Pessoa` = `pessoa`.`id_Pessoa`) and (`aluno`.`id_Escola` = `escola`.`id_Escola`) and (`aluno`.`id_Escola` = `aluno_escola`.`id_Escola`) and (`aluno`.`id_Aluno` = `aluno_escola`.`id_Aluno`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_acesso_distrito`
--
DROP TABLE IF EXISTS `dados_acesso_distrito`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_acesso_distrito`  AS  select `user_distrital_admin`.`id_user` AS `id_user`,`user_distrital_admin`.`id_Dir` AS `id_Dir`,`user_distrital_admin`.`Estado` AS `Estado`,`user_distrital_admin`.`Gestao_Escolas` AS `Gestao_Escolas`,`user_distrital_admin`.`Gestao_Operacoes` AS `Gestao_Operacoes`,`user_distrital_admin`.`Gestao_Usuarios` AS `Gestao_Usuarios`,`direcao_distrital_educacao`.`id_Distrito` AS `id_Distrito`,`direcao_distrital_educacao`.`Designacao` AS `Designacao`,`direcao_distrital_educacao`.`Total_Escola` AS `Total_Escola`,`direcao_distrital_educacao`.`Data_Criacao` AS `Data_Criacao` from (`user_distrital_admin` join `direcao_distrital_educacao`) where (`user_distrital_admin`.`id_Dir` = `direcao_distrital_educacao`.`id_Distrito`) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_user`
--
DROP TABLE IF EXISTS `dados_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_user`  AS  select `usuario`.`id_User` AS `id_User`,`usuario`.`Username` AS `Username`,`usuario`.`Senha` AS `Senha`,`usuario`.`Email` AS `Email`,`usuario`.`Estado` AS `Estado`,`usuario`.`DataCriacao` AS `DataCriacao`,`usuario`.`Acesso_Distrital` AS `Acesso_Distrital`,`usuario`.`Acesso_Escola` AS `Acesso_Escola`,`usuario`.`Acesso_Aluno` AS `Acesso_Aluno`,`usuario`.`Acesso_Professor` AS `Acesso_Professor`,`usuario`.`Acesso_Secretaria` AS `Acesso_Secretaria`,`usuario`.`Acesso_Convidado` AS `Acesso_Convidado`,`usuario`.`Acesso_Candidato` AS `Acesso_Candidato`,`usuario`.`Acesso_Adminastrivo` AS `Acesso_Adminastrivo`,`pessoa`.`id_Pessoa` AS `id_Pessoa`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`pessoa`.`Estado_Civil` AS `Estado_Civil`,`pessoa`.`Data_Nasc` AS `Data_Nasc`,`pessoa`.`Email_Pessoal` AS `Email_Pessoal`,`pessoa`.`Nr_Tell` AS `Nr_Tell` from (`usuario` join `pessoa`) where (`usuario`.`id_User` = `pessoa`.`id_Pessoa`) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_user_escola`
--
DROP TABLE IF EXISTS `dados_user_escola`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_user_escola`  AS  select `escola`.`id_Escola` AS `id_Escola`,`escola`.`Nome` AS `Nome`,`escola`.`Nivel` AS `Nivel`,`escola`.`Pertenca` AS `Pertenca`,`escola`.`id_dir` AS `id_dir`,`user_escola`.`id_user` AS `id_user`,`user_escola`.`Estado` AS `Estado`,`user_escola`.`Acesso_Ensino` AS `Acesso_Ensino`,`user_escola`.`Acesso_Avaliacoes` AS `Acesso_Avaliacoes`,`user_escola`.`Acesso_Disciplina` AS `Acesso_Disciplina` from (`escola` join `user_escola`) where (`user_escola`.`id_Escola` = `escola`.`id_Escola`) ;

-- --------------------------------------------------------

--
-- Structure for view `usuarioacessoescola`
--
DROP TABLE IF EXISTS `usuarioacessoescola`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuarioacessoescola`  AS  select `user_escola`.`id_user` AS `id_user`,`user_escola`.`Estado` AS `Estado`,`user_escola`.`NivelAcesso` AS `NivelAcesso`,`escola`.`id_Escola` AS `id_Escola`,`escola`.`Nome` AS `Escola`,`escola`.`Nivel` AS `Nivel` from (`user_escola` join `escola`) where (`user_escola`.`Estado` = 'Ativo') order by `user_escola`.`id_user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradorescola`
--
ALTER TABLE `administradorescola`
  ADD KEY `id_Escola` (`id_Escola`),
  ADD KEY `id_Pessoa` (`id_Pessoa`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_Aluno`),
  ADD UNIQUE KEY `id_Pessoa` (`id_Pessoa`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD PRIMARY KEY (`id_Aluno`,`id_Escola`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_Bairro`),
  ADD UNIQUE KEY `id_Distriro` (`id_Distriro`,`Nome`);

--
-- Indexes for table `cargo_directivo`
--
ALTER TABLE `cargo_directivo`
  ADD PRIMARY KEY (`id_Cargo`);

--
-- Indexes for table `direcao_distrital_educacao`
--
ALTER TABLE `direcao_distrital_educacao`
  ADD PRIMARY KEY (`id_Distrito`);

--
-- Indexes for table `direcao_escola`
--
ALTER TABLE `direcao_escola`
  ADD KEY `id_Escola` (`id_Escola`),
  ADD KEY `id_Cargo` (`id_Cargo`);

--
-- Indexes for table `direcao_provincial_educacao`
--
ALTER TABLE `direcao_provincial_educacao`
  ADD PRIMARY KEY (`id_Prov`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD UNIQUE KEY `id_Prov` (`id_Prov`,`Nome`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id_Escola`),
  ADD KEY `id_dir` (`id_dir`);

--
-- Indexes for table `localizacao_escola`
--
ALTER TABLE `localizacao_escola`
  ADD KEY `id_Escola` (`id_Escola`),
  ADD KEY `id_Bairro` (`id_Bairro`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_Pais`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_Pessoa`),
  ADD KEY `Nome` (`Nome`,`Apelido`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_Prov`),
  ADD UNIQUE KEY `id_Pais` (`id_Pais`,`Nome`);

--
-- Indexes for table `user_distrital_admin`
--
ALTER TABLE `user_distrital_admin`
  ADD PRIMARY KEY (`id_user`) USING BTREE,
  ADD UNIQUE KEY `id_user` (`id_user`,`id_Dir`),
  ADD KEY `id_Dir` (`id_Dir`);

--
-- Indexes for table `user_escola`
--
ALTER TABLE `user_escola`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_User`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_Aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_Bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cargo_directivo`
--
ALTER TABLE `cargo_directivo`
  MODIFY `id_Cargo` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id_Escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_Pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_Prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradorescola`
--
ALTER TABLE `administradorescola`
  ADD CONSTRAINT `administradorescola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `administradorescola_ibfk_2` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`id_Distriro`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direcao_distrital_educacao`
--
ALTER TABLE `direcao_distrital_educacao`
  ADD CONSTRAINT `direcao_distrital_educacao_ibfk_1` FOREIGN KEY (`id_Distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direcao_escola`
--
ALTER TABLE `direcao_escola`
  ADD CONSTRAINT `direcao_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcao_escola_ibfk_2` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo_directivo` (`id_Cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direcao_provincial_educacao`
--
ALTER TABLE `direcao_provincial_educacao`
  ADD CONSTRAINT `direcao_provincial_educacao_ibfk_1` FOREIGN KEY (`id_Prov`) REFERENCES `provincia` (`id_Prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_Prov`) REFERENCES `provincia` (`id_Prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_dir`) REFERENCES `direcao_distrital_educacao` (`id_Distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `localizacao_escola`
--
ALTER TABLE `localizacao_escola`
  ADD CONSTRAINT `localizacao_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `localizacao_escola_ibfk_2` FOREIGN KEY (`id_Bairro`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_Pais`) REFERENCES `pais` (`id_Pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_distrital_admin`
--
ALTER TABLE `user_distrital_admin`
  ADD CONSTRAINT `user_distrital_admin_ibfk_1` FOREIGN KEY (`id_Dir`) REFERENCES `direcao_distrital_educacao` (`id_Distrito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_distrital_admin_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_escola`
--
ALTER TABLE `user_escola`
  ADD CONSTRAINT `user_escola_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_escola_ibfk_2` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
