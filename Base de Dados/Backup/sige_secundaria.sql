-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jul-2019 às 05:29
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
-- Database: `sige_secundaria`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `TansacaoAddAluno` ()  BEGIN
DECLARE contS int(11) DEFAULT(0);
if(contS=0) THEN
ROLLBACK;
ELSE
IF(contS>0)THEN
COMMIT;
end if;
end if;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `addAlunoS` (`_classe` ENUM('8','9','10','11','12'), `_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Data_Nasc` DATE, `_nrCasa` TINYINT(4), `_querterao` TINYINT(4), `_Avenida` VARCHAR(35), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_distritoN` VARCHAR(35), `_provinciaN` VARCHAR(35), `_paisN` VARCHAR(35), `_sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Tipo` ENUM('BI','Cedula'), `_Numero` VARCHAR(20), `_LocalEmissao` VARCHAR(20), `_DataEmissao` DATE, `_NomePai` VARCHAR(35), `_NomeMae` VARCHAR(35), `_ProfissaoPai` VARCHAR(35), `_ProfissaoMae` VARCHAR(35), `_LocalTrabPai` VARCHAR(35), `_LocalTrabMae` VARCHAR(35), `_NrTellPai` INT(11), `_NrTellMae` INT(11)) RETURNS INT(11) BEGIN
declare _id_Pessoa int(11);
declare _id_Filiacao int(11);
declare contS int(11) default(0);
select `regePessoaS`(`_Nome`, `_Apelido`, `_Data_Nasc`, `_nrCasa` , `_querterao` ,
 `_Avenida`, `_bairro` , `_distrito`, `_provincia`, `_pais` , `_nr_Tell` , `_Email`,
 `_distritoN`, `_provinciaN`, `_paisN` , `_sexo` , `_Estado_Civil`, `_Tipo`, `_Numero`,
 `_LocalEmissao`, `_DataEmissao`) into _id_Pessoa;
select `regeFiliacao`(`_NomePai`, `_NomeMae`, `_ProfissaoPai` , `_ProfissaoMae`, 
`_LocalTrabPai` , `_LocalTrabMae` , `_NrTellPai`, `_NrTellMae`) into _id_Filiacao;
select `regeAluno`(_id_Pessoa , _id_Filiacao , _classe) into contS;


return contS;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addEncarregado` (`_Nome` VARCHAR(35), `_Profissao` VARCHAR(35), `_LocalTrab` VARCHAR(35), `_NrTell` INT(11), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35)) RETURNS INT(11) BEGIN
DECLARE contS int(11) DEFAULT(0);
declare contM int(11);
SELECT count(id_Encarregado) into contS FROM `encarregado` WHERE nr_Tell=_NrTell;
if(contS=0)then
select `regeBairro`(`_bairro` , `_distrito`,`_provincia` , `_pais`) into contM;
INSERT INTO `encarregado` ( `Nome`, `Profissao`, `LocalTrab`, `id_morada`, `nr_Tell`) VALUES (`_Nome`, `_Profissao`, `_LocalTrab`,contM,_NrTell);
end if;

SELECT count(id_Encarregado) into contS FROM `encarregado` WHERE nr_Tell=_NrTell;
if(contS>0)then
SELECT id_Encarregado into contS FROM `encarregado` WHERE nr_Tell=_NrTell;
end if;
RETURN contS;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addFiliacao` (`_NomePai` VARCHAR(35), `_NomeMae` VARCHAR(35), `_ProfissaoPai` VARCHAR(35), `_ProfissaoMae` VARCHAR(35), `_LocalTrabPai` VARCHAR(35), `_LocalTrabMae` VARCHAR(35), `_nr_Tell_Pai` INT(11), `_nr_Tell_Mae` INT(11)) RETURNS INT(11) BEGIN
DECLARE contS int(11) DEFAULT(0);
DECLARE contT int(11);
SELECT COUNT(id_Filiacao) into contS FROM filiacao WHERE nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae and filiacao.NomePai LIKE _NomePai and filiacao.NomeMae LIKE _NomeMae;
SELECT COUNT(id_Filiacao) into contT FROM filiacao WHERE nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae;
if(contS=0 and contT=0)then
INSERT INTO `filiacao` ( `NomePai`, `NomeMae`, `ProfissaoPai`, `ProfissaoMae`, `LocalTrabPai`, `LocalTrabMae`, `nr_Tell_Pai`, `nr_Tell_Mae`) VALUES (`_NomePai`, `_NomeMae`, `_ProfissaoPai`, `_ProfissaoMae`, `_LocalTrabPai`, `_LocalTrabMae`, `_nr_Tell_Pai`, `_nr_Tell_Mae`);
end if;

SELECT COUNT(id_Filiacao) into contS FROM filiacao WHERE nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae and filiacao.NomePai LIKE _NomePai and filiacao.NomeMae LIKE _NomeMae;

if(contS>0)THEN
SELECT id_Filiacao into contS FROM filiacao WHERE nr_Tell_Pai=_nr_Tell_Pai and nr_Tell_Mae=_nr_Tell_Mae and filiacao.NomePai LIKE _NomePai and filiacao.NomeMae LIKE _NomeMae;
end if;

RETURN contS;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addPessoa` (`_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_DataNasc` DATE, `_id_Morada` INT(11), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_id_Nasc` INT(11), `_sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado')) RETURNS INT(11) BEGIN
DECLARE contP int(11);
select `pesquisaPessoa`(_id_Morada,_nr_Tell, _Email, _id_Nasc) into contP;
if(contP=0)then
INSERT INTO `pessoa` (`Nome`, `Apelido`,`Sexo`,`Estado_Civil`, `Data_Nasc`, `id_Morada`, `nr_Tell`, `Email`, `id_Nasc`)
VALUES (_Nome,_Apelido,_sexo,_Estado_Civil,  _DataNasc,_id_Morada,_nr_Tell, _Email, _id_Nasc);
end if;
select `pesquisaPessoa`(_id_Morada,_nr_Tell, _Email, _id_Nasc) into contP;
return contP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addPre_Matricula` (`_classe` ENUM('8','9','10','11','12'), `_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Data_Nasc` DATE, `_nrCasa` TINYINT(4), `_querterao` TINYINT(4), `_Avenida` VARCHAR(35), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_distritoN` VARCHAR(35), `_provinciaN` VARCHAR(35), `_paisN` VARCHAR(35), `_sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Tipo` ENUM('BI','Cedula'), `_Numero` VARCHAR(20), `_LocalEmissao` VARCHAR(20), `_DataEmissao` DATE, `_NomePai` VARCHAR(35), `_NomeMae` VARCHAR(35), `_ProfissaoPai` VARCHAR(35), `_ProfissaoMae` VARCHAR(35), `_LocalTrabPai` VARCHAR(35), `_LocalTrabMae` VARCHAR(35), `_nr_Tell_Pai` INT(11), `_nr_Tell_Mae` INT(11), `_NomeE` VARCHAR(35), `_ProfissaoE` VARCHAR(35), `_LocalTrabE` VARCHAR(35), `_NrTellE` INT(11), `_bairroE` VARCHAR(35), `_distritoE` VARCHAR(35), `_provinciaE` VARCHAR(35), `_paisE` VARCHAR(35)) RETURNS INT(11) BEGIN
declare codP int(11);
declare codF int(11);
declare codX int(11);
declare codS int(11) default(0);
select `regePessoaS`(`_Nome`, `_Apelido`, `_Data_Nasc`, `_nrCasa`, `_querterao`, `_Avenida`, `_bairro`, `_distrito`,
 `_provincia` , `_pais`, `_nr_Tell`, `_Email`, `_distritoN` , `_provinciaN`, `_paisN`, `_sexo` , `_Estado_Civil`,
 `_Tipo` , `_Numero` , `_LocalEmissao`, `_DataEmissao`) into codP;
select `addFiliacao`(`_NomePai`, `_NomeMae`, `_ProfissaoPai` , `_ProfissaoMae`, `_LocalTrabPai`, `_LocalTrabMae`, `_nr_Tell_Pai` , `_nr_Tell_Mae`) into codF;
if(codP>0 and codF>0) then
select `regeAluno`(codP, codF, `_classe`) into codS;
if(codS>0)then
select `addEncarregado`(`_NomeE`, `_ProfissaoE`, `_LocalTrabE` , `_NrTellE`, `_bairroE`, `_distritoE`, `_provinciaE`,`_paisE` ) into codX;
if(codX>0)then
INSERT INTO `aluno_encarregado` (`id_aluno`, `id_Encarregado`, `Data_inicio`) VALUES (codS,codX, curDate());
end if;
end if;
end if;

return codS;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `AlunoMatricular` (`_id_aluno` INT, `_classe` ENUM('8','9','10','11','12')) RETURNS TINYINT(1) begin
DECLARE contS int(11)DEFAULT(0);
declare codM int(11);
declare codF int(11);
select pegaMatricula(_classe) into codM;
if(codM>0) THEN
SELECT COUNT(id_aluno) into codF FROM `aluno` where id_aluno=_id_aluno;
SELECT COUNT(id_Aluno) into contS FROM `aluno_matricula` WHERE id_Aluno=_id_aluno and id_Matricula=codM;
if(codM>0 and codF>0 and contS=0)then
INSERT INTO `aluno_matricula` (`id_Aluno`, `id_Matricula`, `DataRealizada`) VALUES (_id_aluno, codM, CURRENT_DATE);
SELECT COUNT(id_Aluno) into contS FROM `aluno_matricula` WHERE id_Aluno=_id_aluno and id_Matricula=codM;
end if;
end if;
return (contS>0);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pegaMatricula` (`_classe` ENUM('8','9','10','11','12')) RETURNS INT(11) begin
declare cod int(11) default(0);
DECLARE contS int(11);
SELECT COUNT(dados_matricula.id_matri) into contS FROM `dados_matricula` WHERE dados_matricula.classe=_classe and CURRENT_DATE BETWEEN dados_matricula.DataI and dados_matricula.DataF;
if(contS>0) then
SELECT dados_matricula.id_matri into cod  FROM `dados_matricula` WHERE dados_matricula.classe=_classe and CURRENT_DATE BETWEEN dados_matricula.DataI and dados_matricula.DataF;
end if;
return cod;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pesquisaAluno` (`_id_Pessoa` INT(11), `_id_Filiacao` INT(11)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE contS int(11) DEFAULT(0);
SELECT COUNT(id_aluno) into contS FROM `aluno` WHERE id_Pessoa=_id_Pessoa and id_Filiacao=_id_Filiacao;
if(contS>0)then
SELECT id_aluno into contS FROM `aluno` WHERE id_Pessoa=_id_Pessoa and id_Filiacao=_id_Filiacao;
end if;
return contS;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pesquisaPessoa` (`_id_Morada` INT(11), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_id_Nasc` INT(11)) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE contS int(11) DEFAULT(0);
SELECT COUNT(id_Pessoa) into contS FROM `pessoa` WHERE nr_Tell=_nr_Tell and Email=_Email and pessoa.id_Morada=_id_Morada AND pessoa.id_Nasc=_id_Nasc;
if(contS>0)then
SELECT id_Pessoa into contS FROM `pessoa` WHERE nr_Tell=_nr_Tell and Email=_Email and pessoa.id_Morada=_id_Morada AND pessoa.id_Nasc=_id_Nasc;
end if;
return contS;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regeAluno` (`_id_Pessoa` INT(11), `_id_Filiacao` INT(11), `_classe` ENUM('8','9','10','11','12')) RETURNS INT(11) NO SQL
    DETERMINISTIC
BEGIN
DECLARE contS int(11) DEFAULT(0);
DECLARE contC int(11);
DECLARE contP int(11);
DECLARE contF int(11);
DECLARE contA int(11);
SELECT pesquisaAluno(_id_Pessoa , _id_Filiacao ) into contS;
if(contS=0) THEN
SELECT COUNT(id_Pessoa) into contP FROM `pessoa` WHERE id_Pessoa=_id_Pessoa;
SELECT COUNT(id_Filiacao) into contF FROM `filiacao` WHERE id_Filiacao=_id_Filiacao;
SELECT COUNT(id_classe) into contC FROM `classe` WHERE classe=_classe;
SELECT COUNT(aluno.id_Aluno) into contA from aluno WHERE aluno.id_Pessoa=_id_Pessoa;
if(contC>0 and contP>0 and contF>0 and contA=0)THEN
INSERT INTO `aluno` ( `id_Pessoa`, `id_Classe`, `id_Filiacao`) VALUES ( _id_Pessoa, (SELECT id_classe FROM `classe` WHERE classe=_classe), _id_Filiacao);
end if;
end if;
SELECT pesquisaAluno(_id_Pessoa , _id_Filiacao ) into contS;
if(contS>0)THEN
select  `AlunoMatricular`(contS, _classe)into _id_Pessoa ;
end if;

return contS;

end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regeBairro` (`_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35)) RETURNS INT(11) BEGIN
declare contD int(11);
declare contT int(11);
declare contS int (11) default(0);
SELECT COUNT(descricao_bairro.id_bairro) into contT FROM `descricao_bairro` WHERE descricao_bairro.Bairro=_bairro and descricao_bairro.Distrito=_distrito and descricao_bairro.Provincia=_provincia and descricao_bairro.Pais=_pais;
 if(contT=0) then
 select `regeNasc` (_distrito ,_provincia ,_pais) into contD;
SELECT COUNT(id_Bairro) into contT FROM `bairro` WHERE id_distrito=contD and Nome=_bairro;
if(contT=0 and contD>0) then
INSERT INTO `bairro` ( `id_distrito`, `Nome`) VALUES ( contD, _bairro);
end if;
end if;
SELECT COUNT(descricao_bairro.id_bairro) into contT FROM `descricao_bairro` WHERE descricao_bairro.Bairro=_bairro and descricao_bairro.Distrito=_distrito and descricao_bairro.Provincia=_provincia and descricao_bairro.Pais=_pais;
if(contT>0) then
SELECT descricao_bairro.id_bairro into contS FROM `descricao_bairro` WHERE descricao_bairro.Bairro=_bairro and descricao_bairro.Distrito=_distrito and descricao_bairro.Provincia=_provincia and descricao_bairro.Pais=_pais;
end if;
return contS;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regeDoc` (`_id_Pessoa` INT(11), `_Tipo` ENUM('BI','Cedula'), `_Numero` VARCHAR(20), `_LocalEmissao` VARCHAR(20), `_DataEmissao` DATE) RETURNS TINYINT(1) NO SQL
BEGIN
DECLARE contP int(11);
DECLARE contR int(11);
SELECT COUNT(id_Pessoa) into contR FROM `pessoa` WHERE id_Pessoa=_id_Pessoa;
SELECT COUNT(DataEmissao) into contP FROM `documentos` WHERE id_Pessoa=_id_Pessoa and Tipo=_Tipo;
if(contP=0 and contR>0)then
if(_DataEmissao BETWEEN (SELECT data_Nasc FROM `pessoa` WHERE id_Pessoa=_id_Pessoa) and CURRENT_DATE)then
INSERT INTO `documentos` (`id_Pessoa`, `Tipo`, `Numero`, `LocalEmissao`, `DataEmissao`) VALUES (_id_Pessoa, _Tipo,_Numero, _LocalEmissao, _DataEmissao);
ELSE
INSERT INTO `documentos` (`id_Pessoa`, `Tipo`, `Numero`, `LocalEmissao`, `DataEmissao`) VALUES (_id_Pessoa, _Tipo,_Numero, _LocalEmissao, CURRENT_DATE);
end if;
end if;
SELECT COUNT(DataEmissao) into contP FROM `documentos` WHERE id_Pessoa=_id_Pessoa and Tipo=_Tipo;
return(contP>0);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regeMorada` (`_nrCasa` TINYINT(4), `_querterao` TINYINT(4), `_Avenida` VARCHAR(35), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35)) RETURNS INT(11) BEGIN
declare contD int(11);
declare contT int(11);
declare contS int (11) default(0);
SELECT COUNT(endereco.id_Morada) into contT FROM `endereco` WHERE endereco.Avenida=_Avenida and endereco.Quarterao=_querterao AND endereco.nrCasa=_nrCasa and endereco.Bairro=_bairro and endereco.Distrito=_distrito and endereco.Provincia=_provincia and endereco.Pais=_pais;
if(contT=0)then
select regeBairro(_bairro , _distrito , _provincia , _pais) into contD;
if(contD>0)then
INSERT INTO `morada` ( `id_Bairro`, `Avenida/Rua`, `Quarterao`, `nrCasa`) VALUES (contD, _Avenida, _querterao,_nrCasa);
end if;
end if;
SELECT COUNT(endereco.id_Morada) into contT FROM `endereco` WHERE endereco.Avenida=_Avenida and endereco.Quarterao=_querterao AND endereco.nrCasa=_nrCasa and endereco.Bairro=_bairro and endereco.Distrito=_distrito and endereco.Provincia=_provincia and endereco.Pais=_pais;
if(contT>0)then
SELECT endereco.id_Morada into contS FROM `endereco` WHERE endereco.Avenida=_Avenida and endereco.Quarterao=_querterao AND endereco.nrCasa=_nrCasa and endereco.Bairro=_bairro and endereco.Distrito=_distrito and endereco.Provincia=_provincia and endereco.Pais=_pais;
end if;
return contS;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regeNasc` (`_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35)) RETURNS INT(11) BEGIN
declare contD int(11);
declare contPr int(11);
declare contPa int(11);
declare contS int (11) default(0);
/*SELECT COUNT(descricao_distrito.id_pais) into contPa  FROM `descricao_distrito` WHERE descricao_distrito.pais=_pais;*/
SELECT COUNT(id_Pais) into contPa FROM `pais` WHERE Nome=_pais;
if(contPa=0)then
INSERT INTO `pais` (`Nome`) VALUES (_pais);
end if;
SELECT id_Pais into contPa FROM `pais` WHERE Nome=_pais;
SELECT COUNT(id_provincia) into contPr FROM `provincia` WHERE id_pais=contPa and Nome=_provincia;
if(contPr=0 and contPa>0)then
INSERT INTO `provincia` (`id_pais`, `Nome`) VALUES (contPa, _provincia);
end if;
SELECT id_provincia into contPr FROM `provincia` WHERE id_pais=contPa and Nome=_provincia;
SELECT COUNT(id_distrito) into contD FROM `distrito` WHERE id_Provincia=contPr AND Nome=_distrito;
if(contD=0 and contPr>0)then
INSERT INTO `distrito` ( `id_Provincia`, `Nome`) VALUES (contPr, _distrito);
end if;
SELECT COUNT(descricao_distrito.id_distrito) into contD  FROM `descricao_distrito` WHERE descricao_distrito.distrito=_distrito and descricao_distrito.provincia=_provincia and descricao_distrito.pais=_pais;
if(contD>0) then
SELECT descricao_distrito.id_distrito into contS  FROM `descricao_distrito` WHERE descricao_distrito.distrito=_distrito and descricao_distrito.provincia=_provincia and descricao_distrito.pais=_pais;
end if;
return contS;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `regePessoaS` (`_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Data_Nasc` DATE, `_nrCasa` TINYINT(4), `_querterao` TINYINT(4), `_Avenida` VARCHAR(35), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_distritoN` VARCHAR(35), `_provinciaN` VARCHAR(35), `_paisN` VARCHAR(35), `_sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Tipo` ENUM('BI','Cedula'), `_Numero` VARCHAR(20), `_LocalEmissao` VARCHAR(20), `_DataEmissao` DATE) RETURNS INT(11) BEGIN
DECLARE contS int(11) DEFAULT(0);
declare contN int(11);
declare contM int (11);
if(YEAR(_Data_Nasc)<=(YEAR(CURRENT_DATE)-10) and YEAR(_Data_Nasc)>1900)THEN
SELECT regeMorada(_nrCasa,_querterao ,_Avenida ,_bairro,_distrito ,_provincia ,_pais) into contN;
select regeNasc(_distritoN,_provinciaN ,_paisN) into contM;
if(contN>0 and contM>0)then
select addPessoa(_Nome, _Apelido, _Data_Nasc, contN, _nr_Tell, _Email, contM, _sexo , _Estado_Civil) into contS;
if(contS>0)THEN
select regeDoc (contS,_Tipo, _Numero,_LocalEmissao, _DataEmissao) into contN;
end if;
end if;
end if;
return contS;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `TransacaoAddAlunoC` (`_classe` ENUM('8','9','10','11','12'), `_Nome` VARCHAR(35), `_Apelido` VARCHAR(35), `_Data_Nasc` DATE, `_nrCasa` TINYINT(4), `_querterao` TINYINT(4), `_Avenida` VARCHAR(35), `_bairro` VARCHAR(35), `_distrito` VARCHAR(35), `_provincia` VARCHAR(35), `_pais` VARCHAR(35), `_nr_Tell` INT(11), `_Email` VARCHAR(200), `_distritoN` VARCHAR(35), `_provinciaN` VARCHAR(35), `_paisN` VARCHAR(35), `_sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Tipo` ENUM('BI','Cedula'), `_Numero` VARCHAR(20), `_LocalEmissao` VARCHAR(20), `_DataEmissao` DATE, `_NomePai` VARCHAR(35), `_NomeMae` VARCHAR(35), `_ProfissaoPai` VARCHAR(35), `_ProfissaoMae` VARCHAR(35), `_LocalTrabPai` VARCHAR(35), `_LocalTrabMae` VARCHAR(35), `_NrTellPai` INT(11), `_NrTellMae` INT(11)) RETURNS INT(11) BEGIN
declare contS int(11) default(0);
select addAluno(_classe, _Nome , _Apelido , _Data_Nasc, _nrCasa, _querterao , _Avenida ,_bairro , _distrito , _provincia , _pais, _nr_Tell, _Email, _distritoN , _provinciaN ,_paisN,_sexo , _Estado_Civil, _Tipo ,_Numero ,_LocalEmissao , _DataEmissao, _NomePai, _NomeMae , _ProfissaoPai, _ProfissaoMae, _LocalTrabPai , _LocalTrabMae, _NrTellPai , _NrTellMae) into conts;
return contS;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_Aluno` int(11) NOT NULL,
  `id_Pessoa` int(11) NOT NULL,
  `id_Turma` tinyint(4) NOT NULL DEFAULT '0',
  `id_Classe` tinyint(4) NOT NULL DEFAULT '1',
  `id_Filiacao` int(11) NOT NULL,
  `Estado` enum('Ativo','Graduado','Desistente') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_Aluno`, `id_Pessoa`, `id_Turma`, `id_Classe`, `id_Filiacao`, `Estado`) VALUES
(5, 3, 0, 1, 2, 'Ativo'),
(6, 4, 0, 1, 4, 'Ativo'),
(7, 5, 0, 1, 5, 'Ativo'),
(8, 6, 0, 2, 6, 'Ativo');

-- --------------------------------------------------------

--
-- Stand-in structure for view `aluno_dados_pessoais`
-- (See below for the actual view)
--
CREATE TABLE `aluno_dados_pessoais` (
`id_Aluno` int(11)
,`id_Pessoa` int(11)
,`id_Filiacao` int(11)
,`Nome` varchar(35)
,`Apelido` varchar(35)
,`Sexo` enum('M','F')
,`Estado_Civil` enum('Solteiro','Casado')
,`nr_Tell` int(11)
,`Email` varchar(200)
,`Bairo_Morada` varchar(35)
,`Distito_Morada` varchar(35)
,`Distrito_Nascimento` varchar(35)
,`Provincia_Nascimento` varchar(35)
,`Pais_Nascimento` varchar(35)
,`classe` enum('8','9','10','11','12')
,`NomePai` varchar(35)
,`NomeMae` varchar(35)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `id_aluno` int(11) NOT NULL,
  `id_Encarregado` int(11) NOT NULL,
  `Data_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_encarregado`
--

INSERT INTO `aluno_encarregado` (`id_aluno`, `id_Encarregado`, `Data_inicio`) VALUES
(6, 7, '2019-06-01'),
(7, 8, '2019-06-01'),
(7, 8, '2019-06-01'),
(7, 8, '2019-06-02'),
(8, 9, '2019-06-07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `id_Aluno` int(11) NOT NULL,
  `id_Matricula` int(11) NOT NULL,
  `Estado` enum('Pendente','Matriculado') NOT NULL DEFAULT 'Pendente',
  `DataRealizada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_matricula`
--

INSERT INTO `aluno_matricula` (`id_Aluno`, `id_Matricula`, `Estado`, `DataRealizada`) VALUES
(5, 1, 'Pendente', '2019-06-01'),
(6, 1, 'Pendente', '2019-06-01'),
(7, 1, 'Pendente', '2019-06-01'),
(8, 2, 'Pendente', '2019-06-07');

--
-- Acionadores `aluno_matricula`
--
DELIMITER $$
CREATE TRIGGER `atualizarMatricula` BEFORE UPDATE ON `aluno_matricula` FOR EACH ROW if(new.Estado='Matriculado')THEN
UPDATE matricula_classe set VagasPreenchidas=VagasPreenchidas+1 WHERE id_matri=new.id_Matricula;
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_turma`
--

CREATE TABLE `aluno_turma` (
  `id_aluno` int(11) NOT NULL,
  `id_turma` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `id_Bairro` int(11) NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`id_Bairro`, `id_distrito`, `Nome`) VALUES
(1, 1, 'Mateque'),
(3, 6, 'dsf'),
(4, 8, 'Laulane'),
(5, 9, 'Matola rio'),
(8, 12, ''),
(9, 13, 'Zavalas'),
(10, 15, 'Zona Verde'),
(11, 15, 'Benfica'),
(12, 17, 'Mateque'),
(13, 17, 'Exemplo'),
(14, 19, 'dsvsd'),
(15, 21, 'vcxvxc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `classe` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`codigo`, `nome`, `classe`) VALUES
(1, 'Joao', '8'),
(2, 'Folege', '8'),
(3, 'Claudio', '10'),
(4, 'Dio', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_matricula`
--

CREATE TABLE `candidato_matricula` (
  `codCand` int(11) NOT NULL,
  `ref` varchar(35) NOT NULL,
  `id_Aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato_matricula`
--

INSERT INTO `candidato_matricula` (`codCand`, `ref`, `id_Aluno`) VALUES
(1, 'Default', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `id_classe` tinyint(4) NOT NULL,
  `classe` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`id_classe`, `classe`) VALUES
(1, '8'),
(2, '9'),
(3, '10'),
(4, '11'),
(5, '12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_filiacao`
-- (See below for the actual view)
--
CREATE TABLE `dados_filiacao` (
`id_Filiacao` int(11)
,`NomePai` varchar(35)
,`NomeMae` varchar(35)
,`ProfissaoPai` varchar(35)
,`ProfissaoMae` varchar(35)
,`LocalTrabPai` varchar(35)
,`LocalTrabMae` varchar(35)
,`nr_Tell_Pai` int(11)
,`nr_Tell_Mae` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dados_matricula`
-- (See below for the actual view)
--
CREATE TABLE `dados_matricula` (
`id_matri` int(11)
,`classe` enum('8','9','10','11','12')
,`Vagas_Classe` int(11)
,`Vagas_Preenchidas` int(11)
,`id_Matricula` int(11)
,`DataI` date
,`DataF` date
,`Ano` year(4)
,`totalVagas` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `descricao_bairro`
-- (See below for the actual view)
--
CREATE TABLE `descricao_bairro` (
`id_bairro` int(11)
,`Bairro` varchar(35)
,`id_distrito` int(11)
,`Distrito` varchar(35)
,`id_provincia` int(11)
,`Provincia` varchar(35)
,`id_Pais` int(11)
,`Pais` varchar(35)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `descricao_distrito`
-- (See below for the actual view)
--
CREATE TABLE `descricao_distrito` (
`id_distrito` int(11)
,`Distrito` varchar(35)
,`id_provincia` int(11)
,`Provincia` varchar(35)
,`id_Pais` int(11)
,`Pais` varchar(35)
);

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
(4, 'Educaco Fisica', 'Geral'),
(5, 'Filosofia', 'Geral'),
(6, 'Ingles', 'Geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `id_Provincia` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `id_Provincia`, `Nome`) VALUES
(1, 1, 'Marracuene'),
(2, 1, 'Manhica'),
(3, 1, 'Magude'),
(6, 13, 'dsf'),
(7, 14, 'dgs'),
(8, 1, 'Mahota'),
(9, 1, 'Boane'),
(12, 16, ''),
(13, 3, 'Zavala'),
(14, 3, 'Morrumbene'),
(15, 1, 'Ka mbucuana'),
(16, 1, 'Ka Tembe'),
(17, 8, 'Morrumbene'),
(18, 17, 'Magude'),
(19, 18, 'dsvsd'),
(20, 19, 'fsdfs'),
(21, 20, 'vcxvx');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id_Pessoa` int(11) NOT NULL,
  `Tipo` enum('BI','Cedula') NOT NULL DEFAULT 'BI',
  `Numero` varchar(20) NOT NULL,
  `LocalEmissao` varchar(35) NOT NULL,
  `DataEmissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id_Pessoa`, `Tipo`, `Numero`, `LocalEmissao`, `DataEmissao`) VALUES
(1, 'Cedula', '234123451234f', 'Mahota', '2019-06-01'),
(2, 'BI', 'dfh', 'dfh', '2005-06-04'),
(3, 'Cedula', '1234512345t', 'Inhassouro', '2019-05-01'),
(4, 'BI', '123454321234A', 'Maputo', '2019-06-01'),
(5, 'Cedula', '12345678', 'Maputo', '2019-06-01'),
(6, 'BI', 'gddfg', 'dfgdf', '2019-06-07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `id_Encarregado` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL,
  `Profissao` varchar(35) NOT NULL,
  `LocalTrab` varchar(35) NOT NULL,
  `id_morada` int(11) NOT NULL,
  `nr_Tell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encarregado`
--

INSERT INTO `encarregado` (`id_Encarregado`, `Nome`, `Profissao`, `LocalTrab`, `id_morada`, `nr_Tell`) VALUES
(1, '', '', '', 1, 0),
(2, 'Ernesto Candido', 'Motorista', 'CarTrack', 5, 1),
(5, 'Teeza', '', '', 8, 82),
(6, 'Tereza', '', '', 8, 8245),
(7, 'Luiza', 'Mendes', 'Maputo', 11, 87650369),
(8, 'Tereza', ' dfgdf', ' gfdgd', 13, 29),
(9, 'xczxcz', 'xzczxcz', 'cxzczx', 15, 32432);

-- --------------------------------------------------------

--
-- Stand-in structure for view `endereco`
-- (See below for the actual view)
--
CREATE TABLE `endereco` (
`id_Morada` int(11)
,`Avenida` varchar(35)
,`Quarterao` tinyint(4)
,`nrCasa` tinyint(4)
,`Bairro` varchar(35)
,`Distrito` varchar(35)
,`Provincia` varchar(35)
,`Pais` varchar(35)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `id_Filiacao` int(11) NOT NULL,
  `NomePai` varchar(35) NOT NULL,
  `NomeMae` varchar(35) NOT NULL,
  `ProfissaoPai` varchar(35) NOT NULL,
  `ProfissaoMae` varchar(35) NOT NULL,
  `LocalTrabPai` varchar(35) NOT NULL,
  `LocalTrabMae` varchar(35) NOT NULL,
  `nr_Tell_Pai` int(11) NOT NULL DEFAULT '0',
  `nr_Tell_Mae` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filiacao`
--

INSERT INTO `filiacao` (`id_Filiacao`, `NomePai`, `NomeMae`, `ProfissaoPai`, `ProfissaoMae`, `LocalTrabPai`, `LocalTrabMae`, `nr_Tell_Pai`, `nr_Tell_Mae`) VALUES
(1, '', '', '', '', '', '', 0, 0),
(2, 'Jose', 'Luana', '', '', '', '', 823, 846),
(3, 'Jose', '', '', '', '', '', 646, 0),
(4, 'Jose', 'Maria', 'Tolven', 'Jogadora', 'Maputo', 'Matola', 8796510, 852410),
(5, 'Ernesto Candido', 'Tereza', 'Medico', 'hoteleira', 'Maputo', ' Gaza', 16, 2147483647),
(6, 'fdsfsd', 'dsfdsf', 'dsfds', 'dsfds', 'dfdsf', 'dsfds', 23423, 32423);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `id_Matricula` int(11) NOT NULL,
  `DataI` date NOT NULL,
  `DataF` date NOT NULL,
  `Ano` year(4) NOT NULL,
  `totalVagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`id_Matricula`, `DataI`, `DataF`, `Ano`, `totalVagas`) VALUES
(1, '2019-06-01', '2019-08-29', 2019, 800);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_classe`
--

CREATE TABLE `matricula_classe` (
  `id_matri` int(11) NOT NULL,
  `classe` tinyint(4) NOT NULL,
  `id_Matricula` int(11) NOT NULL,
  `totalVagas` int(11) NOT NULL,
  `VagasPreenchidas` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula_classe`
--

INSERT INTO `matricula_classe` (`id_matri`, `classe`, `id_Matricula`, `totalVagas`, `VagasPreenchidas`) VALUES
(1, 1, 1, 500, 0),
(2, 2, 1, 300, 1);

--
-- Acionadores `matricula_classe`
--
DELIMITER $$
CREATE TRIGGER `atualizaMatricula` BEFORE INSERT ON `matricula_classe` FOR EACH ROW begin 
UPDATE matricula set matricula.totalVagas=+matricula.totalVagas+new.totalVagas WHERE matricula.id_Matricula=new.id_Matricula;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE `morada` (
  `id_Morada` int(11) NOT NULL,
  `id_Bairro` int(11) NOT NULL,
  `Avenida/Rua` varchar(35) NOT NULL,
  `Quarterao` tinyint(4) NOT NULL,
  `nrCasa` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`id_Morada`, `id_Bairro`, `Avenida/Rua`, `Quarterao`, `nrCasa`) VALUES
(1, 1, 'Mocambique', 25, 22),
(3, 3, 'fds', 127, 32),
(4, 8, '', 0, 0),
(5, 9, 'Mocambique', 10, 12),
(6, 10, 'JT', 15, 12),
(7, 12, 'Mocambique', 11, 13),
(8, 14, 'vsddsvsd', 127, 127);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id_Pais` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_Pais`, `Nome`) VALUES
(1, 'Mocambique'),
(2, 'Nigeria'),
(3, 'Brazil'),
(4, 'Angola'),
(5, 'Africa do Sul'),
(6, 'Madagascar'),
(7, 'Portugal'),
(8, 'EUA'),
(9, 'China'),
(10, 'Malawe'),
(12, 'dsf'),
(13, 'dgs'),
(15, ''),
(16, 'vsdv'),
(17, 'dfsfds'),
(18, 'cxvxcv');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_Pessoa` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL,
  `Apelido` varchar(35) NOT NULL,
  `Sexo` enum('M','F') NOT NULL DEFAULT 'M',
  `Estado_Civil` enum('Solteiro','Casado') NOT NULL DEFAULT 'Solteiro',
  `Data_Nasc` date NOT NULL,
  `id_Morada` int(11) NOT NULL,
  `nr_Tell` int(11) NOT NULL DEFAULT '0',
  `Email` varchar(200) NOT NULL DEFAULT 'exemplo@SIGE_Secundaria.com',
  `id_Nasc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nasc`, `id_Morada`, `nr_Tell`, `Email`, `id_Nasc`) VALUES
(1, 'Candido', 'Ernesto', 'M', 'Solteiro', '2007-06-03', 1, 849516237, 'BaratoCandido@gmail.com', 3),
(2, 'gfdg', 'dfgd', 'F', 'Casado', '2000-06-04', 3, 643, 'dsg', 7),
(3, 'Elisarda', 'Boane', 'F', 'Solteiro', '2000-06-06', 5, 8564789, 'ElisardaBoane@gmail.com', 14),
(4, 'Ricardo', 'Golo', 'M', 'Solteiro', '2000-06-04', 6, 879456, 'RicarrdoGolo@Hotmail.com', 16),
(5, 'dfhdfhf', 'Barato', 'M', 'Casado', '1998-06-14', 7, 14, 'baratocandidtt@gmail.com', 18),
(6, 'vxdd', 'vdvds', 'F', 'Casado', '2000-06-05', 8, 4324, 'cxcxv', 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pessoa_dados`
-- (See below for the actual view)
--
CREATE TABLE `pessoa_dados` (
`id_Pessoa` int(11)
,`Nome` varchar(35)
,`Apelido` varchar(35)
,`Sexo` enum('M','F')
,`Estado_Civil` enum('Solteiro','Casado')
,`nr_Tell` int(11)
,`Email` varchar(200)
,`id_Morada` int(11)
,`Avenida` varchar(35)
,`Quarterao` tinyint(4)
,`nrCasa` tinyint(4)
,`Bairo_Morada` varchar(35)
,`Distito_Morada` varchar(35)
,`Povincia_Moada` varchar(35)
,`Pais_Morada` varchar(35)
,`id_distrito` int(11)
,`Distrito_Nascimento` varchar(35)
,`Provincia_Nascimento` varchar(35)
,`Pais_Nascimento` varchar(35)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id_prof` int(11) NOT NULL,
  `id_func` int(11) NOT NULL,
  `Data_inicio` date NOT NULL,
  `Estado` enum('Ativo','Passivo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_leciona`
--

CREATE TABLE `professor_leciona` (
  `id_prof` int(11) NOT NULL,
  `id_disciplina` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id_prof` int(11) NOT NULL,
  `id_turma` tinyint(4) NOT NULL,
  `id_disciplina` tinyint(4) NOT NULL,
  `Data_Alocacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `Nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `id_pais`, `Nome`) VALUES
(1, 1, 'Maputo'),
(2, 1, 'Gaza'),
(3, 1, 'Inhembane'),
(4, 1, 'Sofala'),
(5, 1, 'Zambezia'),
(6, 1, 'Manica'),
(7, 1, 'Tete'),
(8, 1, 'Nampula'),
(9, 1, 'Cabo Delgado'),
(10, 1, 'Niassa'),
(13, 12, 'ds'),
(14, 13, 'dsg'),
(16, 15, ''),
(17, 7, 'Nampula'),
(18, 16, 'dsvds'),
(19, 17, 'fdsfsd'),
(20, 18, 'xcvxc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id_Turma` tinyint(4) NOT NULL,
  `Descricao` char(2) NOT NULL,
  `Ano` year(4) NOT NULL,
  `Periodo` enum('Diurno','Noturno') NOT NULL DEFAULT 'Diurno',
  `id_classe` enum('8','9','10','11','12') NOT NULL DEFAULT '8',
  `Seccao` enum('Geral','A','B','C') NOT NULL DEFAULT 'Geral'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `tipo` enum('aluno','professor','secretaria','director') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `senha`, `tipo`) VALUES
(1, 'Candido', 'candido', 'aluno'),
(2, 'Claudio', 'claudio', 'director'),
(3, 'Paulo', 'Paulo', 'secretaria');

-- --------------------------------------------------------

--
-- Structure for view `aluno_dados_pessoais`
--
DROP TABLE IF EXISTS `aluno_dados_pessoais`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aluno_dados_pessoais`  AS  select `aluno`.`id_Aluno` AS `id_Aluno`,`aluno`.`id_Pessoa` AS `id_Pessoa`,`aluno`.`id_Filiacao` AS `id_Filiacao`,`pessoa_dados`.`Nome` AS `Nome`,`pessoa_dados`.`Apelido` AS `Apelido`,`pessoa_dados`.`Sexo` AS `Sexo`,`pessoa_dados`.`Estado_Civil` AS `Estado_Civil`,`pessoa_dados`.`nr_Tell` AS `nr_Tell`,`pessoa_dados`.`Email` AS `Email`,`pessoa_dados`.`Bairo_Morada` AS `Bairo_Morada`,`pessoa_dados`.`Distito_Morada` AS `Distito_Morada`,`pessoa_dados`.`Distrito_Nascimento` AS `Distrito_Nascimento`,`pessoa_dados`.`Provincia_Nascimento` AS `Provincia_Nascimento`,`pessoa_dados`.`Pais_Nascimento` AS `Pais_Nascimento`,`classe`.`classe` AS `classe`,`filiacao`.`NomePai` AS `NomePai`,`filiacao`.`NomeMae` AS `NomeMae` from (((`aluno` join `pessoa_dados`) join `classe`) join `filiacao`) where ((`aluno`.`id_Pessoa` = `pessoa_dados`.`id_Pessoa`) and (`aluno`.`id_Classe` = `classe`.`id_classe`) and (`aluno`.`id_Filiacao` = `filiacao`.`id_Filiacao`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dados_filiacao`
--
DROP TABLE IF EXISTS `dados_filiacao`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_filiacao`  AS  select `filiacao`.`id_Filiacao` AS `id_Filiacao`,`filiacao`.`NomePai` AS `NomePai`,`filiacao`.`NomeMae` AS `NomeMae`,`filiacao`.`ProfissaoPai` AS `ProfissaoPai`,`filiacao`.`ProfissaoMae` AS `ProfissaoMae`,`filiacao`.`LocalTrabPai` AS `LocalTrabPai`,`filiacao`.`LocalTrabMae` AS `LocalTrabMae`,`filiacao`.`nr_Tell_Pai` AS `nr_Tell_Pai`,`filiacao`.`nr_Tell_Mae` AS `nr_Tell_Mae` from `filiacao` ;

-- --------------------------------------------------------

--
-- Structure for view `dados_matricula`
--
DROP TABLE IF EXISTS `dados_matricula`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dados_matricula`  AS  select `matricula_classe`.`id_matri` AS `id_matri`,`classe`.`classe` AS `classe`,`matricula_classe`.`totalVagas` AS `Vagas_Classe`,`matricula_classe`.`VagasPreenchidas` AS `Vagas_Preenchidas`,`matricula`.`id_Matricula` AS `id_Matricula`,`matricula`.`DataI` AS `DataI`,`matricula`.`DataF` AS `DataF`,`matricula`.`Ano` AS `Ano`,`matricula`.`totalVagas` AS `totalVagas` from ((`matricula_classe` join `matricula`) join `classe`) where ((`matricula_classe`.`id_Matricula` = `matricula`.`id_Matricula`) and (`matricula_classe`.`classe` = `classe`.`id_classe`)) ;

-- --------------------------------------------------------

--
-- Structure for view `descricao_bairro`
--
DROP TABLE IF EXISTS `descricao_bairro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `descricao_bairro`  AS  select `bairro`.`id_Bairro` AS `id_bairro`,`bairro`.`Nome` AS `Bairro`,`descricao_distrito`.`id_distrito` AS `id_distrito`,`descricao_distrito`.`Distrito` AS `Distrito`,`descricao_distrito`.`id_provincia` AS `id_provincia`,`descricao_distrito`.`Provincia` AS `Provincia`,`descricao_distrito`.`id_Pais` AS `id_Pais`,`descricao_distrito`.`Pais` AS `Pais` from (`bairro` join `descricao_distrito`) where (`bairro`.`id_distrito` = `descricao_distrito`.`id_distrito`) ;

-- --------------------------------------------------------

--
-- Structure for view `descricao_distrito`
--
DROP TABLE IF EXISTS `descricao_distrito`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `descricao_distrito`  AS  select `distrito`.`id_distrito` AS `id_distrito`,`distrito`.`Nome` AS `Distrito`,`provincia`.`id_provincia` AS `id_provincia`,`provincia`.`Nome` AS `Provincia`,`pais`.`id_Pais` AS `id_Pais`,`pais`.`Nome` AS `Pais` from ((`distrito` join `provincia`) join `pais`) where ((`distrito`.`id_Provincia` = `provincia`.`id_provincia`) and (`provincia`.`id_pais` = `pais`.`id_Pais`)) ;

-- --------------------------------------------------------

--
-- Structure for view `endereco`
--
DROP TABLE IF EXISTS `endereco`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `endereco`  AS  select `morada`.`id_Morada` AS `id_Morada`,`morada`.`Avenida/Rua` AS `Avenida`,`morada`.`Quarterao` AS `Quarterao`,`morada`.`nrCasa` AS `nrCasa`,`descricao_bairro`.`Bairro` AS `Bairro`,`descricao_bairro`.`Distrito` AS `Distrito`,`descricao_bairro`.`Provincia` AS `Provincia`,`descricao_bairro`.`Pais` AS `Pais` from (`morada` join `descricao_bairro`) where (`morada`.`id_Bairro` = `descricao_bairro`.`id_bairro`) ;

-- --------------------------------------------------------

--
-- Structure for view `pessoa_dados`
--
DROP TABLE IF EXISTS `pessoa_dados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pessoa_dados`  AS  select `pessoa`.`id_Pessoa` AS `id_Pessoa`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`pessoa`.`Estado_Civil` AS `Estado_Civil`,`pessoa`.`nr_Tell` AS `nr_Tell`,`pessoa`.`Email` AS `Email`,`endereco`.`id_Morada` AS `id_Morada`,`endereco`.`Avenida` AS `Avenida`,`endereco`.`Quarterao` AS `Quarterao`,`endereco`.`nrCasa` AS `nrCasa`,`endereco`.`Bairro` AS `Bairo_Morada`,`endereco`.`Distrito` AS `Distito_Morada`,`endereco`.`Provincia` AS `Povincia_Moada`,`endereco`.`Pais` AS `Pais_Morada`,`descricao_distrito`.`id_distrito` AS `id_distrito`,`descricao_distrito`.`Distrito` AS `Distrito_Nascimento`,`descricao_distrito`.`Provincia` AS `Provincia_Nascimento`,`descricao_distrito`.`Pais` AS `Pais_Nascimento` from ((`pessoa` join `endereco`) join `descricao_distrito`) where ((`pessoa`.`id_Morada` = `endereco`.`id_Morada`) and (`pessoa`.`id_Nasc` = `descricao_distrito`.`id_distrito`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_Aluno`),
  ADD UNIQUE KEY `id_Pessoa` (`id_Pessoa`),
  ADD KEY `id_Filiacao` (`id_Filiacao`),
  ADD KEY `id_Classe` (`id_Classe`);

--
-- Indexes for table `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_Encarregado` (`id_Encarregado`);

--
-- Indexes for table `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD UNIQUE KEY `codAluno` (`id_Aluno`,`id_Matricula`),
  ADD KEY `codMatricula` (`id_Matricula`);

--
-- Indexes for table `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_Bairro`),
  ADD KEY `id_distrito` (`id_distrito`);

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD PRIMARY KEY (`codCand`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD UNIQUE KEY `Descricao` (`Descricao`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD KEY `id_Provincia` (`id_Provincia`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_Pessoa`,`Tipo`) USING BTREE;

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`id_Encarregado`),
  ADD UNIQUE KEY `nr_Tell` (`nr_Tell`),
  ADD KEY `encarregado_ibfk_1` (`id_morada`);

--
-- Indexes for table `filiacao`
--
ALTER TABLE `filiacao`
  ADD PRIMARY KEY (`id_Filiacao`),
  ADD UNIQUE KEY `NomePai` (`NomePai`,`NomeMae`,`nr_Tell_Pai`,`nr_Tell_Mae`),
  ADD UNIQUE KEY `nr_Tell_Pai` (`nr_Tell_Pai`,`nr_Tell_Mae`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_func`),
  ADD UNIQUE KEY `codP` (`codP`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_Matricula`);

--
-- Indexes for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD PRIMARY KEY (`id_matri`),
  ADD KEY `id_Matricula` (`id_Matricula`),
  ADD KEY `classe` (`classe`);

--
-- Indexes for table `morada`
--
ALTER TABLE `morada`
  ADD PRIMARY KEY (`id_Morada`),
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
  ADD KEY `id_Morada` (`id_Morada`),
  ADD KEY `id_Nasc` (`id_Nasc`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `id_func` (`id_func`);

--
-- Indexes for table `professor_leciona`
--
ALTER TABLE `professor_leciona`
  ADD PRIMARY KEY (`id_disciplina`,`id_prof`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Indexes for table `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD PRIMARY KEY (`id_turma`,`id_prof`,`id_disciplina`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `professor_turma_ibfk_1` (`id_prof`,`id_disciplina`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_Turma`),
  ADD UNIQUE KEY `Descricao` (`Descricao`,`Ano`,`Periodo`,`id_classe`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_Aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_Bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `candidato`
--
ALTER TABLE `candidato`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  MODIFY `codCand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `id_Encarregado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `filiacao`
--
ALTER TABLE `filiacao`
  MODIFY `id_Filiacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_func` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_Matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
  MODIFY `id_matri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `morada`
--
ALTER TABLE `morada`
  MODIFY `id_Morada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_Pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id_Turma` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_Filiacao`) REFERENCES `filiacao` (`id_Filiacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`id_Classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD CONSTRAINT `aluno_encarregado_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_encarregado_ibfk_2` FOREIGN KEY (`id_Encarregado`) REFERENCES `encarregado` (`id_Encarregado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD CONSTRAINT `aluno_matricula_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_matricula_ibfk_2` FOREIGN KEY (`id_Matricula`) REFERENCES `matricula_classe` (`id_matri`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD CONSTRAINT `aluno_turma_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_Aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_Turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_Provincia`) REFERENCES `provincia` (`id_provincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encarregado`
--
ALTER TABLE `encarregado`
  ADD CONSTRAINT `encarregado_ibfk_1` FOREIGN KEY (`id_morada`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD CONSTRAINT `matricula_classe_ibfk_1` FOREIGN KEY (`id_Matricula`) REFERENCES `matricula` (`id_Matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_classe_ibfk_2` FOREIGN KEY (`classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `morada`
--
ALTER TABLE `morada`
  ADD CONSTRAINT `morada_ibfk_1` FOREIGN KEY (`id_Bairro`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`id_Morada`) REFERENCES `morada` (`id_Morada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pessoa_ibfk_2` FOREIGN KEY (`id_Nasc`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`id_func`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `professor_leciona`
--
ALTER TABLE `professor_leciona`
  ADD CONSTRAINT `professor_leciona_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_leciona_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`id_prof`,`id_disciplina`) REFERENCES `professor_leciona` (`id_prof`, `id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_Turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_Pais`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
