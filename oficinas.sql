
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/05/2017 às 21:21:12
-- Versão do Servidor: 10.0.28-MariaDB
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u449569243_of`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `oficinas`
--

CREATE TABLE IF NOT EXISTS `oficinas` (
  `codempresa` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomeempresa` varchar(50) DEFAULT NULL,
  `ativo` integer DEFAULT NULL,
  PRIMARY KEY (`codempresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `oficinas`(`nomeempresa`, `ativo`) VALUES ('Administadores GiroDesenvolvimento',1),
                                                      ('GiroMecanica AutoCenter',1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `m_veiculos`
--

CREATE TABLE IF NOT EXISTS `m_veiculos` (
   `cdveic` bigint(20) NOT NULL AUTO_INCREMENT,
   `deplac` varchar(10) DEFAULT NULL,
   `deanof` varchar(4) DEFAULT NULL,
   `deanom` varchar(4) DEFAULT NULL,
   `demarc` varchar(50) DEFAULT NULL,
   `demode` varchar(50) DEFAULT NULL,  
   `decor`  varchar(10) DEFAULT NULL,
   `cdclie` varchar(14) DEFAULT NULL,
   `flativ` varchar(10) DEFAULT NULL,
   `dtcada` date DEFAULT NULL,
   `dtulti` date DEFAULT NULL, 
   `codempresa` bigint(20) DEFAULT NULL, 
   PRIMARY KEY (`cdveic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `cdusua` bigint(20) DEFAULT NULL, 
  `dtlog` varchar(50) DEFAULT NULL,
  `delog` varchar(50) DEFAULT NULL,
  `iplog` varchar(50) DEFAULT NULL,
  `flativ` varchar(50) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cdclie` varchar(14) NOT NULL,
  `declie` varchar(100) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `nrrg` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(50) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(10) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdclie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Estrutura da tabela `contas`
--

CREATE TABLE IF NOT EXISTS `contas` (
  `cdcont` bigint(20) NOT NULL AUTO_INCREMENT,
  `decont` varchar(50) DEFAULT NULL,
  `dtcont` date DEFAULT NULL,
  `vlcont` decimal(15,2) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdquem` varchar(100) DEFAULT NULL,
  `cdorig` varchar(100) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdcont`),
  KEY `icontas1` (`decont`,`dtcont`),
  KEY `icontas2` (`dtcont`,`cdquem`),
  KEY `icontas3` (`dtcont`,`cdorig`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Estrutura da tabela `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `cdesta` char(2) NOT NULL,
  `deesta` char(35) DEFAULT NULL,
  PRIMARY KEY (`cdesta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`cdesta`, `deesta`) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AM', 'Amazonas'),
('AP', 'Amapá'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MG', 'Minas Gerais'),
('MS', 'Mato Grosso do Sul'),
('MT', 'Mato Grosso'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('PR', 'Paraná'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RO', 'Rondônia'),
('RR', 'Roraima'),
('RS', 'Rio Grande do Sul'),
('SC', 'Santa Catarina'),
('SE', 'Sergipe'),
('SP', 'São Paulo'),
('TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `cdforn` varchar(14) NOT NULL,
  `deforn` varchar(100) DEFAULT NULL,
  `cdtipo` varchar(15) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `nrrg` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(50) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(10) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdforn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE IF NOT EXISTS `ordem` (
  `cdorde` bigint(20) NOT NULL AUTO_INCREMENT,
  `cdclie` varchar(100) DEFAULT NULL,
  `veplac` char(7) DEFAULT NULL,
  `vemarc` varchar(30) DEFAULT NULL,
  `vemode` varchar(30) DEFAULT NULL,
  `veanom` char(4) DEFAULT NULL,
  `veanof` char(4) DEFAULT NULL,
  `vecorv` varchar(15) DEFAULT NULL,
  `cdsitu` varchar(30) DEFAULT NULL,
  `dtorde` date DEFAULT NULL,
  `vlorde` decimal(15,2) DEFAULT NULL,
  `cdform` varchar(30) DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date NOT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdorde`),
  KEY `iordem1` (`cdclie`,`dtorde`),
  KEY `iordem2` (`cdform`,`dtorde`),
  KEY `iordem3` (`cdclie`,`dtpago`),
  KEY `iordem4` (`cdform`,`dtpago`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ordem`
--


--
-- Estrutura da tabela `ordemi`
--

CREATE TABLE IF NOT EXISTS `ordemi` (
  `cdorde` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  KEY `iordemi1` (`cdorde`,`nritem`,`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Estrutura da tabela `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `cdprop` varchar(14) NOT NULL,
  `deprop` varchar(100) DEFAULT NULL,
  `nrinsc` varchar(20) DEFAULT NULL,
  `nrccm` varchar(20) DEFAULT NULL,
  `deende` varchar(100) DEFAULT NULL,
  `nrende` int(11) DEFAULT NULL,
  `decomp` varchar(50) DEFAULT NULL,
  `debair` varchar(50) DEFAULT NULL,
  `decida` varchar(100) DEFAULT NULL,
  `cdesta` varchar(50) DEFAULT NULL,
  `nrcepi` varchar(8) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `nrcelu` varchar(20) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdprop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `parametros`
--

INSERT INTO `parametros` (`cdprop`, `deprop`, `nrinsc`, `nrccm`, `deende`, `nrende`, `decomp`, `debair`, `decida`, `cdesta`, `nrcepi`, `nrtele`, `nrcelu`, `demail`,`codempresa`) VALUES
('99999999999999', 'Oficina Mecânica Nova Aliança', 'Isento', '2345', 'Rua Anecy Rocha', 1520, '', 'Jardim Nova Vitória', 'São Paulo', 'SP - São Paulo', '08372-20', '11 2734-3353', '11 9-8448-3928', 'of.mecanicanovaalianca@hotmail.com','1'),
('61843256000155', 'Oficina Mecânica Nova Aliança', 'Isento', '2345', 'Rua Anecy Rocha', 1520, '', 'Jardim Nova Vitória', 'São Paulo', 'SP - São Paulo', '08372-20', '11 2734-3353', '11 9-8448-3928', 'of.mecanicanovaalianca@hotmail.com','2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE IF NOT EXISTS `pecas` (
  `cdpeca` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `depeca` varchar(100) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE IF NOT EXISTS `agendamentos` (
  `cdage` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `cdclie` varchar(100) DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `cdorde` bigint(20) DEFAULT NULL,
  `dtret`  date DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `cdpedi` bigint(20) NOT NULL AUTO_INCREMENT,
  `cdforn` varchar(100) DEFAULT NULL,
  `dtpedi` date DEFAULT NULL,
  `vlpedi` decimal(15,2) DEFAULT NULL,
  `vlpago` decimal(15,2) DEFAULT NULL,
  `dtpago` date DEFAULT NULL,
  `cdform` varchar(30) DEFAULT NULL,
  `qtform` int(11) DEFAULT NULL,
  `decont` varchar(100) DEFAULT NULL,
  `dtentr` date DEFAULT NULL,
  `deobse` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdpedi`),
  KEY `ipedidos1` (`cdforn`,`cdpedi`,`dtpedi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Estrutura da tabela `pedidosi`
--

CREATE TABLE IF NOT EXISTS `pedidosi` (
  `cdpedi` bigint(20) DEFAULT NULL,
  `nritem` int(11) DEFAULT NULL,
  `cdpeca` varchar(100) DEFAULT NULL,
  `qtpeca` int(11) DEFAULT NULL,
  `vlpeca` decimal(15,2) DEFAULT NULL,
  `vltota` decimal(15,2) DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  KEY `ipedidosi1` (`cdpedi`,`nritem`,`cdpeca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
  `cdserv` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `deserv` varchar(100) DEFAULT NULL,
  `vlserv` decimal(15,2) DEFAULT NULL,
  `qtserv` int(11) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdserv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cdusua` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `deusua` varchar(100) DEFAULT NULL,
  `demail` varchar(255) DEFAULT NULL,
  `nrtele` varchar(20) DEFAULT NULL,
  `cdtipo` varchar(30) DEFAULT NULL,
  `defoto` varchar(500) DEFAULT NULL,
  `desenh` varchar(500) DEFAULT NULL,
  `flativ` varchar(15) DEFAULT NULL,
  `dtcada` date DEFAULT NULL,
  `codempresa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cdusua`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`deusua`, `demail`, `nrtele`, `cdtipo`, `defoto`, `desenh`, `flativ`, `dtcada`,`codempresa`) VALUES
('Marlon Pilonetto', 'adm@adm.com', '11 1234-1234', 'Suporte', 'img/1rato.png', '18bcc99ed4c9f9a80f7b91e8ede5acc1', 'Sim', '2016-10-28','1'),
('Luiz Girolometo', 'adm@adm.com', '11 1234-1234', 'Suporte', 'img/1rato.png', '77949c9f02621a4c85964be115a9dcc9', 'Sim', '2016-10-28','1'),
('Usuário teste', 'adm@adm.com', '11 1234-1234', 'Suporte', 'img/1rato.png', '202cb962ac59075b964b07152d234b70', 'Sim', '2016-10-28','2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
