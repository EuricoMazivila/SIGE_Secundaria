-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Set-2019 às 13:43
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
-- Database: `sige`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAluno_matriculado` (`_apelido` VARCHAR(30), `_nomes` VARCHAR(50), `_pais_nas` VARCHAR(50), `_provincia_nas` VARCHAR(50), `_distrito_nas` VARCHAR(50), `_data_nascimento` DATE, `_bi` VARCHAR(13), `_local_emissao` VARCHAR(50), `_data_em` DATE, `_sexo` ENUM('M','F'), `_estado_civil` ENUM('Casado(a)','Solteiro(a)'), `_provincia_res` VARCHAR(50), `_distrito_res` VARCHAR(50), `_bairro` VARCHAR(50), `_av_ou_rua` VARCHAR(50), `_quarteirao` VARCHAR(50), `_nr_casa` INT, `_numero_tf` INT, `_email` VARCHAR(50), `_foto` BLOB, `_nome_pai` VARCHAR(50), `_telefone_pai` INT, `_local_trabalho_pai` VARCHAR(50), `_profissao_pai` VARCHAR(50), `_nome_mae` VARCHAR(50), `_telefone_mae` INT, `_local_trabalho_mae` VARCHAR(50), `_profissao_mae` VARCHAR(50), `_nome_enc` VARCHAR(50), `_numero_tf_enc` INT, `_provincia_enc` VARCHAR(50), `_distrito_enc` VARCHAR(50), `_bairro_enc` VARCHAR(50), `_av_ou_rua_enc` VARCHAR(50), `_local_trab_enc` VARCHAR(50), `_profissao_enc` VARCHAR(50), `_classe` ENUM('8','9','10','11','12'), `_ensino` VARCHAR(10), `_nome_escola` VARCHAR(50), `_classe_anter` ENUM('7','8','9','10','11','12'), `_turma_anter` VARCHAR(4), `_numero_anter` INT, `_ano` YEAR)  Begin
	declare codp_p int; 
	declare codprov_enc int;
	declare coddist_enc int;
	declare codbairro_enc int;
	declare codEnc_enc int;	
	declare codCand_al int;
	declare codal_m int;
	declare codclass_al int;
	declare codmatr_al int;
	declare _turno enum('diurno','noctuno','a distancia');
	declare nome varchar(50);
	declare classe enum('8','9','10','11','12');
	declare codescola_ int;	
	
	Start transaction;
	Call addPessoa(_apelido,_nomes,_pais_nas,_provincia_nas,_distrito_nas,_data_nascimento,
	_bi,_local_emissao,_data_em,_sexo,_estado_civil,_provincia_res,_distrito_res,_bairro,
	_av_ou_rua,_quarteirao,_nr_casa,_numero_tf,_email,_foto);
	
	Select codp into codp_p from Pessoa where apelido=_apelido and nomes=_nomes;
	Select CONCAT(nomes,' ',apelido) into nome from pessoa where codp=codp_p;

	if(codp_p is not null) then
		Begin
			Select codprov into codprov_enc from provincia where provincia=_provincia_enc and codPais=(Select codPais from pais where pais='Mocambique');
			Select coddist into coddist_enc from distrito where codprov=codprov_enc and distrito=_distrito_enc;
			Select codbairro into codbairro_enc from bairro where coddist=coddist_enc and bairro=_bairro_enc;
			
			if(codbairro_enc is not null) then
				Begin
					Select codCand into codCand_al from Candidato_Aluno where nome_completo=nome;
					Select turno into _turno from candidato_Aluno where nome_completo=nome;
					Select classe_matricular into classe from candidato_Aluno where nome_completo=nome;
					if((codCand_al is not null) && (classe=_classe)) then
						Begin
							Insert into aluno (codAl,codP,turno,codCand) values (default,codP_p,_turno,codCand_al);
							Select codAl into codal_m from aluno where codP=codp_p;
							Insert into filiacao (codFil,codAl,nome_pai,telefone_pai,local_trabalho_pai,profissao_pai,nome_mae,telefone_mae,local_trabalho_mae,profissao_mae) values (default,codal_m,_nome_pai,_telefone_pai,_local_trabalho_pai,_profissao_pai,_nome_mae,_telefone_mae,_local_trabalho_mae,_profissao_mae);
							Insert into encarregado (codEnc,codAl,nome_completo,numero_telefone,local_trabalho,profissao) values (default,codal_m,_nome_enc,_numero_tf_enc,_local_trab_enc,_profissao_enc);
							Select codEnc into codEnc_enc from encarregado where codal=codal_m;
							Insert into residencia_encarregado (codRes,codEnc,codProv,codbairro,av_ou_rua) values (default,codEnc_enc,codprov_enc,codbairro_enc,_av_ou_rua_enc);
							Insert into aluno_classe (codAl,codClass, ano) values (codal_m,classe,year(curdate()));
							Select codescola into codescola_ from escola where nome_escola=_nome_escola and nivel=_ensino;
							Insert into dados_escola_anterior (codDados,codAl,classe_anterior,turma,numero,ano,codEscola) values (default,codal_m,_classe_anter,_turma_anter,_numero_anter,_ano,codescola_);
							Select codMatr into codmatr_al from matricula where year(dataF)=year(curdate()) LIMIT 1;
							if((codal_m is not null) && (codmatr_al is not null)) then
								Begin
									Insert into aluno_matricula (codAl,codMatr,data) values (codal_m,codmatr_al,curdate()); 
									Insert into candidato_matricula (codCand,codMatr,data) values (codCand_al,codmatr_al,curdate());
									Insert into usuario (codUsuario,usuario,senha,email,tipo,codP) values (default,CONCAT(_nomes,_apelido,'.sige.ac.mz'),AES_ENCRYPT(_apelido,'senha'),_email,'aluno',codp_p);
									commit;
								End;	
							else
								Begin
									Select 'Erro no codal_m, codclass_al e codmatr_al ' as Mensagem;
									rollback;
								End;

							End if;	
						End;
					else
						Begin
							Select 'Erro no codCand' as Mensagem;
							rollback;
						End;
						
					End if;			
				End;
			else
				Begin
					Select 'Erro no codRes_enc' as Mensagem;
					rollback;
				End;
			End if;
		End;	
	else	
		Begin
			Select 'Erro no codP_p' as Mensagem;
			rollback;
		End;
	End if;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addCandidato` (`_codCand` INT, `_nome` VARCHAR(50), `_classe_anterior` ENUM('7','8','9','10','11','12'), `_classe_matricular` ENUM('8','9','10','11','12'), `_provincia_origem` VARCHAR(50), `_distrito_origem` VARCHAR(50), `_escola_Origem` VARCHAR(50), `_regime` VARCHAR(10), `_senha` VARCHAR(10))  Begin 
	declare codEsco int;
	declare codmat int;
	
	Start transaction; 
	select codEscola into codEsco from escola where nome_escola=_escola_Origem and escola.coddist=(Select distrito.coddist from provincia,distrito where provincia.codProv=distrito.codProv and provincia=_provincia_origem and distrito=_distrito_origem);  
	Select codmatr into codmat from matricula where estado='activa' or estado='em espera' and dataF>=curdate();
	
	if((codEsco is not null) && (codmat is not null) && (_classe_matricular>_classe_anterior)) then
		begin
			if(MONTH(curdate())>4) then
				insert into candidato_aluno (codCand,nome_completo,classe_anterior,classe_matricular,
				turno,codEscola,senha,estado,ano) values (_codCand,_nome, _classe_anterior,_classe_matricular,_regime,
				codEsco,AES_ENCRYPT(_senha,'senha'),default,(year(curdate())+1));
				commit;
			else
				insert into candidato_aluno (codCand,nome_completo,classe_anterior,classe_matricular,
				turno,codEscola,senha,estado,ano) values (_codCand,_nome, _classe_anterior,_classe_matricular,_regime,
				codEsco,AES_ENCRYPT(_senha,'senha'),default,year(curdate()));
				commit;
			end if;		
		end;
	else
		Select 'Cadastro invalido' as Mensagem;	
		rollback;
	end if;		
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPessoa` (`_apelido` VARCHAR(30), `_nomes` VARCHAR(50), `_pais_nas` VARCHAR(50), `_provincia_nas` VARCHAR(50), `_distrito_nas` VARCHAR(50), `_data_nascimento` DATE, `_bi` VARCHAR(13), `_local_emissao` VARCHAR(50), `_data_em` DATE, `_sexo` ENUM('M','F'), `_estado_civil` ENUM('Casado(a)','Solteiro(a)'), `_provincia_res` VARCHAR(50), `_distrito_res` VARCHAR(50), `_bairro` VARCHAR(50), `_av_ou_rua` VARCHAR(50), `_quarteirao` VARCHAR(50), `_nr_casa` INT, `_numero_tf` INT, `_email` VARCHAR(50), `_foto` BLOB)  Begin
	declare codPais_nas int;
	declare codProv_nas int;
	declare coddist_nas int;
	declare codpais_res int;
	declare codprov_res int;
	declare coddist_res int;
	declare codbairro_res int;
	declare codres_p int; 
	declare codp_p int;
 	
	Start transaction;
	Select codPais into codPais_nas from pais where pais=_pais_nas;
	Select codProv into codProv_nas from provincia where codpais=codPais_nas and provincia=_provincia_nas;
	Select coddist into coddist_nas from distrito where codProv=codProv_nas and distrito=_distrito_nas;
	if((coddist_nas is not null) && (year(curdate())-year(_data_nascimento))>9 && (year(curdate())-year(_data_em))<6) then
		Begin	
			Select codPais into codpais_res from pais where pais='Mocambique';
			Select codProv into codprov_res from provincia where codpais=codpais_res and provincia=_provincia_res;
			Select coddist into coddist_res from distrito where codProv=codprov_res and distrito=_distrito_res;
			Select codbairro into codbairro_res from bairro where coddist=coddist_res and bairro=_bairro;
			if(codbairro_res is not null) then
				Begin 
					Insert into pessoa (codp,apelido,nomes,coddist,data_nascimento,sexo,estado_civil,numero_telefone,email,foto) values (default,_apelido,_nomes,coddist_nas,_data_nascimento,_sexo,_estado_civil,_numero_tf,_email,_foto);	
					Select codp into codp_p from pessoa where nomes=_nomes and apelido=_apelido;
					Insert into bi (codp,bi,local_emissao,data_emissao) values (codp_p,_bi,_local_emissao,_data_em);
					Insert into residencia_pessoa (codRes,codP,codProv,codbairro,av_ou_rua,quarteirao,nr_casa) values (default,codp_p,codprov_res,codbairro_res,_av_ou_rua,_quarteirao,_nr_casa);
					commit;
				End;
			else
				Begin
					Select 'Erro do codBairro' as Mensagem;
					rollback;
				End;
			End if;	
		End;
	else
		Begin	
			select 'Erro de codigo de distrito' as Mensagem;
			rollback;
		End;	
	End if;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPriodo_Matricula` (`_dataI` DATE, `_dataF` DATE, `_classe_oita` ENUM('8','9','10','11','12'), `_total_vagas_oita_d` INT, `_total_vagas_oita_n` INT, `_classe_nona` ENUM('8','9','10','11','12'), `_total_vagas_nona_d` INT, `_total_vagas_nona_n` INT, `_classe_dec` ENUM('8','9','10','11','12'), `_total_vagas_dec_d` INT, `_total_vagas_dec_n` INT, `_classe_decp` ENUM('8','9','10','11','12'), `_total_vagas_decp_d` INT, `_total_vagas_decp_n` INT, `_classe_decs` ENUM('8','9','10','11','12'), `_total_vagas_decs_d` INT, `_total_vagas_decs_n` INT)  Begin
	declare codMa int;
	declare codClas_oita_d int;
	declare codClas_oita_n int;
	declare codClas_nona_d int;
	declare codClas_nona_n int;
	declare codClas_dec_d int;
	declare codClas_dec_n int;
	declare codClas_decp_d int;
	declare codClas_decp_n int;
	declare codClas_decs_d int;
	declare codClas_decs_n int;
	
	Start transaction;
	if((_dataI>=curdate()) && (_dataF>curdate())) then
		Begin
			Insert into matricula (codMatr,dataI,dataF) values (default,_dataI,_dataF);
			savepoint sp1;
		End;	
	else
		Begin
			Select 'Datas invalidas' as Mensagem;
			rollback;
		End;
	End if;
		
	
	Select codMatr into codMa from matricula where dataI=_dataI;

	if(codMa is not null) then
		Begin
			Select codClass into codClas_oita_d from classe where classe=_classe_oita and turno='diurno'; 
			Select codClass into codClas_oita_n from classe where classe=_classe_oita and turno='nocturno';
			Select codClass into codClas_nona_d from classe where classe=_classe_nona and turno='diurno';
			Select codClass into codClas_nona_n from classe where classe=_classe_nona and turno='nocturno';
			Select codClass into codClas_dec_d from classe where classe=_classe_dec and turno='diurno';
			Select codClass into codClas_dec_n from classe where classe=_classe_dec and turno='nocturno';
			Select codClass into codClas_decp_d from classe where classe=_classe_decp and turno='diurno';
			Select codClass into codClas_decp_n from classe where classe=_classe_decp and turno='nocturno';
			Select codClass into codClas_decs_d from classe where classe=_classe_decs and turno='diurno';
			Select codClass into codClas_decs_n from classe where classe=_classe_decs and turno='nocturno';
			
			if((codClas_oita_d is not null) && (codClas_oita_n is not null) && (codClas_nona_d is not null)
				&& (codClas_nona_n is not null) && (codClas_dec_d is not null) && (codClas_dec_n is not null)
				&& (codClas_decp_d is not null) && (codClas_decp_n is not null) && (codClas_decs_d is not null)
				&& (codClas_decs_n is not null)) then
				Begin
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_oita_d,_total_vagas_oita_d,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_oita_n,_total_vagas_oita_n,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_nona_d,_total_vagas_nona_d,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_nona_n,_total_vagas_nona_n,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_dec_d,_total_vagas_dec_d,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_dec_n,_total_vagas_dec_n,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_decp_d,_total_vagas_decp_d,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_decp_n,_total_vagas_decp_n,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_decs_d,_total_vagas_decs_d,year(_dataI));
					Insert into matricula_classe (codMatr,codClass,total_vagas,ano) values (codMa,codClas_decs_n,_total_vagas_decs_n,year(_dataI));
					commit;	
					
				End;
				
			else
				Begin
					select 'Falha no registo das classes e o total de vagas' as Mensagem;
					rollback to sp1;
					rollback;
				End;
			End if;
		End;
	else
		Select 'Falha ao registar nova matricula' as Mensagem;
		rollback to sp1;
		rollback;
	End if;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `codAl` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `turno` enum('diurno','nocturno','','') NOT NULL,
  `codCand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`codAl`, `codP`, `turno`, `codCand`) VALUES
(14, 19, 'diurno', 4),
(15, 21, 'diurno', 5),
(17, 27, 'diurno', 6),
(18, 28, 'diurno', 13);

--
-- Acionadores `aluno`
--
DELIMITER $$
CREATE TRIGGER `Actualiza_Estado_Candidato` AFTER INSERT ON `aluno` FOR EACH ROW Begin
	Update candidato_aluno set estado='Pre Matriculado'
	where new.codCand=candidato_aluno.codCand;
End
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Actualiza_Estado_Candidato_d` AFTER DELETE ON `aluno` FOR EACH ROW Begin
	Update candidato_aluno set estado='Nao Matriculado'
	where candidato_aluno.codCand=old.codCand;
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `alunos_matriculados`
-- (See below for the actual view)
--
CREATE TABLE `alunos_matriculados` (
`codal` int(11)
,`nome` varchar(81)
,`data` date
,`classe` enum('8','9','10','11','12')
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classe`
--

CREATE TABLE `aluno_classe` (
  `codAl` int(11) NOT NULL,
  `codClass` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_classe`
--

INSERT INTO `aluno_classe` (`codAl`, `codClass`, `ano`) VALUES
(14, 2, 2019),
(15, 2, 2019),
(17, 1, 2019),
(18, 3, 2019);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `codAl` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipo` enum('Novo ingresso','Renovacao','','') NOT NULL DEFAULT 'Novo ingresso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_matricula`
--

INSERT INTO `aluno_matricula` (`codAl`, `codMatr`, `data`, `tipo`) VALUES
(14, 10, '2019-07-19', 'Novo ingresso'),
(15, 10, '2019-07-19', 'Novo ingresso'),
(17, 10, '2019-07-19', 'Novo ingresso'),
(18, 10, '2019-07-21', 'Novo ingresso');

--
-- Acionadores `aluno_matricula`
--
DELIMITER $$
CREATE TRIGGER `Actualiza_vagas_preenchidas` AFTER INSERT ON `aluno_matricula` FOR EACH ROW Begin
	declare codClas int;
	declare ano year;

	Select codClass into codClas from aluno_classe where aluno_classe.codAl=new.codAl;
	Select year(aluno_matricula.data) into ano from aluno_matricula where aluno_matricula.codal=new.codAl;	

	if((codClas is not null) && (ano=year(curdate()))) then
		update matricula_classe set total_vagas_preenchidas=total_vagas_preenchidas+1 where matricula_classe.codClass=codClas;
	End if;
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `codbairro` int(11) NOT NULL,
  `coddist` int(11) NOT NULL,
  `bairro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`codbairro`, `coddist`, `bairro`) VALUES
(2, 2, 'Jorge Dimitrov');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bi`
--

CREATE TABLE `bi` (
  `codP` int(11) NOT NULL,
  `bi` varchar(13) NOT NULL,
  `local_emissao` varchar(50) NOT NULL,
  `data_emissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bi`
--

INSERT INTO `bi` (`codP`, `bi`, `local_emissao`, `data_emissao`) VALUES
(19, '1990P717P0202', 'Cidade de Maputo', '2018-09-12'),
(21, '1990P717P0902', 'Cidade de Maputo', '2018-09-12'),
(28, '2323232323', 'Cidade de Maputo', '2019-07-09'),
(27, '2323232323s', 'Cidade de Maputo', '2019-07-15'),
(7, '3333333333333', 'Cidade de Maputo', '2019-07-02'),
(8, '3333333333334', 'Cidade de Maputo', '2019-07-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_aluno`
--

CREATE TABLE `candidato_aluno` (
  `codCand` int(11) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `classe_anterior` enum('7','8','9','10','11','12') NOT NULL,
  `classe_matricular` enum('8','9','10','11','12','') NOT NULL,
  `turno` enum('diurno','nocturno','a distancia','') NOT NULL,
  `codEscola` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `estado` enum('Matriculado','Pre Matriculado','Nao Matriculado','') NOT NULL DEFAULT 'Nao Matriculado',
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato_aluno`
--

INSERT INTO `candidato_aluno` (`codCand`, `nome_completo`, `classe_anterior`, `classe_matricular`, `turno`, `codEscola`, `senha`, `estado`, `ano`) VALUES
(4, 'Candido Barato', '8', '9', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Pre Matriculado', 2019),
(5, 'Joao Teste', '8', '9', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Pre Matriculado', 2019),
(6, 'Ricardo Manhice', '8', '8', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Pre Matriculado', 2019),
(7, 'Claudio Bucene', '8', '8', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Nao Matriculado', 2019),
(8, 'Helena', '8', '8', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Nao Matriculado', 2019),
(9, 'Jorge', '11', '12', 'nocturno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Nao Matriculado', 2020),
(11, 'Rosa', '10', '11', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Nao Matriculado', 2020),
(12, 'Maria', '7', '8', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Nao Matriculado', 2020),
(13, 'Euro Euro', '9', '10', 'diurno', 4, 'xÆØ±¡X%H›-è¹XˆÑû', 'Pre Matriculado', 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_matricula`
--

CREATE TABLE `candidato_matricula` (
  `codCand` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato_matricula`
--

INSERT INTO `candidato_matricula` (`codCand`, `codMatr`, `data`) VALUES
(4, 10, '2019-07-19'),
(5, 10, '2019-07-19'),
(6, 10, '2019-07-19'),
(13, 10, '2019-07-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chefia`
--

CREATE TABLE `chefia` (
  `codTrab` int(11) NOT NULL,
  `data_nomea` date NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `codClass` int(11) NOT NULL,
  `classe` enum('8','9','10','11','12') NOT NULL,
  `turno` enum('diurno','nocturno','a distancia','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`codClass`, `classe`, `turno`) VALUES
(1, '8', 'diurno'),
(2, '9', 'diurno'),
(3, '10', 'diurno'),
(4, '11', 'diurno'),
(5, '12', 'diurno'),
(6, '8', 'nocturno'),
(7, '9', 'nocturno'),
(8, '10', 'nocturno'),
(9, '11', 'nocturno'),
(10, '12', 'nocturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_escola_anterior`
--

CREATE TABLE `dados_escola_anterior` (
  `codDados` int(11) NOT NULL,
  `codAl` int(11) NOT NULL,
  `classe_anterior` enum('7','8','9','10','11','12') NOT NULL,
  `turma` varchar(5) NOT NULL,
  `numero` int(11) NOT NULL,
  `ano` year(4) NOT NULL,
  `codEscola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dados_escola_anterior`
--

INSERT INTO `dados_escola_anterior` (`codDados`, `codAl`, `classe_anterior`, `turma`, `numero`, `ano`, `codEscola`) VALUES
(2, 14, '8', 'A3', 23, 2019, 4),
(3, 15, '8', 'A3', 23, 2019, 4),
(5, 17, '8', 'A3', 33, 2018, 4),
(6, 18, '9', 'A4', 6, 2018, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `coddist` int(11) NOT NULL,
  `codProv` int(11) NOT NULL,
  `distrito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`coddist`, `codProv`, `distrito`) VALUES
(1, 1, 'Kamavota'),
(2, 1, 'Kamubukwana'),
(3, 1, 'Katembe'),
(4, 1, 'Kanhaka'),
(5, 1, 'Kalhamankulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `codEnc` int(11) NOT NULL,
  `codAl` int(11) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `local_trabalho` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encarregado`
--

INSERT INTO `encarregado` (`codEnc`, `codAl`, `nome_completo`, `numero_telefone`, `local_trabalho`, `profissao`) VALUES
(14, 14, 'Mario', 2147483647, 'Cidade de Maputo', 'Pedreiro'),
(15, 15, 'Mario', 2147483647, 'Cidade de Maputo', 'Pedreiro'),
(17, 17, 'Candido Barato', 3232455, 'Cidade de Maputo', 'Guarda'),
(18, 18, 'Ernesto Euro', 848382848, 'Cidade de Maputo', 'Pedreiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `codEscola` int(11) NOT NULL,
  `nome_escola` varchar(50) NOT NULL,
  `nivel` enum('primaria','secundaria','misto','') NOT NULL,
  `tipo` enum('publica','privada','','') NOT NULL,
  `coddist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`codEscola`, `nome_escola`, `nivel`, `tipo`, `coddist`) VALUES
(4, 'Escola Secundaria Quisse Mavota', 'primaria', 'publica', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `codFil` int(11) NOT NULL,
  `codAl` int(11) NOT NULL,
  `nome_pai` varchar(50) NOT NULL,
  `telefone_pai` int(11) NOT NULL,
  `local_trabalho_pai` varchar(50) NOT NULL,
  `profissao_pai` varchar(50) NOT NULL,
  `nome_mae` varchar(50) NOT NULL,
  `telefone_mae` int(11) NOT NULL,
  `local_trabalho_mae` varchar(50) NOT NULL,
  `profissao_mae` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filiacao`
--

INSERT INTO `filiacao` (`codFil`, `codAl`, `nome_pai`, `telefone_pai`, `local_trabalho_pai`, `profissao_pai`, `nome_mae`, `telefone_mae`, `local_trabalho_mae`, `profissao_mae`) VALUES
(14, 14, 'Mario', 842191892, 'Cidade de Maputo', 'Pedreiro', 'Maria', 842993842, 'Cidade de Maputo', 'Domestica'),
(15, 15, 'Mario', 842191892, 'Cidade de Maputo', 'Pedreiro', 'Maria', 842993842, 'Cidade de Maputo', 'Domestica'),
(17, 17, 'Candido Barato', 3232455, 'Cidade de Maputo', 'Guarda', 'Paula Barato', 34565676, 'Cidade de Maputo', 'Domestica'),
(18, 18, 'Ernesto Euro', 34323232, 'Cidade de Maputo', 'Pedreiro', 'Erica', 848484848, 'Cidade de Maputo', 'Enfermeira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `codTrab` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `carreira` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `codMatr` int(11) NOT NULL,
  `dataI` date NOT NULL,
  `dataF` date NOT NULL,
  `estado` enum('Em espera','Activa','Terminada','') NOT NULL DEFAULT 'Em espera',
  `total_vagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`codMatr`, `dataI`, `dataF`, `estado`, `total_vagas`) VALUES
(10, '2019-01-03', '2019-03-10', 'Em espera', 1660),
(11, '2016-07-02', '2018-07-19', 'Em espera', 111),
(12, '2016-01-16', '2017-03-02', 'Em espera', 177),
(13, '0000-00-00', '0000-00-00', 'Activa', 73),
(14, '2020-01-08', '2020-03-06', 'Em espera', 1050);

-- --------------------------------------------------------

--
-- Stand-in structure for view `matriculas_marcadas`
-- (See below for the actual view)
--
CREATE TABLE `matriculas_marcadas` (
`classe` enum('8','9','10','11','12')
,`turno` enum('diurno','nocturno','a distancia','')
,`total_vagas` int(11)
,`total_vagas_preenchidas` int(11)
,`ano` year(4)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_classe`
--

CREATE TABLE `matricula_classe` (
  `codMatr` int(11) NOT NULL,
  `codClass` int(11) NOT NULL,
  `total_Vagas` int(11) NOT NULL,
  `ano` year(4) NOT NULL,
  `total_vagas_preenchidas` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula_classe`
--

INSERT INTO `matricula_classe` (`codMatr`, `codClass`, `total_Vagas`, `ano`, `total_vagas_preenchidas`) VALUES
(10, 1, 200, 2019, 0),
(10, 2, 250, 2019, 0),
(10, 3, 100, 2019, 1),
(10, 4, 130, 2019, 0),
(10, 5, 130, 2019, 0),
(10, 6, 150, 2019, 0),
(10, 7, 300, 2019, 0),
(10, 8, 170, 2019, 0),
(10, 9, 120, 2019, 0),
(10, 10, 110, 2019, 0),
(11, 1, 11, 2019, 0),
(11, 2, 11, 2019, 0),
(11, 3, 11, 2019, 1),
(11, 4, 11, 2019, 0),
(11, 5, 11, 2019, 0),
(11, 6, 12, 2019, 0),
(11, 7, 11, 2019, 0),
(11, 8, 11, 2019, 0),
(11, 9, 11, 2019, 0),
(11, 10, 11, 2019, 0),
(12, 1, 12, 2018, 0),
(12, 2, 14, 2018, 0),
(12, 3, 16, 2018, 1),
(12, 4, 19, 2018, 0),
(12, 5, 21, 2018, 0),
(12, 6, 13, 2018, 0),
(12, 7, 15, 2018, 0),
(12, 8, 17, 2018, 0),
(12, 9, 20, 2018, 0),
(12, 10, 30, 2018, 0),
(13, 1, 4, 0000, 0),
(13, 2, 10, 0000, 0),
(13, 3, 3, 0000, 1),
(13, 4, 2, 0000, 0),
(13, 5, 10, 0000, 0),
(13, 6, 7, 0000, 0),
(13, 7, 7, 0000, 0),
(13, 8, 1, 0000, 0),
(13, 9, 18, 0000, 0),
(13, 10, 11, 0000, 0),
(14, 1, 200, 2020, 0),
(14, 2, 100, 2020, 0),
(14, 3, 150, 2020, 1),
(14, 4, 100, 2020, 0),
(14, 5, 150, 2020, 0),
(14, 6, 50, 2020, 0),
(14, 7, 50, 2020, 0),
(14, 8, 100, 2020, 0),
(14, 9, 50, 2020, 0),
(14, 10, 100, 2020, 0);

--
-- Acionadores `matricula_classe`
--
DELIMITER $$
CREATE TRIGGER `Actualiza_Vagas` AFTER UPDATE ON `matricula_classe` FOR EACH ROW Begin
	Update matricula set matricula.total_vagas=matricula.total_vagas-old.total_vagas+new.total_vagas
	where new.codMatr=matricula.codMatr;
End
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Incrementa_Vagas` AFTER INSERT ON `matricula_classe` FOR EACH ROW Begin
	Update matricula set matricula.total_vagas=matricula.total_vagas+new.total_vagas
	where new.codMatr=matricula.codMatr;
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `codPais` int(11) NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`codPais`, `pais`) VALUES
(1, 'Mocambique ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `codP` int(11) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `nomes` varchar(50) NOT NULL,
  `coddist` int(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('M','F','','') NOT NULL,
  `estado_civil` enum('Casado(a)','Solteiro(a)','','') NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`codP`, `apelido`, `nomes`, `coddist`, `data_nascimento`, `sexo`, `estado_civil`, `numero_telefone`, `email`, `foto`) VALUES
(19, 'Barato', 'Candido', 2, '1999-09-09', 'M', 'Solteiro(a)', 843229480, 'E_tit_u', 0x31323139333231),
(21, 'Teste', 'Joao', 2, '1999-09-09', 'M', 'Solteiro(a)', 843229480, 'E_tit_u', 0x31323139333231),
(27, 'Manhice', 'Ricardo', 2, '1999-07-01', 'M', 'Casado(a)', 22222222, 'dder@gmail.com', 0x32333233323332),
(28, 'Euro', 'Euro', 2, '2000-07-15', 'M', 'Casado(a)', 848484848, 'dddd@gmail.com', 0x32333233323332);

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `codProv` int(11) NOT NULL,
  `codPais` int(11) NOT NULL,
  `provincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`codProv`, `codPais`, `provincia`) VALUES
(1, 1, 'Cidade de Maputo'),
(2, 1, 'Província de Maputo '),
(3, 1, 'Gaza'),
(4, 1, 'Inhambane'),
(5, 1, 'Manica'),
(6, 1, 'Sofala'),
(7, 1, 'Tete'),
(8, 1, 'Zambézia '),
(9, 1, 'Nampula'),
(10, 1, 'Niassa'),
(11, 1, 'Cabo delgado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia_encarregado`
--

CREATE TABLE `residencia_encarregado` (
  `codRes` int(11) NOT NULL,
  `codEnc` int(11) NOT NULL,
  `codProv` int(11) NOT NULL,
  `codbairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `residencia_encarregado`
--

INSERT INTO `residencia_encarregado` (`codRes`, `codEnc`, `codProv`, `codbairro`, `av_ou_rua`) VALUES
(14, 14, 1, 2, 'Av. de Mocambique'),
(15, 15, 1, 2, 'Av. de Mocambique'),
(17, 17, 1, 2, 'Exemplo'),
(18, 18, 1, 2, 'Exemplo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia_pessoa`
--

CREATE TABLE `residencia_pessoa` (
  `codRes` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `codProv` int(11) NOT NULL,
  `codbairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL,
  `quarteirao` varchar(5) NOT NULL,
  `nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `residencia_pessoa`
--

INSERT INTO `residencia_pessoa` (`codRes`, `codP`, `codProv`, `codbairro`, `av_ou_rua`, `quarteirao`, `nr_casa`) VALUES
(10, 19, 1, 2, 'Av. de Mocambique', '45', 49),
(11, 21, 1, 2, 'Av. de Mocambique', '45', 49),
(16, 27, 1, 2, 'Av. de Mocambique', 'A3', 32),
(17, 28, 1, 2, 'Av. de Mocambique', 'A3', 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` enum('aluno','funcionario','','') NOT NULL,
  `codP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `usuario`, `senha`, `email`, `tipo`, `codP`) VALUES
(1, 'EuroEuro.sige.ac.mz', 'xÆØ±¡X%H›-è¹XˆÑû', 'dddd@gmail.com', 'aluno', 28);

-- --------------------------------------------------------

--
-- Structure for view `alunos_matriculados`
--
DROP TABLE IF EXISTS `alunos_matriculados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alunos_matriculados`  AS  select `aluno`.`codAl` AS `codal`,concat(`pessoa`.`nomes`,' ',`pessoa`.`apelido`) AS `nome`,`aluno_matricula`.`data` AS `data`,`classe`.`classe` AS `classe` from ((((`aluno` join `pessoa`) join `aluno_matricula`) join `aluno_classe`) join `classe`) where ((`aluno`.`codP` = `pessoa`.`codP`) and (`aluno`.`codAl` = `aluno_matricula`.`codAl`) and (`aluno`.`codAl` = `aluno_classe`.`codAl`) and (`aluno_classe`.`codClass` = `classe`.`codClass`)) ;

-- --------------------------------------------------------

--
-- Structure for view `matriculas_marcadas`
--
DROP TABLE IF EXISTS `matriculas_marcadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `matriculas_marcadas`  AS  select `classe`.`classe` AS `classe`,`classe`.`turno` AS `turno`,`matricula_classe`.`total_Vagas` AS `total_vagas`,`matricula_classe`.`total_vagas_preenchidas` AS `total_vagas_preenchidas`,`matricula_classe`.`ano` AS `ano` from ((`classe` join `matricula`) join `matricula_classe`) where ((`classe`.`codClass` = `matricula_classe`.`codClass`) and (`matricula`.`codMatr` = `matricula_classe`.`codMatr`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAl`),
  ADD KEY `codCand` (`codCand`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD PRIMARY KEY (`codAl`,`codClass`),
  ADD KEY `codClass` (`codClass`);

--
-- Indexes for table `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD PRIMARY KEY (`codAl`,`codMatr`),
  ADD KEY `codMatr` (`codMatr`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`codbairro`),
  ADD KEY `coddist` (`coddist`);

--
-- Indexes for table `bi`
--
ALTER TABLE `bi`
  ADD PRIMARY KEY (`bi`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD PRIMARY KEY (`codCand`),
  ADD UNIQUE KEY `nome_completo` (`nome_completo`),
  ADD KEY `codEscola` (`codEscola`);

--
-- Indexes for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD PRIMARY KEY (`codCand`,`codMatr`),
  ADD KEY `codMatr` (`codMatr`);

--
-- Indexes for table `chefia`
--
ALTER TABLE `chefia`
  ADD PRIMARY KEY (`codTrab`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`codClass`);

--
-- Indexes for table `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  ADD PRIMARY KEY (`codDados`),
  ADD KEY `codEscola` (`codEscola`),
  ADD KEY `codAl` (`codAl`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`coddist`),
  ADD KEY `codProv` (`codProv`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`codEnc`),
  ADD KEY `codAl` (`codAl`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`codEscola`),
  ADD KEY `coddist` (`coddist`);

--
-- Indexes for table `filiacao`
--
ALTER TABLE `filiacao`
  ADD PRIMARY KEY (`codFil`),
  ADD KEY `codAl` (`codAl`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codTrab`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codMatr`);

--
-- Indexes for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD PRIMARY KEY (`codMatr`,`codClass`),
  ADD KEY `codClass` (`codClass`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codPais`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codP`),
  ADD KEY `coddist` (`coddist`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`codProv`),
  ADD KEY `codPais` (`codPais`);

--
-- Indexes for table `residencia_encarregado`
--
ALTER TABLE `residencia_encarregado`
  ADD PRIMARY KEY (`codRes`),
  ADD KEY `codEnc` (`codEnc`);

--
-- Indexes for table `residencia_pessoa`
--
ALTER TABLE `residencia_pessoa`
  ADD PRIMARY KEY (`codRes`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `codP` (`codP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `codAl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `codbairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `codClass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  MODIFY `codDados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `coddist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `codEnc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `codEscola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `filiacao`
--
ALTER TABLE `filiacao`
  MODIFY `codFil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `codMatr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `codPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `codProv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `residencia_encarregado`
--
ALTER TABLE `residencia_encarregado`
  MODIFY `codRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `residencia_pessoa`
--
ALTER TABLE `residencia_pessoa`
  MODIFY `codRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_4` FOREIGN KEY (`codCand`) REFERENCES `candidato_aluno` (`codCand`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_5` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD CONSTRAINT `aluno_classe_ibfk_1` FOREIGN KEY (`codClass`) REFERENCES `classe` (`codClass`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_classe_ibfk_2` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD CONSTRAINT `aluno_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_matricula_ibfk_3` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`coddist`) REFERENCES `distrito` (`coddist`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bi`
--
ALTER TABLE `bi`
  ADD CONSTRAINT `bi_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD CONSTRAINT `candidato_aluno_ibfk_1` FOREIGN KEY (`codEscola`) REFERENCES `escola` (`codEscola`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD CONSTRAINT `candidato_matricula_ibfk_1` FOREIGN KEY (`codCand`) REFERENCES `candidato_aluno` (`codCand`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `candidato_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `chefia`
--
ALTER TABLE `chefia`
  ADD CONSTRAINT `chefia_ibfk_1` FOREIGN KEY (`codTrab`) REFERENCES `funcionario` (`codTrab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  ADD CONSTRAINT `dados_escola_anterior_ibfk_1` FOREIGN KEY (`codEscola`) REFERENCES `escola` (`codEscola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dados_escola_anterior_ibfk_2` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`codProv`) REFERENCES `provincia` (`codProv`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encarregado`
--
ALTER TABLE `encarregado`
  ADD CONSTRAINT `encarregado_ibfk_2` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`coddist`) REFERENCES `distrito` (`coddist`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `filiacao`
--
ALTER TABLE `filiacao`
  ADD CONSTRAINT `filiacao_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD CONSTRAINT `matricula_classe_ibfk_1` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_classe_ibfk_2` FOREIGN KEY (`codClass`) REFERENCES `classe` (`codClass`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_6` FOREIGN KEY (`coddist`) REFERENCES `distrito` (`coddist`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`codPais`) REFERENCES `pais` (`codPais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `residencia_encarregado`
--
ALTER TABLE `residencia_encarregado`
  ADD CONSTRAINT `residencia_encarregado_ibfk_1` FOREIGN KEY (`codEnc`) REFERENCES `encarregado` (`codEnc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `residencia_pessoa`
--
ALTER TABLE `residencia_pessoa`
  ADD CONSTRAINT `residencia_pessoa_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
