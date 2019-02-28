CREATE DATABASE  IF NOT EXISTS `db_edoc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_edoc`;
-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: db_edoc
-- ------------------------------------------------------
-- Server version	5.6.40

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
-- Table structure for table `persona`
--
create table `persona` (
  `per_id` bigint(20) not null auto_increment,
  `per_tip_cruc` bigint(3) default null,
  `per_ced_ruc` varchar(15) default null,
  `per_nombre` varchar(100) default null,
  `per_apellido` varchar(100) default null,
  `per_genero` varchar(1) default null,
  `per_fec_nacimiento` date default null,
  `per_est_log` varchar(1) default null,
  `per_fec_cre` timestamp null default null,
  `per_fec_mod` timestamp null default null,
  primary key (`per_id`)
) engine=innodb auto_increment=0 default charset=latin1;
--
-- Table structure for table `usuario`
--
create table `usuario` (
  `usu_id` bigint(20) not null auto_increment,
  `per_id` bigint(20) not null,
  `usu_nombre` varchar(100) default null,
  `usu_password` varchar(50) default null,
  `usu_alias` varchar(60) default null,
  `usu_correo` varchar(100) default null,
  `usu_est_log` varchar(1) default null,
  `usu_fec_cre` timestamp null default current_timestamp,
  `usu_fec_mod` timestamp null default null,
  primary key (`usu_id`),
  key `fk_usuario_persona` (`per_id`),
  constraint `fk_usuario_persona` foreign key (`per_id`) references `persona` (`per_id`) on delete no action on update no action
) engine=innodb auto_increment=0 default charset=latin1;

--
-- Table structure for table `NubeDatoAdicionalDetalleFactura`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalDetalleFactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalDetalleFactura` (
  `IdDatoAdicionalDetalleFactura` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdDetalleFactura` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalDetalleFactura`),
  KEY `FK_NubeDatoAdicionalDetalleFactura_NubeDetalleFactura` (`IdDetalleFactura`),
  CONSTRAINT `FK_NubeDatoAdicionalDetalleFactura_NubeDetalleFactura` FOREIGN KEY (`IdDetalleFactura`) REFERENCES `NubeDetalleFactura` (`IdDetalleFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalDetalleNotaCredito`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalDetalleNotaCredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalDetalleNotaCredito` (
  `IdDatoAdicionalDetalleNotaCredito` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdDetalleNotaCredito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalDetalleNotaCredito`),
  KEY `FK_NubeDatoAdicionalDetalleNotaCredito_NubeDetalleNotaCredito` (`IdDetalleNotaCredito`),
  CONSTRAINT `FK_NubeDatoAdicionalDetalleNotaCredito_NubeDetalleNotaCredito` FOREIGN KEY (`IdDetalleNotaCredito`) REFERENCES `NubeDetalleNotaCredito` (`IdDetalleNotaCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalFactura`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalFactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalFactura` (
  `IdDatoAdicionalFactura` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdFactura` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalFactura`),
  KEY `FK_NubeDatoAdicionalFactura_NubeFactura` (`IdFactura`),
  CONSTRAINT `FK_NubeDatoAdicionalFactura_NubeFactura` FOREIGN KEY (`IdFactura`) REFERENCES `NubeFactura` (`IdFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalGuiaRemision`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalGuiaRemision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalGuiaRemision` (
  `IdDatoAdicionalGuiaRemision` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdGuiaRemision` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalGuiaRemision`),
  KEY `FK_NubeDatoAdicionalGuiaRemision_NubeGuiaRemision` (`IdGuiaRemision`),
  CONSTRAINT `FK_NubeDatoAdicionalGuiaRemision_NubeGuiaRemision` FOREIGN KEY (`IdGuiaRemision`) REFERENCES `NubeGuiaRemision` (`IdGuiaRemision`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalGuiaRemisionDetalle`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalGuiaRemisionDetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalGuiaRemisionDetalle` (
  `IdDatoAdicionalGuiaRemisionDetalle` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdGuiaRemisionDetalle` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalGuiaRemisionDetalle`),
  KEY `FK_NubeDatoAdicionalGuiaRemisionDetalle_NubeGuiaRemisionDetalle` (`IdGuiaRemisionDetalle`),
  CONSTRAINT `FK_NubeDatoAdicionalGuiaRemisionDetalle_NubeGuiaRemisionDetalle` FOREIGN KEY (`IdGuiaRemisionDetalle`) REFERENCES `NubeGuiaRemisionDetalle` (`IdGuiaRemisionDetalle`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalNotaCredito`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalNotaCredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalNotaCredito` (
  `IdDatoAdicionalNotaCredito` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdNotaCredito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalNotaCredito`),
  KEY `FK_NubeDatoAdicionalNotaCredito_NubeNotaCredito` (`IdNotaCredito`),
  CONSTRAINT `FK_NubeDatoAdicionalNotaCredito_NubeNotaCredito` FOREIGN KEY (`IdNotaCredito`) REFERENCES `NubeNotaCredito` (`IdNotaCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalNotaDebito`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalNotaDebito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalNotaDebito` (
  `IdDatoAdicionalNotaDebito` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdNotaDebito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalNotaDebito`),
  KEY `FK_NubeDatoAdicionalNotaDebito_NubeNotaDebito` (`IdNotaDebito`),
  CONSTRAINT `FK_NubeDatoAdicionalNotaDebito_NubeNotaDebito` FOREIGN KEY (`IdNotaDebito`) REFERENCES `NubeNotaDebito` (`IdNotaDebito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDatoAdicionalRetencion`
--

DROP TABLE IF EXISTS `NubeDatoAdicionalRetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDatoAdicionalRetencion` (
  `IdDatoAdicionalRetencion` bigint(19) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(300) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdRetencion` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDatoAdicionalRetencion`),
  KEY `FK_NubeDatoAdicionalRetencion_NubeRetencion` (`IdRetencion`),
  CONSTRAINT `FK_NubeDatoAdicionalRetencion_NubeRetencion` FOREIGN KEY (`IdRetencion`) REFERENCES `NubeRetencion` (`IdRetencion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDetalleFactura`
--

DROP TABLE IF EXISTS `NubeDetalleFactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDetalleFactura` (
  `IdDetalleFactura` bigint(19) NOT NULL AUTO_INCREMENT,
  `CodigoPrincipal` varchar(25) DEFAULT NULL,
  `CodigoAuxiliar` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `Cantidad` decimal(19,4) DEFAULT NULL,
  `PrecioUnitario` decimal(19,4) DEFAULT NULL,
  `Descuento` decimal(19,4) DEFAULT NULL,
  `PrecioTotalSinImpuesto` decimal(19,4) DEFAULT NULL,
  `IdFactura` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleFactura`),
  KEY `FK_NubeDetalleFactura_NubeFactura` (`IdFactura`),
  CONSTRAINT `FK_NubeDetalleFactura_NubeFactura` FOREIGN KEY (`IdFactura`) REFERENCES `NubeFactura` (`IdFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDetalleFacturaImpuesto`
--

DROP TABLE IF EXISTS `NubeDetalleFacturaImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDetalleFacturaImpuesto` (
  `IdDetalleFacturaImpuesto` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoPorcentaje` int(10) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `Tarifa` decimal(19,4) DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdDetalleFactura` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleFacturaImpuesto`),
  KEY `FK_NubeDetalleFacturaImpuesto_NubeDetalleFactura` (`IdDetalleFactura`),
  CONSTRAINT `FK_NubeDetalleFacturaImpuesto_NubeDetalleFactura` FOREIGN KEY (`IdDetalleFactura`) REFERENCES `NubeDetalleFactura` (`IdDetalleFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDetalleNotaCredito`
--

DROP TABLE IF EXISTS `NubeDetalleNotaCredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDetalleNotaCredito` (
  `IdDetalleNotaCredito` bigint(19) NOT NULL AUTO_INCREMENT,
  `CodigoPrincipal` varchar(25) DEFAULT NULL,
  `CodigoAuxiliar` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `Cantidad` int(10) DEFAULT NULL,
  `PrecioUnitario` decimal(19,4) DEFAULT NULL,
  `Descuento` decimal(19,4) DEFAULT NULL,
  `PrecioTotalSinImpuesto` decimal(19,4) DEFAULT NULL,
  `IdNotaCredito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleNotaCredito`),
  KEY `FK_NubeDetalleNotaCredito_NubeNotaCredito` (`IdNotaCredito`),
  CONSTRAINT `FK_NubeDetalleNotaCredito_NubeNotaCredito` FOREIGN KEY (`IdNotaCredito`) REFERENCES `NubeNotaCredito` (`IdNotaCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDetalleNotaCreditoImpuesto`
--

DROP TABLE IF EXISTS `NubeDetalleNotaCreditoImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDetalleNotaCreditoImpuesto` (
  `IdDetalleNotaCreditoImpuesto` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoPorcentaje` int(10) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `Tarifa` decimal(19,4) DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdDetalleNotaCredito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleNotaCreditoImpuesto`),
  KEY `FK_NubeDetalleNotaCreditoImpuesto_NubeDetalleNotaCredito` (`IdDetalleNotaCredito`),
  CONSTRAINT `FK_NubeDetalleNotaCreditoImpuesto_NubeDetalleNotaCredito` FOREIGN KEY (`IdDetalleNotaCredito`) REFERENCES `NubeDetalleNotaCredito` (`IdDetalleNotaCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeDetalleRetencion`
--

DROP TABLE IF EXISTS `NubeDetalleRetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeDetalleRetencion` (
  `IdDetalleRetencion` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoRetencion` varchar(5) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `PorcentajeRetener` decimal(19,4) DEFAULT NULL,
  `ValorRetenido` decimal(19,4) DEFAULT NULL,
  `CodDocRetener` varchar(2) DEFAULT NULL,
  `NumDocRetener` varchar(20) DEFAULT NULL,
  `FechaEmisionDocRetener` datetime DEFAULT NULL,
  `IdRetencion` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleRetencion`),
  KEY `FK_NubeDetalleRetencion_NubeRetencion` (`IdRetencion`),
  CONSTRAINT `FK_NubeDetalleRetencion_NubeRetencion` FOREIGN KEY (`IdRetencion`) REFERENCES `NubeRetencion` (`IdRetencion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeFactura`
--

DROP TABLE IF EXISTS `NubeFactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeFactura` (
  `IdFactura` bigint(19) NOT NULL AUTO_INCREMENT,
  `AutorizacionSRI` varchar(50) DEFAULT NULL,
  `FechaAutorizacion` datetime DEFAULT NULL,
  `Ambiente` int(1) DEFAULT NULL,
  `TipoEmision` int(1) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `NombreComercial` varchar(300) DEFAULT NULL,
  `Ruc` varchar(20) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  `CodigoDocumento` varchar(2) DEFAULT NULL,
  `Establecimiento` varchar(3) DEFAULT NULL,
  `PuntoEmision` varchar(3) DEFAULT NULL,
  `Secuencial` varchar(15) DEFAULT NULL,
  `DireccionMatriz` varchar(300) DEFAULT NULL,
  `FechaEmision` datetime DEFAULT NULL,
  `DireccionEstablecimiento` varchar(300) DEFAULT NULL,
  `ContribuyenteEspecial` varchar(10) DEFAULT NULL,
  `ObligadoContabilidad` varchar(2) DEFAULT NULL,
  `TipoIdentificacionComprador` varchar(2) DEFAULT NULL,
  `GuiaRemision` varchar(20) DEFAULT NULL,
  `RazonSocialComprador` varchar(300) DEFAULT NULL,
  `IdentificacionComprador` varchar(13) DEFAULT NULL,
  `TotalSinImpuesto` decimal(14,4) DEFAULT NULL,
  `TotalDescuento` decimal(14,4) DEFAULT NULL,
  `Propina` decimal(14,4) DEFAULT NULL,
  `ImporteTotal` decimal(14,4) DEFAULT NULL,
  `Moneda` varchar(15) DEFAULT NULL,
  `UsuarioCreador` varchar(100) DEFAULT NULL,
  `EmailResponsable` varchar(100) DEFAULT NULL,
  `EstadoDocumento` varchar(25) DEFAULT NULL,
  `DescripcionError` blob,
  `CodigoError` varchar(10) DEFAULT NULL,
  `DirectorioDocumento` varchar(100) DEFAULT NULL,
  `NombreDocumento` varchar(100) DEFAULT NULL,
  `GeneradoXls` int(4) DEFAULT NULL,
  `SecuencialERP` varchar(10) DEFAULT NULL,
  `CodigoTransaccionERP` varchar(3) DEFAULT NULL,
  `Estado` int(10) DEFAULT NULL,
  `EstadoEnv` int(10) DEFAULT '2',
  `FechaCarga` datetime DEFAULT NULL,
  `FechaAnula` datetime DEFAULT NULL,
  `IdLote` bigint(20) DEFAULT NULL,
  `IdRad` bigint(20) DEFAULT '0',
  `USU_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`IdFactura`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeFacturaFormaPago`
--

DROP TABLE IF EXISTS `NubeFacturaFormaPago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeFacturaFormaPago` (
  `IdFormaPagoFact` bigint(20) NOT NULL AUTO_INCREMENT,
  `IdForma` bigint(20) NOT NULL,
  `IdFactura` bigint(19) NOT NULL,
  `FormaPago` varchar(2) DEFAULT NULL,
  `Total` decimal(14,4) DEFAULT NULL,
  `Plazo` int(5) DEFAULT NULL,
  `UnidadTiempo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdFormaPagoFact`),
  KEY `IdFactura` (`IdFactura`),
  KEY `NubeFacturaFormaPago_ibfk_2` (`IdForma`),
  CONSTRAINT `NubeFacturaFormaPago_ibfk_1` FOREIGN KEY (`IdFactura`) REFERENCES `NubeFactura` (`IdFactura`),
  CONSTRAINT `NubeFacturaFormaPago_ibfk_2` FOREIGN KEY (`IdForma`) REFERENCES `VSFormaPago` (`IdForma`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeFacturaImpuesto`
--

DROP TABLE IF EXISTS `NubeFacturaImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeFacturaImpuesto` (
  `IdFacturaImpuesto` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoPorcentaje` int(10) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `Tarifa` decimal(19,4) DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdFactura` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdFacturaImpuesto`),
  KEY `FK_NubeFacturaImpuesto_NubeFactura` (`IdFactura`),
  CONSTRAINT `FK_NubeFacturaImpuesto_NubeFactura` FOREIGN KEY (`IdFactura`) REFERENCES `NubeFactura` (`IdFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeGuiaRemision`
--

DROP TABLE IF EXISTS `NubeGuiaRemision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeGuiaRemision` (
  `IdGuiaRemision` bigint(19) NOT NULL AUTO_INCREMENT,
  `AutorizacionSRI` varchar(50) DEFAULT NULL,
  `FechaAutorizacion` datetime DEFAULT NULL,
  `Ambiente` int(1) DEFAULT NULL,
  `TipoEmision` int(1) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `NombreComercial` varchar(300) DEFAULT NULL,
  `Ruc` varchar(20) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  `CodigoDocumento` varchar(2) DEFAULT NULL,
  `Establecimiento` varchar(3) DEFAULT NULL,
  `PuntoEmision` varchar(3) DEFAULT NULL,
  `Secuencial` varchar(15) DEFAULT NULL,
  `DireccionMatriz` varchar(300) DEFAULT NULL,
  `DireccionEstablecimiento` varchar(300) DEFAULT NULL,
  `DireccionPartida` varchar(300) DEFAULT NULL,
  `RazonSocialTransportista` varchar(300) DEFAULT NULL,
  `TipoIdentificacionTransportista` varchar(2) DEFAULT NULL,
  `IdentificacionTransportista` varchar(20) DEFAULT NULL,
  `Rise` varchar(40) DEFAULT NULL,
  `ObligadoContabilidad` varchar(2) DEFAULT NULL,
  `ContribuyenteEspecial` varchar(10) DEFAULT NULL,
  `FechaInicioTransporte` datetime DEFAULT NULL,
  `FechaFinTransporte` datetime DEFAULT NULL,
  `Placa` varchar(20) DEFAULT NULL,
  `UsuarioCreador` varchar(50) DEFAULT NULL,
  `EmailResponsable` varchar(100) DEFAULT NULL,
  `EstadoDocumento` varchar(25) DEFAULT NULL,
  `DescripcionError` blob,
  `CodigoError` varchar(10) DEFAULT NULL,
  `DirectorioDocumento` varchar(100) DEFAULT NULL,
  `NombreDocumento` varchar(100) DEFAULT NULL,
  `GeneradoXls` tinyint(4) DEFAULT NULL,
  `CodigoTransaccionERP` varchar(3) DEFAULT NULL,
  `SecuencialERP` varchar(10) DEFAULT NULL,
  `Estado` int(10) DEFAULT NULL,
  `EstadoEnv` int(10) DEFAULT '2',
  `IdLote` varchar(50) DEFAULT NULL,
  `IdRad` bigint(20) DEFAULT '0',
  `FechaEmisionErp` datetime DEFAULT NULL,
  `FechaCarga` datetime DEFAULT NULL,
  `FechaAnula` datetime DEFAULT NULL,
  `USU_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`IdGuiaRemision`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeGuiaRemisionDestinatario`
--

DROP TABLE IF EXISTS `NubeGuiaRemisionDestinatario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeGuiaRemisionDestinatario` (
  `IdGuiaRemisionDestinatario` bigint(19) NOT NULL AUTO_INCREMENT,
  `IdentificacionDestinatario` varchar(13) DEFAULT NULL,
  `RazonSocialDestinatario` varchar(300) DEFAULT NULL,
  `DirDestinatario` varchar(300) DEFAULT NULL,
  `MotivoTraslado` varchar(300) DEFAULT NULL,
  `DocAduaneroUnico` varchar(20) DEFAULT NULL,
  `CodEstabDestino` varchar(3) DEFAULT NULL,
  `Ruta` varchar(300) DEFAULT NULL,
  `CodDocSustento` varchar(2) DEFAULT NULL,
  `NumDocSustento` varchar(20) DEFAULT NULL,
  `NumAutDocSustento` varchar(50) DEFAULT NULL,
  `FechaEmisionDocSustento` date DEFAULT NULL,
  `IdGuiaRemision` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdGuiaRemisionDestinatario`),
  KEY `FK_NubeGuiaRemisionDestinatario_NubeGuiaRemision` (`IdGuiaRemision`),
  CONSTRAINT `FK_NubeGuiaRemisionDestinatario_NubeGuiaRemision` FOREIGN KEY (`IdGuiaRemision`) REFERENCES `NubeGuiaRemision` (`IdGuiaRemision`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeGuiaRemisionDetalle`
--

DROP TABLE IF EXISTS `NubeGuiaRemisionDetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeGuiaRemisionDetalle` (
  `IdGuiaRemisionDetalle` bigint(19) NOT NULL AUTO_INCREMENT,
  `CodigoInterno` varchar(25) DEFAULT NULL,
  `CodigoAdicional` varchar(25) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `Cantidad` decimal(19,4) DEFAULT NULL,
  `IdGuiaRemisionDestinatario` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdGuiaRemisionDetalle`),
  KEY `FK_NubeGuiaRemisionDetalle_NubeGuiaRemisionDestinatario` (`IdGuiaRemisionDestinatario`),
  CONSTRAINT `FK_NubeGuiaRemisionDetalle_NubeGuiaRemisionDestinatario` FOREIGN KEY (`IdGuiaRemisionDestinatario`) REFERENCES `NubeGuiaRemisionDestinatario` (`IdGuiaRemisionDestinatario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeLote`
--

DROP TABLE IF EXISTS `NubeLote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeLote` (
  `Id` int(10) NOT NULL,
  `IdLote` varchar(50) NOT NULL,
  `TipoLote` varchar(50) DEFAULT NULL,
  `FechaEmision` datetime DEFAULT NULL,
  `UsuarioCreador` varchar(50) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdLote`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeMensajeError`
--

DROP TABLE IF EXISTS `NubeMensajeError`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeMensajeError` (
  `Id` bigint(19) NOT NULL AUTO_INCREMENT,
  `IdFactura` bigint(19) DEFAULT NULL,
  `IdRetencion` bigint(19) DEFAULT NULL,
  `IdNotaCredito` bigint(19) DEFAULT NULL,
  `IdNotaDebito` bigint(19) DEFAULT NULL,
  `IdGuiaRemision` bigint(19) DEFAULT NULL,
  `Identificador` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `TipoMensaje` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Mensaje` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `InformacionAdicional` blob,
  `FechaError` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeNotaCredito`
--

DROP TABLE IF EXISTS `NubeNotaCredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeNotaCredito` (
  `IdNotaCredito` bigint(19) NOT NULL AUTO_INCREMENT,
  `AutorizacionSRI` varchar(50) DEFAULT NULL,
  `FechaAutorizacion` datetime DEFAULT NULL,
  `Ambiente` int(10) DEFAULT NULL,
  `TipoEmision` int(10) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `NombreComercial` varchar(300) DEFAULT NULL,
  `Ruc` varchar(13) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  `CodigoDocumento` varchar(2) DEFAULT NULL,
  `Establecimiento` varchar(3) DEFAULT NULL,
  `PuntoEmision` varchar(3) DEFAULT NULL,
  `Secuencial` varchar(15) DEFAULT NULL,
  `DireccionMatriz` varchar(300) DEFAULT NULL,
  `FechaEmision` datetime DEFAULT NULL,
  `DireccionEstablecimiento` varchar(300) DEFAULT NULL,
  `ContribuyenteEspecial` varchar(10) DEFAULT NULL,
  `ObligadoContabilidad` varchar(2) DEFAULT NULL,
  `TipoIdentificacionComprador` varchar(2) DEFAULT NULL,
  `RazonSocialComprador` varchar(300) DEFAULT NULL,
  `IdentificacionComprador` varchar(13) DEFAULT NULL,
  `Rise` varchar(40) DEFAULT NULL,
  `CodDocModificado` varchar(2) DEFAULT NULL,
  `NumDocModificado` varchar(20) DEFAULT NULL,
  `FechaEmisionDocModificado` datetime DEFAULT NULL,
  `TotalSinImpuesto` decimal(19,4) DEFAULT NULL,
  `ValorModificacion` decimal(19,4) DEFAULT NULL,
  `MotivoModificacion` varchar(300) DEFAULT NULL,
  `Moneda` varchar(10) DEFAULT NULL,
  `UsuarioCreador` varchar(300) DEFAULT NULL,
  `EmailResponsable` varchar(100) DEFAULT NULL,
  `EstadoDocumento` varchar(25) DEFAULT NULL,
  `DescripcionError` blob,
  `CodigoError` varchar(10) DEFAULT NULL,
  `DirectorioDocumento` varchar(100) DEFAULT NULL,
  `NombreDocumento` varchar(100) DEFAULT NULL,
  `GeneradoXls` tinyint(4) DEFAULT NULL,
  `SecuencialERP` varchar(30) DEFAULT NULL,
  `Estado` int(10) DEFAULT NULL,
  `EstadoEnv` int(10) DEFAULT '2',
  `IdLote` varchar(50) DEFAULT NULL,
  `FechaCarga` datetime DEFAULT NULL,
  `FechaAnula` datetime DEFAULT NULL,
  `CodigoTransaccionERP` varchar(20) DEFAULT NULL,
  `USU_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`IdNotaCredito`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeNotaCreditoImpuesto`
--

DROP TABLE IF EXISTS `NubeNotaCreditoImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeNotaCreditoImpuesto` (
  `IdNotaCreditoImpuesto` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoPorcentaje` int(10) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `Tarifa` decimal(19,4) DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdNotaCredito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdNotaCreditoImpuesto`),
  KEY `FK_NubeNotaCreditoImpuesto_NubeNotaCredito` (`IdNotaCredito`),
  CONSTRAINT `FK_NubeNotaCreditoImpuesto_NubeNotaCredito` FOREIGN KEY (`IdNotaCredito`) REFERENCES `NubeNotaCredito` (`IdNotaCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeNotaDebito`
--

DROP TABLE IF EXISTS `NubeNotaDebito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeNotaDebito` (
  `IdNotaDebito` bigint(19) NOT NULL AUTO_INCREMENT,
  `AutorizacionSRI` varchar(50) DEFAULT NULL,
  `FechaAutorizacion` datetime DEFAULT NULL,
  `Ambiente` int(10) DEFAULT NULL,
  `TipoEmision` int(10) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `NombreComercial` varchar(300) DEFAULT NULL,
  `Ruc` varchar(13) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  `CodigoDocumento` varchar(2) DEFAULT NULL,
  `Establecimiento` varchar(3) DEFAULT NULL,
  `PuntoEmision` varchar(3) DEFAULT NULL,
  `Secuencial` varchar(15) DEFAULT NULL,
  `DireccionMatriz` varchar(300) DEFAULT NULL,
  `FechaEmision` datetime DEFAULT NULL,
  `DireccionEstablecimiento` varchar(300) DEFAULT NULL,
  `ContribuyenteEspecial` varchar(10) DEFAULT NULL,
  `ObligadoContabilidad` varchar(2) DEFAULT NULL,
  `TipoIdentificacionComprador` varchar(2) DEFAULT NULL,
  `RazonSocialComprador` varchar(300) DEFAULT NULL,
  `IdentificacionComprador` varchar(13) DEFAULT NULL,
  `Rise` varchar(40) DEFAULT NULL,
  `CodDocModificado` varchar(2) DEFAULT NULL,
  `NumDocModificado` varchar(20) DEFAULT NULL,
  `FechaEmisionDocModificado` datetime DEFAULT NULL,
  `TotalSinImpuesto` decimal(19,4) DEFAULT NULL,
  `ValorTotal` decimal(19,4) DEFAULT NULL,
  `UsuarioCreador` varchar(300) DEFAULT NULL,
  `EmailResponsable` varchar(100) DEFAULT NULL,
  `EstadoDocumento` varchar(25) DEFAULT NULL,
  `DescripcionError` varchar(300) DEFAULT NULL,
  `CodigoError` varchar(10) DEFAULT NULL,
  `DirectorioDocumento` varchar(100) DEFAULT NULL,
  `NombreDocumento` varchar(100) DEFAULT NULL,
  `GeneradoXls` tinyint(4) DEFAULT NULL,
  `SecuencialERP` varchar(30) DEFAULT NULL,
  `Estado` int(10) DEFAULT NULL,
  `EstadoEnv` int(10) DEFAULT '2',
  `FechaCarga` datetime DEFAULT NULL,
  `FechaAnula` datetime DEFAULT NULL,
  `IdLote` varchar(50) DEFAULT NULL,
  `USU_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`IdNotaDebito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeNotaDebitoImpuesto`
--

DROP TABLE IF EXISTS `NubeNotaDebitoImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeNotaDebitoImpuesto` (
  `IdNotaDebitoImpuesto` bigint(19) NOT NULL AUTO_INCREMENT,
  `Codigo` int(10) DEFAULT NULL,
  `CodigoPorcentaje` int(10) DEFAULT NULL,
  `BaseImponible` decimal(19,4) DEFAULT NULL,
  `Tarifa` decimal(19,4) DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdNotaDebito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdNotaDebitoImpuesto`),
  KEY `FK_NubeNotaDebitoImpuesto_NubeNotaDebito` (`IdNotaDebito`),
  CONSTRAINT `FK_NubeNotaDebitoImpuesto_NubeNotaDebito` FOREIGN KEY (`IdNotaDebito`) REFERENCES `NubeNotaDebito` (`IdNotaDebito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeNotaDebitoMotivos`
--

DROP TABLE IF EXISTS `NubeNotaDebitoMotivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeNotaDebitoMotivos` (
  `IdNotaDebitoMotivo` bigint(19) NOT NULL AUTO_INCREMENT,
  `Razon` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `Valor` decimal(19,4) DEFAULT NULL,
  `IdNotaDebito` bigint(19) DEFAULT NULL,
  PRIMARY KEY (`IdNotaDebitoMotivo`),
  KEY `FK_NubeNotaDebitoMotivos_NubeNotaDebito` (`IdNotaDebito`),
  CONSTRAINT `FK_NubeNotaDebitoMotivos_NubeNotaDebito` FOREIGN KEY (`IdNotaDebito`) REFERENCES `NubeNotaDebito` (`IdNotaDebito`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NubeRetencion`
--

DROP TABLE IF EXISTS `NubeRetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NubeRetencion` (
  `IdRetencion` bigint(19) NOT NULL AUTO_INCREMENT,
  `AutorizacionSRI` varchar(50) DEFAULT NULL,
  `FechaAutorizacion` datetime DEFAULT NULL,
  `Ambiente` int(10) DEFAULT NULL,
  `TipoEmision` int(10) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `NombreComercial` varchar(300) DEFAULT NULL,
  `Ruc` varchar(13) DEFAULT NULL,
  `ClaveAcceso` varchar(50) DEFAULT NULL,
  `CodigoDocumento` varchar(2) DEFAULT NULL,
  `PuntoEmision` varchar(3) DEFAULT NULL,
  `Establecimiento` varchar(3) DEFAULT NULL,
  `Secuencial` varchar(15) DEFAULT NULL,
  `DireccionMatriz` varchar(300) DEFAULT NULL,
  `FechaEmision` datetime DEFAULT NULL,
  `DireccionEstablecimiento` varchar(300) DEFAULT NULL,
  `ContribuyenteEspecial` varchar(10) DEFAULT NULL,
  `ObligadoContabilidad` varchar(2) DEFAULT NULL,
  `TipoIdentificacionSujetoRetenido` varchar(2) DEFAULT NULL,
  `IdentificacionSujetoRetenido` varchar(20) DEFAULT NULL,
  `RazonSocialSujetoRetenido` varchar(300) DEFAULT NULL,
  `PeriodoFiscal` varchar(10) DEFAULT NULL,
  `TotalRetencion` decimal(19,4) DEFAULT NULL,
  `UsuarioCreador` varchar(50) DEFAULT NULL,
  `EmailResponsable` varchar(100) DEFAULT NULL,
  `EstadoDocumento` varchar(25) DEFAULT NULL,
  `DescripcionError` blob,
  `CodigoError` varchar(10) DEFAULT NULL,
  `DirectorioDocumento` varchar(100) DEFAULT NULL,
  `NombreDocumento` varchar(100) DEFAULT NULL,
  `GeneradoXls` tinyint(4) DEFAULT NULL,
  `SecuencialERP` varchar(10) DEFAULT NULL,
  `CodigoTransaccionERP` varchar(20) DEFAULT NULL,
  `DocSustentoERP` varchar(20) DEFAULT NULL,
  `Estado` int(10) DEFAULT NULL,
  `EstadoEnv` int(10) DEFAULT '2',
  `FechaCarga` datetime DEFAULT NULL,
  `FechaAnula` datetime DEFAULT NULL,
  `IdLote` varchar(50) DEFAULT NULL,
  `IdRad` bigint(20) DEFAULT '0',
  `USU_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`IdRetencion`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSDirectorio`
--

DROP TABLE IF EXISTS `VSDirectorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSDirectorio` (
  `IdDirectorio` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` bigint(20) NOT NULL,
  `TipoDocumento` varchar(3) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Ruta` varchar(100) DEFAULT NULL,
  `UsuarioCreacion` int(10) DEFAULT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`IdDirectorio`),
  KEY `fk_VSDirectorio_empresa1_idx` (`emp_id`),
  CONSTRAINT `fk_VSDirectorio_empresa1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSFirmaDigital`
--

DROP TABLE IF EXISTS `VSFirmaDigital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSFirmaDigital` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `emp_id` bigint(20) NOT NULL,
  `Clave` varchar(100) DEFAULT NULL,
  `RutaFile` varchar(100) DEFAULT NULL,
  `RutaFileCrt` varchar(100) DEFAULT NULL,
  `FechaCaducidad` date DEFAULT NULL,
  `EmpresaCertificadora` varchar(100) DEFAULT NULL,
  `SeaDocXml` varchar(100) DEFAULT NULL,
  `Wdsl_local` varchar(100) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  `UsuarioCreacion` int(10) DEFAULT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaModificacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_VSFirmaDigital_empresa1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSFormaPago`
--

DROP TABLE IF EXISTS `VSFormaPago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSFormaPago` (
  `IdForma` bigint(20) NOT NULL AUTO_INCREMENT,
  `FormaPago` varchar(100) DEFAULT NULL,
  `Codigo` varchar(2) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaFin` date DEFAULT NULL,
  PRIMARY KEY (`IdForma`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSImpuesto`
--

DROP TABLE IF EXISTS `VSImpuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSImpuesto` (
  `Idimpuesto` int(20) NOT NULL AUTO_INCREMENT,
  `Impuesto` varchar(80) DEFAULT NULL,
  `Codigo` varchar(2) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idimpuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSImpuestoRetencion`
--

DROP TABLE IF EXISTS `VSImpuestoRetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSImpuestoRetencion` (
  `Idimpreten` int(20) NOT NULL AUTO_INCREMENT,
  `Idimpuesto` int(20) NOT NULL,
  `Impuesto` varchar(60) DEFAULT NULL,
  `Codigo` varchar(2) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idimpreten`),
  KEY `fk_VSImpuestoRetencion_VSImpuesto1_idx` (`Idimpuesto`),
  CONSTRAINT `fk_VSImpuestoRetencion_VSImpuesto1` FOREIGN KEY (`Idimpuesto`) REFERENCES `VSImpuesto` (`Idimpuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSRetencion`
--

DROP TABLE IF EXISTS `VSRetencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSRetencion` (
  `Idretencion` int(20) NOT NULL AUTO_INCREMENT,
  `Idimpreten` int(20) NOT NULL,
  `Retencion` text,
  `Porcentaje` decimal(5,2) DEFAULT '0.00',
  `Codigo` varchar(10) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idretencion`),
  KEY `Idimpreten` (`Idimpreten`),
  CONSTRAINT `VSRetencion_ibfk_1` FOREIGN KEY (`Idimpreten`) REFERENCES `VSImpuestoRetencion` (`Idimpreten`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSServiciosSRI`
--

DROP TABLE IF EXISTS `VSServiciosSRI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSServiciosSRI` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` bigint(20) NOT NULL,
  `Ambiente` varchar(1) DEFAULT NULL,
  `Recepcion` varchar(200) DEFAULT NULL,
  `Autorizacion` varchar(200) DEFAULT NULL,
  `RecepcionLote` varchar(100) DEFAULT NULL,
  `TiempoRespuesta` int(10) DEFAULT '0',
  `TiempoSincronizacion` int(10) DEFAULT '0',
  `UsuarioCreacion` varchar(45) DEFAULT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaModificacion` timestamp NULL DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `emp_id` (`emp_id`),
  CONSTRAINT `VSServiciosSRI_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSServidorCorreo`
--

DROP TABLE IF EXISTS `VSServidorCorreo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSServidorCorreo` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` bigint(20) NOT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `NombreMostrar` varchar(200) DEFAULT NULL,
  `Asunto` text,
  `Cuerpo` text,
  `EsHtml` varchar(1) DEFAULT NULL,
  `Clave` varchar(25) DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `SMTPServidor` varchar(100) DEFAULT NULL,
  `SMTPPuerto` int(10) DEFAULT NULL,
  `TiempoRespuesta` int(10) DEFAULT NULL,
  `TiempoEspera` int(10) DEFAULT NULL,
  `ServidorAcuse` text,
  `ActivarAcuse` int(1) DEFAULT NULL,
  `CCO` varchar(100) DEFAULT NULL,
  `UsuarioCreacion` int(10) DEFAULT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaModificacion` timestamp NULL DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_VSServidorCorreo_empresa1_idx` (`emp_id`),
  CONSTRAINT `fk_VSServidorCorreo_empresa1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSTarifa`
--

DROP TABLE IF EXISTS `VSTarifa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSTarifa` (
  `Idtarifa` int(20) NOT NULL AUTO_INCREMENT,
  `Idimpuesto` int(20) NOT NULL,
  `Codigo` varchar(5) DEFAULT NULL,
  `Tarifa` text,
  `Porcentaje` decimal(5,2) DEFAULT NULL,
  `Grupo` varchar(2) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idtarifa`),
  KEY `fk_VSTarifa_VSImpuesto1_idx` (`Idimpuesto`),
  CONSTRAINT `fk_VSTarifa_VSImpuesto1` FOREIGN KEY (`Idimpuesto`) REFERENCES `VSImpuesto` (`Idimpuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSValidacion`
--

DROP TABLE IF EXISTS `VSValidacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSValidacion` (
  `Idvalidacion` int(10) NOT NULL AUTO_INCREMENT,
  `Validacion` text,
  `Codigo` varchar(2) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idvalidacion`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VSValidacion_Mensajes`
--

DROP TABLE IF EXISTS `VSValidacion_Mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VSValidacion_Mensajes` (
  `Idvalmen` int(20) NOT NULL AUTO_INCREMENT,
  `Idvalidacion` int(10) NOT NULL,
  `Codigo` int(3) DEFAULT NULL,
  `Descripcion` text,
  `Solucion` text,
  `Estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Idvalmen`),
  KEY `fk_VSValidacion_Mensajes_VSValidacion1_idx` (`Idvalidacion`),
  CONSTRAINT `fk_VSValidacion_Mensajes_VSValidacion1` FOREIGN KEY (`Idvalidacion`) REFERENCES `VSValidacion` (`Idvalidacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `emp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_ruc` varchar(15) DEFAULT NULL,
  `emp_razonsocial` varchar(300) DEFAULT NULL,
  `emp_nom_comercial` varchar(300) DEFAULT NULL,
  `emp_ambiente` varchar(1) DEFAULT NULL,
  `emp_tipo_emision` varchar(1) DEFAULT NULL,
  `emp_direccion_matriz` varchar(300) DEFAULT NULL,
  `emp_obliga_contabilidad` varchar(2) DEFAULT NULL,
  `emp_contri_especial` varchar(5) DEFAULT NULL,
  `emp_telefono` varchar(20) DEFAULT NULL,
  `emp_fax` varchar(20) DEFAULT NULL,
  `emp_email` varchar(45) DEFAULT NULL,
  `emp_email_digital` varchar(60) DEFAULT NULL,
  `emp_email_conta` varchar(60) DEFAULT NULL,
  `emp_moneda` varchar(10) DEFAULT NULL,
  `emp_website` varchar(45) DEFAULT NULL,
  `emp_logo` varchar(100) DEFAULT NULL,
  `usuario` varchar(60) DEFAULT NULL,
  `emp_est_log` varchar(1) DEFAULT NULL,
  `emp_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `emp_fec_mod` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `est_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_id` bigint(20) NOT NULL,
  `est_numero` varchar(3) DEFAULT NULL,
  `est_nombre` varchar(300) DEFAULT NULL,
  `est_direccion` varchar(300) DEFAULT NULL,
  `est_telefono` varchar(45) DEFAULT NULL,
  `est_log` varchar(1) DEFAULT NULL,
  `fec_cre` timestamp NULL DEFAULT NULL,
  `fec_mod` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_establecimiento_empresa1_idx` (`emp_id`),
  CONSTRAINT `fk_establecimiento_empresa1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `punto_emision`
--

DROP TABLE IF EXISTS `punto_emision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `punto_emision` (
  `pemi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `est_id` bigint(20) NOT NULL,
  `pemi_numero` varchar(3) DEFAULT NULL,
  `pemi_nombre` varchar(300) DEFAULT NULL,
  `est_log` varchar(1) DEFAULT NULL,
  `fec_cre` timestamp NULL DEFAULT NULL,
  `fec_mod` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pemi_id`),
  KEY `fk_punto_emision_establecimiento1_idx` (`est_id`),
  CONSTRAINT `fk_punto_emision_establecimiento1` FOREIGN KEY (`est_id`) REFERENCES `establecimiento` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sysdiagrams`
--

DROP TABLE IF EXISTS `sysdiagrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysdiagrams` (
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `principal_id` int(10) NOT NULL,
  `diagram_id` int(10) NOT NULL AUTO_INCREMENT,
  `version` int(10) DEFAULT NULL,
  `definition` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`diagram_id`),
  UNIQUE KEY `UK_principal_name` (`principal_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-25 17:46:23
