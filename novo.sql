-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Set-2019 às 10:58
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
-- Database: `novo`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAluno_matriculado` (IN `_apelido` VARCHAR(30), IN `_nomes` VARCHAR(50), IN `_pais_nas` VARCHAR(50), IN `_provincia_nas` VARCHAR(50), IN `_distrito_nas` VARCHAR(50), IN `_data_nascimento` DATE, IN `_bi` VARCHAR(13), IN `_local_emissao` VARCHAR(50), IN `_data_em` DATE, IN `_sexo` ENUM('M','F'), IN `_estado_civil` ENUM('S','C'), IN `_provincia_res` VARCHAR(50), IN `_distrito_res` VARCHAR(50), IN `_bairro` VARCHAR(50), IN `_av_ou_rua` VARCHAR(50), IN `_quarteirao` VARCHAR(50), IN `_nr_casa` INT, IN `_numero_telf` INT, IN `_email` VARCHAR(50), IN `_nome_pai` VARCHAR(50), IN `_telefone_pai` INT, IN `_local_trabalho_pai` VARCHAR(50), IN `_profissao_pai` VARCHAR(50), IN `_nome_mae` VARCHAR(50), IN `_telefone_mae` INT, IN `_local_trabalho_mae` VARCHAR(50), IN `_profissao_mae` VARCHAR(50), IN `_nome_enc` VARCHAR(50), IN `_numero_tf_enc` INT, IN `_provincia_enc` VARCHAR(50), IN `_distrito_enc` VARCHAR(50), IN `_bairro_enc` VARCHAR(50), IN `_av_ou_rua_enc` VARCHAR(50), IN `_local_trab_enc` VARCHAR(50), IN `_profissao_enc` VARCHAR(50))  Begin
	declare idp_p int; 
	declare idp_p_t int; 
	declare id_bair_enc int;
	declare id_bair_al int;
	declare id_enc int;
	declare id_nat int;
	declare id_al int;
	declare id_matr int;
	declare id_cand int;	
	declare clas varchar(5);
	declare id_clas int;
	declare turn enum('diurno','nocturno');

	Start transaction;
	Select id_pessoa into idp_p_t from pessoa where apelido=_apelido and nomes=_nomes; 
	if (idp_p_t is not null) then
		Select "Este Aluno ja esta registado" as Mensagem;
	else
		Begin
			Select id_candidato into id_cand from candidato_aluno where nome=_nomes and apelido=_apelido;
 			Select classe_matricular into clas from candidato_aluno where nome=_nomes and apelido=_apelido;
			Select regime into turn from candidato_aluno where nome=_nomes and apelido=_apelido;
 
			Call addPessoa(6,_nomes,_apelido,_data_nascimento,_sexo, 
			_estado_civil,_numero_telf,_email);
	
			Select id_pessoa into idp_p from pessoa where apelido=_apelido and nomes=_nomes;
	
			if(idp_p is not null) then
				Begin
					Select id_distrito into id_nat from distrito where nome_distrito=_distrito_nas;
					Insert into aluno (id_aluno,id_pessoa,id_natural) values (2,idp_p,id_nat);
					Select id_aluno into id_al from aluno where id_pessoa=idp_p;
					if(id_al is not null) then
						begin 
							Select id_bairro into id_bair_al from bairro where nome_bairro=_bairro;
							Insert into residencia_aluno (id_aluno,id_bairro,av_ou_rua,quarteirao,nr_casa) values (id_al,id_bair_al,_av_ou_rua,_quarteirao,_nr_casa);
							Insert into aluno_candidato (id_aluno,id_candidato,estado,data) values (id_al,id_cand,'candidato',curdate());			
							Select id_classe into id_clas from classe where classe=clas and turno=turn;
							Insert into aluno_classe (id_aluno,id_classe,ano) values (id_al,id_clas,year(curdate()));
							Select id_matricula into id_matr from matricula where data_fim>=curdate();
							Insert into aluno_matricula (id_aluno,id_matricula,estado) value (id_al,id_matr,default);
							Insert into bi (id_aluno,numero_bi,data_emissao,local_emissao) values (id_al,_bi,_data_em,_local_emissao);
							Insert into filiacao (id_filiacao,id_aluno,nome_pai,telefone_pai,local_trabalho_pai,profissao_pai,nome_mae,telefone_mae,local_trabalho_mae,profissao_mae) values (default,id_al,_nome_pai,_telefone_pai,_local_trabalho_pai,_profissao_pai,_nome_mae,_telefone_mae,_local_trabalho_mae,_profissao_mae);
							Insert into encarregado (id_encarregado,id_aluno,nome_completo,numero_telefone,local_trabalho,profissao) values (default,id_al,_nome_enc,_numero_tf_enc,_local_trab_enc,_profissao_enc);	
							Select id_encarregado into id_enc from encarregado where id_aluno=id_al;
							Select id_bairro into id_bair_enc from bairro where nome_bairro=_bairro_enc; 
							Insert into residencia_encarregado (id_encarregado,id_bairro,av_ou_rua) values (id_enc,id_bair_enc,_av_ou_rua_enc);
							commit;
						end;
					else
						Begin
							Select 'Erro no id_al' as Mensagem;
							rollback;
						End;	
					end if;
				end;

			else
				Begin
					Select 'Erro no idP_p' as Mensagem;
					rollback;
				End;
			end if;		
		End;
	End if; 
	
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addCandidato` (`_id_cand` INT, `_nomes` VARCHAR(50), `_apelido` VARCHAR(50), `_data_nascimento` DATE, `_sexo` ENUM('M','F'), `_classe_matricular` ENUM('8','9','10','11','12'), `_regime` ENUM('Diurno','Nocturno'), `_escola_Origem` VARCHAR(50), `_distrito_origem` VARCHAR(50))  Begin 
	declare id_esco int;
	declare id_matr int;
	declare usuario varchar(50);
	
	Start transaction; 
	select id_escola into id_esco from direcao_distrital,escola where designacao=_distrito_origem and nome_escola=_escola_Origem;
	Select id_matricula into id_matr from matricula where estado='Em curso' or estado='Pendente' and data_fim>=curdate();
	Select username into usuario from candidato_aluno where nome=_nomes and apelido=_apelido;	

	if((id_esco is not null) && (id_matr is not null)) then
		begin
			if(usuario is not null) then
				begin
					Select CONCAT(username,109) into usuario from candidato_aluno where nome=_nomes and apelido=_apelido;
					
					insert into candidato_aluno (id_candidato,id_escola,nome,apelido,data_nascimento,sexo,classe_matricular,
					regime,ano,username,senha) values (_id_cand,id_esco,_nomes,_apelido,_data_nascimento,_sexo,_classe_matricular,_regime,
					year(curdate()),usuario,AES_ENCRYPT('Euro','senha'));
					commit;
				end;
			else
				insert into candidato_aluno (id_candidato,id_escola,nome,apelido,data_nascimento,sexo,classe_matricular,
				regime,ano,username,senha) values (_id_cand,id_esco,_nomes,_apelido,_data_nascimento,_sexo,_classe_matricular,_regime,
				year(curdate()),CONCAT(_nomes,_apelido),AES_ENCRYPT('Euro','senha'));
				commit;
			end if;		
		end;
	else
		Select 'Cadastro invalido' as Mensagem;	
		rollback;
	end if;		
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addPessoa` (IN `_id_pessoa` INT(11), IN `_nome` VARCHAR(50), IN `_apelido` VARCHAR(30), IN `_data_nascimento` DATE, IN `_sexo` ENUM('M','F'), IN `_estado_civil` ENUM('S','C'), IN `_numero_telf` INT(11), IN `_email` VARCHAR(50))  Begin
	insert into pessoa (id_pessoa, nomes,apelido,data_nascimento, sexo, estado_civil,
	numero_telf,email, data_cadastro) values (_id_pessoa, _nome,_apelido,_data_nascimento, _sexo, _estado_civil,
	_numero_telf, _email,curdate());  
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_natural` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `id_pessoa`, `id_natural`) VALUES
(1, 5, 1),
(2, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_candidato`
--

CREATE TABLE `aluno_candidato` (
  `id_aluno` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `estado` enum('candidato','aluno') NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_candidato`
--

INSERT INTO `aluno_candidato` (`id_aluno`, `id_candidato`, `estado`, `data`) VALUES
(1, 2, 'candidato', '2019-09-19'),
(2, 4, 'candidato', '2019-09-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classe`
--

CREATE TABLE `aluno_classe` (
  `id_aluno` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_classe`
--

INSERT INTO `aluno_classe` (`id_aluno`, `id_classe`, `ano`) VALUES
(1, 1, 2019),
(2, 1, 2019);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_escola`
--

CREATE TABLE `aluno_escola` (
  `id_aluno` int(11) NOT NULL,
  `id_escola` int(11) NOT NULL,
  `estado` enum('Ativo','Transferido','Graduado','Desistente') NOT NULL,
  `data_ingresso` date NOT NULL,
  `classe_ingresso` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `id_aluno` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `estado` enum('Candidato_Aluno','Renovada','Novo Ingresso') NOT NULL DEFAULT 'Candidato_Aluno'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno_matricula`
--

INSERT INTO `aluno_matricula` (`id_aluno`, `id_matricula`, `estado`) VALUES
(1, 1, 'Candidato_Aluno'),
(2, 1, 'Candidato_Aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `id_bairro` int(11) NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `nome_bairro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`id_bairro`, `id_distrito`, `nome_bairro`) VALUES
(1, 1, 'Jorge Dimitrov');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bi`
--

CREATE TABLE `bi` (
  `id_aluno` int(11) NOT NULL,
  `numero_bi` varchar(13) NOT NULL,
  `data_emissao` date NOT NULL,
  `local_emissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bi`
--

INSERT INTO `bi` (`id_aluno`, `numero_bi`, `data_emissao`, `local_emissao`) VALUES
(1, '1990A7S7P090C', '2019-09-12', 'Cidade de Maputo'),
(2, '1990A797P090C', '2019-09-10', 'Cidade de Maputo');

-- --------------------------------------------------------

--
-- Stand-in structure for view `candidatos_cadastrados`
-- (See below for the actual view)
--
CREATE TABLE `candidatos_cadastrados` (
`id_candidato` int(11)
,`nome` varchar(50)
,`apelido` varchar(50)
,`regime` enum('Diurno','Nocturno')
,`classe_matricular` enum('8','9','10','11','12')
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_aluno`
--

CREATE TABLE `candidato_aluno` (
  `id_candidato` int(11) NOT NULL,
  `id_escola` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `classe_matricular` enum('8','9','10','11','12') NOT NULL,
  `regime` enum('Diurno','Nocturno') NOT NULL,
  `ano` year(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato_aluno`
--

INSERT INTO `candidato_aluno` (`id_candidato`, `id_escola`, `nome`, `apelido`, `data_nascimento`, `sexo`, `classe_matricular`, `regime`, `ano`, `username`, `senha`) VALUES
(1, 1, 'Candido Ernesto', 'Barato', '2019-09-02', 'M', '8', 'Diurno', 2019, 'CandidoErnestoBarato', 'BaratoCandido'),
(2, 1, 'Paulo Titos', 'Mondlane', '2019-09-09', 'M', '8', 'Diurno', 2019, 'exemplo', 'xÆØ±¡X%H›-è¹XˆÑû'),
(3, 1, 'Absalao Nelio', 'Nhamtubo', '2019-09-26', 'M', '8', 'Diurno', 2017, 'Absalao NelioNhamtubo', 'xÆØ±¡X%H›-è¹XˆÑû'),
(4, 2, 'Ricardo Orlando', 'Manhice', '2019-09-02', 'M', '8', 'Diurno', 2019, 'Ricardo OrlandoManhice', 'xÆØ±¡X%H›-è¹XˆÑû');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chefia`
--

CREATE TABLE `chefia` (
  `id_funcionario` int(11) NOT NULL,
  `data_nomea` date NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `classe` enum('8','9','10','11','12') NOT NULL,
  `seccao` enum('A','B','C') NOT NULL,
  `turno` enum('nocturno','diurno') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`id_classe`, `classe`, `seccao`, `turno`) VALUES
(1, '8', '', 'diurno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_distrital`
--

CREATE TABLE `direcao_distrital` (
  `id_distrito` int(11) NOT NULL,
  `designacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `direcao_distrital`
--

INSERT INTO `direcao_distrital` (`id_distrito`, `designacao`) VALUES
(1, 'kamubukwana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `nome_distrito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `id_provincia`, `nome_distrito`) VALUES
(1, 1, 'kamubukwana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `id_encarregado` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `local_trabalho` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encarregado`
--

INSERT INTO `encarregado` (`id_encarregado`, `id_aluno`, `nome_completo`, `numero_telefone`, `local_trabalho`, `profissao`) VALUES
(6, 1, 'Mario', 847788118, 'Cidade de Maputo', 'Pedreiro'),
(7, 2, 'Marcio', 840788118, 'Cidade de Maputo', 'Pedreiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco_escola`
--

CREATE TABLE `endereco_escola` (
  `id_escola` int(11) NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `nr_casa` int(11) NOT NULL,
  `nr_quarteirao` varchar(10) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id_escola` int(11) NOT NULL,
  `id_distrital` int(11) NOT NULL,
  `nome_escola` varchar(50) NOT NULL,
  `tipo` enum('primaria','secundaria') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id_escola`, `id_distrital`, `nome_escola`, `tipo`) VALUES
(1, 1, 'Escola Secundaria Quisse Mavota', 'secundaria'),
(2, 1, 'Escola Secundaria Joaquim Chissano', 'secundaria'),
(3, 1, 'Escola Secundaria Herois Mocambicanos ', 'secundaria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `id_filiacao` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
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

INSERT INTO `filiacao` (`id_filiacao`, `id_aluno`, `nome_pai`, `telefone_pai`, `local_trabalho_pai`, `profissao_pai`, `nome_mae`, `telefone_mae`, `local_trabalho_mae`, `profissao_mae`) VALUES
(6, 1, 'Mario', 842191892, 'Cidade de Maputo', 'Pedreiro', 'Maria', 842993842, 'Cidade de Maputo', 'Domestica'),
(7, 2, 'Marcio', 840788118, 'Cidade de Maputo', 'Pedreiro', 'Marta', 842093842, 'Cidade de Maputo', 'Domestica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `carreira` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_escola`
--

CREATE TABLE `funcionario_escola` (
  `id_funcionario` int(11) NOT NULL,
  `id_escola` int(11) NOT NULL,
  `data_ingresso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `id_matricula` int(11) NOT NULL,
  `tipo` enum('Novo ingresso','Renovacao') NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `estado` enum('Em curso','Terminada','Pendente') NOT NULL,
  `total_vagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`id_matricula`, `tipo`, `data_inicio`, `data_fim`, `estado`, `total_vagas`) VALUES
(1, 'Novo ingresso', '2019-09-18', '2020-05-04', 'Em curso', 55445);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_classe`
--

CREATE TABLE `matricula_classe` (
  `id_matricula` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `numero_vagas` int(11) NOT NULL,
  `data` date NOT NULL,
  `total_vagas_preenchidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nome_pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nome_pais`) VALUES
(1, 'Mocambique');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nomes` varchar(50) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `estado_civil` enum('S','C') NOT NULL,
  `numero_telf` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nomes`, `apelido`, `data_nascimento`, `sexo`, `estado_civil`, `numero_telf`, `email`, `data_cadastro`) VALUES
(5, 'Paulo Titos', 'Mondlane', '2017-04-03', 'M', 'C', 843229480, 'dddd@gmail.com', '2019-09-19'),
(6, 'Ricardo Orlando', 'Manhice', '2019-09-10', 'M', 'S', 33, 'dddd@gmail.com', '2019-09-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nome_provincia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `id_pais`, `nome_provincia`) VALUES
(1, 1, 'Cidade de Maputo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia_aluno`
--

CREATE TABLE `residencia_aluno` (
  `id_aluno` int(11) NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL,
  `quarteirao` varchar(50) NOT NULL,
  `nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `residencia_aluno`
--

INSERT INTO `residencia_aluno` (`id_aluno`, `id_bairro`, `av_ou_rua`, `quarteirao`, `nr_casa`) VALUES
(1, 1, 'Av. de Mocambique', '45', 45),
(2, 1, 'Av. de Mocambique', '33', 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia_encarregado`
--

CREATE TABLE `residencia_encarregado` (
  `id_encarregado` int(11) NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `residencia_encarregado`
--

INSERT INTO `residencia_encarregado` (`id_encarregado`, `id_bairro`, `av_ou_rua`) VALUES
(6, 1, 'Av. de Mocambique'),
(7, 1, 'Av. de Mocambique');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_pessoa` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `numero_telf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `candidatos_cadastrados`
--
DROP TABLE IF EXISTS `candidatos_cadastrados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `candidatos_cadastrados`  AS  select `candidato_aluno`.`id_candidato` AS `id_candidato`,`candidato_aluno`.`nome` AS `nome`,`candidato_aluno`.`apelido` AS `apelido`,`candidato_aluno`.`regime` AS `regime`,`candidato_aluno`.`classe_matricular` AS `classe_matricular` from (`candidato_aluno` join `aluno_candidato`) where ((`candidato_aluno`.`id_candidato` = `aluno_candidato`.`id_candidato`) and (`aluno_candidato`.`estado` = 'candidato') and (`candidato_aluno`.`ano` = year(curdate()))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `id_natural` (`id_natural`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- Indexes for table `aluno_candidato`
--
ALTER TABLE `aluno_candidato`
  ADD PRIMARY KEY (`id_aluno`,`id_candidato`),
  ADD KEY `id_candidato` (`id_candidato`);

--
-- Indexes for table `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD PRIMARY KEY (`id_classe`,`id_aluno`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Indexes for table `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD PRIMARY KEY (`id_aluno`,`id_escola`),
  ADD KEY `id_escola` (`id_escola`);

--
-- Indexes for table `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD PRIMARY KEY (`id_aluno`,`id_matricula`),
  ADD KEY `id_matricula` (`id_matricula`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_bairro`),
  ADD KEY `id_distrito` (`id_distrito`);

--
-- Indexes for table `bi`
--
ALTER TABLE `bi`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Indexes for table `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD PRIMARY KEY (`id_candidato`),
  ADD KEY `id_escola` (`id_escola`);

--
-- Indexes for table `chefia`
--
ALTER TABLE `chefia`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Indexes for table `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD PRIMARY KEY (`id_distrito`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`id_encarregado`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Indexes for table `endereco_escola`
--
ALTER TABLE `endereco_escola`
  ADD PRIMARY KEY (`id_escola`),
  ADD KEY `id_bairro` (`id_bairro`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id_escola`),
  ADD KEY `id_distrital` (`id_distrital`);

--
-- Indexes for table `filiacao`
--
ALTER TABLE `filiacao`
  ADD PRIMARY KEY (`id_filiacao`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- Indexes for table `funcionario_escola`
--
ALTER TABLE `funcionario_escola`
  ADD PRIMARY KEY (`id_funcionario`,`id_escola`),
  ADD KEY `id_escola` (`id_escola`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_matricula`);

--
-- Indexes for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD PRIMARY KEY (`id_matricula`,`id_classe`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indexes for table `residencia_aluno`
--
ALTER TABLE `residencia_aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `id_bairro` (`id_bairro`);

--
-- Indexes for table `residencia_encarregado`
--
ALTER TABLE `residencia_encarregado`
  ADD PRIMARY KEY (`id_encarregado`),
  ADD KEY `id_bairro` (`id_bairro`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bi`
--
ALTER TABLE `bi`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `id_encarregado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id_escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filiacao`
--
ALTER TABLE `filiacao`
  MODIFY `id_filiacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`id_natural`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_4` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_candidato`
--
ALTER TABLE `aluno_candidato`
  ADD CONSTRAINT `aluno_candidato_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_candidato_ibfk_4` FOREIGN KEY (`id_candidato`) REFERENCES `candidato_aluno` (`id_candidato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD CONSTRAINT `aluno_classe_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_classe_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD CONSTRAINT `aluno_escola_ibfk_2` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_escola_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD CONSTRAINT `aluno_matricula_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_matricula_ibfk_4` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bi`
--
ALTER TABLE `bi`
  ADD CONSTRAINT `bi_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD CONSTRAINT `candidato_aluno_ibfk_1` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_escola`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `chefia`
--
ALTER TABLE `chefia`
  ADD CONSTRAINT `chefia_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD CONSTRAINT `direcao_distrital_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encarregado`
--
ALTER TABLE `encarregado`
  ADD CONSTRAINT `encarregado_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `endereco_escola`
--
ALTER TABLE `endereco_escola`
  ADD CONSTRAINT `endereco_escola_ibfk_1` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `endereco_escola_ibfk_2` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_distrital`) REFERENCES `direcao_distrital` (`id_distrito`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `filiacao`
--
ALTER TABLE `filiacao`
  ADD CONSTRAINT `filiacao_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario_escola`
--
ALTER TABLE `funcionario_escola`
  ADD CONSTRAINT `funcionario_escola_ibfk_1` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_escola_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD CONSTRAINT `matricula_classe_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_classe_ibfk_2` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `residencia_aluno`
--
ALTER TABLE `residencia_aluno`
  ADD CONSTRAINT `residencia_aluno_ibfk_2` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `residencia_aluno_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `residencia_encarregado`
--
ALTER TABLE `residencia_encarregado`
  ADD CONSTRAINT `residencia_encarregado_ibfk_1` FOREIGN KEY (`id_encarregado`) REFERENCES `encarregado` (`id_encarregado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `residencia_encarregado_ibfk_2` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
