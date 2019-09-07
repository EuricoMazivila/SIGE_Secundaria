-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2019 at 07:37 PM
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
(1, 2, 8, 3),
(2, 3, 8, 4),
(3, 5, 9, 1);

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
(2, 4, '2019-09-06', 0, '0000-00-00', 0, 'Pendete'),
(3, 1, '2019-09-06', 9, '2019-09-05', 0, 'Pendete');

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
-- Stand-in structure for view `dadosusuairio`
-- (See below for the actual view)
--
CREATE TABLE `dadosusuairio` (
`id_User` int(11)
,`Username` varchar(40)
,`Senha` varchar(40)
,`Email` varchar(100)
,`Nome` varchar(40)
,`Apelido` varchar(40)
,`Email_Pessoal` varchar(60)
,`Nr_Tell` int(11)
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
-- Stand-in structure for view `dados_escola_user`
-- (See below for the actual view)
--
CREATE TABLE `dados_escola_user` (
`id_user` int(11)
,`id_Escola` int(11)
,`NivelAcesso` enum('Admin','Professor','Secretaria','Directoria','Convidado','Aluno')
,`Estado` enum('Ativo','Rescendido')
,`Nome` varchar(60)
,`Nivel` enum('Primaria','Secundaria','Tecnico','Superio')
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
(18, 10, 'Sagrada Familia', 'Secundaria', 'Privada');

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
  `Email` varchar(60) NOT NULL,
  `Nr_Tell` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nasc`, `Email`, `Nr_Tell`) VALUES
(2, 'Candido', 'barato', 'M', 'Solteiro', '2019-09-06', 'BaratoCandido@gmail.com', 0),
(3, 'Nelson', 'Nambe', 'M', 'Solteiro', '2019-09-06', 'BaratoCandido@gmail.com', 0),
(5, 'Julio', 'Nguambe', 'M', 'Casado', '2019-09-05', 'NguambeJulio@gmail.com', 0),
(6, 'Paulo', 'Mondlane', 'M', 'Solteiro', '2000-06-01', '', 0),
(7, 'Euico', 'Mazivila', 'M', 'Solteiro', '1997-09-06', '', 0),
(8, 'Claudio', 'Bucene', 'M', 'Solteiro', '1998-09-26', '', 0),
(9, 'Ricardo', 'Manhice', 'M', 'Solteiro', '1995-09-05', '', 0),
(10, 'Euclesia', 'Cadia', 'M', 'Solteiro', '1996-09-06', '', 0),
(11, 'Neima', 'Fulano', 'F', 'Casado', '1998-06-01', '', 0);

--
-- Triggers `pessoa`
--
DELIMITER $$
CREATE TRIGGER `AddUser` AFTER INSERT ON `pessoa` FOR EACH ROW INSERT INTO usuario(id_User,Username,senha,DataCriacao)VALUES(new.id_Pessoa,new.Nome ,new.Apelido, CURRENT_DATE)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `privilegio_usuario`
--

CREATE TABLE `privilegio_usuario` (
  `Nivel` varchar(40) NOT NULL,
  `Criar_Escola` enum('S','N') NOT NULL DEFAULT 'N',
  `Criar_Usuario` enum('S','N') NOT NULL DEFAULT 'N',
  `Criar_Turma` enum('S','N') NOT NULL DEFAULT 'N',
  `Marcar_Tarefas` enum('S','N') NOT NULL DEFAULT 'N',
  `Marcar_Avaliacao` enum('S','N') NOT NULL DEFAULT 'N',
  `Lancar_Nota` enum('S','N') NOT NULL DEFAULT 'N',
  `Consultar_Nota` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilegio_usuario`
--

INSERT INTO `privilegio_usuario` (`Nivel`, `Criar_Escola`, `Criar_Usuario`, `Criar_Turma`, `Marcar_Tarefas`, `Marcar_Avaliacao`, `Lancar_Nota`, `Consultar_Nota`) VALUES
('Administrador Escola', 'N', 'N', 'S', 'S', 'N', 'N', 'N'),
('Aluno', 'N', 'N', 'N', 'N', 'N', 'N', 'S'),
('Convidado', 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
('Gerente de Avalicaoes', 'N', 'N', 'N', 'N', 'S', 'S', 'S'),
('Gerente Distrital', 'S', 'S', 'N', 'S', 'N', 'N', 'N');

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
(2, 10, 'Ativo', 'S', 'N', 'N'),
(3, 3, 'Ativo', 'S', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `user_escola`
--

CREATE TABLE `user_escola` (
  `id_user` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL,
  `NivelAcesso` enum('Admin','Professor','Secretaria','Directoria','Convidado','Aluno') NOT NULL DEFAULT 'Convidado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_escola`
--

INSERT INTO `user_escola` (`id_user`, `id_Escola`, `Estado`, `NivelAcesso`) VALUES
(2, 1, 'Ativo', 'Convidado'),
(2, 1, 'Ativo', 'Directoria'),
(3, 3, 'Ativo', 'Admin'),
(3, 2, 'Ativo', 'Professor'),
(3, 4, 'Ativo', 'Secretaria'),
(5, 4, 'Ativo', 'Secretaria');

-- --------------------------------------------------------

--
-- Table structure for table `user_privilegio`
--

CREATE TABLE `user_privilegio` (
  `idUser` int(11) NOT NULL,
  `Tipo` varchar(40) NOT NULL DEFAULT 'Convidado',
  `Estado` enum('Ativo','Revogado') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_privilegio`
--

INSERT INTO `user_privilegio` (`idUser`, `Tipo`, `Estado`) VALUES
(5, 'Gerente Distrital', 'Ativo'),
(5, 'Administrador Escola', 'Ativo'),
(6, 'Convidado', 'Ativo'),
(7, 'Convidado', 'Ativo'),
(8, 'Convidado', 'Ativo'),
(9, 'Convidado', 'Ativo'),
(10, 'Convidado', 'Ativo'),
(11, 'Convidado', 'Ativo');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_User` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Senha` varchar(40) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Estado` enum('Ativo','Revogado') NOT NULL,
  `DataCriacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_User`, `Username`, `Senha`, `Email`, `Estado`, `DataCriacao`) VALUES
(2, 'Candido', 'barato', NULL, 'Ativo', '2019-09-06'),
(3, 'Nelson', 'Nambe', NULL, 'Ativo', '2019-09-06'),
(5, 'Julio', 'Nguambe', NULL, 'Ativo', '2019-09-06'),
(6, 'Paulo', 'Mondlane', NULL, 'Ativo', '2019-09-06'),
(7, 'Euico', 'Mazivila', NULL, 'Ativo', '2019-09-06'),
(8, 'Claudio', 'Bucene', NULL, 'Ativo', '2019-09-06'),
(9, 'Ricardo', 'Manhice', NULL, 'Ativo', '2019-09-06'),
(10, 'Euclesia', 'Cadia', NULL, 'Ativo', '2019-09-06'),
(11, 'Neima', 'Fulano', NULL, 'Ativo', '2019-09-06');

--
-- Triggers `usuario`
--
DELIMITER $$
CREATE TRIGGER `AddUserPrivilegio` AFTER INSERT ON `usuario` FOR EACH ROW INSERT INTO `user_privilegio` (`idUser`, `Tipo`, `Estado`) VALUES (new.id_User, 'Convidado', 'Ativo')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `usuarioacessoescola`
-- (See below for the actual view)
--
CREATE TABLE `usuarioacessoescola` (
`id_user` int(11)
,`Estado` enum('Ativo','Rescendido')
,`NivelAcesso` enum('Admin','Professor','Secretaria','Directoria','Convidado','Aluno')
,`id_Escola` int(11)
,`Escola` varchar(60)
,`Nivel` enum('Primaria','Secundaria','Tecnico','Superio')
);

-- --------------------------------------------------------

--
-- Structure for view `dadosalunoescola`
--
DROP TABLE IF EXISTS `dadosalunoescola`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dadosalunoescola`  AS  select `aluno`.`id_Aluno` AS `id_Aluno`,`pessoa`.`id_Pessoa` AS `id_Pessoa`,`escola`.`id_Escola` AS `id_Escola`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`escola`.`Nome` AS `Escola`,`escola`.`Nivel` AS `Nivel`,`aluno`.`Classe` AS `Classe`,`aluno_escola`.`Data_Ingresso` AS `Data_Ingresso`,`aluno_escola`.`ClasseIngresso` AS `ClasseIngresso`,`aluno_escola`.`Estado` AS `Estado`,`aluno_escola`.`DataSaida` AS `DataSaida`,`aluno_escola`.`ClasseSaida` AS `ClasseSaida` from (((`aluno` join `pessoa`) join `escola`) join `aluno_escola`) where ((`aluno`.`id_Pessoa` = `pessoa`.`id_Pessoa`) and (`aluno`.`id_Escola` = `escola`.`id_Escola`) and (`aluno`.`id_Escola` = `aluno_escola`.`id_Escola`) and (`aluno`.`id_Aluno` = `aluno_escola`.`id_Aluno`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dadosusuairio`
--
DROP TABLE IF EXISTS `dadosusuairio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dadosusuairio`  AS  select `usuario`.`id_User` AS `id_User`,`usuario`.`Username` AS `Username`,`usuario`.`Senha` AS `Senha`,`usuario`.`Email` AS `Email`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Email` AS `Email_Pessoal`,`pessoa`.`Nr_Tell` AS `Nr_Tell` from (`usuario` join `pessoa`) where (`usuario`.`id_User` = `pessoa`.`id_Pessoa`) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_acesso_distrito`
--
DROP TABLE IF EXISTS `dados_acesso_distrito`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_acesso_distrito`  AS  select `user_distrital_admin`.`id_user` AS `id_user`,`user_distrital_admin`.`id_Dir` AS `id_Dir`,`user_distrital_admin`.`Estado` AS `Estado`,`user_distrital_admin`.`Gestao_Escolas` AS `Gestao_Escolas`,`user_distrital_admin`.`Gestao_Operacoes` AS `Gestao_Operacoes`,`user_distrital_admin`.`Gestao_Usuarios` AS `Gestao_Usuarios`,`direcao_distrital_educacao`.`id_Distrito` AS `id_Distrito`,`direcao_distrital_educacao`.`Designacao` AS `Designacao`,`direcao_distrital_educacao`.`Total_Escola` AS `Total_Escola`,`direcao_distrital_educacao`.`Data_Criacao` AS `Data_Criacao` from (`user_distrital_admin` join `direcao_distrital_educacao`) where (`user_distrital_admin`.`id_Dir` = `direcao_distrital_educacao`.`id_Distrito`) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_escola_user`
--
DROP TABLE IF EXISTS `dados_escola_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_escola_user`  AS  select `user_escola`.`id_user` AS `id_user`,`user_escola`.`id_Escola` AS `id_Escola`,`user_escola`.`NivelAcesso` AS `NivelAcesso`,`user_escola`.`Estado` AS `Estado`,`escola`.`Nome` AS `Nome`,`escola`.`Nivel` AS `Nivel` from (`user_escola` join `escola`) where (`user_escola`.`id_Escola` = `escola`.`id_Escola`) ;

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
  ADD PRIMARY KEY (`id_Pessoa`);

--
-- Indexes for table `privilegio_usuario`
--
ALTER TABLE `privilegio_usuario`
  ADD PRIMARY KEY (`Nivel`);

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
-- Indexes for table `user_privilegio`
--
ALTER TABLE `user_privilegio`
  ADD KEY `idUser` (`idUser`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `id_User` (`id_User`);

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
  MODIFY `id_Escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_Pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `user_privilegio`
--
ALTER TABLE `user_privilegio`
  ADD CONSTRAINT `user_privilegio_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privilegio_ibfk_3` FOREIGN KEY (`Tipo`) REFERENCES `privilegio_usuario` (`Nivel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
