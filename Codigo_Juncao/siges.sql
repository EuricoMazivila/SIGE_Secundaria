-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2019 at 04:07 AM
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
-- Database: `siges`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddEscola` (IN `_Nome` VARCHAR(40), IN `_Nivel` ENUM('Secundaria','Primaria'), IN `_Pertenca` ENUM('Publica','Privada'), IN `_id_Dir` INT, IN `_id_End` INT)  NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`, `id_End`) VALUES ( (SELECT `Gera_ID_Escola`(YEAR(CURRENT_DATE))), _Nome, _Nivel,_Pertenca, _id_Dir,_id_End)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddPessoa` (IN `_Nome` VARCHAR(40), IN `_Apelido` VARCHAR(40), IN `_Sexo` ENUM('M','F'), IN `_Estado_Civil` ENUM('Solteiro','Casado'), IN `_Data_Nascimento` DATE, IN `_Email` VARCHAR(100), IN `_Nr_Tell` INT)  NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
INSERT INTO pessoa (id_Pessoa,Nome,Apelido,Sexo,Estado_Civil,Data_Nascimento,Email,Nr_Tell, Data_Cadastro) VALUES ((SELECT `ContaIDpessoa`(YEAR(CURRENT_DATE))),_Nome,_Apelido,_Sexo,_Estado_Civil,_Data_Nascimento,_Email,_Nr_Tell,CURRENT_DATE)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CriarTurma` (IN `_id_Escola` INT(11), IN `_Desiganacao` VARCHAR(40), IN `_id_Classe` TINYINT(4), IN `_Turno` ENUM('Manha','Tarde','Noite'), IN `_Sala` TINYINT(4))  NO SQL
    DETERMINISTIC
    COMMENT 'Permite Gerar Turma'
INSERT INTO `turma` (`id_Turma`, `id_Escola`, `Desiganacao`, `id_Classe`, `Turno`, `Sala`, `Ano`) VALUES ((SELECT `Gera_Id_Turma`(YEAR(CURRENT_DATE), _id_Escola)),_id_Escola, _Desiganacao, _id_Classe, _Turno, _Sala, CURRENT_DATE)$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ContaIDpessoa` (`_Ano` INT(4)) RETURNS INT(9) UNSIGNED NO SQL
    DETERMINISTIC
BEGIN
DECLARE cod int(11);
DECLARE totalP int(11);


SELECT ((_Ano*100000)+(SELECT COUNT(*) FROM pessoa WHERE YEAR(pessoa.Data_Cadastro)=_Ano)+1) as 'Id_Pessoa_Gerado' into cod;

SELECT COUNT(pessoa.id_Pessoa) FROM pessoa WHERE pessoa.id_Pessoa=cod into totalP;
WHILE(totalP!=0)do
set cod=cod+1;
SELECT COUNT(pessoa.id_Pessoa) FROM pessoa WHERE pessoa.id_Pessoa=cod into totalP;
end WHILE;

return cod;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GeraCodRecuperacao` () RETURNS INT(11) NO SQL
    DETERMINISTIC
    COMMENT 'Essa Funcao Permite Gerar codigo de recuperacao aleatorio'
RETURN (SELECT round(rand()*1000000))$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Gera_ID_Escola` (`_Ano` INT(4)) RETURNS INT(9) UNSIGNED NO SQL
    DETERMINISTIC
BEGIN
DECLARE cod int(11);
DECLARE totalP int(11);
SELECT COUNT(escola.id_Escola) into totalP FROM escola WHERE escola.id_Escola LIKE (SELECT concat('%',_Ano,'%'));

SELECT _Ano*10000+totalP+1 into cod;
SELECT COUNT(escola.id_Escola) into totalP FROM escola WHERE escola.id_Escola=cod;

WHILE(totalP!=0)do
set cod=cod+1;
SELECT COUNT(escola.id_Escola) into totalP FROM escola WHERE escola.id_Escola=cod;
end WHILE;


return cod;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Gera_Id_Turma` (`_Ano` INT, `_id_Escola` INT) RETURNS INT(11) NO SQL
    DETERMINISTIC
    COMMENT 'Essa Funcao permite gerar codigo de turma'
return _id_Escola*10000000+_Ano*1000+(SELECT COUNT(*) FROM `turma` WHERE id_Escola=_id_Escola and Ano=_Ano)+1$$

CREATE DEFINER=`root`@`localhost` FUNCTION `RecuperaSenha` (`_id_usuario` INT, `_TipoEnvio` ENUM('Email','Telefone','Ambos'), `_CampoEnvio` VARCHAR(100)) RETURNS INT(11) NO SQL
    COMMENT 'Permite Recuperar Senha'
BEGIN
DECLARE codGerado int(11);
DECLARE dataValidade date;
set codGerado=(SELECT `GeraCodRecuperacao`());
set dataValidade = (SELECT date(DATE_ADD(CURRENT_TIMESTAMP,INTERVAL 1 DAY)));

INSERT INTO `recupera_senha_usuario` (`id_Usuario`, `CodigoRecuperacao`, `Data_Validalidade`, `Senha_Antiga`,  `Tipo_Envio`,`Campo_Envio`) VALUES (_id_usuario,codGerado , dataValidade, (SELECT senha FROM `usuario` WHERE id_User=_id_usuario),_TipoEnvio,_CampoEnvio);

RETURN (SELECT max(recupera_senha_usuario.id_Solicitacao) FROM recupera_senha_usuario WHERE recupera_senha_usuario.id_Usuario=_id_usuario  and recupera_senha_usuario.CodigoRecuperacao=codGerado AND recupera_senha_usuario.Data_Validalidade=dataValidade);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Reg_Endereco` (`id_Dir` INT, `_Bairro` VARCHAR(40), `Nr_Casa` SMALLINT(4), `Nr_Q` SMALLINT(4), `Avenida` VARCHAR(40)) RETURNS INT(11) NO SQL
BEGIN
DECLARE codB int(11);
DECLARE codF int(11);
set codB=0;
set codF=0;
SELECT COUNT(bairro.id_Bairro)into codB FROM bairro WHERE bairro.id_Distriro=id_Dir and bairro.Nome=_Bairro;
if(codB>0)THEN
SELECT bairro.id_Bairro into codB FROM bairro WHERE bairro.id_Distriro=id_Dir and bairro.Nome=_Bairro;
ELSE
INSERT INTO bairro (bairro.id_Distriro,bairro.Nome) VALUES(id_Dir,_Bairro);
SELECT bairro.id_Bairro into codB FROM bairro WHERE bairro.id_Distriro=id_Dir and bairro.Nome=_Bairro;
end if;
INSERT INTO `endereco` (`id_Bairro`, `Nr_casa`, `Nr_Quaterao`, `Avenida_Rua`) VALUES ( codB, Nr_Casa,Nr_Q, Avenida);
SELECT endereco.id_End INTO codF FROM endereco WHERE endereco.id_Bairro=codB and endereco.Nr_casa=Nr_Casa AND endereco.Nr_Quaterao=Nr_Q and endereco.Avenida_Rua=Avenida;

RETURN codF;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Reg_Endereco_Completo` (`_Pais` VARCHAR(40), `_Provincia` VARCHAR(40), `_Distrito` VARCHAR(40), `_Bairro` VARCHAR(40)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE codP int(11);
set codP=0;
SELECT COUNT(*) into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
if(codP>0)then
SELECT bairro.id_Bairro into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
ELSE
INSERT INTO bairro (id_Distriro, `Nome`) VALUES ((SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito)) ,_Bairro);
SELECT bairro.id_Bairro into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
end if;
return codP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Seach_Bairro` (`_Pais` VARCHAR(40), `_Provincia` VARCHAR(40), `_Distrito` VARCHAR(40), `_Bairro` VARCHAR(40)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE codP int(11);
set codP=0;
SELECT COUNT(*) into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
if(codP>0)then
SELECT bairro.id_Bairro into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
ELSE
INSERT INTO bairro (id_Distriro, `Nome`) VALUES ((SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito)) ,_Bairro);
SELECT bairro.id_Bairro into codP FROM bairro WHERE bairro.id_Distriro=(SELECT `Seach_Distrito`(_Pais, _Provincia, _Distrito))  and bairro.Nome=_Bairro;
end if;
return codP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Seach_Distrito` (`_Pais` VARCHAR(40), `_Provincia` VARCHAR(40), `_Distrito` VARCHAR(40)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE codP int(11);
set codP=0;
SELECT COUNT(*) into codP FROM distrito WHERE distrito.id_Prov=(SELECT `Seach_Prov`(_Pais, _Provincia))  and distrito.Nome=_Distrito;
if(codP>0)then
SELECT distrito.id_distrito into codP FROM distrito WHERE distrito.id_Prov=(SELECT `Seach_Prov`(_Pais, _Provincia))  and distrito.Nome=_Distrito;
ELSE
INSERT INTO distrito ( id_Prov, `Nome`) VALUES ((SELECT `Seach_Prov`(_Pais, _Provincia)) ,_Distrito);
SELECT distrito.id_distrito into codP FROM distrito WHERE distrito.id_Prov=(SELECT `Seach_Prov`(_Pais, _Provincia))  and distrito.Nome=_Distrito;
end if;
return codP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Seach_Pais` (`Pais` VARCHAR(40)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE codP int(11);
set codP=0;

SELECT COUNT(*)into codP FROM `pais` WHERE pais.Nome=Pais;
if(codP>0)then
SELECT pais.id_Pais into codP FROM `pais` WHERE pais.Nome=Pais;
ELSE
INSERT INTO `pais` ( `Nome`) VALUES (Pais);
SELECT pais.id_Pais into codP FROM `pais` WHERE pais.Nome=Pais;
end if;
return codP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Seach_Prov` (`Pais` VARCHAR(40), `Provincia` VARCHAR(40)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE codP int(11);
set codP=0;
SELECT COUNT(*)into codP FROM `provincia` WHERE provincia.id_Pais=`Seach_Pais`(Pais) and provincia.Nome=Provincia;
if(codP>0)then
SELECT provincia.id_Prov into codP FROM `provincia` WHERE provincia.id_Pais=`Seach_Pais`(Pais) and provincia.Nome=Provincia;
ELSE
INSERT INTO `provincia` ( `id_Pais`, `Nome`) VALUES (`Seach_Pais`(Pais), Provincia);
SELECT provincia.id_Prov into codP FROM `provincia` WHERE provincia.id_Pais=`Seach_Pais`(Pais) and provincia.Nome=Provincia;
end if;
return codP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `upDateSenha` (`_id` INT, `_nova` VARCHAR(40)) RETURNS TINYINT(1) NO SQL
    COMMENT 'Permite actualizar Senha'
BEGIN
UPDATE `recupera_senha_usuario` SET `Senha_Nova` = _nova WHERE `recupera_senha_usuario`.`id_Solicitacao` =_id;

RETURN (SELECT COUNT(recupera_senha_usuario.id_Solicitacao) FROM recupera_senha_usuario WHERE recupera_senha_usuario.id_Solicitacao=_id and recupera_senha_usuario.Senha_Nova=_nova)>0;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id_Aluno` int(11) NOT NULL,
  `Classe` enum('8','9','10','11','12') NOT NULL DEFAULT '8',
  `Turno` enum('Diurno','Noturno') NOT NULL DEFAULT 'Diurno',
  `id_Escola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id_Aluno`, `Classe`, `Turno`, `id_Escola`) VALUES
(201900003, '8', 'Diurno', 20190002),
(201900004, '8', 'Diurno', 20190001);

-- --------------------------------------------------------

--
-- Table structure for table `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `id_Aluno` int(11) NOT NULL,
  `id_Enc` int(11) NOT NULL,
  `Data_Registo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aluno_encarregado`
--

INSERT INTO `aluno_encarregado` (`id_Aluno`, `id_Enc`, `Data_Registo`) VALUES
(201900003, 1, '2019-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `aluno_escola`
--

CREATE TABLE `aluno_escola` (
  `id_Aluno` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Estado` enum('Ativo','Transferido','Graduado','Desistente') NOT NULL DEFAULT 'Ativo',
  `Data_Ingresso` date NOT NULL,
  `Classe_Ingresso` tinyint(4) NOT NULL,
  `Data_Saida` date NOT NULL,
  `Classe_Saida` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aluno_escola`
--

INSERT INTO `aluno_escola` (`id_Aluno`, `id_Escola`, `Estado`, `Data_Ingresso`, `Classe_Ingresso`, `Data_Saida`, `Classe_Saida`) VALUES
(201900003, 20190001, 'Ativo', '2019-09-01', 0, '2019-09-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `aluno_turma`
--

CREATE TABLE `aluno_turma` (
  `id_Aluno` int(11) NOT NULL,
  `id_Turma` int(11) NOT NULL,
  `Data_Alocacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(11, 3, 'Bobole'),
(9, 3, 'Habel Jafar'),
(8, 8, 'Albazine'),
(6, 8, 'Laulane'),
(7, 8, 'Magoanine'),
(2, 10, 'Bagamoio'),
(1, 10, 'Benfica'),
(4, 10, 'Chopal'),
(5, 10, 'Malhazine'),
(3, 10, 'Missao Rock'),
(10, 12, 'Xongoene');

-- --------------------------------------------------------

--
-- Table structure for table `candidato_matricula`
--

CREATE TABLE `candidato_matricula` (
  `id_Aluno` int(11) NOT NULL,
  `id_Maticula` int(11) NOT NULL,
  `Estado` enum('Pendente','Matriculado') NOT NULL,
  `Escola_Proviniencia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidato_matricula`
--

INSERT INTO `candidato_matricula` (`id_Aluno`, `id_Maticula`, `Estado`, `Escola_Proviniencia`) VALUES
(201900004, 1, 'Pendente', 'Escola Primaria de Bagamoio');

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `id_Cargo` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id_Cargo`, `Designacao`) VALUES
(1, 'Administrador'),
(2, 'Director Geral'),
(3, 'Director Adjunto Geral'),
(4, 'Director Pedagogico'),
(5, 'Director Pedagogico Adjunto'),
(6, 'Secretario'),
(7, 'Professor'),
(8, 'Aluno');

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id_Classe` tinyint(4) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `Secao` varchar(40) NOT NULL DEFAULT 'Geral'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`id_Classe`, `Classe`, `Secao`) VALUES
(1, 8, 'Geral'),
(2, 9, 'Geral'),
(3, 10, 'Geral'),
(6, 11, 'Biologia'),
(5, 11, 'Desenho'),
(4, 11, 'Letras'),
(9, 12, 'Biologia'),
(8, 12, 'Desenho'),
(7, 12, 'Letras');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_log_user`
-- (See below for the actual view)
--
CREATE TABLE `dados_log_user` (
`id_User` int(11)
,`Username` varchar(40)
,`Senha` varchar(40)
,`Email_Instituconal` varchar(100)
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
,`Estado_Civil` enum('Solteiro','Casado')
,`Data_Nascimento` date
,`Email` varchar(100)
,`Nr_tell` int(11)
,`Data_Cadastro` date
);

-- --------------------------------------------------------

--
-- Table structure for table `direcao_distrital`
--

CREATE TABLE `direcao_distrital` (
  `id_Dir` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `direcao_distrital`
--

INSERT INTO `direcao_distrital` (`id_Dir`, `Designacao`, `Total_Escola`) VALUES
(2, 'Manhica', 0),
(3, 'Marracuene', 0),
(8, 'Ka Mahota', 0),
(10, 'Ka Mbucuana', 0);

-- --------------------------------------------------------

--
-- Table structure for table `direcao_escola`
--

CREATE TABLE `direcao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `id_Cargo` int(11) NOT NULL,
  `Data_Colocacao` date NOT NULL,
  `Estado` enum('Ativo','Desativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10, 2, 'Ka-Mubucuana'),
(12, 3, 'Mandjacaze'),
(11, 5, 'Dondo');

-- --------------------------------------------------------

--
-- Table structure for table `encarregado`
--

CREATE TABLE `encarregado` (
  `id_Enc` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Profissao` varchar(40) NOT NULL,
  `id_End` int(11) NOT NULL,
  `Nr_tell` int(11) NOT NULL,
  `Relacao` enum('Pai','Mae','Outro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `encarregado`
--

INSERT INTO `encarregado` (`id_Enc`, `Nome`, `Profissao`, `id_End`, `Nr_tell`, `Relacao`) VALUES
(1, 'Olivia Jose', 'Domestica', 1, 845324398, 'Mae');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `id_End` int(11) NOT NULL,
  `id_Bairro` int(11) NOT NULL,
  `Nr_casa` smallint(4) NOT NULL,
  `Nr_Quaterao` smallint(4) NOT NULL,
  `Avenida_Rua` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`id_End`, `id_Bairro`, `Nr_casa`, `Nr_Quaterao`, `Avenida_Rua`) VALUES
(1, 8, 222, 4, 'Cas'),
(2, 1, 452, 5, 'Mocambique');

-- --------------------------------------------------------

--
-- Table structure for table `escola`
--

CREATE TABLE `escola` (
  `id_Escola` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Nivel` enum('Primario','Secundaria') NOT NULL DEFAULT 'Secundaria',
  `Pertenca` enum('Publica','Privada','Comunitaria') NOT NULL DEFAULT 'Publica',
  `id_Dir` int(11) NOT NULL,
  `id_End` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escola`
--

INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`, `id_End`) VALUES
(20190001, 'Heroes Mocambicanos', 'Secundaria', 'Publica', 10, 1),
(20190002, 'Xinavane', 'Secundaria', 'Publica', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `matricula`
--

CREATE TABLE `matricula` (
  `id_Matricula` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Tipo` enum('Normal','Renovacao') NOT NULL,
  `Ano` year(4) NOT NULL,
  `Data_Inicio` date NOT NULL,
  `Data_Fim` date NOT NULL,
  `Estado` enum('Em curso','Pendete','Terminada') NOT NULL DEFAULT 'Pendete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matricula`
--

INSERT INTO `matricula` (`id_Matricula`, `id_Escola`, `Tipo`, `Ano`, `Data_Inicio`, `Data_Fim`, `Estado`) VALUES
(1, 20190001, 'Normal', 2019, '2019-09-01', '2019-12-01', 'Em curso');

-- --------------------------------------------------------

--
-- Table structure for table `matricula_marcada`
--

CREATE TABLE `matricula_marcada` (
  `id_Matri` int(11) NOT NULL,
  `id_Matricula` int(11) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `Turno` enum('Diurno','Noturno') NOT NULL,
  `Total_Vagas` int(11) NOT NULL DEFAULT '0',
  `Vagas_Preenchidas` int(11) NOT NULL DEFAULT '0',
  `Ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matricula_marcada`
--

INSERT INTO `matricula_marcada` (`id_Matri`, `id_Matricula`, `Classe`, `Turno`, `Total_Vagas`, `Vagas_Preenchidas`, `Ano`) VALUES
(1, 1, 1, 'Diurno', 500, 0, 2019);

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
(1, 'Mocambique'),
(2, 'Angola'),
(3, 'Africa do Sul');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa`
--

CREATE TABLE `pessoa` (
  `id_Pessoa` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Apelido` varchar(40) NOT NULL,
  `Sexo` enum('M','F') NOT NULL DEFAULT 'M',
  `Estado_Civil` enum('Solteiro','Casado') NOT NULL DEFAULT 'Solteiro',
  `Data_Nascimento` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Nr_tell` int(11) NOT NULL,
  `Data_Cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nascimento`, `Email`, `Nr_tell`, `Data_Cadastro`) VALUES
(201900001, 'Candido', 'Barato', 'M', 'Solteiro', '2019-09-01', 'BaratoCandido@gmail.com', 0, '2019-09-01'),
(201900002, 'Paulo', 'Mondlane', 'M', 'Solteiro', '2019-09-01', 'MondlanePaulo@gmail.com', 825794562, '2019-09-17'),
(201900003, 'Eurico', 'Mazivila', 'M', 'Solteiro', '2019-09-01', 'EuricoMazivila@gmail.com', 85123546, '2019-09-17'),
(201900004, 'Absalao', 'Nhatumbo', 'M', 'Solteiro', '2019-09-01', 'NhatumboAbsalao@gmail.com', 0, '2019-09-17');

--
-- Triggers `pessoa`
--
DELIMITER $$
CREATE TRIGGER `Cria_User` AFTER INSERT ON `pessoa` FOR EACH ROW INSERT INTO usuario(id_User,Username,Senha,DataCriacao,Email_Instituconal) VALUES(new.id_Pessoa,(SELECT concat(new.Nome,new.id_Pessoa)),new.Apelido,CURRENT_DATE,(SELECT concat(new.Apelido,'.',new.Nome,'.',new.id_Pessoa,'@sige.ac.mz')))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_documento`
--

CREATE TABLE `pessoa_documento` (
  `id_Pessoa` int(11) NOT NULL,
  `Tipo` enum('Cedula','BI') NOT NULL,
  `Numero` varchar(20) NOT NULL,
  `Data_Emissao` date NOT NULL,
  `Local_Emissao` varchar(40) NOT NULL,
  `Estado` enum('Valido','Invalido') NOT NULL DEFAULT 'Valido',
  `Data_Submissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pessoa_documento`
--

INSERT INTO `pessoa_documento` (`id_Pessoa`, `Tipo`, `Numero`, `Data_Emissao`, `Local_Emissao`, `Estado`, `Data_Submissao`) VALUES
(201900001, 'BI', '111101201145B', '2019-09-01', 'Maputo', 'Valido', '2019-09-17'),
(201900002, 'Cedula', '124596478', '2019-09-01', 'Maputo', 'Valido', '2019-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_endereco`
--

CREATE TABLE `pessoa_endereco` (
  `id_Pessoa` int(11) NOT NULL,
  `id_Endereco` int(11) NOT NULL,
  `Estado` enum('Actual','Substituido') NOT NULL,
  `Data_Registo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pessoa_endereco`
--

INSERT INTO `pessoa_endereco` (`id_Pessoa`, `id_Endereco`, `Estado`, `Data_Registo`) VALUES
(201900001, 1, 'Actual', '2019-09-01'),
(201900002, 2, 'Actual', '2019-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_nascimento`
--

CREATE TABLE `pessoa_nascimento` (
  `id_Pessoa` int(11) NOT NULL,
  `id_Natural` int(11) NOT NULL,
  `NomeMae` varchar(40) NOT NULL,
  `NomePai` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pessoa_nascimento`
--

INSERT INTO `pessoa_nascimento` (`id_Pessoa`, `id_Natural`, `NomeMae`, `NomePai`) VALUES
(201900001, 3, 'Olivia Jose Nnhassengo', 'Ernesto Candido Barato'),
(201900002, 10, 'Dercia Manuel', 'Titos Mondlane');

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
(9, 1, 'Cabo Delgado'),
(3, 1, 'Gaza'),
(4, 1, 'Inhembane'),
(6, 1, 'Manica'),
(1, 1, 'Maputo'),
(2, 1, 'Maputo Cidade'),
(8, 1, 'Nampula'),
(11, 1, 'Niassa'),
(5, 1, 'Sofala'),
(7, 1, 'Tete'),
(10, 1, 'Zambezia'),
(12, 2, 'Luanda');

-- --------------------------------------------------------

--
-- Table structure for table `recupera_senha_usuario`
--

CREATE TABLE `recupera_senha_usuario` (
  `id_Solicitacao` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `CodigoRecuperacao` int(11) NOT NULL,
  `Data_Validalidade` date NOT NULL,
  `Senha_Antiga` varchar(40) NOT NULL,
  `Senha_Nova` varchar(40) NOT NULL,
  `Tipo_Envio` enum('Email','Telefone','Ambos') NOT NULL,
  `Campo_Envio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recupera_senha_usuario`
--

INSERT INTO `recupera_senha_usuario` (`id_Solicitacao`, `id_Usuario`, `CodigoRecuperacao`, `Data_Validalidade`, `Senha_Antiga`, `Senha_Nova`, `Tipo_Envio`, `Campo_Envio`) VALUES
(6, 201900002, 566710, '2019-09-19', 'Mondlane', '', 'Email', 'MondlanePaulo@gmail.com'),
(7, 201900002, 272422, '2019-09-19', 'Mondlane', 'mondlane', 'Email', 'MondlanePaulo@gmail.com'),
(8, 201900001, 613299, '2019-09-19', 'Barato', 'candido', 'Email', 'BaratoCandido@gmail.com'),
(9, 201900002, 623120, '2019-09-19', 'mondlane', 'candido', 'Email', 'MondlanePaulo@gmail.com'),
(10, 201900001, 538128, '2019-09-19', 'candido', 'barato', 'Email', 'BaratoCandido@gmail.com');

--
-- Triggers `recupera_senha_usuario`
--
DELIMITER $$
CREATE TRIGGER `actualizaUsuario` AFTER UPDATE ON `recupera_senha_usuario` FOR EACH ROW UPDATE `usuario` SET `Senha` = new.Senha_Nova WHERE `usuario`.`id_User` = old.id_Usuario
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `turma`
--

CREATE TABLE `turma` (
  `id_Turma` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Desiganacao` varchar(40) NOT NULL,
  `id_Classe` tinyint(4) NOT NULL,
  `Turno` enum('Manha','Tarde','Noite') NOT NULL,
  `Sala` tinyint(4) NOT NULL,
  `Ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turma`
--

INSERT INTO `turma` (`id_Turma`, `id_Escola`, `Desiganacao`, `id_Classe`, `Turno`, `Sala`, `Ano`) VALUES
(1, 20190001, '9A', 1, 'Manha', 1, 2019),
(2, 20190002, '9B', 2, 'Manha', 2, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `user_distrital`
--

CREATE TABLE `user_distrital` (
  `id_user` int(11) NOT NULL,
  `id_Dir` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL DEFAULT 'Ativo',
  `Gestao_Escolas` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Operacoes` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Usuarios` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_distrital`
--

INSERT INTO `user_distrital` (`id_user`, `id_Dir`, `Estado`, `Gestao_Escolas`, `Gestao_Operacoes`, `Gestao_Usuarios`) VALUES
(201900001, 2, 'Ativo', 'S', 'S', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `user_escola`
--

CREATE TABLE `user_escola` (
  `id_User` int(11) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Tipo` enum('Aluno','Professor','Secretaria','Directoria','Admin') NOT NULL DEFAULT 'Aluno',
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_escola`
--

INSERT INTO `user_escola` (`id_User`, `id_Escola`, `Tipo`, `Estado`) VALUES
(201900003, 20190001, 'Admin', 'Ativo'),
(201900002, 20190002, 'Directoria', 'Ativo');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_User` int(11) NOT NULL,
  `Username` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Senha` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Email_Instituconal` varchar(100) NOT NULL,
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

INSERT INTO `usuario` (`id_User`, `Username`, `Senha`, `Email_Instituconal`, `Estado`, `DataCriacao`, `Acesso_Distrital`, `Acesso_Escola`, `Acesso_Aluno`, `Acesso_Professor`, `Acesso_Secretaria`, `Acesso_Convidado`, `Acesso_Candidato`, `Acesso_Adminastrivo`) VALUES
(201900001, 'Candido3', 'barato', 'Barato.Candido.201900001@sige.ac.mz', 'Ativo', '2019-09-17', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(201900002, 'Paulo201900002', 'candido', 'Mondlane.Paulo.201900002@sige.ac.mz', 'Ativo', '2019-09-17', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(201900003, 'Eurico201900003', 'Mazivila', 'Mazivila.Eurico.201900003@sige.ac.mz', 'Ativo', '2019-09-17', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N'),
(201900004, 'Absalao201900004', 'Nhatumbo', 'Nhatumbo.Absalao.201900004@sige.ac.mz', 'Ativo', '2019-09-17', 'N', 'N', 'N', 'N', 'N', 'S', 'N', 'N');

-- --------------------------------------------------------

--
-- Structure for view `dados_log_user`
--
DROP TABLE IF EXISTS `dados_log_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_log_user`  AS  select `usuario`.`id_User` AS `id_User`,`usuario`.`Username` AS `Username`,`usuario`.`Senha` AS `Senha`,`usuario`.`Email_Instituconal` AS `Email_Instituconal`,`usuario`.`Estado` AS `Estado`,`usuario`.`DataCriacao` AS `DataCriacao`,`usuario`.`Acesso_Distrital` AS `Acesso_Distrital`,`usuario`.`Acesso_Escola` AS `Acesso_Escola`,`usuario`.`Acesso_Aluno` AS `Acesso_Aluno`,`usuario`.`Acesso_Professor` AS `Acesso_Professor`,`usuario`.`Acesso_Secretaria` AS `Acesso_Secretaria`,`usuario`.`Acesso_Convidado` AS `Acesso_Convidado`,`usuario`.`Acesso_Candidato` AS `Acesso_Candidato`,`usuario`.`Acesso_Adminastrivo` AS `Acesso_Adminastrivo`,`pessoa`.`id_Pessoa` AS `id_Pessoa`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`pessoa`.`Estado_Civil` AS `Estado_Civil`,`pessoa`.`Data_Nascimento` AS `Data_Nascimento`,`pessoa`.`Email` AS `Email`,`pessoa`.`Nr_tell` AS `Nr_tell`,`pessoa`.`Data_Cadastro` AS `Data_Cadastro` from (`usuario` join `pessoa`) where (`usuario`.`id_User` = `pessoa`.`id_Pessoa`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_Aluno`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD KEY `id_Aluno` (`id_Aluno`),
  ADD KEY `id_Enc` (`id_Enc`);

--
-- Indexes for table `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD PRIMARY KEY (`id_Aluno`,`id_Escola`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD PRIMARY KEY (`id_Aluno`,`id_Turma`),
  ADD KEY `id_Turma` (`id_Turma`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_Bairro`),
  ADD UNIQUE KEY `id_Distriro` (`id_Distriro`,`Nome`);

--
-- Indexes for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD KEY `id_Aluno` (`id_Aluno`),
  ADD KEY `id_Maticula` (`id_Maticula`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_Cargo`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_Classe`),
  ADD UNIQUE KEY `Classe` (`Classe`,`Secao`);

--
-- Indexes for table `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD PRIMARY KEY (`id_Dir`);

--
-- Indexes for table `direcao_escola`
--
ALTER TABLE `direcao_escola`
  ADD KEY `id_Escola` (`id_Escola`),
  ADD KEY `id_Pessoa` (`id_Pessoa`),
  ADD KEY `id_Cargo` (`id_Cargo`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD UNIQUE KEY `id_Prov` (`id_Prov`,`Nome`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`id_Enc`),
  ADD KEY `id_End` (`id_End`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_End`),
  ADD KEY `id_Bairro` (`id_Bairro`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id_Escola`),
  ADD KEY `id_Dir` (`id_Dir`),
  ADD KEY `id_End` (`id_End`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_Matricula`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `matricula_marcada`
--
ALTER TABLE `matricula_marcada`
  ADD PRIMARY KEY (`id_Matri`),
  ADD KEY `id_Matricula` (`id_Matricula`),
  ADD KEY `Classe` (`Classe`);

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
-- Indexes for table `pessoa_documento`
--
ALTER TABLE `pessoa_documento`
  ADD UNIQUE KEY `id_Pessoa` (`id_Pessoa`,`Tipo`,`Estado`),
  ADD UNIQUE KEY `Tipo` (`Tipo`,`Numero`);

--
-- Indexes for table `pessoa_endereco`
--
ALTER TABLE `pessoa_endereco`
  ADD KEY `id_Pessoa` (`id_Pessoa`),
  ADD KEY `id_Endereco` (`id_Endereco`);

--
-- Indexes for table `pessoa_nascimento`
--
ALTER TABLE `pessoa_nascimento`
  ADD KEY `id_Pessoa` (`id_Pessoa`),
  ADD KEY `id_Natural` (`id_Natural`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_Prov`),
  ADD UNIQUE KEY `id_Pais` (`id_Pais`,`Nome`);

--
-- Indexes for table `recupera_senha_usuario`
--
ALTER TABLE `recupera_senha_usuario`
  ADD PRIMARY KEY (`id_Solicitacao`),
  ADD UNIQUE KEY `id_Usuario` (`id_Usuario`,`CodigoRecuperacao`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_Turma`),
  ADD UNIQUE KEY `Turno` (`Turno`,`Sala`,`Ano`,`id_Escola`),
  ADD KEY `id_Classe` (`id_Classe`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `user_distrital`
--
ALTER TABLE `user_distrital`
  ADD PRIMARY KEY (`id_user`) USING BTREE,
  ADD UNIQUE KEY `id_user` (`id_user`,`id_Dir`),
  ADD KEY `id_Dir` (`id_Dir`);

--
-- Indexes for table `user_escola`
--
ALTER TABLE `user_escola`
  ADD KEY `id_User` (`id_User`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_User`) USING BTREE,
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email_Instituconal` (`Email_Instituconal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_Bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_Classe` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `id_Enc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_End` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id_Escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20190003;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_Matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `matricula_marcada`
--
ALTER TABLE `matricula_marcada`
  MODIFY `id_Matri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_Pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201900005;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_Prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `recupera_senha_usuario`
--
ALTER TABLE `recupera_senha_usuario`
  MODIFY `id_Solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id_Turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD CONSTRAINT `aluno_encarregado_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_encarregado_ibfk_2` FOREIGN KEY (`id_Enc`) REFERENCES `encarregado` (`id_Enc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD CONSTRAINT `aluno_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_escola_ibfk_2` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD CONSTRAINT `aluno_turma_ibfk_2` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_turma_ibfk_3` FOREIGN KEY (`id_Turma`) REFERENCES `turma` (`id_Turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`id_Distriro`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD CONSTRAINT `candidato_matricula_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidato_matricula_ibfk_2` FOREIGN KEY (`id_Maticula`) REFERENCES `matricula_marcada` (`id_Matri`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD CONSTRAINT `direcao_distrital_ibfk_1` FOREIGN KEY (`id_Dir`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direcao_escola`
--
ALTER TABLE `direcao_escola`
  ADD CONSTRAINT `direcao_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcao_escola_ibfk_2` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcao_escola_ibfk_3` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_Prov`) REFERENCES `provincia` (`id_Prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD CONSTRAINT `encarregado_ibfk_1` FOREIGN KEY (`id_End`) REFERENCES `endereco` (`id_End`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_Bairro`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_Dir`) REFERENCES `direcao_distrital` (`id_Dir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `escola_ibfk_2` FOREIGN KEY (`id_End`) REFERENCES `endereco` (`id_End`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matricula_marcada`
--
ALTER TABLE `matricula_marcada`
  ADD CONSTRAINT `matricula_marcada_ibfk_2` FOREIGN KEY (`Classe`) REFERENCES `classe` (`id_Classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_marcada_ibfk_3` FOREIGN KEY (`id_Matricula`) REFERENCES `matricula` (`id_Matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pessoa_documento`
--
ALTER TABLE `pessoa_documento`
  ADD CONSTRAINT `pessoa_documento_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pessoa_endereco`
--
ALTER TABLE `pessoa_endereco`
  ADD CONSTRAINT `pessoa_endereco_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pessoa_endereco_ibfk_2` FOREIGN KEY (`id_Endereco`) REFERENCES `endereco` (`id_End`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pessoa_nascimento`
--
ALTER TABLE `pessoa_nascimento`
  ADD CONSTRAINT `pessoa_nascimento_ibfk_1` FOREIGN KEY (`id_Natural`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pessoa_nascimento_ibfk_2` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_Pais`) REFERENCES `pais` (`id_Pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`id_Classe`) REFERENCES `classe` (`id_Classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_distrital`
--
ALTER TABLE `user_distrital`
  ADD CONSTRAINT `user_distrital_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_distrital_ibfk_2` FOREIGN KEY (`id_Dir`) REFERENCES `direcao_distrital` (`id_Dir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_escola`
--
ALTER TABLE `user_escola`
  ADD CONSTRAINT `user_escola_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
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
