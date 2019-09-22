-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Set-2019 às 04:52
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

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

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `AddEscola` (`_Nome` VARCHAR(40), `_Nivel` ENUM('Secundaria','Primaria'), `_Pertenca` ENUM('Publica','Privada'), `_id_Dir` INT) RETURNS INT(11) NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN
DECLARE _id_Escola int(11);
DECLARE quant int(11);
set _id_escola=(SELECT `Gera_Id_Escola`());
INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`) VALUES (_id_escola, _Nome, _Nivel, _Pertenca, _id_Dir);
SET quant = (SELECT COUNT(escola.id_Escola)  FROM escola WHERE escola.id_Escola=_id_escola);
if(quant>0)THEN
set quant=_id_escola;
ELSE
set quant=0;
end if;






RETURN quant;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `AddFuncionario` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Carreira` VARCHAR(40)) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
SELECT AddPessoa(_Nome , _Apelido , _Sexo, _Estado_Civil, _Data_Nascimento, "F") as 'Id' into idP;
INSERT INTO `funcionario` (`id_Funcionaio`, `carreira`) VALUES (idP, _Carreira);



RETURN idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `AddPessoa` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Tipo` ENUM('F','A','C')) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
set idP=( SELECT `Gera_Id`(_Tipo));

INSERT INTO pessoa (id_Pessoa,Nome,Apelido,Sexo,Estado_Civil,Data_Nascimento) VALUES (idP,_Nome,_Apelido,_Sexo,_Estado_Civil,_Data_Nascimento);

RETURN  idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Add_Candidato` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Tipo` ENUM('F','A','C'), `_classeM` ENUM('8','9','10','11','12'), `_regime` ENUM('Diurno','Noturno'), `_nome_escola` VARCHAR(60), `_id_escola` INT) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
Begin 
declare id_cand varchar(9);
SELECT `AddPessoa`(_nomes, _apelido, _sexo, 'Solteiro', _data_nascimento, 'C') as 'id' into id_cand;

 INSERT INTO `aluno` (`id_aluno`, `Tipo`) VALUES (id_cand, 'Candidato');


    

RETURN  id_cand;
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

CREATE DEFINER=`root`@`localhost` FUNCTION `Gera_Id_Escola` () RETURNS INT(11) NO SQL
    COMMENT 'Essa Funcao Gera id Pessoa'
BEGIN
DECLARE cod int(11);
DECLARE codG int(11);
SELECT COUNT(escola.id_Escola) into cod FROM escola;
set codG= (SELECT YEAR(CURRENT_DATE)*10000+cod)+1;
SELECT COUNT(escola.id_Escola) FROM escola WHERE escola.id_Escola=codG into cod;
WHILE(cod!=0)do
set codG=codG+1;
SELECT COUNT(escola.id_Escola)FROM escola WHERE escola.id_Escola=codG into cod;
end WHILE;





RETURN codG;

end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Pega_Cargo_Id` (`_Cargo` VARCHAR(40)) RETURNS INT(11) NO SQL
    COMMENT 'Pega id cargo'
BEGIN
DECLARE id_Cargo int(11);
set id_Cargo =(SELECT COUNT(cargo.id_Cargo) FROM cargo WHERE cargo.Designacao=_Cargo);
if(id_Cargo>0)THEN
set id_Cargo =(SELECT cargo.id_Cargo FROM cargo WHERE cargo.Designacao=_Cargo);
ELSE
INSERT INTO cargo (Designacao) VALUES(_Cargo);
set id_Cargo =(SELECT cargo.id_Cargo FROM cargo WHERE cargo.Designacao=_Cargo);
end if;

RETURN id_Cargo;

end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `RecuperaSenha` (`_id_usuario` VARCHAR(9), `_TipoEnvio` ENUM('Email','Telefone','Ambos'), `_CampoEnvio` VARCHAR(100)) RETURNS INT(11) NO SQL
    COMMENT 'Permite Recuperar Senha'
BEGIN
DECLARE codGerado int(11);
DECLARE dataValidade date;
set codGerado=(SELECT `GeraCodRecuperacao`());
set dataValidade = (SELECT date(DATE_ADD(CURRENT_TIMESTAMP,INTERVAL 1 DAY)));

INSERT INTO `recupera_senha_usuario` (`id_Usuario`, `CodigoRecuperacao`, `Data_Validalidade`, `Senha_Antiga`,  `Tipo_Envio`,`Campo_Envio`) VALUES (_id_usuario,codGerado , dataValidade, (SELECT senha FROM `usuario` WHERE id_User=_id_usuario),_TipoEnvio,_CampoEnvio);

RETURN (SELECT max(recupera_senha_usuario.id_Solicitacao) FROM recupera_senha_usuario WHERE recupera_senha_usuario.id_Usuario=_id_usuario  and recupera_senha_usuario.CodigoRecuperacao=codGerado AND recupera_senha_usuario.Data_Validalidade=dataValidade);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Candidato_Escola` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_classe_matricular` ENUM('8','9','10','11','12'), `_regime` ENUM('Diurno','Nocturno'), `_nome_escola` VARCHAR(60), `_id_Escola` INT) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
SELECT AddPessoa(_Nome , _Apelido , _Sexo, _Estado_Civil, _Data_Nascimento, "C") as 'Id' into idP;
INSERT INTO `aluno` (`id_aluno`, `Tipo`) VALUES (idP, 'Candidato');
INSERT INTO `candidato_aluno` (`id_candidato`, `id_escola`, `classe_matricular`, `regime`, `ano`) VALUES (idP, _id_Escola, _classe_matricular, _regime, year(CURRENT_DATE));
INSERT INTO `escola_anterior` (`id_Candidato`, `Nome_escola`, `Classe`) VALUES (idP, _nome_escola, (SELECT (_classe_matricular-1)));



RETURN idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Candidato_Matricula_Escola` (`_id_Escola` INT, `_id_Candidato` VARCHAR(9), `_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Tipo` ENUM('Cedula','BI'), `_Numero` VARCHAR(20), `_Data_Emissao` DATE, `_Local_Emissao` VARCHAR(40), `_id_Bairro` INT, `_av_ou_rua` VARCHAR(50), `_quarteirao` INT, `_nr_casa` INT, `_email` VARCHAR(100), `_NrTell` INT, `_nome_pai` VARCHAR(40), `_telefone_pai` INT, `_local_trabalho_pai` VARCHAR(40), `_profissao_pai` VARCHAR(40), `_nome_mae` VARCHAR(40), `_telefone_mae` INT, `_local_trabalho_mae` VARCHAR(40), `_profissao_mae` VARCHAR(40), `nome_completoE` VARCHAR(40), `numero_telefoneE` INT, `local_trabalhoE` VARCHAR(50), `profissaoE` VARCHAR(50), `_id_BairroE` INT, `AvenidaE` VARCHAR(60)) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
declare estado varchar(9);

if((SELECT `Status_Candidato`(_id_Escola, _id_Candidato, 'Candidato'))=1)then

INSERT INTO `aluno_documento` (`id_Aluno`, `Tipo`, `Numero`, `Data_Emissao`, `Local_Emissao`, `Estado`, `Data_Submissao`) VALUES (_id_Candidato, _Tipo, _Numero, _Data_Emissao, _Data_Emissao, 'Valido', date(CURRENT_DATE));

INSERT INTO `residencia_aluno` (id_aluno, `id_bairro`, `av_ou_rua`, `quarteirao`, `nr_casa`) VALUES (_id_Candidato, _id_Bairro, _av_ou_rua, _quarteirao, _nr_casa);
if((SELECT COUNT(contacto.Email) FROM contacto WHERE contacto.Email LIKE _email)=0)THEN
UPDATE `contacto` SET `Email` = _email, `Nr_Tell` =_NrTell WHERE `contacto`.`id_Pessoa` = _id_Candidato;
end if;

INSERT INTO `filiacao_aluno` (`id_aluno`, `nome_pai`, `telefone_pai`, `local_trabalho_pai`, `profissao_pai`, `nome_mae`, `telefone_mae`, `local_trabalho_mae`, `profissao_mae`) VALUES (_id_Candidato, _nome_pai, _telefone_pai, _local_trabalho_pai, _profissao_pai, _nome_mae, _telefone_mae, _local_trabalho_mae, _profissao_mae);

INSERT INTO `aluno_encarregado` (`id_aluno`, `nome_completo`, `numero_telefone`, `local_trabalho`, `profissao`,id_bairro,Avenida_Rua) VALUES (_id_Candidato, nome_completoE, numero_telefoneE, local_trabalhoE, profissaoE,_id_BairroE,AvenidaE);
UPDATE `candidato_aluno` SET `Estado` = 'Cadastrado' WHERE `candidato_aluno`.`id_candidato` = _id_Candidato AND `candidato_aluno`.`id_escola` = _id_Escola;

set estado='Sucesso';
ELSE
set estado='Falha';
end if;



RETURN estado;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Escola_Com_Admin` (`_Nome` VARCHAR(40), `_Nivel` ENUM('Secundaria','Primaria'), `_Pertenca` ENUM('Publica','Privada'), `_id_Dir` INT, `_id_bairro` INT, `_Nr` SMALLINT, `_Avenida` VARCHAR(40), `_NomeE` VARCHAR(40), `_ApelidoE` VARCHAR(40), `_Data_NascimentoE` DATE, `_EmailE` VARCHAR(100)) RETURNS VARCHAR(17) CHARSET latin1 NO SQL
BEGIN
DECLARE id_escola int(11);
DECLARE _id_func varchar(9);

set id_escola=(SELECT `Regista_Escola_com_Bairro`(_Nome, _Nivel, _Pertenca , _id_Dir, _id_bairro, _Nr, _Avenida));
set _id_func=(SELECT `Regista_Funcionario_Escola`(_NomeE , _ApelidoE , 'M','Solteiro', _Data_NascimentoE , 'Docente', id_escola,'Admin','Admin' ));
UPDATE `contacto` SET `Email` = _EmailE WHERE contacto.id_Pessoa = _id_func;

RETURN (SELECT concat(_id_func, id_escola));
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Escola_com_Bairro` (`_Nome` VARCHAR(40), `_Nivel` ENUM('Secundaria','Primaria'), `_Pertenca` ENUM('Publica','Privada'), `_id_Dir` INT, `_id_bairro` INT, `_Nr` SMALLINT, `_Avenida` VARCHAR(40)) RETURNS INT(11) NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN
DECLARE _id_Escola int(11);
select `AddEscola`(`_Nome` , `_Nivel` , `_Pertenca` , `_id_Dir`) as 'id' into _id_Escola;
INSERT INTO `localizacao_escola` (`id_escola`, `id_bairro`, `Nr`, `Avenida_Rua`) VALUES (_id_Escola, _id_Bairro, _Nr, _Avenida);

RETURN _id_Escola;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Funcionario_Distrito` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Carreira` VARCHAR(40), `_id_Distrito` INT, `_cargo` VARCHAR(40)) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
SELECT AddPessoa(_Nome , _Apelido , _Sexo, _Estado_Civil, _Data_Nascimento, "F") as 'Id' into idP;
INSERT INTO `funcionario` (`id_Funcionaio`, `carreira`) VALUES (idP, _Carreira);
INSERT INTO `funcionario_distrital` (`id_Funcionario`, `id_distrito`, id_cargo ,`Data_Cadastro`) VALUES (idP, _id_Distrito,(SELECT `Pega_Cargo_Id`(_cargo)), date(CURRENT_DATE));



RETURN idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Regista_Funcionario_Escola` (`_Nome` VARCHAR(40), `_Apelido` VARCHAR(40), `_Sexo` ENUM('M','F'), `_Estado_Civil` ENUM('Solteiro','Casado'), `_Data_Nascimento` DATE, `_Carreira` VARCHAR(40), `_id_Escola` INT, `_cargo` VARCHAR(40), `_acesso` ENUM('Convidado','Admin','Secretaria','Directoia')) RETURNS VARCHAR(9) CHARSET latin1 NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE idP varchar(9);
SELECT AddPessoa(_Nome , _Apelido , _Sexo, _Estado_Civil, _Data_Nascimento, "F") as 'Id' into idP;
INSERT INTO `funcionario` (`id_Funcionaio`, `carreira`) VALUES (idP, _Carreira);
INSERT INTO funcionario_escola (`id_Escola`, `id_Funcionario`, `id_Cargo`, `Data_Colocacao`,Acesso) VALUES (_id_Escola, idP,  (SELECT `Pega_Cargo_Id`(_cargo)), CURRENT_DATE,_acesso);



RETURN idP;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Status_Candidato` (`_id_Escola` INT, `_id_Candidato` VARCHAR(9), `_Estado` ENUM('Candidato','Matriculado','Cadastrado')) RETURNS TINYINT(1) NO SQL
    COMMENT 'Essa Funcao Cria Pessoa'
BEGIN 
DECLARE tot int(11);
declare estado varchar(9);
set tot =(SELECT COUNT(candidato_aluno.id_candidato) FROM candidato_aluno WHERE candidato_aluno.id_candidato=_id_Candidato and candidato_aluno.id_escola=_id_Escola and candidato_aluno.Estado=_Estado);
if(tot!=0)then
set estado='Sucesso';
ELSE
set estado='Falha';
end if;



RETURN (tot!=0);
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
('2019C0006', 'Candidato'),
('2019C0007', 'Candidato'),
('2019C0008', 'Candidato'),
('2019C0009', 'Candidato'),
('2019C0010', 'Candidato'),
('2019C0011', 'Candidato'),
('2019C0012', 'Candidato');

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

--
-- Extraindo dados da tabela `aluno_documento`
--

INSERT INTO `aluno_documento` (`id_Aluno`, `Tipo`, `Numero`, `Data_Emissao`, `Local_Emissao`, `Estado`, `Data_Submissao`) VALUES
('2019C0006', 'Cedula', 'GSDGSD', '2019-09-01', '2019-09-01', 'Valido', '2019-09-21'),
('2019C0007', 'Cedula', '64564', '2019-09-01', '2019-09-01', 'Valido', '2019-09-21'),
('2019C0010', 'Cedula', 'gfdgdf', '2019-09-02', '2019-09-02', 'Valido', '2019-09-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `id_aluno` varchar(9) NOT NULL,
  `nome_completo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `local_trabalho` varchar(50) CHARACTER SET latin1 NOT NULL,
  `profissao` varchar(50) CHARACTER SET latin1 NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `Avenida_Rua` varchar(60) NOT NULL,
  `Q` int(11) NOT NULL,
  `Nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_encarregado`
--

INSERT INTO `aluno_encarregado` (`id_aluno`, `nome_completo`, `numero_telefone`, `local_trabalho`, `profissao`, `id_bairro`, `Avenida_Rua`, `Q`, `Nr_casa`) VALUES
('2019C0010', 'cxvxc', 4, 'vxcv', 'xcvx', 0, '', 0, 0);

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
('2019C0006', 20190003, '9', 'Diurno', 2019, 'Candidato'),
('2019C0007', 20190003, '10', 'Nocturno', 2019, 'Cadastrado'),
('2019C0008', 20190003, '9', 'Nocturno', 2019, 'Candidato'),
('2019C0009', 20190003, '11', 'Nocturno', 2019, 'Candidato'),
('2019C0010', 20190001, '10', 'Nocturno', 2019, 'Cadastrado'),
('2019C0011', 20190001, '10', 'Nocturno', 2019, 'Candidato'),
('2019C0012', 20190001, '10', 'Nocturno', 2019, 'Candidato');

--
-- Acionadores `candidato_aluno`
--
DELIMITER $$
CREATE TRIGGER `Inserindo_Candidato_Aluno` AFTER INSERT ON `candidato_aluno` FOR EACH ROW INSERT into user_escola (id_User,id_Escola,Tipo) VALUES (new.id_candidato,new.id_escola,'Candidato')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `id_Cargo` int(11) NOT NULL,
  `Designacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargo`
--

INSERT INTO `cargo` (`id_Cargo`, `Designacao`) VALUES
(1, 'dfgdfg'),
(2, 'Admin'),
(4, 'Gerente escolar'),
(5, 'Tecnico Informatico'),
(6, 'Tecnico de Secretaria');

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

--
-- Extraindo dados da tabela `contacto`
--

INSERT INTO `contacto` (`id_Pessoa`, `Email`, `Nr_Tell`) VALUES
('2019C0006', '2019C0006@exemplo', 0),
('2019C0007', 'DFGDFGD', 23),
('2019C0008', '2019C0008@exemplo', 0),
('2019C0009', '2019C0009@exemplo', 0),
('2019C0010', 'vxcvx', 2),
('2019C0011', '2019C0011@exemplo', 0),
('2019C0012', '2019C0012@exemplo', 0),
('2019F0001', 'MazimbeErnes@gmail.com', 887),
('2019F0002', 'LuizBernaldo@gmail.com', 0),
('2019F0003', 'MazimbeErnesto@gmail.com', 0),
('2019F0004', 'GuambeMateus@hotmail.com', 0),
('2019F0005', '2019F0005@exemplo', 0);

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
(1, 'Ka Mbucuana', 1),
(2, 'Ka Mahota', 0),
(3, 'Marracuene', 0),
(4, 'Boane', 0);

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
  `Nivel` enum('Primaria','Secundaria') NOT NULL DEFAULT 'Secundaria',
  `Pertenca` enum('Publica','Privada','Comunitaria') NOT NULL DEFAULT 'Publica',
  `id_Dir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id_Escola`, `Nome`, `Nivel`, `Pertenca`, `id_Dir`) VALUES
(20190001, 'Heroes Mocambicanos', 'Secundaria', 'Publica', 1),
(20190002, 'Malhazine', 'Secundaria', 'Publica', 1),
(20190003, 'Infulene Benfica', 'Secundaria', 'Publica', 1),
(20190004, '1 de Junho', 'Primaria', 'Publica', 3);

--
-- Acionadores `escola`
--
DELIMITER $$
CREATE TRIGGER `Update_Escola_Dados` AFTER UPDATE ON `escola` FOR EACH ROW UPDATE usuario set usuario.Nome_Local=(SELECT concat('Escola ',new.Nivel,' ',new.Nome)),usuario.id_Local=new.id_Escola WHERE usuario.id_Local=old.id_Escola
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_anterior`
--

CREATE TABLE `escola_anterior` (
  `id_Candidato` varchar(9) CHARACTER SET utf8 NOT NULL,
  `Nome_escola` varchar(60) NOT NULL,
  `Turma` varchar(9) NOT NULL DEFAULT 'N/D',
  `Classe` enum('7','8','9','10','11','12') NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola_anterior`
--

INSERT INTO `escola_anterior` (`id_Candidato`, `Nome_escola`, `Turma`, `Classe`) VALUES
('2019C0006', 'Alber Eisten', 'N/D', '7'),
('2019C0007', 'Joaqum Chissano', 'N/D', '8'),
('2019C0008', '1 de Junho', 'N/D', '7'),
('2019C0009', '1 de Junho', 'N/D', '9'),
('2019C0010', 'Malhazine', 'N/D', '8'),
('2019C0011', 'Infulene Benfica', 'N/D', '8'),
('2019C0012', 'Heroes Mocambicanos', 'N/D', '8');

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

--
-- Extraindo dados da tabela `filiacao_aluno`
--

INSERT INTO `filiacao_aluno` (`id_aluno`, `nome_pai`, `telefone_pai`, `local_trabalho_pai`, `profissao_pai`, `nome_mae`, `telefone_mae`, `local_trabalho_mae`, `profissao_mae`) VALUES
('2019C0010', 'dsfds', 3, 'vcvx', 'cxvx', 'cvxv', 4, 'vxcvx', 'cxvxc');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_Funcionaio` varchar(9) CHARACTER SET utf8 NOT NULL,
  `carreira` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_Funcionaio`, `carreira`) VALUES
('2019F0001', 'Docente'),
('2019F0002', 'Docente'),
('2019F0003', 'Docente'),
('2019F0004', 'Docente'),
('2019F0005', 'Secretariado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_distrital`
--

CREATE TABLE `funcionario_distrital` (
  `id_Funcionario` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `Estado` enum('Ativo','Desativado') NOT NULL DEFAULT 'Ativo',
  `Data_Cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario_distrital`
--

INSERT INTO `funcionario_distrital` (`id_Funcionario`, `id_distrito`, `id_cargo`, `Estado`, `Data_Cadastro`) VALUES
('2019F0010', 3, 2, 'Ativo', '2019-09-21'),
('2019F0011', 4, 5, 'Ativo', '2019-09-21');

--
-- Acionadores `funcionario_distrital`
--
DELIMITER $$
CREATE TRIGGER `Inserindo_Funcionario_Distrital` BEFORE INSERT ON `funcionario_distrital` FOR EACH ROW INSERT INTO user_distrital (id_user,id_Dir,Tipo) VALUES(new.id_Funcionario,new.id_distrito,'Distrital')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_escola`
--

CREATE TABLE `funcionario_escola` (
  `id_Escola` int(11) NOT NULL,
  `id_Funcionario` varchar(9) NOT NULL,
  `id_Cargo` int(11) NOT NULL,
  `Data_Colocacao` date NOT NULL,
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo',
  `Acesso` enum('Professor','Secretaria','Directoria','Admin','Convidado') NOT NULL DEFAULT 'Convidado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario_escola`
--

INSERT INTO `funcionario_escola` (`id_Escola`, `id_Funcionario`, `id_Cargo`, `Data_Colocacao`, `Estado`, `Acesso`) VALUES
(20190001, '2019F0001', 2, '2019-09-21', 'Ativo', 'Convidado'),
(20190002, '2019F0002', 2, '2019-09-21', 'Ativo', 'Convidado'),
(20190003, '2019F0003', 2, '2019-09-21', 'Ativo', 'Convidado'),
(20190003, '2019F0005', 6, '2019-09-21', 'Ativo', 'Secretaria'),
(20190004, '2019F0004', 2, '2019-09-21', 'Ativo', 'Admin');

--
-- Acionadores `funcionario_escola`
--
DELIMITER $$
CREATE TRIGGER `inserindo_Funcionario_Escola` AFTER INSERT ON `funcionario_escola` FOR EACH ROW INSERT user_escola (id_User,id_Escola,Tipo) VALUES(new.id_Funcionario,new.id_Escola,new.Acesso)
$$
DELIMITER ;

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

--
-- Extraindo dados da tabela `localizacao_escola`
--

INSERT INTO `localizacao_escola` (`id_escola`, `id_bairro`, `Nr`, `Avenida_Rua`) VALUES
(20190001, 2, 222, 'OUA'),
(20190002, 2, 222, 'OUA'),
(20190003, 3, 222, 'OUA'),
(20190004, 1, 1324, 'De Mocambique');

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
('2019C0006', 'Lucas', 'Mariamo', 'M', 'Solteiro', '2019-09-01'),
('2019C0007', 'Lorena', 'Miket', 'F', 'Solteiro', '2019-09-01'),
('2019C0008', 'Olivia', 'Jose', 'F', 'Solteiro', '2019-09-07'),
('2019C0009', 'Tereza', 'Mendes', 'F', 'Solteiro', '2019-09-10'),
('2019C0010', 'Yuan', 'Castro', 'F', 'Solteiro', '2019-09-12'),
('2019C0011', 'Manuel', 'Januario', 'F', 'Solteiro', '2019-09-04'),
('2019C0012', 'Lucas', 'Mbeve', 'F', 'Solteiro', '2019-09-05'),
('2019F0001', 'Ernesto', 'Mazimbe', 'M', 'Solteiro', '1990-09-01'),
('2019F0002', 'Luiz', 'Bernaldo', 'M', 'Solteiro', '1999-09-01'),
('2019F0003', 'Ernesto', 'Mazimbe', 'M', 'Solteiro', '1990-09-01'),
('2019F0004', 'Mateus', 'Guambe', 'M', 'Solteiro', '2019-09-01'),
('2019F0005', 'Mendesa', 'Cumbe', 'F', 'Casado', '2019-09-01');

--
-- Acionadores `pessoa`
--
DELIMITER $$
CREATE TRIGGER `Cria_User` AFTER INSERT ON `pessoa` FOR EACH ROW begin
INSERT INTO usuario(id_User,Username,Senha,DataCriacao,Email_Instituconal) VALUES(new.id_Pessoa,(SELECT concat(new.Nome,new.id_Pessoa)),new.Apelido,CURRENT_DATE,(SELECT concat(new.Apelido,'.',new.Nome,'.',new.id_Pessoa,'@sige.ac.mz')));
INSERT INTO contacto(id_Pessoa,Email) VALUES (new.id_Pessoa,(SELECT concat(new.id_Pessoa,'@exemplo')));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `privilegio_acesso`
--

CREATE TABLE `privilegio_acesso` (
  `id_Privilegio` int(11) NOT NULL,
  `Acesso` enum('Convidado','Aluno','Candidato','Professor','Secretaria','Directoria','Admin') NOT NULL DEFAULT 'Convidado',
  `Descricao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `privilegio_acesso`
--

INSERT INTO `privilegio_acesso` (`id_Privilegio`, `Acesso`, `Descricao`) VALUES
(1, 'Convidado', 'Login'),
(2, 'Convidado', 'Perfil'),
(3, 'Candidato', 'Pre-Matricula'),
(4, 'Candidato', 'Matricular'),
(5, 'Professor', 'Marcar Avaliacao'),
(6, 'Professor', 'Editar Avaliacao'),
(7, 'Professor', 'Lancar Notas Avaliacao'),
(8, 'Aluno', 'Renovar Matricula'),
(9, 'Aluno', 'Ver Notas Avaliacao');

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
-- Extraindo dados da tabela `recupera_senha_usuario`
--

INSERT INTO `recupera_senha_usuario` (`id_Solicitacao`, `id_Usuario`, `CodigoRecuperacao`, `Data_Validalidade`, `Senha_Antiga`, `Senha_Nova`, `Tipo_Envio`, `Campo_Envio`) VALUES
(1, '2019F0005', 829917, '2019-09-22', 'Cumbe', 'Joaquim', 'Email', '2019F0005@exemplo');

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
  `quarteirao` int(11) NOT NULL DEFAULT '0',
  `nr_casa` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `residencia_aluno`
--

INSERT INTO `residencia_aluno` (`id_aluno`, `id_bairro`, `av_ou_rua`, `quarteirao`, `nr_casa`) VALUES
('2019C0007', 2, 'GDGF', 4, 4),
('2019C0010', 2, 'dgdfgd', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_distrital`
--

CREATE TABLE `user_distrital` (
  `id_user` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_Dir` int(11) NOT NULL,
  `Tipo` enum('Admin','Distrital','Convidado') NOT NULL DEFAULT 'Convidado',
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `user_distrital`
--
DELIMITER $$
CREATE TRIGGER `Inseindo_User_Distital` AFTER INSERT ON `user_distrital` FOR EACH ROW UPDATE usuario set usuario.Local='Distrito',usuario.id_Local=new.id_Dir,usuario.Nivel_Acesso=new.Tipo,usuario.Nome_Local=(SELECT concat('Servico Distrital de ',nome) FROM `distrito` WHERE distrito.id_distrito=new.id_Dir) WHERE usuario.id_User=new.id_User
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_escola`
--

CREATE TABLE `user_escola` (
  `id_User` varchar(9) NOT NULL,
  `id_Escola` int(11) NOT NULL,
  `Tipo` enum('Aluno','Candidato','Professor','Secretaria','Directoria','Admin','Convidado') NOT NULL DEFAULT 'Convidado',
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_escola`
--

INSERT INTO `user_escola` (`id_User`, `id_Escola`, `Tipo`, `Estado`) VALUES
('2019C0006', 20190002, 'Candidato', 'Ativo'),
('2019C0007', 20190003, 'Candidato', 'Ativo'),
('2019C0008', 20190003, 'Candidato', 'Ativo'),
('2019C0009', 20190003, 'Candidato', 'Ativo'),
('2019C0010', 20190001, 'Candidato', 'Ativo'),
('2019C0011', 20190001, 'Candidato', 'Ativo'),
('2019C0012', 20190001, 'Candidato', 'Ativo'),
('2019F0001', 20190001, 'Secretaria', 'Ativo'),
('2019F0002', 20190002, 'Admin', 'Ativo'),
('2019F0003', 20190003, 'Directoria', 'Ativo'),
('2019F0004', 20190004, 'Admin', 'Ativo'),
('2019F0005', 20190003, 'Secretaria', 'Ativo');

--
-- Acionadores `user_escola`
--
DELIMITER $$
CREATE TRIGGER `Insercao` AFTER INSERT ON `user_escola` FOR EACH ROW UPDATE usuario set usuario.Local='Escola',usuario.id_Local=new.id_Escola,usuario.Nivel_Acesso=new.Tipo,usuario.Nome_Local=(SELECT concat('Escola ',Nivel,' ',Nome) FROM `escola` WHERE escola.id_Escola=new.id_Escola) WHERE usuario.id_User=new.id_User
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpDateUserEscola` AFTER UPDATE ON `user_escola` FOR EACH ROW UPDATE usuario set usuario.Nivel_Acesso=new.Tipo WHERE usuario.id_User=new.id_User and usuario.id_Local=new.id_Escola
$$
DELIMITER ;

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
  `Nivel_Acesso` enum('Convidado','Candidato','Aluno','Professor','Directoria','Secretaria','Admin','Distrital') NOT NULL DEFAULT 'Convidado',
  `Local` enum('Distrito','Escola','Indefinido') NOT NULL DEFAULT 'Indefinido',
  `id_Local` int(11) NOT NULL DEFAULT '0',
  `Nome_Local` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_User`, `Username`, `Senha`, `Email_Instituconal`, `Estado`, `DataCriacao`, `Nivel_Acesso`, `Local`, `id_Local`, `Nome_Local`) VALUES
('2019C0006', 'Lucas2019C0006', 'Mariamo', 'Mariamo.Lucas.2019C0006@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190002, 'Escola Secundaria Malhazine'),
('2019C0007', 'Lorena2019C0007', 'Miket', 'Miket.Lorena.2019C0007@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190003, 'Escola Secundaria Infulene Benfica'),
('2019C0008', 'Olivia2019C0008', 'Jose', 'Jose.Olivia.2019C0008@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190003, 'Escola Secundaria Infulene Benfica'),
('2019C0009', 'Tereza2019C0009', 'Mendes', 'Mendes.Tereza.2019C0009@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190003, 'Escola Secundaria Infulene Benfica'),
('2019C0010', 'Yuan2019C0010', 'Castro', 'Castro.Yuan.2019C0010@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190001, 'Escola Secundaria Heroes Mocambicanos'),
('2019C0011', 'Manuel2019C0011', 'Januario', 'Januario.Manuel.2019C0011@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190001, 'Escola Secundaria Heroes Mocambicanos'),
('2019C0012', 'Lucas2019C0012', 'Mbeve', 'Mbeve.Lucas.2019C0012@sige.ac.mz', 'Ativo', '2019-09-21', 'Candidato', 'Escola', 20190001, 'Escola Secundaria Heroes Mocambicanos'),
('2019F0001', 'Ernesto2019F0001', 'Mazimbe', 'Mazimbe.Ernesto.2019F0001@sige.ac.mz', 'Ativo', '2019-09-21', 'Secretaria', 'Escola', 20190001, 'Escola Secundaria Heroes Mocambicanos'),
('2019F0002', 'Luiz2019F0002', 'Bernaldo', 'Bernaldo.Luiz.2019F0002@sige.ac.mz', 'Ativo', '2019-09-21', 'Admin', 'Escola', 20190002, 'Escola Secundaria Malhazine'),
('2019F0003', 'Ernesto2019F0003', 'Mazimbe', 'Mazimbe.Ernesto.2019F0003@sige.ac.mz', 'Ativo', '2019-09-21', 'Directoria', 'Escola', 20190003, 'Escola Secundaria Infulene Benfica'),
('2019F0004', 'Mateus2019F0004', 'Guambe', 'Guambe.Mateus.2019F0004@sige.ac.mz', 'Ativo', '2019-09-21', 'Admin', 'Escola', 20190004, 'Escola  1 de Junho'),
('2019F0005', 'Mendesa2019F0005', 'Joaquim', 'Cumbe.Mendesa.2019F0005@sige.ac.mz', 'Ativo', '2019-09-21', 'Secretaria', 'Escola', 20190003, 'Escola Secundaria Infulene Benfica');

--
-- Acionadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `ActualizaCamposDeLocal` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN

if(new.Local='Escola')THEN
UPDATE user_distrital set user_distrital.Estado='Desativo' WHERE user_distrital.id_user=new.id_User;
end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertUser_Privilegio` AFTER INSERT ON `usuario` FOR EACH ROW INSERT INTO usuario_privilegio_acesso (id_usuario) VALUES(new.id_User)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_privilegio_acesso`
--

CREATE TABLE `usuario_privilegio_acesso` (
  `id_usuario` varchar(9) CHARACTER SET utf8 NOT NULL,
  `id_privilegio` int(11) NOT NULL DEFAULT '1',
  `Estado` enum('Ativo','Desativo') NOT NULL DEFAULT 'Ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_privilegio_acesso`
--

INSERT INTO `usuario_privilegio_acesso` (`id_usuario`, `id_privilegio`, `Estado`) VALUES
('2019C0006', 1, 'Ativo'),
('2019C0007', 1, 'Ativo'),
('2019C0008', 1, 'Ativo'),
('2019C0009', 1, 'Ativo'),
('2019C0010', 1, 'Ativo'),
('2019C0011', 1, 'Ativo'),
('2019C0012', 1, 'Ativo'),
('2019F0001', 1, 'Ativo'),
('2019F0002', 1, 'Ativo'),
('2019F0003', 1, 'Ativo'),
('2019F0004', 1, 'Ativo'),
('2019F0005', 1, 'Ativo');

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
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_Pessoa`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `id_Pessoa` (`id_Pessoa`);

--
-- Indexes for table `direcao_distrital`
--
ALTER TABLE `direcao_distrital`
  ADD PRIMARY KEY (`id_Dir`);

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
-- Indexes for table `escola_anterior`
--
ALTER TABLE `escola_anterior`
  ADD PRIMARY KEY (`id_Candidato`);

--
-- Indexes for table `filiacao_aluno`
--
ALTER TABLE `filiacao_aluno`
  ADD PRIMARY KEY (`id_aluno`) USING BTREE;

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_Funcionaio`),
  ADD KEY `id_pessoa` (`id_Funcionaio`);

--
-- Indexes for table `funcionario_distrital`
--
ALTER TABLE `funcionario_distrital`
  ADD PRIMARY KEY (`id_Funcionario`,`id_distrito`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indexes for table `funcionario_escola`
--
ALTER TABLE `funcionario_escola`
  ADD UNIQUE KEY `id_Escola_2` (`id_Escola`,`id_Funcionario`,`id_Cargo`),
  ADD KEY `id_Escola` (`id_Escola`),
  ADD KEY `id_Pessoa` (`id_Funcionario`),
  ADD KEY `id_Cargo` (`id_Cargo`);

--
-- Indexes for table `localizacao_escola`
--
ALTER TABLE `localizacao_escola`
  ADD PRIMARY KEY (`id_escola`),
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
-- Indexes for table `privilegio_acesso`
--
ALTER TABLE `privilegio_acesso`
  ADD PRIMARY KEY (`id_Privilegio`);

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
  ADD PRIMARY KEY (`id_user`,`id_Dir`) USING BTREE,
  ADD KEY `id_Dir` (`id_Dir`);

--
-- Indexes for table `user_escola`
--
ALTER TABLE `user_escola`
  ADD PRIMARY KEY (`id_User`,`id_Escola`),
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
-- Indexes for table `usuario_privilegio_acesso`
--
ALTER TABLE `usuario_privilegio_acesso`
  ADD PRIMARY KEY (`id_usuario`,`id_privilegio`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_Bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_Cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_Escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20190006;

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
-- AUTO_INCREMENT for table `privilegio_acesso`
--
ALTER TABLE `privilegio_acesso`
  MODIFY `id_Privilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_Prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recupera_senha_usuario`
--
ALTER TABLE `recupera_senha_usuario`
  MODIFY `id_Solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Limitadores para a tabela `escola_anterior`
--
ALTER TABLE `escola_anterior`
  ADD CONSTRAINT `escola_anterior_ibfk_1` FOREIGN KEY (`id_Candidato`) REFERENCES `candidato_aluno` (`id_candidato`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Limitadores para a tabela `funcionario_distrital`
--
ALTER TABLE `funcionario_distrital`
  ADD CONSTRAINT `funcionario_distrital_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_Cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario_escola`
--
ALTER TABLE `funcionario_escola`
  ADD CONSTRAINT `funcionario_escola_ibfk_1` FOREIGN KEY (`id_Escola`) REFERENCES `escola` (`id_Escola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_escola_ibfk_2` FOREIGN KEY (`id_Funcionario`) REFERENCES `funcionario` (`id_Funcionaio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_escola_ibfk_3` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Limitadores para a tabela `usuario_privilegio_acesso`
--
ALTER TABLE `usuario_privilegio_acesso`
  ADD CONSTRAINT `usuario_privilegio_acesso_ibfk_1` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegio_acesso` (`id_Privilegio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_privilegio_acesso_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_User`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
