-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jul-2019 às 12:03
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `codAl` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `turno` enum('diurno','nocturno','','') NOT NULL,
  `codEnc` int(11) NOT NULL,
  `codFil` int(11) NOT NULL,
  `codCand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classe`
--

CREATE TABLE `aluno_classe` (
  `codAl` int(11) NOT NULL,
  `codClass` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `codAl` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipo` enum('Novo ingresso','Renovacao','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `codbairro` int(11) NOT NULL,
  `coddist` int(11) NOT NULL,
  `bairro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bi`
--

CREATE TABLE `bi` (
  `bi` varchar(13) NOT NULL,
  `local_emissao` varchar(50) NOT NULL,
  `data_emissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_aluno`
--

CREATE TABLE `candidato_aluno` (
  `codCand` int(11) NOT NULL,
  `nome_completo` int(11) NOT NULL,
  `classe_matricular` int(11) NOT NULL,
  `turno` enum('diurno','nocturno','','') NOT NULL,
  `codDados` int(11) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_matricula`
--

CREATE TABLE `candidato_matricula` (
  `codCand` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `classe` enum('8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacto`
--

CREATE TABLE `contacto` (
  `CodConct` int(11) NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `numero_telefone_op` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_escola_anterior`
--

CREATE TABLE `dados_escola_anterior` (
  `codDados` int(11) NOT NULL,
  `classe_anterior` enum('7','8','9','10','11','12') NOT NULL,
  `turma` varchar(5) NOT NULL,
  `numero` int(11) NOT NULL,
  `ano` year(4) NOT NULL,
  `codEscola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `coddist` int(11) NOT NULL,
  `codProv` int(11) NOT NULL,
  `distrito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `codEnc` int(11) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `numero_telefone` int(11) NOT NULL,
  `local_trabalho` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL,
  `codRes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `codEscola` int(11) NOT NULL,
  `nome_escola` varchar(50) NOT NULL,
  `nivel` enum('primaria','secundaria','misto','') NOT NULL,
  `tipo` enum('publica','privada','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `codFil` int(11) NOT NULL,
  `nome_pai` varchar(50) NOT NULL,
  `nome_mae` varchar(50) NOT NULL,
  `telefone_pai` int(11) NOT NULL,
  `telefone_mae` int(11) NOT NULL,
  `profissao_pai` varchar(50) NOT NULL,
  `profissao_mae` varchar(50) NOT NULL,
  `local_trabalho_pai` varchar(50) NOT NULL,
  `local_trabalho_mae` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `estado` enum('Em espera','Activa','Terminada','') NOT NULL,
  `total_vagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_classe`
--

CREATE TABLE `matricula_classe` (
  `codMatr` int(11) NOT NULL,
  `codClass` int(11) NOT NULL,
  `total_Vagas` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `codPais` int(11) NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `codP` int(11) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `nomes` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `coddist` int(11) NOT NULL,
  `bi` varchar(13) NOT NULL,
  `sexo` enum('M','F','','') NOT NULL,
  `codConct` int(11) NOT NULL,
  `codRes` int(11) NOT NULL,
  `foto` blob NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `codProv` int(11) NOT NULL,
  `codPais` int(11) NOT NULL,
  `provincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia`
--

CREATE TABLE `residencia` (
  `codRes` int(11) NOT NULL,
  `codProv` int(11) NOT NULL,
  `codbairro` int(11) NOT NULL,
  `av_ou_rua` varchar(50) NOT NULL,
  `quarteirao` varchar(5) NOT NULL,
  `nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` enum('aluno','funcionario','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAl`),
  ADD KEY `codP` (`codP`),
  ADD KEY `codEnc` (`codEnc`),
  ADD KEY `codFil` (`codFil`),
  ADD KEY `codCand` (`codCand`);

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
  ADD PRIMARY KEY (`bi`);

--
-- Indexes for table `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD PRIMARY KEY (`codCand`),
  ADD KEY `codDados` (`codDados`);

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
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`CodConct`);

--
-- Indexes for table `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  ADD PRIMARY KEY (`codDados`),
  ADD KEY `codEscola` (`codEscola`);

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
  ADD KEY `codRes` (`codRes`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`codEscola`);

--
-- Indexes for table `filiacao`
--
ALTER TABLE `filiacao`
  ADD PRIMARY KEY (`codFil`);

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
  ADD KEY `bi` (`bi`),
  ADD KEY `codConct` (`codConct`),
  ADD KEY `codRes` (`codRes`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `coddist` (`coddist`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`codProv`),
  ADD KEY `codPais` (`codPais`);

--
-- Indexes for table `residencia`
--
ALTER TABLE `residencia`
  ADD PRIMARY KEY (`codRes`),
  ADD KEY `codProv` (`codProv`),
  ADD KEY `codbairro` (`codbairro`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `codbairro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `codClass` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `CodConct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  MODIFY `codDados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `coddist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `codEnc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `codEscola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filiacao`
--
ALTER TABLE `filiacao`
  MODIFY `codFil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `codMatr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `codPais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `codProv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residencia`
--
ALTER TABLE `residencia`
  MODIFY `codRes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`codEnc`) REFERENCES `encarregado` (`codEnc`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`codFil`) REFERENCES `filiacao` (`codFil`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_4` FOREIGN KEY (`codCand`) REFERENCES `candidato_aluno` (`codCand`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `aluno_matricula_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`coddist`) REFERENCES `distrito` (`coddist`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_aluno`
--
ALTER TABLE `candidato_aluno`
  ADD CONSTRAINT `candidato_aluno_ibfk_1` FOREIGN KEY (`codDados`) REFERENCES `dados_escola_anterior` (`codDados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `dados_escola_anterior_ibfk_1` FOREIGN KEY (`codEscola`) REFERENCES `escola` (`codEscola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`codProv`) REFERENCES `provincia` (`codProv`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encarregado`
--
ALTER TABLE `encarregado`
  ADD CONSTRAINT `encarregado_ibfk_1` FOREIGN KEY (`codRes`) REFERENCES `residencia` (`codRes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `pessoa_ibfk_2` FOREIGN KEY (`bi`) REFERENCES `bi` (`bi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pessoa_ibfk_3` FOREIGN KEY (`codConct`) REFERENCES `contacto` (`CodConct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pessoa_ibfk_4` FOREIGN KEY (`codRes`) REFERENCES `residencia` (`codRes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pessoa_ibfk_5` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pessoa_ibfk_6` FOREIGN KEY (`coddist`) REFERENCES `distrito` (`coddist`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`codPais`) REFERENCES `pais` (`codPais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `residencia`
--
ALTER TABLE `residencia`
  ADD CONSTRAINT `residencia_ibfk_1` FOREIGN KEY (`codProv`) REFERENCES `provincia` (`codProv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `residencia_ibfk_2` FOREIGN KEY (`codbairro`) REFERENCES `bairro` (`codbairro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
