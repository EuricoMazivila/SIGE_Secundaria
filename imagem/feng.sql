-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Set-2019 às 17:30
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
-- Database: `feng`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addProvincia` (`_nome_p` VARCHAR(50), `_nome_prov` VARCHAR(50))  Begin 
	declare codp int;
	 
	Insert into paises (id,nome) values (default,_nome_p);
	Select id into codp from paises where nome=_nome_p;
	
	if(codp is not null) then
		begin
			insert into provincia (id,codpais,nome) values(default,codp,_nome_prov);					
		end;
	else
		Select 'Cadastro invalido' as Mensagem;	
	end if;		
end$$

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
-- Estrutura da tabela `administradorescola`
--

CREATE TABLE `administradorescola` (
  `id_Escola` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `Data_Criacao` date NOT NULL,
  `Estado` enum('Ativo','Revogado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_Aluno` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `id_Escola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_Aluno`, `id_Pessoa`, `Classe`, `id_Escola`) VALUES
(1, 2, 8, 3),
(2, 3, 8, 4),
(3, 5, 9, 1);

--
-- Acionadores `aluno`
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
-- Estrutura da tabela `aluno_escola`
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
-- Extraindo dados da tabela `aluno_escola`
--

INSERT INTO `aluno_escola` (`id_Aluno`, `id_Escola`, `Data_Ingresso`, `ClasseIngresso`, `DataSaida`, `ClasseSaida`, `Estado`) VALUES
(2, 4, '2019-09-06', 0, '0000-00-00', 0, 'Pendete'),
(3, 1, '2019-09-06', 9, '2019-09-05', 0, 'Pendete');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `id_Bairro` int(11) NOT NULL,
  `id_Distriro` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairro`
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
-- Estrutura da tabela `cand`
--

CREATE TABLE `cand` (
  `cod` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `classe_ante` enum('8','9','10','11','12') NOT NULL,
  `classe_matricular` enum('8','9','10','11','12') NOT NULL,
  `turno` enum('diurno','nocturno','','') NOT NULL,
  `escola` enum('Escola Primaria Completa Unidade 29','Escola Primaria Completa Unidade 30','','') NOT NULL,
  `ano` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cand`
--

INSERT INTO `cand` (`cod`, `nome`, `classe_ante`, `classe_matricular`, `turno`, `escola`, `ano`, `senha`) VALUES
(1, 'Testando', '10', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 4, ''),
(2, 'Exemplo', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 0, ''),
(3, 'Testando', '9', '10', 'nocturno', 'Escola Primaria Completa Unidade 29', 3, ''),
(4, 'Testando', '9', '10', 'nocturno', 'Escola Primaria Completa Unidade 29', 3, ''),
(5, 'Testando', '9', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 5, ''),
(14, 'Testando Agora', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 5, ''),
(18, 'Testando', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 4, ''),
(19, 'Testando', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 4, ''),
(20, 'Testando', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 4, ''),
(21, 'Ultimo', '11', '12', 'nocturno', 'Escola Primaria Completa Unidade 29', 2019, '3a\r™7Šdk-‹,n­†\n'),
(22, 'dddddd', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 2019, '»Nlà+t*msÊÝŠ¬š'),
(23, 'Teste', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 2019, '\'Ò{µvÜ -ê…Àt,ÿÊ'),
(24, '3', '8', '8', 'diurno', 'Escola Primaria Completa Unidade 29', 3, 'avb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL,
  `imagem` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`codigo`, `nome`, `imagem`) VALUES
(7, 'Exemplo', 0x313535393832353739395f313830302e6a7067),
(8, 'Exemplo 2', 0x313535393832353834375f333836352e6a7067),
(9, 'Testando', 0x313536333738373339315f373736312e6a7067);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo_directivo`
--

CREATE TABLE `cargo_directivo` (
  `id_Cargo` tinyint(4) NOT NULL,
  `Descricao` varchar(40) NOT NULL,
  `Nivel` enum('Principal','Adjunto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cargo_directivo`
--

INSERT INTO `cargo_directivo` (`id_Cargo`, `Descricao`, `Nivel`) VALUES
(1, 'Director Geral', 'Principal'),
(2, 'Directo Pedagogico', 'Principal'),
(3, 'Director Financeiro', 'Principal'),
(4, 'Director do Recursos Humanos', 'Principal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosalunoescola`
--

CREATE TABLE `dadosalunoescola` (
  `id_Aluno` int(11) DEFAULT NULL,
  `id_Pessoa` int(11) DEFAULT NULL,
  `id_Escola` int(11) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Apelido` varchar(40) DEFAULT NULL,
  `Sexo` enum('M','F') DEFAULT NULL,
  `Escola` varchar(60) DEFAULT NULL,
  `Nivel` enum('Primaria','Secundaria','Tecnico','Superio') DEFAULT NULL,
  `Classe` tinyint(4) DEFAULT NULL,
  `Data_Ingresso` date DEFAULT NULL,
  `ClasseIngresso` tinyint(4) DEFAULT NULL,
  `Estado` enum('Ativo','Transferido','Expulso','Pendete') DEFAULT NULL,
  `DataSaida` date DEFAULT NULL,
  `ClasseSaida` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dadosusuairio`
--

CREATE TABLE `dadosusuairio` (
  `id_User` int(11) DEFAULT NULL,
  `Username` varchar(40) DEFAULT NULL,
  `Senha` varchar(40) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Apelido` varchar(40) DEFAULT NULL,
  `Email_Pessoal` varchar(60) DEFAULT NULL,
  `Nr_Tell` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_acesso_distrito`
--

CREATE TABLE `dados_acesso_distrito` (
  `id_user` int(11) DEFAULT NULL,
  `id_Dir` int(11) DEFAULT NULL,
  `Estado` enum('Ativo','Rescendido') DEFAULT NULL,
  `Gestao_Escolas` enum('S','N') DEFAULT NULL,
  `Gestao_Operacoes` enum('S','N') DEFAULT NULL,
  `Gestao_Usuarios` enum('S','N') DEFAULT NULL,
  `id_Distrito` int(11) DEFAULT NULL,
  `Designacao` varchar(40) DEFAULT NULL,
  `Total_Escola` int(11) DEFAULT NULL,
  `Data_Criacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_escola_user`
--

CREATE TABLE `dados_escola_user` (
  `id_user` int(11) DEFAULT NULL,
  `id_Escola` int(11) DEFAULT NULL,
  `NivelAcesso` enum('Admin','Professor','Secretaria','Directoria','Convidado','Aluno') DEFAULT NULL,
  `Estado` enum('Ativo','Rescendido') DEFAULT NULL,
  `Nome` varchar(60) DEFAULT NULL,
  `Nivel` enum('Primaria','Secundaria','Tecnico','Superio') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_distrital_educacao`
--

CREATE TABLE `direcao_distrital_educacao` (
  `id_Distrito` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL DEFAULT '0',
  `Data_Criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `direcao_distrital_educacao`
--

INSERT INTO `direcao_distrital_educacao` (`id_Distrito`, `Designacao`, `Total_Escola`, `Data_Criacao`) VALUES
(3, 'Marracuene', 0, '2019-09-04'),
(10, 'KaMbucuana', 0, '2019-09-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_escola`
--

CREATE TABLE `direcao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Cargo` tinyint(4) NOT NULL,
  `id_Func` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL,
  `Data_Inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `direcao_escola`
--

INSERT INTO `direcao_escola` (`id_Escola`, `id_Cargo`, `id_Func`, `Estado`, `Data_Inicio`) VALUES
(2, 1, 0, 'Ativo', '2019-09-04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_provincial_educacao`
--

CREATE TABLE `direcao_provincial_educacao` (
  `id_Prov` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL,
  `Data_Criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `id_Prov` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `distrito`
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
-- Estrutura da tabela `docentes`
--

CREATE TABLE `docentes` (
  `nome` varchar(45) NOT NULL,
  `cadeira` varchar(45) NOT NULL,
  `classificacao` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `docentes`
--

INSERT INTO `docentes` (`nome`, `cadeira`, `classificacao`) VALUES
('Ruben Manhica', 'Programacao Web', 'Muito Bom'),
('Vali Issufo', 'Engenharia de Software', 'Muito Bom'),
('Edson Michaque', 'Programacao Web', 'Bom'),
('Bhavika', 'Web', 'Muito Bom'),
('Delcio Chadreca', 'Redes de computadores', 'muito bom'),
('Paulo', 'Web', 'Bom'),
('Paulo', 'Web', 'Bom');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id_Escola` int(11) NOT NULL,
  `id_dir` int(11) NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `Nivel` enum('Primaria','Secundaria','Tecnico','Superio') NOT NULL DEFAULT 'Secundaria',
  `Pertenca` enum('Publica','Privada','Comunitaria') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
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
-- Estrutura da tabela `exemplo_1`
--

CREATE TABLE `exemplo_1` (
  `cod` int(11) NOT NULL,
  `nome_exempl_1` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exemplo_1`
--

INSERT INTO `exemplo_1` (`cod`, `nome_exempl_1`) VALUES
(3, 'Exemplo_4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exemplo_2`
--

CREATE TABLE `exemplo_2` (
  `codE` int(11) NOT NULL,
  `exemplo_2` varchar(30) NOT NULL,
  `cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exemplo_2`
--

INSERT INTO `exemplo_2` (`codE`, `exemplo_2`, `cod`) VALUES
(1, 'Testando', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exemplo_3`
--

CREATE TABLE `exemplo_3` (
  `codex` int(11) NOT NULL,
  `exemplo_3` varchar(50) NOT NULL,
  `cod` int(11) NOT NULL,
  `codE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exemplo_3`
--

INSERT INTO `exemplo_3` (`codex`, `exemplo_3`, `cod`, `codE`) VALUES
(2, 'fff', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao_escola`
--

CREATE TABLE `localizacao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Bairro` int(11) NOT NULL,
  `Nr` int(11) NOT NULL DEFAULT '0',
  `Quarterao` int(11) NOT NULL DEFAULT '0',
  `Avenida` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localizacao_escola`
--

INSERT INTO `localizacao_escola` (`id_Escola`, `id_Bairro`, `Nr`, `Quarterao`, `Avenida`) VALUES
(2, 3, 0, 0, 'Sebastiao Mabote');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id_Pais` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_Pais`, `Nome`) VALUES
(1, 'Mocambique');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id`, `nome`) VALUES
(1, 'Angola');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
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
-- Extraindo dados da tabela `pessoa`
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
-- Acionadores `pessoa`
--
DELIMITER $$
CREATE TRIGGER `AddUser` AFTER INSERT ON `pessoa` FOR EACH ROW INSERT INTO usuario(id_User,Username,senha,DataCriacao)VALUES(new.id_Pessoa,new.Nome ,new.Apelido, CURRENT_DATE)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `privilegio_usuario`
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
-- Extraindo dados da tabela `privilegio_usuario`
--

INSERT INTO `privilegio_usuario` (`Nivel`, `Criar_Escola`, `Criar_Usuario`, `Criar_Turma`, `Marcar_Tarefas`, `Marcar_Avaliacao`, `Lancar_Nota`, `Consultar_Nota`) VALUES
('Administrador Escola', 'N', 'N', 'S', 'S', 'N', 'N', 'N'),
('Aluno', 'N', 'N', 'N', 'N', 'N', 'N', 'S'),
('Convidado', 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
('Gerente de Avalicaoes', 'N', 'N', 'N', 'N', 'S', 'S', 'S'),
('Gerente Distrital', 'S', 'S', 'N', 'S', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL,
  `codPais` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`id`, `codPais`, `nome`) VALUES
(5, 1, 'Luanda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `usuario` varchar(35) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `tipo` enum('aluno','professor','director','pedagogico') NOT NULL,
  `imagem` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`usuario`, `senha`, `tipo`, `imagem`) VALUES
('Feng', 'Feng', 'aluno', ''),
('Docente', 'Docente', 'professor', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_distrital_admin`
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
-- Extraindo dados da tabela `user_distrital_admin`
--

INSERT INTO `user_distrital_admin` (`id_user`, `id_Dir`, `Estado`, `Gestao_Escolas`, `Gestao_Operacoes`, `Gestao_Usuarios`) VALUES
(2, 10, 'Ativo', 'S', 'N', 'N'),
(3, 3, 'Ativo', 'S', 'N', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_escola`
--

CREATE TABLE `user_escola` (
  `id_user` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL,
  `NivelAcesso` enum('Admin','Professor','Secretaria','Directoria','Convidado','Aluno') NOT NULL DEFAULT 'Convidado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_escola`
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
-- Estrutura da tabela `user_privilegio`
--

CREATE TABLE `user_privilegio` (
  `idUser` int(11) NOT NULL,
  `Tipo` varchar(40) NOT NULL DEFAULT 'Convidado',
  `Estado` enum('Ativo','Revogado') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_privilegio`
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
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario`, `email`, `senha`, `data`) VALUES
('Exemplo ', 'dddd', 'avb', '0000-00-00'),
('Exemplo ', 'dddd', 'Ë1ìþ?¬ÂSç­eVTŠ', '0000-00-00'),
('', 'ddddd', '2', '0000-00-00'),
('', 'ddddd', 'Í,åñVŸi¤þc­Í', '0000-00-00'),
('', 'f', '2', '0000-00-00'),
('Eu', 'f', 'ð\râ8ª\\Ç0ËyÖ\nùÔ', '0000-00-00'),
('Tete', 'dddd@gmail.com', '¸Æ„NøzŽõÃÄMÒh', '0000-00-00'),
('Eu', 'Eu', 'Eu', '0000-00-00'),
('', '', 'avb', '2019-07-10'),
('EE', 'EEE', 'ER', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL,
  `apelido` varchar(35) NOT NULL,
  `celular` int(11) NOT NULL,
  `senha` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `apelido`, `celular`, `senha`) VALUES
(1, 'Docente', 'Docente', 11111, '11111'),
(2, 'Folege', 'Ricardo', 8222222, 'folege'),
(3, 'Docente', 'Docente', 1111, 'docente'),
(4, 'Docente', 'Docente', 11112, 'docentes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cand`
--
ALTER TABLE `cand`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `exemplo_1`
--
ALTER TABLE `exemplo_1`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `exemplo_2`
--
ALTER TABLE `exemplo_2`
  ADD PRIMARY KEY (`codE`),
  ADD KEY `exemplo_2_ibfk_1` (`cod`);

--
-- Indexes for table `exemplo_3`
--
ALTER TABLE `exemplo_3`
  ADD PRIMARY KEY (`codex`),
  ADD KEY `cod` (`cod`),
  ADD KEY `codE` (`codE`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codPais` (`codPais`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cand`
--
ALTER TABLE `cand`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `candidato`
--
ALTER TABLE `candidato`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exemplo_1`
--
ALTER TABLE `exemplo_1`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exemplo_2`
--
ALTER TABLE `exemplo_2`
  MODIFY `codE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exemplo_3`
--
ALTER TABLE `exemplo_3`
  MODIFY `codex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `exemplo_2`
--
ALTER TABLE `exemplo_2`
  ADD CONSTRAINT `exemplo_2_ibfk_1` FOREIGN KEY (`cod`) REFERENCES `exemplo_1` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `exemplo_3`
--
ALTER TABLE `exemplo_3`
  ADD CONSTRAINT `exemplo_3_ibfk_1` FOREIGN KEY (`cod`) REFERENCES `exemplo_1` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exemplo_3_ibfk_2` FOREIGN KEY (`codE`) REFERENCES `exemplo_2` (`codE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`codPais`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
