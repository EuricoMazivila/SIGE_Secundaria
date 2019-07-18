-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jul-2019 às 05:28
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
-- Database: `siga`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addPessoaP` (IN `_Nome` VARCHAR(35), IN `_Apelido` VARCHAR(35), IN `_Sexo` ENUM('M','F'), IN `_Estado_Civil` ENUM('Solteiro','Casado'), IN `_Data_Nascimento` DATE, IN `_pais` VARCHAR(35), IN `_provincia` VARCHAR(35), IN `_distrito` VARCHAR(35), IN `_paisM` VARCHAR(35), IN `_provinciaM` VARCHAR(35), IN `_distritoM` VARCHAR(35), IN `_bairroM` VARCHAR(35), IN `_quarterao` INT(11), IN `_nrCasa` INT(11), IN `_Nr_Tell` INT(11), IN `_Email` VARCHAR(200))  begin
declare cont int(11) default (0);
if((YEAR(_Data_Nascimento))<=(YEAR(curDate())-10)) then
begin 
INSERT INTO `pessoa` (`Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nascimento`, `id_distrito`, `id_morada`, `Nr_Tell`, `Email`) 
VALUES ( _Nome, _Apelido, _Sexo, _Estado_Civil, _Data_Nascimento, 
(SELECT pegaDistrito(_pais, _provincia, _distrito)), 
(SELECT pegaMorada(_paisM , _provinciaM, _distritoM , _bairroM ,_quarterao , _nrCasa)), _Nr_Tell, _Email);
SELECT count(codP) into cont FROM `pessoa` where Nome=_Nome and Apelido=_Apelido and Sexo=_Sexo and Estado_Civil=_Estado_Civil and `Data_Nascimento`=_Data_Nascimento and id_distrito=(SELECT pegaDistrito(_pais, _provincia, _distrito)) and id_morada=(SELECT pegaMorada(_paisM , _provinciaM, _distritoM , _bairroM ,_quarterao , _nrCasa)) and Nr_Tell=_Nr_Tell and Email=_Email;
end;
else
begin
SELECT 0 into cont;
end;
end if;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `addAluno` (`_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35), `_paisM` VARCHAR(35), `_provinciaM` VARCHAR(35), `_distritoM` VARCHAR(35), `_bairroM` VARCHAR(35), `_quarterao` INT(11), `_nrCasa` INT(11), `_Nr_Tell` INT(11), `_Email` VARCHAR(200), `_Nome_Pai` VARCHAR(35), `_Nome_Mae` VARCHAR(35), `_Profissao_Pai` VARCHAR(35), `_Profissao_Mae` VARCHAR(35), `_Local_Trabalho_Pai` VARCHAR(35), `_Local_Trabalho_Mae` VARCHAR(35), `_nr_Tell_Pai` INT(11), `_nr_Tell_Mae` INT(11), `_classe` ENUM('8','9','10','11','12')) RETURNS INT(11) begin
declare coP int(11);
declare coF int(11);
declare codA int (11) ;
select `addPessoa`(_Nome , `_Apelido` , `_Sexo` , `_Estado_Civil`, `_Data_Nascimento`, `_pais` ,
 `_provincia`, `_distrito` , `_paisM` , `_provinciaM` , `_distritoM`, `_bairroM` , `_quarterao`, 
 `_nrCasa` , `_Nr_Tell` , `_Email`) into coP;
select `pegaFiliacao`(_Nome_Pai , _Nome_Mae , _Profissao_Pai , _Profissao_Mae,_Local_Trabalho_Pai 
, _Local_Trabalho_Mae ,_nr_Tell_Pai ,_nr_Tell_Mae) into coF;
if(select regAluno(_classe , coP ,coF )=0)THEN
SELECT 0 into codA;
else
select regAluno(_classe , coP ,coF ) into codA;

end if;


return codA;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addPessoa` (`_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35), `_paisM` VARCHAR(35), `_provinciaM` VARCHAR(35), `_distritoM` VARCHAR(35), `_bairroM` VARCHAR(35), `_quarterao` INT(11), `_nrCasa` INT(11), `_Nr_Tell` INT(11), `_Email` VARCHAR(200)) RETURNS INT(11) begin
declare cont int(11) default (0);
if((YEAR(_Data_Nascimento))<=(YEAR(curDate())-10)) then
begin 
INSERT INTO `pessoa` (`Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nascimento`, `id_distrito`, `id_morada`, `Nr_Tell`, `Email`) 
VALUES ( _Nome, _Apelido, _Sexo, _Estado_Civil, _Data_Nascimento, 
(SELECT pegaDistrito(_pais, _provincia, _distrito)), 
(SELECT pegaMorada(_paisM , _provinciaM, _distritoM , _bairroM ,_quarterao , _nrCasa)), _Nr_Tell, _Email);
SELECT codP into cont FROM `pessoa` where Nome=_Nome and Apelido=_Apelido and Sexo=_Sexo and Estado_Civil=_Estado_Civil and `Data_Nascimento`=_Data_Nascimento and id_distrito=(SELECT pegaDistrito(_pais, _provincia, _distrito)) and id_morada=(SELECT pegaMorada(_paisM , _provinciaM, _distritoM , _bairroM ,_quarterao , _nrCasa)) and Nr_Tell=_Nr_Tell and Email=_Email;
end;
else
begin
SELECT 0 into cont;
end;
end if;
return cont;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `matricularAluno` (`_codAluno` INT(11), `_classe` ENUM('8','9','10','11','12')) RETURNS TINYINT(1) begin
if(select pegaMatricula(_classe)!=0)then
INSERT INTO `aluno_matricula` (`codAluno`, `codMatricula`, `DataRealizada`) VALUES (_codAluno, (select pegaMatricula(_classe)), curDate());
end if;
return (SELECT COUNT(codAluno) FROM `aluno_matricula` WHERE codMatricula=(select pegaMatricula(_classe))and codAluno=_codAluno) !=0;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaBairro` (`_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35), `_bairro` VARCHAR(35)) RETURNS INT(11) begin
declare cont int(11);
SELECT count(id_bairro) into cont FROM `bairro` WHERE nome=_bairro  and id_distrito=(SELECT pegaDistrito(_pais, _provincia, _distrito));
 if(cont =0) then
	INSERT INTO `bairro` (id_distrito, `Nome`) VALUES ((SELECT pegaDistrito(_pais, _provincia, _distrito)),_bairro);
    end if; 
SELECT id_bairro into cont FROM `bairro` WHERE nome=_bairro  and id_distrito=(SELECT pegaDistrito(_pais, _provincia, _distrito));
    return cont;
   end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaDistrito` (`_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35)) RETURNS INT(11) begin
declare cont int(11);
SELECT count(id_distrito) into cont FROM `distrito` WHERE nome=_distrito and id_prov=(SELECT `pegaProvincia`(_pais, _provincia));
if(cont =0) then
	INSERT INTO `distrito` (`id_Prov`, `Nome`) VALUES ((SELECT `pegaProvincia`(_pais, _provincia)),_distrito);
    end if;
SELECT id_distrito into cont FROM `distrito` WHERE nome=_distrito and id_prov=(SELECT `pegaProvincia`(_pais, _provincia));
   return cont;
   end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaEncarregado` (`_NomeEnc` VARCHAR(35), `_Profissao_Enc` VARCHAR(35), `_Local_Trabalho_Enc` VARCHAR(35), `_nr_Tell_Enc` INT(11), `_paisE` VARCHAR(35), `_provinciaE` VARCHAR(35), `_distritoE` VARCHAR(35), `_bairroE` VARCHAR(35)) RETURNS INT(11) begin
 declare cont int(11);
 SELECT COUNT(id_Encarregado) into cont FROM `encarregado` WHERE Nome=_NomeEnc and Profissao=_Profissao_Enc and id_morada=(select `pegaBairro`(_pais , _provincia  , _distrito  , _bairro )) and Nr_Tell= _nr_Tell_Enc and local_Trab=_Local_Trabalho_Enc;
 if(cont =0) then
	INSERT INTO `encarregado` (`id_Encarregado`, `Nome`, `Profissao`, `id_morada`, `Nr_Tell`, `local_Trab`) VALUES ( _NomeEnc, _Profissao_Enc, (select `pegaBairro`(_paisE , _provinciaE  , _distritoE  , _bairroE )), _nr_Tell_Enc,_Local_Trabalho_Enc);
    end if;
    SELECT id_Encarregado into cont FROM `encarregado` WHERE Nome=_NomeEnc and Profissao=_Profissao_Enc and id_morada=(select `pegaBairro`(_paisE , _provinciaE  , _distritoE  , _bairroE )) and Nr_Tell= _nr_Tell_Enc and local_Trab=_Local_Trabalho_Enc;
return cont;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaFiliacao` (`_Nome_Pai` VARCHAR(35), `_Nome_Mae` VARCHAR(35), `_Profissao_Pai` VARCHAR(35), `_Profissao_Mae` VARCHAR(35), `_Local_Trabalho_Pai` VARCHAR(35), `_Local_Trabalho_Mae` VARCHAR(35), `_nr_Tell_Pai` INT(11), `_nr_Tell_Mae` INT(11)) RETURNS INT(11) begin
declare cont int(11);
SELECT COUNT(id_Fial) into cont FROM `filiacao` WHERE Nome_Pai=_Nome_Pai and Nome_Mae=_Nome_Mae 
and Profissao_Pai=_Profissao_Pai and Profissao_Mae=_Profissao_Mae and 
Local_Trabalho_Pai=_Local_Trabalho_Pai and Local_Trabalho_Mae=_Local_Trabalho_Mae 
and nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae;
if(cont =0) then
	INSERT INTO `filiacao` ( `Nome_Pai`, `Nome_Mae`, `Profissao_Pai`, `Profissao_Mae`,
    `Local_Trabalho_Pai`, `Local_Trabalho_Mae`, `nr_Tell_Pai`, `nr_Tell_Mae`) 
    VALUES (_Nome_Pai , _Nome_Mae , _Profissao_Pai , _Profissao_Mae ,_Local_Trabalho_Pai , 
    _Local_Trabalho_Mae ,_nr_Tell_Pai ,_nr_Tell_Mae );
    end if; 
SELECT id_Fial into cont FROM `filiacao` WHERE Nome_Pai=_Nome_Pai and Nome_Mae=_Nome_Mae 
and Profissao_Pai=_Profissao_Pai and Profissao_Mae=_Profissao_Mae and 
Local_Trabalho_Pai=_Local_Trabalho_Pai and Local_Trabalho_Mae=_Local_Trabalho_Mae 
and nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae;
    return cont;
   end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaMatricula` (`_classe` ENUM('8','9','10','11','12')) RETURNS INT(11) begin
declare cod int(11) default(0);
SELECT count(id_Matricula) into cod  FROM `matricula_classe` where codMatri=(SELECT codMatri  FROM `matricula` WHERE curDate() BETWEEN dataI AND dataF) and codClasse=(SELECT codClasse FROM `classe` WHERE classe=_classe);
if(cod!=0) then
SELECT id_Matricula into cod  FROM `matricula_classe` where codMatri=(SELECT codMatri  FROM `matricula` WHERE curDate() BETWEEN dataI AND dataF) and codClasse=(SELECT codClasse FROM `classe` WHERE classe=_classe);
end if;
return cod;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaMorada` (`_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35), `_bairro` VARCHAR(35), `_quarterao` INT(11), `_nrCasa` INT(11)) RETURNS INT(11) begin
declare cont int(11);
SELECT count(id_morada) into cont FROM residencia where id_Bairro=(SELECT pegaBairro(_pais , _provincia , _distrito , _bairro )) and Quarterao=_quarterao and Nr_Casa=_nrCasa;
if(cont =0) then
	INSERT INTO `residencia` ( `id_Bairro`, `Quarterao`, `Nr_Casa`) VALUES ( (SELECT pegaBairro(_pais , _provincia , _distrito , _bairro )), _quarterao, _nrCasa);
    end if; 
SELECT id_morada into cont FROM residencia where id_Bairro=(SELECT pegaBairro(_pais , _provincia , _distrito , _bairro )) and Quarterao=_quarterao and Nr_Casa=_nrCasa;
    return cont;
   end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaPais` (`_pais` VARCHAR(35)) RETURNS INT(11) begin
declare cont int(11);
SELECT count(id_pais) into cont FROM `paises` WHERE nome=_pais;
if(cont =0) then
	INSERT INTO `paises` ( `Nome`) VALUES ( _pais);
    end if;
SELECT id_pais into cont FROM `paises` WHERE nome=_pais;
    return cont;
    end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaProvincia` (`_pais` VARCHAR(35), `_provincia` VARCHAR(35)) RETURNS INT(11) begin
declare cont int(11);
SELECT count(id_prov) into cont FROM `provincia` WHERE nome=_provincia and id_pais=(SELECT `pegaPais`(_pais));
if(cont =0) then
	INSERT INTO `provincia` ( `id_Pais`, `Nome`) VALUES ( (SELECT `pegaPais`(_pais)), _provincia);
    end if;
SELECT id_prov into cont FROM `provincia` WHERE nome=_provincia and id_pais=(SELECT `pegaPais`(_pais));
    return cont;
    end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `preMatricula` (`_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_pais` VARCHAR(35), `_provincia` VARCHAR(35), `_distrito` VARCHAR(35), `_paisM` VARCHAR(35), `_provinciaM` VARCHAR(35), `_distritoM` VARCHAR(35), `_bairroM` VARCHAR(35), `_quarterao` INT(11), `_nrCasa` INT(11), `_Nr_Tell` INT(11), `_Email` VARCHAR(200), `_Nome_Pai` VARCHAR(35), `_Nome_Mae` VARCHAR(35), `_Profissao_Pai` VARCHAR(35), `_Profissao_Mae` VARCHAR(35), `_Local_Trabalho_Pai` VARCHAR(35), `_Local_Trabalho_Mae` VARCHAR(35), `_nr_Tell_Pai` INT(11), `_nr_Tell_Mae` INT(11), `_classe` ENUM('8','9','10','11','12'), `_Nome_enc` VARCHAR(35), `_Profissao_Enc` VARCHAR(35), ` _Local_Trabalho_Enc` VARCHAR(35), `_nr_Tell_Enc` INT, `_paisE` VARCHAR(35), `_provinciaE` VARCHAR(35), ` _distritoE` VARCHAR(35), `_bairroE` VARCHAR(35)) RETURNS TINYINT(1) begin
declare codA int(11);
declare codE int(11);
select `addAluno`(`_Nome` , `_Apelido` , `_Sexo`, `_Estado_Civil` , `_Data_Nascimento` , `_pais`,
 `_provincia`, `_distrito` , `_paisM` , `_provinciaM` , `_distritoM` , `_bairroM` , `_quarterao` ,
 `_nrCasa` , `_Nr_Tell` , `_Email` , `_Nome_Pai` , `_Nome_Mae` , `_Profissao_Pai` , `_Profissao_Mae`,
 `_Local_Trabalho_Pai`, `_Local_Trabalho_Mae` , `_nr_Tell_Pai` , `_nr_Tell_Mae` , `_classe` ) into codA;
 if(codA!=0 and (select pegaEncarregado(_NomeEnc  ,_Profissao_Enc  , _Local_Trabalho_Enc  ,_nr_Tell_Enc  ,_paisE , _provinciaE  , _distritoE  , _bairroE ))!=0) then
 INSERT INTO `aluno_encarregado` (`id_aluno`, `id_Encarregado`, `Data_inicio`) VALUES (codA, (select pegaEncarregado(_NomeEnc  ,_Profissao_Enc  , _Local_Trabalho_Enc  ,_nr_Tell_Enc  ,_paisE , _provinciaE  , _distritoE  , _bairroE )), curDate());
 end if;
 
 return (SELECT matricularAluno(codA,_classe)=1);
 
 
 end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regAluno` (`_classe` ENUM('8','9','10','11','12'), `_codP` INT(11), `_codF` INT(11)) RETURNS INT(11) begin
declare coP int(11);
declare coF int (11);
declare codA int (11);
SELECT count(cod_Aluno) into codA FROM `aluno` where id_classe=_classe and codP=_codP and id_filiacao=_codF;
SELECT count(codP) into coP FROM `pessoa` WHERE codP=_codP;
SELECT count(id_Fial) into coF FROM `filiacao` WHERE filiacao.id_Fial=_codF;
if(coP>0 and coF>0 and codA=0)then
begin
	INSERT INTO `aluno` ( `id_classe`, `codP`, `id_filiacao`) VALUES (_classe,  _codP, _codF);
	SELECT count(cod_Aluno) into codA FROM `aluno` where id_classe=_classe and codP=_codP and id_filiacao=_codF;
end;
end if;
if(codA>0) then
		SELECT cod_Aluno into codA FROM `aluno` where id_classe=_classe and codP=_codP and id_filiacao=_codF;
	else
		select 0 into codA;
	end if;
return codA; 
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `cod_Aluno` int(11) NOT NULL,
  `id_turma` tinyint(4) NOT NULL,
  `id_classe` enum('8','9','10','11','12') NOT NULL,
  `codP` int(11) NOT NULL,
  `Estado` enum('Ativo','Transferido','Graduado','Desistente') NOT NULL DEFAULT 'Ativo',
  `id_filiacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`cod_Aluno`, `id_turma`, `id_classe`, `codP`, `Estado`, `id_filiacao`) VALUES
(1, 1, '8', 1, 'Ativo', 1),
(3, 0, '8', 8, 'Ativo', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `id_aluno` int(11) NOT NULL,
  `id_Encarregado` int(11) NOT NULL,
  `Data_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `codAluno` int(11) NOT NULL,
  `codMatricula` int(11) NOT NULL,
  `Estado` enum('Pendente','Matriculado') NOT NULL DEFAULT 'Pendente',
  `DataRealizada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_matricula`
--

INSERT INTO `aluno_matricula` (`codAluno`, `codMatricula`, `Estado`, `DataRealizada`) VALUES
(1, 1, 'Pendente', '2019-05-30'),
(3, 1, 'Pendente', '2019-05-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula_funcionario`
--

CREATE TABLE `aluno_matricula_funcionario` (
  `codAluno` int(11) NOT NULL,
  `codMatri` int(11) NOT NULL,
  `id_Funcionario` int(11) NOT NULL,
  `DataRealizada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_turma`
--

CREATE TABLE `aluno_turma` (
  `id_aluno` int(11) NOT NULL,
  `id_turma` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_turma`
--

INSERT INTO `aluno_turma` (`id_aluno`, `id_turma`) VALUES
(1, 1);

--
-- Acionadores `aluno_turma`
--
DELIMITER $$
CREATE TRIGGER `addAluno_Turma` AFTER INSERT ON `aluno_turma` FOR EACH ROW BEGIN
if(YEAR(curDate())>=(SELECT ano FROM `turma` where id_Turma= new.id_turma)) then
UPDATE `aluno` SET `id_turma` = new.id_turma, id_classe=(select id_classe from turma where id_turma=new.id_turma) WHERE `aluno`.`cod_Aluno` = new.id_aluno;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `id_Bairro` int(11) NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`id_Bairro`, `id_distrito`, `Nome`) VALUES
(2, 1, 'Bobole'),
(1, 1, 'Mateque'),
(4, 1, 'Ricatla'),
(3, 2, 'Marinha'),
(5, 7, 'Albazine'),
(11, 7, 'Laulane'),
(6, 8, 'Matola Rio'),
(7, 10, 'Mineiro'),
(13, 11, ''),
(8, 12, ''),
(9, 13, 'Mateque'),
(14, 21, 'Marragra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro_descicao`
--

CREATE TABLE `bairro_descicao` (
  `id_Bairro` int(11) DEFAULT NULL,
  `Bairro` varchar(20) DEFAULT NULL,
  `distrito` varchar(35) DEFAULT NULL,
  `Provincia` varchar(35) DEFAULT NULL,
  `Pais` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `codClasse` tinyint(4) NOT NULL,
  `classe` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`codClasse`, `classe`) VALUES
(1, '8'),
(2, '9'),
(3, '10'),
(4, '11'),
(5, '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` tinyint(4) NOT NULL,
  `Descricao` varchar(50) NOT NULL,
  `Tipo` enum('Geral','A','B','C') NOT NULL DEFAULT 'Geral'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `Descricao`, `Tipo`) VALUES
(1, 'Portugues', 'Geral'),
(2, 'Matematica', 'Geral'),
(3, 'Fisica', 'Geral'),
(4, 'Biologia', 'B'),
(5, 'Agropecuaria', 'B'),
(6, 'Quimica', 'Geral'),
(7, 'Historia', 'A'),
(8, 'Educação Física', 'Geral'),
(9, 'Desenho e Geometria Discritiva', 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `id_Prov` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `id_Prov`, `Nome`) VALUES
(2, 1, 'Ka Tembe'),
(1, 1, 'Marracuene'),
(3, 2, 'Chokee'),
(4, 2, 'Mandjacaze'),
(5, 2, 'Xai-Xai'),
(6, 5, 'Maxixe'),
(8, 6, 'Boane'),
(7, 6, 'Mahota'),
(21, 6, 'Manhica'),
(13, 6, 'Marracuene'),
(9, 7, 'Durban'),
(10, 8, 'Muatize'),
(11, 9, ''),
(12, 10, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `codP` int(11) NOT NULL,
  `Tipo` enum('BI','Cedula','NUIT','Outro') NOT NULL DEFAULT 'BI',
  `Numero` varchar(20) NOT NULL,
  `Local_Emissao` varchar(20) NOT NULL,
  `Data_Emissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `id_Encarregado` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Profissao` varchar(20) NOT NULL,
  `id_morada` int(11) NOT NULL,
  `Nr_Tell` int(11) NOT NULL,
  `local_Trab` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encarregado`
--

INSERT INTO `encarregado` (`id_Encarregado`, `Nome`, `Profissao`, `id_morada`, `Nr_Tell`, `local_Trab`) VALUES
(1, 'Ernesto Candido', 'Professor', 1, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `id_Fial` int(11) NOT NULL,
  `Nome_Pai` varchar(35) NOT NULL,
  `Nome_Mae` varchar(35) NOT NULL,
  `Profissao_Pai` varchar(35) NOT NULL,
  `Profissao_Mae` varchar(35) NOT NULL,
  `Local_Trabalho_Pai` varchar(35) NOT NULL,
  `Local_Trabalho_Mae` varchar(35) NOT NULL,
  `nr_Tell_Pai` int(11) NOT NULL,
  `nr_Tell_Mae` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filiacao`
--

INSERT INTO `filiacao` (`id_Fial`, `Nome_Pai`, `Nome_Mae`, `Profissao_Pai`, `Profissao_Mae`, `Local_Trabalho_Pai`, `Local_Trabalho_Mae`, `nr_Tell_Pai`, `nr_Tell_Mae`) VALUES
(1, 'Ernesto Candido', 'Olivia Jose', 'Pedreiro', 'Domestica', 'Maputo', 'Em casa', 847539621, 824561237),
(9, '', '', '', '', '', '', 0, 0),
(10, 'Nelson', 'Marcia', 'Carpiteiro', 'Seguranca', 'Maputo', 'Matola', 84759631, 84231452);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_func` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `Carreira` enum('Professor','Administrativo','Secretaria','Outro') NOT NULL DEFAULT 'Outro',
  `Data_Admin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `funcionario`
--
DELIMITER $$
CREATE TRIGGER `addFuncionario` AFTER INSERT ON `funcionario` FOR EACH ROW BEGIN
if(new.carreira='Professor') then
INSERT INTO `professor` ( `id_func`, `Data_inicio`) VALUES (New.id_func, curDate());
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_matricular`
--

CREATE TABLE `funcionario_matricular` (
  `id_Func` int(11) NOT NULL,
  `id_Matricula` int(11) NOT NULL,
  `DataR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `local_nascmento`
--

CREATE TABLE `local_nascmento` (
  `id_distrito` int(11) DEFAULT NULL,
  `distrito` varchar(35) DEFAULT NULL,
  `Provincia` varchar(35) DEFAULT NULL,
  `Pais` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
