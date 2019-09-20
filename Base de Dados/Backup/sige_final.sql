-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Set-2019 às 17:14
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
-- Database: `sige_final`
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `addCandidato` (`_nomes` VARCHAR(50), `_apelido` VARCHAR(50), `_data_nascimento` DATE, `_sexo` ENUM('M','F'), `_classe_matricular` ENUM('8','9','10','11','12'), `_regime` ENUM('Diurno','Nocturno'), `_escola_Origem` VARCHAR(60), `_id_escola` INT)  Begin 
	declare id_cand varchar(9);

	Start transaction; 
	set id_cand=(SELECT `AddPessoa`(_nomes, _apelido, _sexo, 'Solteiro', _data_nascimento, 'C'));
	
	if(id_cand is not null) then
		Begin
			INSERT INTO `aluno` (`id_aluno`, `Tipo`) VALUES (id_cand, 'Candidato');
			INSERT INTO `candidato_aluno` (id_candidato, id_escola, classe_matricular, regime,  ano) VALUES (id_cand, _id_escola,_classe_matricular, _regime, year(CURRENT_DATE));  
			INSERT INTO `escola_anterior` (`id_Candidato`, `Nome_escola`, `Turma`, `Classe`) VALUES (id_cand,_escola_Origem, 'P', default);
			commit;
		end;
	else
		Begin
			Select 'O erro esta no id_cand' as Mensagem;
			rollback;
		end;
	end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddEscola` (IN `_Nome` VARCHAR(40), IN `_Nivel` ENUM('Secundaria','Primaria'), IN `_Pertenca` ENUM('Publica','Privada'), IN `_id_Dir` INT, IN `_id_End` INT)  NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`, `id_End`) VALUES ( (SELECT `Gera_ID_Escola`(YEAR(CURRENT_DATE))), _Nome, _Nivel,_Pertenca, _id_Dir,_id_End)$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `AddPessoa` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Tipo` ENUM('F','A','C')) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
set idP=( SELECT `Gera_Id`(_Tipo));

INSERT INTO pessoa (id_Pessoa,Nome,Apelido,Sexo,Estado_Civil,Data_Nascimento) VALUES (idP,_Nome,_Apelido,_Sexo,_Estado_Civil,_Data_Nascimento);

RETURN  idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GeraCodRecuperacao` () RETURNS INT(11) NO SQL
    DETERMINISTIC
    COMMENT 'Essa Funcao Permite Gerar codigo de recuperacao aleatorio'
RETURN (SELECT round(rand()*1000000))$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Gera_Id` (`_Tipo` ENUM('F','A','C')) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Gera id Pessoa'
BEGIN
DECLARE cod int(11);
DECLARE codG int(11);
DECLARE idGerado varchar(9);
set cod=0;


SELECT COUNT(*) into cod FROM `pessoa`;
set codG= (SELECT YEAR(CURRENT_DATE)*10000+cod)+1; 

set idGerado=(SELECT concat((SELECT LEFT(codG,4)),_Tipo,(SELECT RIGHT(codG,4))));

SELECT COUNT(pessoa.id_Pessoa) FROM pessoa WHERE pessoa.id_Pessoa=idGerado into cod;
WHILE(cod!=0)do
set codG=codG+1;
set idGerado=(SELECT concat((SELECT LEFT(codG,4)),_Tipo,(SELECT RIGHT(codG,4))));
SELECT COUNT(pessoa.id_Pessoa) FROM pessoa WHERE pessoa.id_Pessoa=idGerado into cod;
end WHILE;


RETURN idGerado;

end$$

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

CREATE DEFINER=`root`@`localhost` FUNCTION `upDateSenha` (`_id` INT, `_nova` VARCHAR(40)) RETURNS TINYINT(1) NO SQL
    COMMENT 'Permite actualizar Senha'
BEGIN
UPDATE `recupera_senha_usuario` SET `Senha_Nova` = _nova WHERE `recupera_senha_usuario`.`id_Solicitacao` =_id;

RETURN (SELECT COUNT(recupera_senha_usuario.id_Solicitacao) FROM recupera_senha_usuario WHERE recupera_senha_usuario.id_Solicitacao=_id and recupera_senha_usuario.Senha_Nova=_nova)>0;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Tipo` enum('Interno','Candidato') NOT NULL DEFAULT 'Interno'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `Tipo`) VALUES
('2019A0003', 'Candidato'),
('2019C0005', 'Candidato'),
('2019C0006', 'Candidato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classe`
--

CREATE TABLE `aluno_classe` (
  `id_aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_classe` tinyint(4) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_documento`
--

CREATE TABLE `aluno_documento` (
  `id_Aluno` varchar(9) NOT NULL,
  `Tipo` enum('Cedula','BI') NOT NULL,
  `Numero` varchar(20) NOT NULL,
  `Data_Emissao` date NOT NULL,
  `Local_Emissao` varchar(40) NOT NULL,
  `Estado` enum('Valido','Invalido') NOT NULL DEFAULT 'Valido',
  `Data_Submissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `id_aluno` varchar(9) NOT NULL,
  `nome_completo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `local_trabalho` varchar(50) CHARACTER SET latin1 NOT NULL,
  `profissao` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_escola`
--

CREATE TABLE `aluno_escola` (
  `id_aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_escola` int(11) NOT NULL,
  `estado` enum('Ativo','Transferido','Graduado','Desistente') NOT NULL,
  `data_ingresso` date NOT NULL,
  `classe_ingresso` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_interno`
--

CREATE TABLE `aluno_interno` (
  `id_Aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `id_Classe` int(11) NOT NULL,
  `id_Turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 1, 'Bagamoio'),
(1, 1, 'Benfica'),
(3, 2, 'Albazine'),
(4, 2, 'Laulane');

-- --------------------------------------------------------

--
-- Stand-in structure for view `candidatos`
-- (See below for the actual view)
--
CREATE TABLE `candidatos` (
`id_candidato` varchar(9)
,`id_escola` int(11)
,`regime` enum('Diurno','Nocturno')
,`classe_matricular` enum('8','9','10','11','12')
,`ano` year(4)
,`Estado` enum('Candidato','Cadastrado','Matriculado')
,`Nome` varchar(40)
,`Apelido` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `candidatos_cadastrados`
-- (See below for the actual view)
--
CREATE TABLE `candidatos_cadastrados` (
`id_candidato` varchar(9)
,`id_escola` int(11)
,`classe_matricular` enum('8','9','10','11','12')
,`regime` enum('Diurno','Nocturno')
,`ano` year(4)
,`id_Pessoa` varchar(9)
,`Nome` varchar(40)
,`Apelido` varchar(40)
,`Sexo` enum('M','F')
,`Estado_Civil` enum('Solteiro','Casado')
,`Data_Nascimento` date
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_aluno`
--

CREATE TABLE `candidato_aluno` (
  `id_candidato` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_escola` int(11) NOT NULL,
  `classe_matricular` enum('8','9','10','11','12') NOT NULL,
  `regime` enum('Diurno','Nocturno') NOT NULL,
  `ano` year(4) NOT NULL,
  `Estado` enum('Candidato','Cadastrado','Matriculado') NOT NULL DEFAULT 'Candidato'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato_aluno`
--

INSERT INTO `candidato_aluno` (`id_candidato`, `id_escola`, `classe_matricular`, `regime`, `ano`, `Estado`) VALUES
('2019A0003', 2, '8', 'Diurno', 2019, 'Candidato'),
('2019C0005', 3, '8', 'Diurno', 2019, 'Candidato'),
('2019C0006', 3, '8', 'Diurno', 2019, 'Candidato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `id_Classe` tinyint(4) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `Secao` varchar(40) NOT NULL DEFAULT 'Geral'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `classe`
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
-- Estrutura da tabela `contacto`
--

CREATE TABLE `contacto` (
  `id_Pessoa` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Nr_Tell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_distrital`
--

CREATE TABLE `direcao_distrital` (
  `id_Dir` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL,
  `Total_Escola` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `direcao_distrital`
--

INSERT INTO `direcao_distrital` (`id_Dir`, `Designacao`, `Total_Escola`) VALUES
(1, 'Ka Mbucuana', 0),
(2, 'Ka Mahota', 0),
(3, 'Marracuene', 0),
(4, 'Boane', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `direcao_escola`
--

CREATE TABLE `direcao_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Funcionario` varchar(9) NOT NULL,
  `id_Cargo` int(11) NOT NULL,
  `Data_Colocacao` date NOT NULL,
  `Estado` enum('Ativo','Desativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(4, 1, 'Boane'),
(3, 1, 'Marracuene'),
(2, 2, 'Ka Mahota'),
(1, 2, 'Ka Mbucuana');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id_Escola` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Nivel` enum('Primario','Secundaria') NOT NULL DEFAULT 'Secundaria',
  `Pertenca` enum('Publica','Privada','Comunitaria') NOT NULL DEFAULT 'Publica',
  `id_Dir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`) VALUES
(1, 'Heroes Mocambicanos', 'Secundaria', 'Publica', 1),
(2, 'Benfica Infulene', 'Secundaria', 'Publica', 1),
(3, 'Joaquim Chissano', 'Secundaria', 'Publica', 2),
(4, 'Laulane', 'Secundaria', 'Publica', 2),
(5, 'Gwaza Muthine', 'Secundaria', 'Publica', 3),
(6, 'Santa Montanha', 'Secundaria', 'Publica', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_anterior`
--

CREATE TABLE `escola_anterior` (
  `id_Candidato` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Nome_escola` varchar(60) NOT NULL,
  `Turma` int(11) NOT NULL,
  `Classe` enum('7','8','9','10','11','12') NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola_anterior`
--

INSERT INTO `escola_anterior` (`id_Candidato`, `Nome_escola`, `Turma`, `Classe`) VALUES
('2019C0005', 'Exemplo', 0, '7'),
('2019C0005', 'Escola Secundaria Joaquim Chissano', 0, '7'),
('2019C0006', 'Escola Secundaria Joaquim Chissano', 0, '7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao_aluno`
--

CREATE TABLE `filiacao_aluno` (
  `id_aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `nome_pai` varchar(50) NOT NULL,
  `telefone_pai` int(11) NOT NULL,
  `local_trabalho_pai` varchar(50) NOT NULL,
  `profissao_pai` varchar(50) NOT NULL,
  `nome_mae` varchar(50) NOT NULL,
  `telefone_mae` int(11) NOT NULL,
  `local_trabalho_mae` varchar(50) NOT NULL,
  `profissao_mae` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_Funcionaio` varchar(9) CHARACTER SET utf8 NOT NULL,
  `carreira` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao_escola`
--

CREATE TABLE `localizacao_escola` (
  `id_escola` int(11) NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `Nr` smallint(6) NOT NULL,
  `Avenida_Rua` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_classe`
--

CREATE TABLE `matricula_classe` (
  `id_Matri` int(11) NOT NULL,
  `id_Matricula` int(11) NOT NULL,
  `Classe` tinyint(4) NOT NULL,
  `Turno` enum('Diurno','Noturno') NOT NULL,
  `Total_Vagas` int(11) NOT NULL DEFAULT '0',
  `Vagas_Preenchidas` int(11) NOT NULL DEFAULT '0',
  `Ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Mocambique'),
(2, 'Africa do Sul');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_Pessoa` varchar(9) NOT NULL,
  `Nome` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Apelido` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Sexo` enum('M','F') CHARACTER SET latin1 NOT NULL DEFAULT 'M',
  `Estado_Civil` enum('Solteiro','Casado') CHARACTER SET latin1 NOT NULL DEFAULT 'Solteiro',
  `Data_Nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_Pessoa`, `Nome`, `Apelido`, `Sexo`, `Estado_Civil`, `Data_Nascimento`) VALUES
('2019A0003', 'Paulo', 'Mondlane', 'M', 'Solteiro', '2019-09-01'),
('2019C0005', 'Ricardo Orlando', 'Manhice', 'M', 'Solteiro', '2019-09-10'),
('2019C0006', 'Ricardo Orlando', 'Manhice', 'M', 'Solteiro', '2019-09-10'),
('2019F0002', 'Candido', 'Barato', 'M', 'Solteiro', '2019-09-01'),
('2019F0004', 'Eurico', 'Mazivila', 'M', 'Solteiro', '2019-09-01'),
('w', 'Candido', 'Barato', 'M', 'Solteiro', '2019-09-01');

--
-- Acionadores `pessoa`
--
DELIMITER $$
CREATE TRIGGER `Cria_User` AFTER INSERT ON `pessoa` FOR EACH ROW INSERT INTO usuario(id_User,Username,Senha,DataCriacao,Email_Instituconal) VALUES(new.id_Pessoa,(SELECT concat(new.Nome,new.id_Pessoa)),new.Apelido,CURRENT_DATE,(SELECT concat(new.Apelido,'.',new.Nome,'.',new.id_Pessoa,'@sige.ac.mz')))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `id_Prov` int(11) NOT NULL,
  `id_Pais` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`id_Prov`, `id_Pais`, `Nome`) VALUES
(1, 1, 'Maputo'),
(2, 1, 'Maputo Cidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recupera_senha_usuario`
--

CREATE TABLE `recupera_senha_usuario` (
  `id_Solicitacao` int(11) NOT NULL,
  `id_Usuario` varchar(9) CHARACTER SET utf8 NOT NULL,
  `CodigoRecuperacao` int(11) NOT NULL,
  `Data_Validalidade` date NOT NULL,
  `Senha_Antiga` varchar(40) NOT NULL,
  `Senha_Nova` varchar(40) NOT NULL,
  `Tipo_Envio` enum('Email','Telefone','Ambos') NOT NULL,
  `Campo_Envio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `recupera_senha_usuario`
--
DELIMITER $$
CREATE TRIGGER `actualizaUsuario` AFTER UPDATE ON `recupera_senha_usuario` FOR EACH ROW UPDATE `usuario` SET `Senha` = new.Senha_Nova WHERE `usuario`.`id_User` = old.id_Usuario
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia_aluno`
--

CREATE TABLE `residencia_aluno` (
  `id_aluno` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL,
  `quarteirao` varchar(50) NOT NULL,
  `nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_distrital`
--

CREATE TABLE `user_distrital` (
  `id_user` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_Dir` int(11) NOT NULL,
  `Estado` enum('Ativo','Rescendido') NOT NULL DEFAULT 'Ativo',
  `Gestao_Escolas` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Operacoes` enum('S','N') NOT NULL DEFAULT 'N',
  `Gestao_Usuarios` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_escola`
--

CREATE TABLE `user_escola` (
  `id_User` varchar(9) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Tipo` enum('Aluno','Professor','Secretaria','Directoria','Admin') NOT NULL DEFAULT 'Aluno',
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_escola`
--

INSERT INTO `user_escola` (`id_User`, `id_Escola`, `Tipo`, `Estado`) VALUES
('2019A0003', 1, 'Secretaria', 'Ativo'),
('2019F0002', 3, 'Secretaria', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_User` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Username` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Senha` varchar(40) CHARACTER SET latin1 NOT NULL,
  `Email_Instituconal` varchar(100) NOT NULL,
  `Estado` enum('Ativo','Revogado','Pendente') CHARACTER SET latin1 NOT NULL DEFAULT 'Ativo',
  `DataCriacao` date NOT NULL,
  `Acesso_Distrital` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Escola` enum('S','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `Acesso_Convidado` enum('S','N') NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_User`, `Username`, `Senha`, `Email_Instituconal`, `Estado`, `DataCriacao`, `Acesso_Distrital`, `Acesso_Escola`, `Acesso_Convidado`) VALUES
('2019A0003', 'Paulo2019A0003', 'Mondlane', 'Mondlane.Paulo.2019A0003@sige.ac.mz', 'Ativo', '2019-09-19', 'N', 'S', 'S'),
('2019C0005', 'Ricardo Orlando2019C0005', 'Manhice', 'Manhice.Ricardo Orlando.2019C0005@sige.ac.mz', 'Ativo', '2019-09-20', 'N', 'N', 'S'),
('2019C0006', 'Ricardo Orlando2019C0006', 'Manhice', 'Manhice.Ricardo Orlando.2019C0006@sige.ac.mz', 'Ativo', '2019-09-20', 'N', 'N', 'S'),
('2019F0002', 'Candido2019F0002', 'Barato', 'Barato.Candido.2019F0002@sige.ac.mz', 'Ativo', '2019-09-19', 'N', 'N', 'S'),
('2019F0004', 'Eurico2019F0004', 'Mazivila', 'Mazivila.Eurico.2019F0004@sige.ac.mz', 'Ativo', '2019-09-19', 'N', 'N', 'S'),
('w', 'Candidow', 'Barato', 'Barato.Candido.w@sige.ac.mz', 'Ativo', '2019-09-19', 'N', 'N', 'S');

-- --------------------------------------------------------

--
-- Structure for view `candidatos`
--
DROP TABLE IF EXISTS `candidatos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `candidatos`  AS  select `candidato_aluno`.`id_candidato` AS `id_candidato`,`candidato_aluno`.`id_escola` AS `id_escola`,`candidato_aluno`.`regime` AS `regime`,`candidato_aluno`.`classe_matricular` AS `classe_matricular`,`candidato_aluno`.`ano` AS `ano`,`candidato_aluno`.`Estado` AS `Estado`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido` from (`candidato_aluno` join `pessoa`) where (`candidato_aluno`.`id_candidato` = `pessoa`.`id_Pessoa`) ;

-- --------------------------------------------------------

--
-- Structure for view `candidatos_cadastrados`
--
DROP TABLE IF EXISTS `candidatos_cadastrados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `candidatos_cadastrados`  AS  select `candidato_aluno`.`id_candidato` AS `id_candidato`,`candidato_aluno`.`id_escola` AS `id_escola`,`candidato_aluno`.`classe_matricular` AS `classe_matricular`,`candidato_aluno`.`regime` AS `regime`,`candidato_aluno`.`ano` AS `ano`,`pessoa`.`id_Pessoa` AS `id_Pessoa`,`pessoa`.`Nome` AS `Nome`,`pessoa`.`Apelido` AS `Apelido`,`pessoa`.`Sexo` AS `Sexo`,`pessoa`.`Estado_Civil` AS `Estado_Civil`,`pessoa`.`Data_Nascimento` AS `Data_Nascimento` from (`candidato_aluno` join `pessoa`) where (`candidato_aluno`.`id_candidato` = `pessoa`.`id_Pessoa`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `id_natural` (`Tipo`);

--
-- Indexes for table `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD PRIMARY KEY (`id_classe`,`id_aluno`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Indexes for table `aluno_documento`
--
ALTER TABLE `aluno_documento`
  ADD UNIQUE KEY `id_Pessoa` (`id_Aluno`,`Tipo`,`Estado`),
  ADD UNIQUE KEY `Tipo` (`Tipo`,`Numero`);

--
-- Indexes for table `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD PRIMARY KEY (`id_aluno`) USING BTREE;

--
-- Indexes for table `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD PRIMARY KEY (`id_aluno`,`id_escola`),
  ADD KEY `id_escola` (`id_escola`);

--
-- Indexes for table `aluno_interno`
--
ALTER TABLE `aluno_interno`
  ADD KEY `id_Aluno` (`id_Aluno`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_Bairro`),
  ADD UNIQUE KEY `id_Distriro` (`id_Distriro`,`Nome`);

--
-- Indexes for table `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD PRIMARY KEY (`id_candidato`,`id_escola`) USING BTREE,
  ADD KEY `id_escola` (`id_escola`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_Classe`),
  ADD UNIQUE KEY `Classe` (`Classe`,`Secao`);

--
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD KEY `id_Pessoa` (`id_Pessoa`);

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
  ADD KEY `id_Pessoa` (`id_Funcionario`),
  ADD KEY `id_Cargo` (`id_Cargo`);

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
  ADD KEY `id_Dir` (`id_Dir`);

--
-- Indexes for table `filiacao_aluno`
--
ALTER TABLE `filiacao_aluno`
  ADD PRIMARY KEY (`id_aluno`) USING BTREE;

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD KEY `id_pessoa` (`id_Funcionaio`);

--
-- Indexes for table `localizacao_escola`
--
ALTER TABLE `localizacao_escola`
  ADD KEY `id_escola` (`id_escola`),
  ADD KEY `id_bairro` (`id_bairro`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id_Matricula`),
  ADD KEY `id_Escola` (`id_Escola`);

--
-- Indexes for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
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
-- Indexes for table `residencia_aluno`
--
ALTER TABLE `residencia_aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `id_bairro` (`id_bairro`);

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
  ADD PRIMARY KEY (`id_User`),
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
  MODIFY `id_Bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_Classe` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id_Escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id_Matricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula_classe`
--
ALTER TABLE `matricula_classe`
  MODIFY `id_Matri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_Prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recupera_senha_usuario`
--
ALTER TABLE `recupera_senha_usuario`
  MODIFY `id_Solicitacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD CONSTRAINT `aluno_classe_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_classe_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_Classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_documento`
--
ALTER TABLE `aluno_documento`
  ADD CONSTRAINT `aluno_documento_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD CONSTRAINT `aluno_encarregado_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_escola`
--
ALTER TABLE `aluno_escola`
  ADD CONSTRAINT `aluno_escola_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_escola_ibfk_2` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_interno`
--
ALTER TABLE `aluno_interno`
  ADD CONSTRAINT `aluno_interno_ibfk_1` FOREIGN KEY (`id_Aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_interno_ibfk_2` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`id_Distriro`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD CONSTRAINT `candidato_aluno_ibfk_1` FOREIGN KEY (`id_candidato`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidato_aluno_ibfk_2` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`id_Pessoa`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD CONSTRAINT `direcao_distrital_ibfk_1` FOREIGN KEY (`id_Dir`) REFERENCES `distrito` (`id_distrito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `direcao_escola`
--
ALTER TABLE `direcao_escola`
  ADD CONSTRAINT `direcao_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcao_escola_ibfk_2` FOREIGN KEY (`id_Funcionario`) REFERENCES `funcionario` (`id_Funcionaio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_Prov`) REFERENCES `provincia` (`id_Prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_Dir`) REFERENCES `direcao_distrital` (`id_Dir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `filiacao_aluno`
--
ALTER TABLE `filiacao_aluno`
  ADD CONSTRAINT `filiacao_aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_Funcionaio`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `localizacao_escola`
--
ALTER TABLE `localizacao_escola`
  ADD CONSTRAINT `localizacao_escola_ibfk_1` FOREIGN KEY (`id_escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `localizacao_escola_ibfk_2` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula_classe`
--
ALTER TABLE `matricula_classe`
  ADD CONSTRAINT `matricula_classe_ibfk_1` FOREIGN KEY (`id_Matricula`) REFERENCES `matricula` (`id_Matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricula_classe_ibfk_2` FOREIGN KEY (`Classe`) REFERENCES `classe` (`id_Classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_Pais`) REFERENCES `pais` (`id_Pais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `recupera_senha_usuario`
--
ALTER TABLE `recupera_senha_usuario`
  ADD CONSTRAINT `recupera_senha_usuario_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `residencia_aluno`
--
ALTER TABLE `residencia_aluno`
  ADD CONSTRAINT `residencia_aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `residencia_aluno_ibfk_2` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id_Bairro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user_distrital`
--
ALTER TABLE `user_distrital`
  ADD CONSTRAINT `user_distrital_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_distrital_ibfk_2` FOREIGN KEY (`id_Dir`) REFERENCES `direcao_distrital` (`id_Dir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user_escola`
--
ALTER TABLE `user_escola`
  ADD CONSTRAINT `user_escola_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_escola_ibfk_2` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `pessoa` (`id_Pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
