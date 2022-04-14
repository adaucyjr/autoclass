-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/03/2016 às 15:00
-- Versão do servidor: 5.5.47-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `basics`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `financeiro_conta`
--

CREATE TABLE IF NOT EXISTS `financeiro_conta` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_nome` varchar(20) NOT NULL,
  `con_numero` varchar(10) NOT NULL,
  `con_tipo` varchar(10) NOT NULL,
  `con_saldo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `financeiro_movimentacao`
--

CREATE TABLE IF NOT EXISTS `financeiro_movimentacao` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `mov_valor` decimal(10,2) NOT NULL,
  `mov_tipo` char(1) NOT NULL,
  `mov_descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`mov_id`),
  KEY `con_id` (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_cargo`
--

CREATE TABLE IF NOT EXISTS `rh_cargo` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_nome` varchar(30) NOT NULL,
  `car_salario` decimal(5,2) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rh_funcionario`
--

CREATE TABLE IF NOT EXISTS `rh_funcionario` (
  `fun_id` int(11) NOT NULL AUTO_INCREMENT,
  `pes_id` int(11) NOT NULL,
  `fun_documento` varchar(15) NOT NULL,
  `car_id` int(11) NOT NULL,
  `fun_funcao` varchar(20) NOT NULL,
  `fun_salario` decimal(7,2) NOT NULL,
  `fun_admissao` date NOT NULL,
  `fun_demissao` date NOT NULL,
  `fun_setor` int(11) NOT NULL,
  PRIMARY KEY (`fun_id`),
  UNIQUE KEY `pes_id` (`pes_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_acesso`
--

CREATE TABLE IF NOT EXISTS `sistema_acesso` (
  `ace_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_grp_id` int(11) NOT NULL,
  `fer_id` int(11) NOT NULL,
  `ace_visualizar` tinyint(1) NOT NULL DEFAULT '1',
  `ace_inserir` tinyint(1) NOT NULL,
  `ace_alterar` tinyint(1) NOT NULL,
  `ace_excluir` tinyint(1) NOT NULL,
  PRIMARY KEY (`ace_id`),
  UNIQUE KEY `acesso` (`usu_grp_id`,`fer_id`),
  KEY `usu_grp_id` (`usu_grp_id`),
  KEY `fer_id` (`fer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_ferramenta`
--

CREATE TABLE IF NOT EXISTS `sistema_ferramenta` (
  `fer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fer_nome` varchar(20) NOT NULL,
  `fer_page` varchar(20) NOT NULL,
  `mod_id` int(11) NOT NULL,
  PRIMARY KEY (`fer_id`),
  UNIQUE KEY `fer_page` (`fer_page`),
  UNIQUE KEY `fer_nome` (`fer_nome`),
  KEY `mod_id` (`mod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_instituicao`
--

CREATE TABLE IF NOT EXISTS `sistema_instituicao` (
  `ins_id` int(11) NOT NULL AUTO_INCREMENT,
  `ins_cnpj` char(14) NOT NULL,
  `ins_cepj` char(14) NOT NULL,
  `ins_cmpj` char(14) NOT NULL,
  `ins_razao_social` varchar(50) NOT NULL,
  `ins_nome_fantasia` varchar(30) NOT NULL,
  `ins_abertura` date NOT NULL,
  `ins_fechamento` date NOT NULL,
  `ins_tipo` varchar(30) NOT NULL,
  `ins_ramo` varchar(50) NOT NULL,
  `ins_end_logradouro` varchar(50) NOT NULL,
  `ins_end_num` varchar(5) NOT NULL,
  `ins_end_complemento` varchar(30) NOT NULL,
  `ins_end_bairro` varchar(50) NOT NULL,
  `ins_end_cidade` varchar(50) NOT NULL,
  `ins_end_estado` char(2) NOT NULL,
  `ins_end_cep` char(8) NOT NULL,
  `ins_telefone1` char(12) NOT NULL,
  `ins_telefone2` char(12) NOT NULL,
  `ins_email1` varchar(30) NOT NULL,
  `ins_email2` varchar(30) NOT NULL,
  PRIMARY KEY (`ins_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_log`
--

CREATE TABLE IF NOT EXISTS `sistema_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `log_data_hora` datetime NOT NULL,
  `log_ip` varchar(32) NOT NULL,
  `log_tela` varchar(100) NOT NULL,
  `log_acao` varchar(1) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `usu_id` (`usu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2110 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_modulo`
--

CREATE TABLE IF NOT EXISTS `sistema_modulo` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nome` varchar(20) NOT NULL,
  `mod_pasta` varchar(20) NOT NULL,
  PRIMARY KEY (`mod_id`),
  UNIQUE KEY `mod_pasta` (`mod_pasta`),
  UNIQUE KEY `mod_nome` (`mod_nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_pessoa`
--

CREATE TABLE IF NOT EXISTS `sistema_pessoa` (
  `pes_id` int(11) NOT NULL AUTO_INCREMENT,
  `pes_nome` varchar(20) NOT NULL,
  `pes_sobrenome` varchar(50) NOT NULL,
  `pes_cpf` char(11) NOT NULL,
  `pes_rg` char(11) NOT NULL,
  `pes_rg_orgao` varchar(5) NOT NULL,
  `pes_rg_estado` varchar(2) NOT NULL,
  `pes_nascimento` date NOT NULL,
  `pes_obito` date DEFAULT NULL,
  `pes_sexo` tinyint(1) NOT NULL,
  `pes_escolariadade` char(1) NOT NULL,
  `pes_profissao` varchar(40) NOT NULL,
  `pes_naturalidade` varchar(30) NOT NULL,
  `pes_nacionalidade` varchar(30) NOT NULL,
  `pes_res_logradouro` varchar(50) NOT NULL,
  `pes_res_numero` varchar(5) NOT NULL,
  `pes_res_complemento` varchar(30) NOT NULL,
  `pes_res_bairro` varchar(50) NOT NULL,
  `pes_res_cidade` varchar(50) NOT NULL,
  `pes_res_estado` char(2) NOT NULL,
  `pes_res_cep` char(8) NOT NULL,
  `pes_tra_logradouro` varchar(50) NOT NULL,
  `pes_tra_numero` varchar(5) NOT NULL,
  `pes_tra_complemento` varchar(30) NOT NULL,
  `pes_tra_bairro` varchar(50) NOT NULL,
  `pes_tra_cidade` varchar(50) NOT NULL,
  `pes_tra_estado` char(2) NOT NULL,
  `pes_tra_cep` char(8) NOT NULL,
  `pes_telefone1` char(12) NOT NULL,
  `pes_telefone2` char(12) NOT NULL,
  `pes_email1` varchar(30) NOT NULL,
  `pes_email2` varchar(30) NOT NULL,
  PRIMARY KEY (`pes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_usuario`
--

CREATE TABLE IF NOT EXISTS `sistema_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_login` varchar(20) NOT NULL,
  `usu_senha` char(41) NOT NULL,
  `usu_grp_id` int(11) NOT NULL,
  `usu_status` tinyint(1) NOT NULL DEFAULT '0',
  `pes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_nome` (`usu_login`),
  UNIQUE KEY `pes_id` (`pes_id`),
  KEY `usu_grp_id` (`usu_grp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_usuario_grupo`
--

CREATE TABLE IF NOT EXISTS `sistema_usuario_grupo` (
  `usu_grp_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_grp_nome` varchar(20) NOT NULL,
  PRIMARY KEY (`usu_grp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `financeiro_movimentacao`
--
ALTER TABLE `financeiro_movimentacao`
  ADD CONSTRAINT `financeiro_movimentacao_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `financeiro_conta` (`con_id`);

--
-- Restrições para tabelas `rh_funcionario`
--
ALTER TABLE `rh_funcionario`
  ADD CONSTRAINT `rh_funcionario_ibfk_1` FOREIGN KEY (`pes_id`) REFERENCES `sistema_pessoa` (`pes_id`),
  ADD CONSTRAINT `rh_funcionario_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `rh_cargo` (`car_id`);

--
-- Restrições para tabelas `sistema_acesso`
--
ALTER TABLE `sistema_acesso`
  ADD CONSTRAINT `sistema_acesso_ibfk_1` FOREIGN KEY (`usu_grp_id`) REFERENCES `sistema_usuario_grupo` (`usu_grp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sistema_acesso_ibfk_2` FOREIGN KEY (`fer_id`) REFERENCES `sistema_ferramenta` (`fer_id`);

--
-- Restrições para tabelas `sistema_ferramenta`
--
ALTER TABLE `sistema_ferramenta`
  ADD CONSTRAINT `sistema_ferramenta_ibfk_1` FOREIGN KEY (`mod_id`) REFERENCES `sistema_modulo` (`mod_id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `sistema_log`
--
ALTER TABLE `sistema_log`
  ADD CONSTRAINT `sistema_log_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `sistema_usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `sistema_usuario`
--
ALTER TABLE `sistema_usuario`
  ADD CONSTRAINT `sistema_usuario_ibfk_1` FOREIGN KEY (`usu_grp_id`) REFERENCES `sistema_usuario_grupo` (`usu_grp_id`),
  ADD CONSTRAINT `sistema_usuario_ibfk_2` FOREIGN KEY (`pes_id`) REFERENCES `sistema_pessoa` (`pes_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
