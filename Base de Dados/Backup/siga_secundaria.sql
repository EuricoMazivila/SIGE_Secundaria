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
-- Database: `siga_secundaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `codAl` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `periodo` enum('Diurno','Nocturno') DEFAULT NULL,
  `estado_aluno` enum('Pedente','Transferifo','Desistente','Activo') DEFAULT NULL,
  `estado_matricula` enum('Renovada','Nao_renovada') DEFAULT NULL,
  `escola_anterior` varchar(35) NOT NULL,
  `ensino_anterior` enum('Primario','Secundario') DEFAULT NULL,
  `classe_anterior` enum('7','8','9','10','11','12') DEFAULT NULL,
  `turma_anterior` varchar(35) NOT NULL,
  `numero_aluno_anterior` int(11) NOT NULL,
  `ano_anterior` year(4) NOT NULL,
  `codCad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classe`
--

CREATE TABLE `aluno_classe` (
  `codAl` int(11) NOT NULL,
  `codClas` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_disciplina`
--

CREATE TABLE `aluno_disciplina` (
  `codAl` int(11) NOT NULL,
  `codDisc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_encarregado`
--

CREATE TABLE `aluno_encarregado` (
  `codAl` int(11) NOT NULL,
  `codEnc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_filiacao`
--

CREATE TABLE `aluno_filiacao` (
  `codAl` int(11) NOT NULL,
  `codFil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_matricula`
--

CREATE TABLE `aluno_matricula` (
  `codAl` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_turma`
--

CREATE TABLE `aluno_turma` (
  `codAl` int(11) NOT NULL,
  `codT` int(11) NOT NULL,
  `ano` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bi`
--

CREATE TABLE `bi` (
  `numero` varchar(13) NOT NULL,
  `tipo` varchar(35) NOT NULL,
  `local_emissao` varchar(35) NOT NULL,
  `Data_emissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `codCad` int(11) NOT NULL,
  `nome_completo` varchar(35) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` enum('Femenino','Masculino') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato_matricula`
--

CREATE TABLE `candidato_matricula` (
  `codCad` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `codClas` int(11) NOT NULL,
  `classe` enum('8','9','10','11','12') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_escola_anterior`
--

CREATE TABLE `dados_escola_anterior` (
  `codAl` int(11) NOT NULL,
  `escola_anterior` varchar(35) NOT NULL,
  `ensino_anterior` enum('Primario','Secundario','','') NOT NULL,
  `classe` int(11) NOT NULL,
  `turma_anterior` varchar(35) NOT NULL,
  `numero_anterior` int(11) NOT NULL,
  `ano_anterior` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `codDisc` int(11) NOT NULL,
  `disciplina` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado`
--

CREATE TABLE `encarregado` (
  `codEnc` int(11) NOT NULL,
  `nome_completo` varchar(35) NOT NULL,
  `telefone` int(11) NOT NULL,
  `local_trabalho` varchar(35) NOT NULL,
  `profissao` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encarregado_residencia`
--

CREATE TABLE `encarregado_residencia` (
  `codEnc` int(11) NOT NULL,
  `codRes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiacao`
--

CREATE TABLE `filiacao` (
  `codFil` int(11) NOT NULL,
  `nome_pai` varchar(35) NOT NULL,
  `nome_mae` varchar(35) NOT NULL,
  `telefone_pai` int(11) NOT NULL,
  `telefone_mae` int(11) NOT NULL,
  `local_trabalho_pai` varchar(35) NOT NULL,
  `local_trabalho_mae` varchar(35) NOT NULL,
  `profissao_pai` varchar(35) NOT NULL,
  `profissao_mae` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `codF` int(11) NOT NULL,
  `codP` int(11) NOT NULL,
  `Carreira` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_classe`
--

CREATE TABLE `funcionario_classe` (
  `codF` int(11) NOT NULL,
  `codClas` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_disciplina`
--

CREATE TABLE `funcionario_disciplina` (
  `codF` int(11) NOT NULL,
  `codDisc` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_matricula`
--

CREATE TABLE `funcionario_matricula` (
  `codF` int(11) NOT NULL,
  `codMatr` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_turma`
--

CREATE TABLE `funcionario_turma` (
  `codF` int(11) NOT NULL,
  `codT` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `codMatr` int(11) NOT NULL,
  `dataI` date NOT NULL,
  `dataF` date NOT NULL,
  `numero_vagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `codP` int(11) NOT NULL,
  `Apelido` varchar(35) NOT NULL,
  `Nomes` varchar(35) NOT NULL,
  `pais_nascimento` varchar(35) NOT NULL,
  `provincia_nascimento` varchar(35) NOT NULL,
  `distrito_nascimento` date NOT NULL,
  `data_nascimento` date NOT NULL,
  `numero` varchar(13) NOT NULL,
  `sexo` enum('Femenino','Masculino') DEFAULT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_residencia`
--

CREATE TABLE `pessoa_residencia` (
  `codP` int(11) NOT NULL,
  `codRes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `residencia`
--

CREATE TABLE `residencia` (
  `codRes` int(11) NOT NULL,
  `Provincia` varchar(35) NOT NULL,
  `Distrito` varchar(35) NOT NULL,
  `av_ou_rua` varchar(35) NOT NULL,
  `bairro` varchar(35) NOT NULL,
  `quarteirao` varchar(10) NOT NULL,
  `nr_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `codT` int(11) NOT NULL,
  `nome` varchar(10) DEFAULT NULL,
  `periodo` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codP` int(11) NOT NULL,
  `usuario` varchar(35) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `tipo` varchar(35) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAl`),
  ADD KEY `codCad` (`codCad`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD PRIMARY KEY (`codAl`,`codClas`),
  ADD KEY `codClas` (`codClas`);

--
-- Indexes for table `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD PRIMARY KEY (`codAl`,`codDisc`),
  ADD KEY `codDisc` (`codDisc`);

--
-- Indexes for table `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD PRIMARY KEY (`codAl`,`codEnc`),
  ADD KEY `codEnc` (`codEnc`);

--
-- Indexes for table `aluno_filiacao`
--
ALTER TABLE `aluno_filiacao`
  ADD PRIMARY KEY (`codAl`,`codFil`),
  ADD KEY `codFil` (`codFil`);

--
-- Indexes for table `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD PRIMARY KEY (`codAl`,`codMatr`),
  ADD KEY `codMatr` (`codMatr`);

--
-- Indexes for table `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD PRIMARY KEY (`codAl`,`codT`),
  ADD KEY `codT` (`codT`);

--
-- Indexes for table `bi`
--
ALTER TABLE `bi`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`codCad`);

--
-- Indexes for table `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD PRIMARY KEY (`codCad`,`codMatr`),
  ADD KEY `codMatr` (`codMatr`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`codClas`);

--
-- Indexes for table `dados_escola_anterior`
--
ALTER TABLE `dados_escola_anterior`
  ADD PRIMARY KEY (`codAl`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`codDisc`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`codEnc`);

--
-- Indexes for table `encarregado_residencia`
--
ALTER TABLE `encarregado_residencia`
  ADD PRIMARY KEY (`codEnc`,`codRes`),
  ADD KEY `codRes` (`codRes`);

--
-- Indexes for table `filiacao`
--
ALTER TABLE `filiacao`
  ADD PRIMARY KEY (`codFil`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`codF`),
  ADD KEY `codP` (`codP`);

--
-- Indexes for table `funcionario_classe`
--
ALTER TABLE `funcionario_classe`
  ADD PRIMARY KEY (`codF`,`codClas`),
  ADD KEY `codClas` (`codClas`);

--
-- Indexes for table `funcionario_disciplina`
--
ALTER TABLE `funcionario_disciplina`
  ADD PRIMARY KEY (`codF`,`codDisc`),
  ADD KEY `codDisc` (`codDisc`);

--
-- Indexes for table `funcionario_matricula`
--
ALTER TABLE `funcionario_matricula`
  ADD PRIMARY KEY (`codF`,`codMatr`),
  ADD KEY `codMatr` (`codMatr`);

--
-- Indexes for table `funcionario_turma`
--
ALTER TABLE `funcionario_turma`
  ADD PRIMARY KEY (`codF`,`codT`),
  ADD KEY `codT` (`codT`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codMatr`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codP`),
  ADD KEY `numero_bi` (`numero`);

--
-- Indexes for table `pessoa_residencia`
--
ALTER TABLE `pessoa_residencia`
  ADD PRIMARY KEY (`codP`,`codRes`),
  ADD KEY `codRes` (`codRes`);

--
-- Indexes for table `residencia`
--
ALTER TABLE `residencia`
  ADD PRIMARY KEY (`codRes`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codT`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `codAl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidato`
--
ALTER TABLE `candidato`
  MODIFY `codCad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `codClas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `codDisc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `codEnc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filiacao`
--
ALTER TABLE `filiacao`
  MODIFY `codFil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `codF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `codMatr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residencia`
--
ALTER TABLE `residencia`
  MODIFY `codRes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `codT` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`codCad`) REFERENCES `candidato` (`codCad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`);

--
-- Limitadores para a tabela `aluno_classe`
--
ALTER TABLE `aluno_classe`
  ADD CONSTRAINT `aluno_classe_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_classe_ibfk_2` FOREIGN KEY (`codClas`) REFERENCES `classe` (`codClas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_disciplina`
--
ALTER TABLE `aluno_disciplina`
  ADD CONSTRAINT `aluno_disciplina_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_disciplina_ibfk_2` FOREIGN KEY (`codDisc`) REFERENCES `disciplina` (`codDisc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_encarregado`
--
ALTER TABLE `aluno_encarregado`
  ADD CONSTRAINT `aluno_encarregado_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_encarregado_ibfk_2` FOREIGN KEY (`codEnc`) REFERENCES `encarregado` (`codEnc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_filiacao`
--
ALTER TABLE `aluno_filiacao`
  ADD CONSTRAINT `aluno_filiacao_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_filiacao_ibfk_2` FOREIGN KEY (`codFil`) REFERENCES `filiacao` (`codFil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_matricula`
--
ALTER TABLE `aluno_matricula`
  ADD CONSTRAINT `aluno_matricula_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno_turma`
--
ALTER TABLE `aluno_turma`
  ADD CONSTRAINT `aluno_turma_ibfk_1` FOREIGN KEY (`codAl`) REFERENCES `aluno` (`codAl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_turma_ibfk_2` FOREIGN KEY (`codT`) REFERENCES `turma` (`codT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `candidato_matricula`
--
ALTER TABLE `candidato_matricula`
  ADD CONSTRAINT `candidato_matricula_ibfk_1` FOREIGN KEY (`codCad`) REFERENCES `candidato` (`codCad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidato_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encarregado_residencia`
--
ALTER TABLE `encarregado_residencia`
  ADD CONSTRAINT `encarregado_residencia_ibfk_1` FOREIGN KEY (`codEnc`) REFERENCES `encarregado` (`codEnc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `encarregado_residencia_ibfk_2` FOREIGN KEY (`codRes`) REFERENCES `residencia` (`codRes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`);

--
-- Limitadores para a tabela `funcionario_classe`
--
ALTER TABLE `funcionario_classe`
  ADD CONSTRAINT `funcionario_classe_ibfk_1` FOREIGN KEY (`codF`) REFERENCES `funcionario` (`codF`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_classe_ibfk_2` FOREIGN KEY (`codClas`) REFERENCES `classe` (`codClas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario_disciplina`
--
ALTER TABLE `funcionario_disciplina`
  ADD CONSTRAINT `funcionario_disciplina_ibfk_1` FOREIGN KEY (`codF`) REFERENCES `funcionario` (`codF`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_disciplina_ibfk_2` FOREIGN KEY (`codDisc`) REFERENCES `disciplina` (`codDisc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario_matricula`
--
ALTER TABLE `funcionario_matricula`
  ADD CONSTRAINT `funcionario_matricula_ibfk_1` FOREIGN KEY (`codF`) REFERENCES `funcionario` (`codF`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_matricula_ibfk_2` FOREIGN KEY (`codMatr`) REFERENCES `matricula` (`codMatr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario_turma`
--
ALTER TABLE `funcionario_turma`
  ADD CONSTRAINT `funcionario_turma_ibfk_1` FOREIGN KEY (`codF`) REFERENCES `funcionario` (`codF`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_turma_ibfk_2` FOREIGN KEY (`codT`) REFERENCES `turma` (`codT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`numero`) REFERENCES `bi` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoa_residencia`
--
ALTER TABLE `pessoa_residencia`
  ADD CONSTRAINT `pessoa_residencia_ibfk_2` FOREIGN KEY (`codRes`) REFERENCES `residencia` (`codRes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pessoa_residencia_ibfk_3` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codP`) REFERENCES `pessoa` (`codP`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
