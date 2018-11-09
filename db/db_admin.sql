/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Ing Byron Villacreses
 * Created: 05/11/2018
 */

--
-- Base de datos: `RDMI`
--
DROP DATABASE IF EXISTS `db_admin`;
CREATE DATABASE IF NOT EXISTS `db_admin` CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON `db_admin`.* TO 'adminuser' IDENTIFIED BY 'Us3r@W3b2oo19';
GRANT ALL PRIVILEGES ON `db_admin`.* TO 'adminuser'@'localhost' IDENTIFIED BY 'Us3r@W3b2oo19';
USE `db_admin` ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `pai_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pai_nombre` varchar(50) DEFAULT NULL,
  `pai_descripcion` varchar(50) DEFAULT NULL,
  `pai_estado_activo` varchar(1) NOT NULL,
  `pai_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pai_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `pai_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `prov_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pai_id` bigint(20) NOT NULL,
  `prov_nombre` varchar(100) DEFAULT NULL,
  `prov_descripcion` varchar(100) DEFAULT NULL,
  `prov_estado_activo` varchar(1) NOT NULL,
  `prov_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prov_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `prov_estado_logico` varchar(1) NOT NULL,
  FOREIGN KEY (pai_id) REFERENCES `pais`(pai_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE IF NOT EXISTS `canton` (
  `can_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `prov_id` bigint(20) NOT NULL,
  `can_nombre` varchar(150) DEFAULT NULL,
  `can_descripcion` varchar(150) DEFAULT NULL,
  `can_estado_activo` varchar(1) NOT NULL,
  `can_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `can_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `can_estado_logico` varchar(1) NOT NULL,
  FOREIGN KEY (prov_id) REFERENCES `provincia`(prov_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- -----------------------------------------------------
-- table `rdmi`.`persona`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `persona` (
  `per_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `per_ced_ruc` varchar(15) DEFAULT NULL,
  `per_nombre` varchar(100) DEFAULT NULL,
  `per_apellido` varchar(100) DEFAULT NULL,
  `per_genero` varchar(1) DEFAULT NULL,
  `per_fecha_nacimiento` date DEFAULT NULL,
  `per_estado_civil` varchar(1) DEFAULT NULL,
  `per_correo` varchar(100) DEFAULT NULL,
  `per_tipo_sangre` varchar(5) DEFAULT NULL,
  `per_foto` varchar(100) DEFAULT NULL,
  `per_estado_activo` varchar(1) NOT NULL,
  `per_est_log` varchar(1) DEFAULT NULL,
  `per_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `per_fec_mod` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `data_persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS  `data_persona` (
  `dper_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null ,
  `pai_id` bigint(20) null ,
  `prov_id` bigint(20) null ,
  `can_id` bigint(20) null ,
  `dper_descripcion` varchar(100) null ,
  `dper_direccion` varchar(100) null ,
  `dper_telefono` varchar(20) null ,
  `dper_celular` varchar(20) null ,
  `dper_contacto` varchar(60) null ,
  `dper_est_log` varchar(1) null ,
  `dper_fec_cre` timestamp null default current_timestamp ,
  `dper_fec_mod` timestamp null ,
  FOREIGN KEY (per_id) REFERENCES `persona`(per_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `per_id` bigint(20) NOT NULL,
  `usu_username` varchar(45) DEFAULT NULL,
  `usu_password` varchar(255) DEFAULT NULL,
  `usu_sha` varchar(255) DEFAULT NULL,
  `usu_session` varchar(255) DEFAULT NULL,
  `usu_last_login` timestamp NULL DEFAULT NULL,
  `usu_link_activo` text,
  `usu_estado_activo` varchar(1) NOT NULL,
  `usu_alias` varchar(60) DEFAULT NULL,
  `usu_est_log` varchar(1) DEFAULT NULL,
  `usu_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usu_fec_mod` timestamp NULL DEFAULT NULL,
  FOREIGN KEY (per_id) REFERENCES `persona` (per_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS  `log` (
  `log_id` bigint(20) not null auto_increment primary key,
  `usu_id` bigint(20) not null ,
  `log_registro` bigint(20) not null ,  
  `log_accion` varchar(60) null ,
  `log_table` varchar(60) null ,
  `log_fecha` timestamp null default current_timestamp ,
  foreign key (usu_id) references  `usuario` (usu_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS  `empresa` (
  `emp_id` bigint(20) not null auto_increment primary key,
  `emp_nombre` varchar(50) null ,
  `emp_ruc` varchar(15) null ,
  `emp_descripcion` varchar(100) null ,
  `emp_direccion` varchar(100) null ,
  `emp_telefono` varchar(20) null ,
  `emp_est_log` varchar(1) null ,
  `emp_fec_cre` timestamp null default current_timestamp ,
  `emp_fec_mod` timestamp null 
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `session`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `session` (
  `id` varchar(40) NOT NULL PRIMARY KEY,
  `expire` bigint(20) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tipo_password`
--

create table if not exists `tipo_password` (
  `tpas_id` bigint(20) not null auto_increment primary key,
  `tpas_tipo` varchar(50) default null,
  `tpas_validacion` varchar(200) default null,
  `tpas_descripcion` varchar(300) default null,
  `tpas_estado_activo` varchar(1) not null,
  `tpas_fecha_creacion` timestamp not null default current_timestamp,
  `tpas_fecha_modificacion` timestamp null default null,
  `tpas_estado_logico` varchar(1) not null
) engine=innodb  default charset=utf8 auto_increment=1 ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `user_passreset`
--
CREATE TABLE IF NOT EXISTS `user_passreset` (
`upas_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`usu_id` bigint(20) NOT NULL,
`upas_remote_ip_inactivo` varchar(20) DEFAULT NULL,
`upas_remote_ip_activo` varchar(20) DEFAULT NULL,
`upas_link` varchar(500) DEFAULT NULL,
`upas_fecha_inicio` timestamp NULL DEFAULT NULL,
`upas_fecha_fin` timestamp NULL DEFAULT NULL,
`upas_estado_activo` varchar(1) DEFAULT NULL,
`upas_fecha_creacion` timestamp NULL DEFAULT NULL,
`upas_fecha_modificacion` timestamp NULL DEFAULT NULL,
`upas_estado_logico` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- -----------------------------------------------------
-- table  `rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rol_nombre` varchar(50) DEFAULT NULL,
  `rol_descripcion` varchar(45) DEFAULT NULL,
  `rol_estado_activo` varchar(1) NOT NULL,
  `rol_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rol_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `rol_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- -----------------------------------------------------
-- table  `aplicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aplicacion` (
  `apl_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `apl_nombre` varchar(50) DEFAULT NULL,
  `apl_tipo` varchar(45) DEFAULT NULL,
  `apl_lang_file` varchar(100) DEFAULT NULL,
  `apl_est_log` varchar(1) DEFAULT NULL,
  `apl_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `apl_fec_mod` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modulo` (
  `mod_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `apl_id` bigint(20) NOT NULL,
  `mod_nombre` varchar(50) DEFAULT NULL,
  `mod_dir_imagen` varchar(100) DEFAULT NULL,
  `mod_url` varchar(100) DEFAULT NULL,
  `mod_orden` bigint(2) DEFAULT NULL,
  `mod_lang_file` varchar(60) DEFAULT NULL,
  `mod_estado_activo` varchar(1) NOT NULL,
  `mod_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mod_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `mod_estado_logico` varchar(1) NOT NULL,
  FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- table  `objeto_modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `objeto_modulo` (
  `omod_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `mod_id` bigint(20) NOT NULL,
  `omod_padre_id` bigint(20) DEFAULT NULL,
  `omod_nombre` varchar(50) DEFAULT NULL,
  `omod_tipo` varchar(60) DEFAULT NULL,
  `omod_tipo_boton` varchar(1) DEFAULT NULL,
  `omod_accion` varchar(50) DEFAULT NULL,
  `omod_function` varchar(100) DEFAULT NULL,
  `omod_dir_imagen` varchar(100) DEFAULT NULL,
  `omod_entidad` varchar(100) DEFAULT NULL,
  `omod_orden` bigint(2) DEFAULT NULL,
  `omod_estado_visible` int(1) DEFAULT NULL,
  `omod_lang_file` varchar(60) DEFAULT NULL,
  `omod_estado_activo` varchar(1) NOT NULL,
  `omod_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `omod_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `omod_estado_logico` varchar(1) NOT NULL,
  FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ,
  FOREIGN KEY (`omod_padre_id`) REFERENCES `objeto_modulo` (`omod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- table  `usuario_empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario_empresa` (
  `uemp_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usu_id` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `uemp_est_log` varchar(1) DEFAULT NULL,
  `uemp_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uemp_fec_mod` timestamp NULL DEFAULT NULL,
  FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ,
  FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ,
  FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- table  `omodulo_rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `omodulo_rol` (
  `omrol_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `omod_id` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `omrol_est_log` varchar(1) DEFAULT NULL,
  `omrol_fec_cre` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `omrol_fec_mod` timestamp NULL DEFAULT NULL,
  FOREIGN KEY (`omod_id`) REFERENCES `objeto_modulo` (`omod_id`) ,
  FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) 
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `cod_cli` VARCHAR(10) NULL,
  `cli_nombre` VARCHAR(50) NULL DEFAULT NULL,
  `cli_ruc` VARCHAR(15) NULL DEFAULT NULL,
  `cli_descripcion` VARCHAR(100) NULL DEFAULT NULL,
  `cli_direccion` VARCHAR(100) NULL DEFAULT NULL,
  `cli_telefono` VARCHAR(20) NULL DEFAULT NULL,
  `cli_est_log` VARCHAR(1) NULL DEFAULT NULL,
  `cli_fec_cre` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `cli_fec_mod` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`cli_id`))
ENGINE = InnoDB AUTO_INCREMENT=1
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `usuario_cliente` (
  `ucli_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `usu_id` BIGINT(20) NOT NULL,
  `cli_id` BIGINT(20) NOT NULL,
  `rol_id` BIGINT(20) NOT NULL,
  `ucli_est_log` VARCHAR(1) NULL DEFAULT NULL,
  `ucli_fec_cre` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `ucli_fec_mod` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`ucli_id`),
  INDEX `fk_usuario_cliente_usuario1_idx` (`usu_id` ASC),
  INDEX `fk_usuario_cliente_cliente1_idx` (`cli_id` ASC),
  INDEX `fk_usuario_cliente_rol1_idx` (`rol_id` ASC),
  CONSTRAINT `fk_usuario_cliente_usuario1`
    FOREIGN KEY (`usu_id`)
    REFERENCES `db_admin`.`usuario` (`usu_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_cliente_cliente1`
    FOREIGN KEY (`cli_id`)
    REFERENCES `db_admin`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_cliente_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `db_admin`.`rol` (`rol_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB AUTO_INCREMENT=1
DEFAULT CHARACTER SET = utf8;




