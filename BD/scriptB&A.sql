CREATE DATABASE  IF NOT EXISTS `b&a` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `b&a`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: b&a
-- ------------------------------------------------------
-- Server version	5.7.11-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activo`
--

DROP TABLE IF EXISTS `activo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activo` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `fechaRegistro` date NOT NULL,
  `monto` double NOT NULL,
  `depreciacionMensual` double DEFAULT NULL,
  `depreciacionAcumulada` double DEFAULT NULL,
  `depreciacionPeriodo` double DEFAULT NULL,
  `idCliente` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `tipo_idx` (`tipo`),
  KEY `idCliente1_idx` (`idCliente`),
  CONSTRAINT `idCliente2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipo` FOREIGN KEY (`tipo`) REFERENCES `tipoactivo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anticipo`
--

DROP TABLE IF EXISTS `anticipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anticipo` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `idPeriodo` int(11) NOT NULL,
  `tipoPago` varchar(30) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `formulario` varchar(45) DEFAULT NULL,
  `fecha` date NOT NULL,
  `monto` double NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idPeriodo_idx` (`idPeriodo`),
  CONSTRAINT `idPeriodo8` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aspectodeclaracion`
--

DROP TABLE IF EXISTS `aspectodeclaracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aspectodeclaracion` (
  `identificador` double NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `elemento` varchar(70) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `observacion` varchar(70) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idUsuario_idx` (`idUsuario`),
  CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=741 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `identificacion` varchar(15) NOT NULL,
  `tipo` int(1) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `cedulaDGT` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`identificacion`,`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cuentacontable`
--

DROP TABLE IF EXISTS `cuentacontable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentacontable` (
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `declaracionjurada`
--

DROP TABLE IF EXISTS `declaracionjurada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `declaracionjurada` (
  `idCliente` varchar(15) NOT NULL,
  `idAspecto` double NOT NULL,
  `anno` varchar(4) NOT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`idCliente`,`anno`,`idAspecto`),
  KEY `idCliente_idx` (`idCliente`),
  KEY `idAspecto_idx` (`idAspecto`),
  CONSTRAINT `idAspecto` FOREIGN KEY (`idAspecto`) REFERENCES `aspectodeclaracion` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idCliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inversion`
--

DROP TABLE IF EXISTS `inversion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inversion` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `sociedad` varchar(70) DEFAULT NULL,
  `cedulajuridica` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `monto` double NOT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `idCliente` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idCliente6_idx` (`idCliente`),
  CONSTRAINT `idCliente6` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimiento` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `idPeriodo` int(11) NOT NULL,
  `grupo` varchar(20) DEFAULT NULL,
  `fecha` date NOT NULL,
  `proveedor` varchar(50) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `comprobante` varchar(30) DEFAULT NULL,
  `monto` double NOT NULL,
  `moneda` int(1) NOT NULL,
  `codigoContable` varchar(15) NOT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `idPasivo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idPeriodo_idx` (`idPeriodo`),
  KEY `codigoContable_idx` (`codigoContable`),
  KEY `idPasivo_idx` (`idPasivo`),
  CONSTRAINT `codigoContable` FOREIGN KEY (`codigoContable`) REFERENCES `cuentacontable` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPasivo` FOREIGN KEY (`idPasivo`) REFERENCES `pasivo` (`banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPeriodo` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pasivo`
--

DROP TABLE IF EXISTS `pasivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasivo` (
  `banco` varchar(50) NOT NULL,
  `fechaApertura` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `interes` double DEFAULT NULL,
  `principal` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `idCliente` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`banco`,`idCliente`),
  KEY `idCliente3_idx` (`idCliente`),
  CONSTRAINT `idCliente3` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patrimonio`
--

DROP TABLE IF EXISTS `patrimonio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patrimonio` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `accionista` varchar(45) DEFAULT NULL,
  `acta` varchar(45) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `fechaDevolucion` date DEFAULT NULL,
  `idCliente` varchar(15) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idCliente4_idx` (`idCliente`),
  CONSTRAINT `idCliente4` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `anno` varchar(4) NOT NULL,
  `estado` int(1) NOT NULL,
  `idCliente` varchar(15) NOT NULL,
  `creador` int(11) NOT NULL,
  `reviso` int(11) DEFAULT NULL,
  `aprobo` int(11) DEFAULT NULL,
  `fechaCierre` varchar(20) DEFAULT NULL,
  `dolar` double NOT NULL,
  PRIMARY KEY (`identificador`),
  KEY `idCliente_idx` (`idCliente`),
  KEY `creador_idx` (`creador`),
  KEY `reviso_idx` (`reviso`),
  KEY `aprobo_idx` (`aprobo`),
  CONSTRAINT `aprobo` FOREIGN KEY (`aprobo`) REFERENCES `usuario` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `creador` FOREIGN KEY (`creador`) REFERENCES `usuario` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idCliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reviso` FOREIGN KEY (`reviso`) REFERENCES `usuario` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo_activo`
--

DROP TABLE IF EXISTS `periodo_activo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_activo` (
  `idPeriodo` int(11) NOT NULL,
  `idActivo` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  `depreciacionAcumulada` double DEFAULT NULL,
  `depreciacionPeriodo` double DEFAULT NULL,
  PRIMARY KEY (`idPeriodo`,`idActivo`),
  KEY `idActivo_idx` (`idActivo`),
  CONSTRAINT `idActivo3` FOREIGN KEY (`idActivo`) REFERENCES `activo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPeriodo3` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo_inversion`
--

DROP TABLE IF EXISTS `periodo_inversion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_inversion` (
  `idPeriodo` int(11) NOT NULL,
  `idInversion` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`idPeriodo`,`idInversion`),
  KEY `idInversion_idx` (`idInversion`),
  CONSTRAINT `idInversion` FOREIGN KEY (`idInversion`) REFERENCES `inversion` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPeriodo6` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo_pasivo`
--

DROP TABLE IF EXISTS `periodo_pasivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_pasivo` (
  `idPeriodo` int(11) NOT NULL,
  `idPasivo` varchar(50) NOT NULL,
  `principal` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  PRIMARY KEY (`idPeriodo`,`idPasivo`),
  KEY `idPasivo3_idx` (`idPasivo`),
  CONSTRAINT `idPasivo4` FOREIGN KEY (`idPasivo`) REFERENCES `pasivo` (`banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPeriodo4` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `periodo_patrimonio`
--

DROP TABLE IF EXISTS `periodo_patrimonio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo_patrimonio` (
  `idPeriodo` int(11) NOT NULL,
  `idPatrimonio` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  PRIMARY KEY (`idPeriodo`,`idPatrimonio`),
  KEY `idPatrimonio5_idx` (`idPatrimonio`),
  CONSTRAINT `idPatrimonio5` FOREIGN KEY (`idPatrimonio`) REFERENCES `patrimonio` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idPeriodo5` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`identificador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rangoimpuesto`
--

DROP TABLE IF EXISTS `rangoimpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rangoimpuesto` (
  `tipo` int(11) NOT NULL,
  `anno` varchar(4) NOT NULL,
  `tarifa` double NOT NULL,
  `rango` double DEFAULT NULL,
  PRIMARY KEY (`tipo`,`anno`,`tarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipoactivo`
--

DROP TABLE IF EXISTS `tipoactivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoactivo` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `mesesDepreciado` int(11) NOT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `identificador` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(50) NOT NULL,
  `nombreCompleto` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(12) NOT NULL,
  `tipo` int(1) NOT NULL,
  `revisar` int(1) DEFAULT NULL,
  `aprobar` int(1) DEFAULT NULL,
  `editar` int(1) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`identificador`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-27  9:00:44
