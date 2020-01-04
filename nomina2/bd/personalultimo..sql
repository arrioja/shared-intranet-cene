-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 02-07-2008 a las 10:13:59
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `personal`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias`
-- 

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias_categoria`
-- 

CREATE TABLE `asistencias_categoria` (
  `id` int(11) NOT NULL auto_increment,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `codigo` (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias_categoria`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias_dias_no_laborables`
-- 

CREATE TABLE `asistencias_dias_no_laborables` (
  `id` int(11) NOT NULL auto_increment,
  `dia` varchar(2) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias_dias_no_laborables`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias_entrada_salida`
-- 

CREATE TABLE `asistencias_entrada_salida` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias_entrada_salida`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias_justificaciones`
-- 

CREATE TABLE `asistencias_justificaciones` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `codigo_tipo_justificacion` varchar(3) NOT NULL,
  `codigo_categoria_justificacion` varchar(3) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `iddoc` varchar(10) NOT NULL COMMENT 'Correlativo del documento',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias_justificaciones`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asistencias_tipo_justificaciones`
-- 

CREATE TABLE `asistencias_tipo_justificaciones` (
  `id` int(11) NOT NULL auto_increment,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `codigo` (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asistencias_tipo_justificaciones`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `banco`
-- 

CREATE TABLE `banco` (
  `cod` varchar(4) NOT NULL default '',
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(50) default NULL,
  `numero` varchar(30) NOT NULL default '',
  `tipo` varchar(30) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cod`,`numero`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `banco`
-- 

INSERT INTO `banco` VALUES ('0040', 'BANCARIBE', 'cuenta de nomina', '00102231214', 'AHORROS', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cargos`
-- 

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL auto_increment,
  `denominacion` varchar(50) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `grado` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `denominacion` (`denominacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- 
-- Volcar la base de datos para la tabla `cargos`
-- 

INSERT INTO `cargos` VALUES (1, 'AUXILIAR DE OFICINA', '020601', '1');
INSERT INTO `cargos` VALUES (2, 'ALMACENISTA', '020101', '1');
INSERT INTO `cargos` VALUES (3, 'ARCHIVISTA', '020101', '1');
INSERT INTO `cargos` VALUES (4, 'ASISTENTE ADMINISTRATIVO', '020101', '1');
INSERT INTO `cargos` VALUES (5, 'ASISTENTE DE PERSONAL', '020201', '1');
INSERT INTO `cargos` VALUES (6, 'SECRETARIA I', '020401', '1');
INSERT INTO `cargos` VALUES (7, 'CONDUCTOR', '020601', '1');
INSERT INTO `cargos` VALUES (8, 'OPERADOR DE FOTOCOPOADORA', '020601', '1');
INSERT INTO `cargos` VALUES (9, 'RECEPCIONISTA', '020601', '1');
INSERT INTO `cargos` VALUES (10, 'SECRETARIA II', '020402', '2');
INSERT INTO `cargos` VALUES (11, 'ASISTENTE DE BIBLIOTECA', '020602', '2');
INSERT INTO `cargos` VALUES (12, 'FOTÃ“GRAFO', '020602', '1');
INSERT INTO `cargos` VALUES (13, 'OPERADOR I', '020303', '3');
INSERT INTO `cargos` VALUES (14, 'SECRETARIA III', '020403', '3');
INSERT INTO `cargos` VALUES (15, 'ANALISTA DE PRESUPUESTO I', '020104', '4');
INSERT INTO `cargos` VALUES (16, 'ANALISTA DE PRESUPUESTO II', '020105', '5');
INSERT INTO `cargos` VALUES (17, 'PROGRAMADOR I', '020305', '5');
INSERT INTO `cargos` VALUES (18, 'GUIA PROTOCOLAR', '020505', '5');
INSERT INTO `cargos` VALUES (19, 'DIBUJANTE', '020605', '5');
INSERT INTO `cargos` VALUES (20, 'ENTRENADOR DEPORTIVO', '020605', '5');
INSERT INTO `cargos` VALUES (21, 'ABOGADO I', '010106', '6');
INSERT INTO `cargos` VALUES (22, 'AUDITOR I', '010206', '6');
INSERT INTO `cargos` VALUES (23, 'INSPECTOR DE OBRAS I', '010306', '6');
INSERT INTO `cargos` VALUES (24, 'ANALISTA DE ORGANIZACION Y SISTEMAS I', '020306', '6');
INSERT INTO `cargos` VALUES (25, 'PROGRAMADOR II', '020306', '6');
INSERT INTO `cargos` VALUES (26, 'COORDINADOR DE PROTOCOLO', '020506', '6');
INSERT INTO `cargos` VALUES (27, 'BOBLIOTECOLOGO', '020606', '6');
INSERT INTO `cargos` VALUES (28, 'ABOGADO II', '010107', '7');
INSERT INTO `cargos` VALUES (29, 'AUDITOR II', '010207', '7');
INSERT INTO `cargos` VALUES (30, 'INSPECTOR DE OBRAS II', '010307', '7');
INSERT INTO `cargos` VALUES (31, 'ANALISTA DE PERSONAL II', '020207', '7');
INSERT INTO `cargos` VALUES (32, 'ANALISTA DE ORGANIZACION Y SISTEMAS II', '020307', '7');
INSERT INTO `cargos` VALUES (33, 'PROGRAMADOR III', '020307', '7');
INSERT INTO `cargos` VALUES (34, 'ABOGADO III', '010108', '8');
INSERT INTO `cargos` VALUES (35, 'AUDITOR III', '010108', '8');
INSERT INTO `cargos` VALUES (36, 'ANALISTA DE PERSONAL III', '020208', '8');
INSERT INTO `cargos` VALUES (37, 'ANALISTA DE ORGANIZACION Y SISTEMAS III', '020308', '8');
INSERT INTO `cargos` VALUES (38, 'ABOGADO COORDINADOR', '010109', '9');
INSERT INTO `cargos` VALUES (39, 'AUDITOR COORDINADOR', '010209', '9');
INSERT INTO `cargos` VALUES (40, 'INSPECTOR COORDINADOR', '010309', '9');
INSERT INTO `cargos` VALUES (41, 'COORDINADOR DE ADMINISTRACION', '020109', '9');
INSERT INTO `cargos` VALUES (42, 'COORDINADOR DE INFORMATICA', '020309', '9');
INSERT INTO `cargos` VALUES (43, 'COORDINADOR COMUNICACIONAL', '020609', '9');
INSERT INTO `cargos` VALUES (44, 'DIRECTOR', '111111', '9');
INSERT INTO `cargos` VALUES (45, 'CONTRALOR DEL ESTADO', '5555', '9');
INSERT INTO `cargos` VALUES (46, 'DIRECTOR ASISTENTE', '6666', '9');
INSERT INTO `cargos` VALUES (47, 'INSPECTOR DE OBRAS III', '10308', '8');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `conceptos`
-- 

CREATE TABLE `conceptos` (
  `cod` varchar(4) NOT NULL,
  `descripcion` varchar(100) default NULL,
  `tipo` varchar(100) default NULL,
  `tipo_pago` varchar(10) NOT NULL,
  `formula` varchar(100) default NULL,
  `general` char(1) default NULL,
  `frecuencia` varchar(100) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

-- 
-- Volcar la base de datos para la tabla `conceptos`
-- 

INSERT INTO `conceptos` VALUES ('0001', 'Bono de Antiguedad', 'CREDITO', 'CORRIENTE', 'y(aap,map,as,mas)=((aap*map)+(as*mas))/2', '1', 'QUINCENAL', 55);
INSERT INTO `conceptos` VALUES ('0002', 'Prestamos', 'DEBITO', 'CORRIENTE', 'y(pre)=pre/2', '0', 'QUINCENAL', 69);
INSERT INTO `conceptos` VALUES ('0003', 'Fondo de Jubilacion y Pension', 'DEBITO', 'CORRIENTE', 'y(sm)=(sm*0.03)/2', '1', 'QUINCENAL', 20);
INSERT INTO `conceptos` VALUES ('0004', 'CACOENE', 'DEBITO', 'CORRIENTE', 'y(sm)=((sm*0.2)/2)', '1', 'QUINCENAL', 19);
INSERT INTO `conceptos` VALUES ('0005', 'Ley de Vivienda y Habitat', 'DEBITO', 'CORRIENTE', 'y(ta)=ta*0.01', '1', 'QUINCENAL', 56);
INSERT INTO `conceptos` VALUES ('0006', 'S.S.O. y Reg. Prest. Empleo', 'DEBITO', 'CORRIENTE', 'y(sm)=(sm*12/52)*0.045*5/2', '1', 'QUINCENAL', 57);
INSERT INTO `conceptos` VALUES ('0007', 'Sindicato', 'DEBITO', 'CORRIENTE', 'y(sm)=(sm*0.004)/2', '1', 'QUINCENAL', 58);
INSERT INTO `conceptos` VALUES ('0008', 'Prima Profesionales', 'CREDITO', 'CORRIENTE', 'y(pp)=pp/2', '0', 'QUINCENAL', 70);
INSERT INTO `conceptos` VALUES ('0009', 'Prima de Responsabilidad', 'CREDITO', 'CORRIENTE', 'y(pr)=pr/2', '0', 'QUINCENAL', 71);
INSERT INTO `conceptos` VALUES ('0010', 'Poliza HCM', 'DEBITO', 'CORRIENTE', 'y(hcm)=hcm/2', '0', 'QUINCENAL', 72);
INSERT INTO `conceptos` VALUES ('0011', 'Ajuste poliza HCM', 'DEBITO', 'CORRIENTE', 'y(ahc)=ahc/2', '0', 'QUINCENAL', 73);
INSERT INTO `conceptos` VALUES ('0012', 'Prima Jerarquia y Responsabilidad', 'CREDITO', 'CORRIENTE', 'y(pj)=pj/2', '0', 'QUINCENAL', 74);
INSERT INTO `conceptos` VALUES ('0013', 'Comp. Gastos Repres.', 'CREDITO', 'CORRIENTE', 'y(cgr)=cgr/2', '0', 'QUINCENAL', 75);
INSERT INTO `conceptos` VALUES ('0014', ' S.S.O. y Reg. Prest. Empleo 2', 'DEBITO', 'CORRIENTE', 'y(sm)=(2328.75*12/52)*0.045*5/2', '0', 'QUINCENAL', 76);
INSERT INTO `conceptos` VALUES ('0104', 'Prima por Eficiencia', 'CREDITO', 'CORRIENTE', 'y(pe)=pe/2', '0', 'QUINCENAL', 78);
INSERT INTO `conceptos` VALUES ('0582', 'MONTEPIO', 'DEBITO', 'CORRIENTE', 'y(mtp)=mtp', '1', 'QUINCENAL', 77);
INSERT INTO `conceptos` VALUES ('1000', 'Sueldo Quincenal', 'CREDITO', 'CORRIENTE', 'y(sm)=sm/2', '1', 'QUINCENAL', 68);
INSERT INTO `conceptos` VALUES ('2021', 'PENSION DE ALIMENTOS', 'DEBITO', '', 'y(pxa)=pxa/2', '0', 'QUINCENAL', 79);
INSERT INTO `conceptos` VALUES ('9001', 'R.I.S.L.R.', 'DEBITO', 'CORRIENTE', 'y(ta,pct)=ta*(pct/100)', '0', 'QUINCENAL', 67);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `configuracion`
-- 

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL auto_increment,
  `num_periodos` varchar(2) NOT NULL,
  `ano_curso` year(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `configuracion`
-- 

INSERT INTO `configuracion` VALUES (1, '24', 2008);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `constantes`
-- 

CREATE TABLE `constantes` (
  `cod` varchar(4) NOT NULL default '',
  `descripcion` varchar(100) default NULL,
  `abreviatura` varchar(20) NOT NULL,
  `tipo` varchar(30) default NULL,
  `tipo_pago` varchar(10) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cod` (`cod`),
  UNIQUE KEY `abreviatura` (`abreviatura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- 
-- Volcar la base de datos para la tabla `constantes`
-- 

INSERT INTO `constantes` VALUES ('0005', 'Prima de Profesionales', 'pp', 'CREDITO', 'CORRIENTE', 2, '2007-03-28');
INSERT INTO `constantes` VALUES ('0007', 'Prima de Responsabilidad', 'pr', 'CREDITO', 'CORRIENTE', 19, '2007-05-21');
INSERT INTO `constantes` VALUES ('1021', 'Sueldo Mensual', 'sm', 'OTRO', 'CORRIENTE', 22, '2007-06-06');
INSERT INTO `constantes` VALUES ('4444', 'Sueldo Integral', 'si', 'OTRO', 'CORRIENTE', 24, '2007-08-01');
INSERT INTO `constantes` VALUES ('0001', 'INAVI', 'ina', 'DEBITO', 'CORRIENTE', 32, '2007-10-05');
INSERT INTO `constantes` VALUES ('0002', 'R.I.S.L.R.', 'islr', 'DEBITO', 'CORRIENTE', 33, '2007-10-05');
INSERT INTO `constantes` VALUES ('0003', 'POLIZA HCM', 'hcm', 'DEBITO', 'CORRIENTE', 34, '2007-10-05');
INSERT INTO `constantes` VALUES ('0004', 'Prima por Eficiencia', 'pe', 'CREDITO', 'CORRIENTE', 35, '2007-10-05');
INSERT INTO `constantes` VALUES ('1002', 'PRESTAMOS', 'pre', 'DEBITO', 'CORRIENTE', 39, '2007-11-19');
INSERT INTO `constantes` VALUES ('9000', 'Porcentaje RISLR', 'pct', 'OTRO', 'CORRIENTE', 40, '2007-11-19');
INSERT INTO `constantes` VALUES ('0017', 'Ajuste Poliza HCM', 'ahc', 'DEBITO', 'CORRIENTE', 41, '2007-11-22');
INSERT INTO `constantes` VALUES ('0006', 'Prima de Jerarquia y Responsabilidad', 'pj', 'CREDITO', 'CORRIENTE', 42, '2007-11-26');
INSERT INTO `constantes` VALUES ('0008', 'Comp. Gastos Repres.', 'cgr', 'CREDITO', 'CORRIENTE', 43, '2007-11-26');
INSERT INTO `constantes` VALUES ('0582', 'MONTEPIO', 'mtp', 'DEBITO', 'CORRIENTE', 44, '2007-12-04');
INSERT INTO `constantes` VALUES ('2021', 'PENSION DE ALIMENTOS', 'pxa', 'DEBITO', '', 45, '2008-06-30');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `direcciones`
-- 

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL auto_increment,
  `codigo` varchar(6) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `nombre_abreviado` varchar(20) NOT NULL,
  `siglas` varchar(10) NOT NULL,
  `fecha_creacion` date default NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `direcciones`
-- 

INSERT INTO `direcciones` VALUES (1, '1001', 'ORGANIZACIÃ“N Y SISTEMAS', 'ORG Y SIST', 'DOS', '1998-09-19', 'ACTIVO');
INSERT INTO `direcciones` VALUES (2, '1003', 'ADMINISTRACIÃ“N Y PRESUPUESTO', 'DIR ADMON Y PRES', 'DAP', '1978-09-19', 'ACTIVO');
INSERT INTO `direcciones` VALUES (4, '1002', 'RECURSOS HUMANOS', 'REC. HUM.', 'RRHH', '2000-01-01', 'ACTIVO');
INSERT INTO `direcciones` VALUES (5, '1004', 'DESPACHO DEL CONTRALOR', 'DESP. DEL CONTR.', 'DC', '2000-01-01', 'ACTIVO');
INSERT INTO `direcciones` VALUES (6, '1005', 'DIRECCIÃ“N DE ENTES DESCENTRALIZADOS', 'DIR. ENT. DESC.', 'DDED', '2000-01-01', 'ACTIVO');
INSERT INTO `direcciones` VALUES (7, '1006', 'CONTROL DE LA ADMINISTRACION ESTADAL', 'CONTROL ADMON EST', 'CAE', '0000-00-00', 'ACTIVO');
INSERT INTO `direcciones` VALUES (8, '1007', 'DIRECCION DE ATENCION AL CIUDADANO Y CONTROL COMUN', 'DIR.ATEN.CIUD. Y CNT', 'DECCC', '0000-00-00', 'ACTIVO');
INSERT INTO `direcciones` VALUES (9, '1008', 'DIRECCION DE DETERMINACION DE RESPONSABILIDADES', 'DIR. DETER. DE RESP.', 'DDR', '0000-00-00', 'ACTIVO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes`
-- 

CREATE TABLE `integrantes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cedula` int(10) unsigned NOT NULL,
  `cod` varchar(4) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL default '0000-00-00',
  `lugar_nacimiento` varchar(100) NOT NULL,
  `sexo` char(10) default NULL,
  `edo_civil` char(10) default NULL,
  `profesion` varchar(255) default NULL,
  `grado_instruccion` varchar(30) default NULL,
  `cargo` varchar(30) default NULL,
  `fecha_ingreso` date NOT NULL,
  `anos_servicio` varchar(2) NOT NULL default '0',
  `direccion` varchar(100) default NULL,
  `departamento` varchar(100) default NULL,
  `tlf_habitacion` varchar(12) default NULL,
  `tlf_celular` varchar(12) default NULL,
  `status` varchar(1) default NULL,
  `status_asistencia` smallint(1) NOT NULL default '1' COMMENT '0= no sale en asistencias, 1= sale en asistencias,',
  `tipo_nomina` varchar(20) default NULL,
  `pago_banco` varchar(1) default NULL,
  `codigo` varchar(5) default NULL,
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_funcionario` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=166 ;

-- 
-- Volcar la base de datos para la tabla `integrantes`
-- 

INSERT INTO `integrantes` VALUES (1, 4051711, '0072', 'JONNY JOSE', 'ACOSTA REYES', '1952-09-14', 'PAMPATAR', 'MASCULINO', 'SOLTERO', '8V. SEMESTRE CONTADURIA PUBLICA', 'BACHILLER', '', '1987-04-16', '0', 'CALLE JUAN MANUEL GUERRA, SAN LORENZO', '', '', '', '1', 1, 'EMPLEADOS', '1', '1');
INSERT INTO `integrantes` VALUES (2, 4512285, '0110', 'JUVENCIO RAMON', 'AMPARAN', '1949-06-01', 'CARANTOÑA M. GOMEZ', 'MASCULINO', 'SOLTERO', 'TOPOGRAFO', '3 AÑO BACHILLERATO', '', '2000-03-17', '16', 'CALLE PRINCIPAL ENTRADA AL CERCADO', '', '', '', '1', 1, 'EMPLEADOS', '1', '2');
INSERT INTO `integrantes` VALUES (3, 8385761, '0013', 'DERQUI JESUS', 'BRITO MARTINEZ', '1960-10-18', 'LOS ROBLES', 'MASCULINO', 'SOLTERO', '12', 'BACHILLER', '', '1996-02-01', '1', 'CALLE DON JESUS LOS ROBLES', '', '', '', '1', 1, 'EMPLEADOS', '1', '3');
INSERT INTO `integrantes` VALUES (4, 3670594, '0051', 'CARLOS JESUS', 'BRITO', '1950-01-30', 'PUERTO FERMIN', 'MASCULINO', 'SOLTERO', 'CONTABILISTA', 'BACHILLER', '', '1985-12-16', '0', 'CALLE FIGUEROA EL TIRANO', '', '', '', '1', 1, 'EMPLEADOS', '1', '4');
INSERT INTO `integrantes` VALUES (5, 5477294, '0008', 'CATALINO ANTONIO', 'CORDOVA MARIN', '1959-08-16', 'EL MACO', 'MASCULINO', 'SOLTERO', 'ABOGADO ', 'UNIVERSITARIO', '', '1984-05-22', '1', 'CALLE SAN ANTONIO EL MACO', '', '', '', '1', 1, 'EMPLEADOS', '1', '5');
INSERT INTO `integrantes` VALUES (6, 9303416, '0095', 'FELIPE JOSE', 'FERNANDEZ FERMIN', '1965-02-07', '', 'MASCULINO', 'SOLTERO', '10', '', '', '1999-08-02', '0', '', '', '', '', '1', 1, 'EMPLEADOS', '1', '6');
INSERT INTO `integrantes` VALUES (7, 4654397, '0045', 'ALEXIS JOSE', 'FERNANDEZ HERNANDEZ', '1958-04-27', 'MONAGAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '1985-01-01', '1', 'CALLE SALGADO LA CRUZ DEL PASTEL', '', '', '', '1', 1, 'EMPLEADOS', '1', '7');
INSERT INTO `integrantes` VALUES (8, 10204661, '', 'REGULO JOSE', 'FERNANDEZ QUIJADA', '1971-12-27', '', 'Masculino', '0', 'MARATONISTA', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '8');
INSERT INTO `integrantes` VALUES (9, 11829028, '0070', 'LENIN JOSE', 'FLORES', '1974-07-23', 'CUMANA', 'MASCULINO', 'SOLTERO', 'ADMINISTRACION INDUSTRIALES', 'TECNICO SUPERIOR', '', '1996-10-01', '0', 'ISLETA II, CASA NÂº 84-66, MUNICIPIO GARCIA', '', '', '', '0', 1, 'EMPLEADOS', '1', '9');
INSERT INTO `integrantes` VALUES (10, 12222156, '0011', 'KATIUSKA DEL CARMEN', 'GARCIA BRITO', '1975-07-16', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'T.S.U.ADMINISTRACION ADUANERA', 'UNIVERSITARIO', '', '2000-03-01', '0', 'URB. VILLA ROSA, VEREDA 75, SECTOR G.', '', '', '', '1', 1, 'EMPLEADOS', '1', '10');
INSERT INTO `integrantes` VALUES (11, 2803086, '', 'FIDEL ANTONIO', 'GUEVARA', '1948-04-24', '', 'Masculino', '0', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'PENSIONADOS', '', '11');
INSERT INTO `integrantes` VALUES (12, 4018459, '0069', 'ARLENY DEL VALLE', 'HENRIQUEZ ZABALA', '1954-08-29', 'CABIMAS', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '1997-12-01', '0', 'CALLE NARVAEZ, PORLAMAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '12');
INSERT INTO `integrantes` VALUES (13, 9308955, '0040', 'FELICIA DEL CARMEN', 'HENRIQUEZ DE FUENTES', '1967-06-09', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '1991-01-01', '0', 'CALLE LAS FLORES, LA GUARDIA', '', '', '', '1', 1, 'EMPLEADOS', '1', '13');
INSERT INTO `integrantes` VALUES (14, 5477905, '0028', 'JUAN LUIS', 'LEANDRO', '1956-05-16', 'PUNTA DE PIEDRAS', 'MASCULINO', 'SOLTERO', 'OFICINISTA', 'BACHILLER', '', '1997-06-16', '10', 'CALLE COLON PUNTA DE PIEDRAS', '', '', '', '1', 1, 'EMPLEADOS', '1', '15');
INSERT INTO `integrantes` VALUES (15, 8442192, '0052', 'REGULO JOSE', 'MENESES', '1961-04-19', 'SUCRE', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '1989-03-16', '0', 'URB. VISTA ALEGRE, CASA S/N MUNICIPIO DIAZ', '', '', '', '1', 1, 'EMPLEADOS', '1', '16');
INSERT INTO `integrantes` VALUES (16, 8926627, '0087', 'JOSE MARIA', 'MILLAN MARQUEZ', '1963-08-11', '', 'MASCULINO', 'SOLTERO', '12', '', '', '1992-04-16', '4', '', '', '', '', '1', 1, 'EMPLEADOS', '1', '17');
INSERT INTO `integrantes` VALUES (17, 8388339, '0057', 'WILFREDO JOSE', 'NUÃ‘EZ', '1960-08-21', 'PANPATAR', 'MASCULINO', 'SOLTERO', 'T.S.U.ADMINISTRACION ', 'TECNICO SUPERIOR', '', '1999-07-16', '2', 'CALLE JUAN ACOSTA PAMPATAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '18');
INSERT INTO `integrantes` VALUES (18, 8378076, '0056', 'PEDRO JOSE', 'PALMARES', '1962-04-27', 'MATURIN', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '1992-04-16', '6', 'CALLE GOMEZ NÂº 61 SECTOR ACHIPANO', '', '', '', '1', 1, 'EMPLEADOS', '1', '19');
INSERT INTO `integrantes` VALUES (19, 12224570, '0035', 'EVELINDA DEL VALLE', 'PEREZ DE CARRASCO', '1974-03-03', 'LA SIERRA', 'MASCULINO', 'SOLTERO', '12', 'BACHILLER', '', '1997-01-01', '0', 'GUATAMARE', '', '', '', '1', 1, 'EMPLEADOS', '1', '20');
INSERT INTO `integrantes` VALUES (20, 8392072, '0064', 'ROBERTO SALVADOR', 'RAMOS GARCIA', '1962-04-16', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '', 'PRIMER AÃ‘O', '', '1988-04-16', '0', 'CALLE PAEZ,CERCA DEL LICEO NUEVA ESPARTA, MUNICIPIO MARIÃ‘O', '', '', '', '1', 1, 'EMPLEADOS', '1', '21');
INSERT INTO `integrantes` VALUES (21, 8381570, '0134', 'ERNESTO LUIS', 'RODRIGUEZ GONZALEZ', '1961-03-11', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '', 'SEGUNDO AÃ‘O', '', '1985-09-24', '0', 'CALLEJON BOLIVAR DEL VALLE DE PEDRO GONZALEZ', '', '', '', '1', 1, 'EMPLEADOS', '1', '22');
INSERT INTO `integrantes` VALUES (22, 2166981, '0094', 'ANGEL JOSE', 'RODRIGUEZ SALAZAR', '1942-01-25', '', 'MASCULINO', 'SOLTERO', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', '23');
INSERT INTO `integrantes` VALUES (23, 13669573, '0090', 'HAROLDS LUIS', 'ROJAS AGUILERA', '1979-10-25', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ABOGADO ', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE ANTONIO DIAZ,PAMPATAR', '', '', '', '0', 0, 'EMPLEADOS', '1', '24');
INSERT INTO `integrantes` VALUES (24, 12225307, '0098', 'ANDRES EMILIO', 'ROJAS PEREZ', '1971-09-19', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '1997-07-01', '0', 'ISLA DE COCHE LOS CERRITOS', '', '', '', '1', 1, 'EMPLEADOS', '1', '25');
INSERT INTO `integrantes` VALUES (25, 5482703, '0046', 'JOSE LUIS', 'SUAREZ', '1959-12-09', 'AGUA DE VACA', 'MASCULINO', 'SOLTERO', 'CONTABILISTA', '2DO AÃ‘O BACHILLERATO', '', '1987-04-08', '2', 'CALLE PRINCIPAL DEL CASERIO GUERRA, AGUA DE VACA', '', '', '', '1', 1, 'EMPLEADOS', '1', '26');
INSERT INTO `integrantes` VALUES (26, 4649004, '0055', 'NISCAMBRIO RAMON', 'SILVA CARREÃ‘O', '1955-05-30', 'ISLA DE COCHE', 'MASCULINO', 'SOLTERO', '', '2DO AÃ‘O BACHILLERATO', '', '1993-06-07', '0', 'CALLE PRINCIPAL, MACHO MUERTO', '', '', '', '1', 1, 'EMPLEADOS', '1', '27');
INSERT INTO `integrantes` VALUES (27, 1882215, '0062', 'OCTAVIO ELIAS', 'TEJERA PIÑERO', '1938-03-12', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '28');
INSERT INTO `integrantes` VALUES (28, 8382049, '', 'LUZ ELENA', 'TORTABU GONZALEZ', '1961-07-03', '', 'Masculino', '1', '10', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '29');
INSERT INTO `integrantes` VALUES (29, 5473836, '0033', 'MARIA DEL VALLE', 'SANCHEZ HERNANDEZ', '1957-09-08', 'CHAMARIAPA. SUCRE', 'MASCULINO', 'SOLTERO', 'SECRETARIA ', 'BACHILLER', '', '1989-04-03', '0', 'CALLA SAN ANTONIO CASANÂº 04-44 LOS COCOS PORLAMAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '31');
INSERT INTO `integrantes` VALUES (30, 4654821, '0028', 'AGUSTIN JOSE', 'MARCANO GOMEZ', '1950-08-30', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '32');
INSERT INTO `integrantes` VALUES (31, 3486366, '0058', 'CARLOS ALBERTO', 'LEON AGUILERA', '1948-11-01', '', 'MASCULINO', 'SOLTERO', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '33');
INSERT INTO `integrantes` VALUES (32, 5480903, '', 'GUILLERMO ANTONIO', 'SERRA MAGO', '1959-09-11', '', 'Masculino', '2', '9', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '34');
INSERT INTO `integrantes` VALUES (33, 4648525, '0082', 'ROGEL JOSE', 'MORENO MATA', '1949-08-06', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '35');
INSERT INTO `integrantes` VALUES (34, 4653768, '0031', 'NANCY ESTERBINA', 'SANCHEZ HERNANDEZ', '1955-12-26', '', 'MASCULINO', 'SOLTERO', '35', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '36');
INSERT INTO `integrantes` VALUES (35, 4189050, '0084', 'ARMANDO JOSE', 'RODRIGUEZ RODRIGUEZ', '1951-08-27', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '37');
INSERT INTO `integrantes` VALUES (36, 11144676, '0086', 'ALEXIS JAVIER', 'GUERRA SUAREZ', '1971-04-02', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'T.S.U. EN INFORMATICA', 'TECNICO SUPERIOR', '', '1993-06-01', '0', 'CALLE PRINCIPAL. AGUA DE VACA', '', '', '', '1', 1, 'EMPLEADOS', '1', '38');
INSERT INTO `integrantes` VALUES (37, 6428161, '0128', 'MERCEDES MARIA', 'PEPIN ANDRADE', '1961-09-24', 'CARACAS', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '2001-09-03', '0', 'CALLE 1,CASA I-03 URB. LA ARBOLEDA', '', '', '', '1', 1, 'EMPLEADOS', '1', '39');
INSERT INTO `integrantes` VALUES (38, 8396643, '0102', 'ANGELES ZENAIDA', 'ALCALA MATA', '1964-04-24', 'JUANGRIEGO', 'MASCULINO', 'SOLTERO', 'T.S.U. RELACIONES INDUSTRIALES', 'TECNICO SUPERIOR', '', '2000-03-01', '5', 'CALLE PRINCIPAL DE PEDREGALES', '', '', '', '1', 1, 'EMPLEADOS', '1', '41');
INSERT INTO `integrantes` VALUES (39, 11142484, '0118', 'NELLYS TERESA', 'BERBIN SILVA', '1971-11-28', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '12', 'BACHILLER', '', '2000-07-03', '0', 'CALLE LA CEIBA, LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', '42');
INSERT INTO `integrantes` VALUES (40, 5476102, '0032', 'CARMEN JOSEFINA', 'CARRASCO REYES', '1958-11-10', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'T.S.U. ADMINISTRACION TRIBUTARIA', 'TECNICO SUPERIOR', '', '1981-10-16', '0', 'SECTOR EL CIMARRON PTO.FERMIN', '', '', '', '1', 1, 'EMPLEADOS', '1', '43');
INSERT INTO `integrantes` VALUES (41, 12506912, '0034', 'YAQUELINE GREGORIA', 'GONZALEZ SUAREZ', '1975-03-12', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ASISTENTE ADMINISTRATIVO', 'BACHILLER', '', '1993-01-01', '0', 'CALLE PORLAMAR LOS COCOS', '', '', '', '1', 1, 'EMPLEADOS', '1', '44');
INSERT INTO `integrantes` VALUES (42, 8392561, '0117', 'EDGAR RAMON', 'MARTINEZ', '1962-05-05', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '', '4TO. AÃ‘O', '', '2000-05-01', '0', 'CALLE EL LIMON, CASA S/N EL SALADO', '', '', '', '1', 1, 'EMPLEADOS', '1', '47');
INSERT INTO `integrantes` VALUES (43, 4271638, '0124', 'DANIEL ORLANDO', 'AGUERO', '1953-01-03', 'BARQUISIMETO', 'MASCULINO', 'SOLTERO', '32', '4TO. AÃ‘O', '', '2000-11-13', '0', 'EL SALADO SECTOR APECURERO', '', '', '', '1', 1, 'EMPLEADOS', '1', '48');
INSERT INTO `integrantes` VALUES (44, 5589301, '0127', 'NORA ELENA', 'CALDERA GOMEZ', '1959-06-28', 'CARACAS', 'MASCULINO', 'SOLTERO', 'SECRETARIA ', 'BACHILLER', '', '2001-08-01', '3', 'CALLE SAN JOSE LA VECINDAD', '', '', '', '1', 1, 'EMPLEADOS', '1', '50');
INSERT INTO `integrantes` VALUES (45, 8398597, '0038', 'YANET FRANCISCA', 'HEREDIA BELLO', '1964-06-02', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'RECEPCIONISTA', 'BACHILLER', '', '1999-01-04', '0', 'URB. VICUÃ‘A LOS MILLANES', '', '', '', '1', 1, 'EMPLEADOS', '1', '51');
INSERT INTO `integrantes` VALUES (46, 12669638, '0036', 'MARIA GABRIELA', 'LEON SOLEDAD', '1974-09-14', 'CARACAS', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '1998-04-01', '0', 'CALLE MARGARITA CEDEÃ‘O, CASA S/N, LAS MARITAS', '', '', '', '1', 1, 'EMPLEADOS', '1', '52');
INSERT INTO `integrantes` VALUES (48, 5721970, '0044', 'ROMER ANTONIO', 'SALAZAR BRITO', '1959-06-15', 'LAGUNILLA EDO.ZULIA', 'MASCULINO', 'SOLTERO', 'OFICINISTA', 'BACHILLER', '', '1981-03-01', '0', 'CALLE PRINCIPAL DE SAN ANTONIO A 300 MTS DE LA ENTRADA  CASA S/N', '', '', '', '1', 1, 'EMPLEADOS', '1', '54');
INSERT INTO `integrantes` VALUES (49, 13541356, '0129', 'FERNANDO JOSE', 'MARTINEZ BRITO', '1977-08-09', 'PORLAMAR', 'MASCULINO', 'SOLTERO', '', 'BACHILLER', '', '2002-02-19', '0', 'AV. 31 DE JULIO EL SALADO CASA S/N', '', '', '', '1', 1, 'EMPLEADOS', '1', '55');
INSERT INTO `integrantes` VALUES (50, 4647270, '0083', 'PEDRO RAMON', 'ARISMENDI DIAZ', '1952-08-04', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '56');
INSERT INTO `integrantes` VALUES (51, 3946767, '0092', 'THAIS JOSEFINA', 'MERCHAN PADILLA', '1950-12-07', 'CARUPANO', 'MASCULINO', 'SOLTERO', 'ADMINISTRACION COMERCIAL', 'UNIVERSITARIO', '', '1999-08-03', '0', 'RINCON LA CEIBA, ATAMO SUR', '', '', '', '1', 1, 'DIRECTORES', '1', '58');
INSERT INTO `integrantes` VALUES (52, 3824167, '', 'ORLANDO RAFAEL', 'MORENO MATA', '1954-05-30', '', 'Masculino', '2', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '59');
INSERT INTO `integrantes` VALUES (54, 8470624, '0017', 'ALIDA EMILIA', 'MOYA DE GUEVARA', '1964-07-05', 'PARAGUACHI', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '1995-01-06', '0', 'SECTOR LOS CHACOS, VILLA COLONIAL, LOS ROBLES', '', '', '', '1', 1, 'EMPLEADOS', '1', '61');
INSERT INTO `integrantes` VALUES (55, 6966895, '0120', 'JOSE GREGORIO', 'FLORES', '1968-04-12', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ADMINISTRADOR', 'UNIVERSITARIO', 'DIRECTOR DE CONTROL DE LA ADMI', '2000-09-05', '0', 'AV. 31 DE JULIO TEJA ROJA, CASA NÂº 111, SECTOR LOMA DE GUERRA', 'DIRECCION DE CONTROL DE LA ADMINISTRACION ESTADAL', '', '', '1', 1, 'DIRECTORES', '1', '62');
INSERT INTO `integrantes` VALUES (56, 4650716, '0115', 'JOSE FRANCISCO', 'SALAZAR SERRANO', '1956-12-02', 'EL SALADO. MUNICIPIO ANTOLIN DEL CAMPO', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'CONTRALOR DEL ESTADO', '2000-02-14', '16', 'URB. JORGE COLL CONJUNTO RESIDENCIAL VALLE AZUL , TOWNHOUSE NÂº 8 PAMPATAR', 'CONTRALOR DEL ESTADO', '', '', '1', 1, 'DIRECTORES', '1', '63');
INSERT INTO `integrantes` VALUES (57, 6177583, '0126', 'ALBA NATHALIE', 'OCHOA TORRES', '1966-09-23', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'DIRECTORA DE RECURSOS HUMANOS', '2001-06-18', '8', 'URB. BAHIA DE PLATA ,NÂº 10 ALTAGRACIA, MUNICIPIO GOMEZ', 'DIRECCION DE RECURSOS HUMANOS', '', '', '1', 1, 'DIRECTORES', '1', '65');
INSERT INTO `integrantes` VALUES (58, 1633192, '0079', 'ABELARDO', 'VIZCAINO NARVAEZ', '1937-11-22', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '66');
INSERT INTO `integrantes` VALUES (59, 12661621, '0012', 'ANAMARIA', 'GOMEZ COVA', '1975-01-15', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '1999-05-03', '0', 'CALLE QUILARTE RESIDENCIAS MUCURAPARO, PORLAMAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '67');
INSERT INTO `integrantes` VALUES (60, 6122659, '0018', 'GRETTY DIVILEY', 'ATELLA BRAVO', '1965-05-28', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'DIRECTORA DE LA DIRECCION DE D', '1998-04-16', '0', 'AV. FRANCISCO FAJARDO SECTOR CONEJERO', 'DIRECCION DE DETERMINACION DE RESPONSABILIDADES', '', '', '1', 1, 'DIRECTORES', '1', '68');
INSERT INTO `integrantes` VALUES (61, 4647928, '0029', 'LUIS ALBERTO', 'CARREÃ‘O', '1952-11-14', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'LIC. ADMINISTRACION', 'UNIVERSITARIO', '', '1999-05-18', '10', 'URBANIZACIÃ“N LA  GUARINA', '', '', '', '1', 1, 'EMPLEADOS', '1', '69');
INSERT INTO `integrantes` VALUES (62, 4651478, '0025', 'PEDRO LUIS', 'VALDERRAMA MONASTERIOS', '1957-11-08', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '1999-05-16', '3', 'PROLONGACION CALLE SAN JOSE CASA S/N DETRAS DEL JARDINN DE INFANCIA DE PARAGUACHI', '', '', '', '1', 1, 'EMPLEADOS', '1', '70');
INSERT INTO `integrantes` VALUES (63, 5482954, '0107', 'CARMEN JOSEFINA', 'ANDARA SILVA', '1961-07-15', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '2000-03-17', '3', 'URB. PLAYA EL ANGEL ', '', '', '', '1', 1, 'EMPLEADOS', '1', '71');
INSERT INTO `integrantes` VALUES (64, 13023459, '0103', 'JANETH DEL CARMEN', 'COLL FERMIN', '1977-04-06', 'CABIMAS', 'MASCULINO', 'SOLTERO', 'LIC. ADMINISTRACIÃ“N', 'UNIVERSITARIO', 'DIRECTORA DE ADMINISTRACION Y ', '2000-03-16', '0', 'AV. 31 DE JULIO EL SALADO', 'DIRECCION DE ADMINISTRACION Y PRESUPUESTO', '', '', '1', 1, 'DIRECTORES', '1', '72');
INSERT INTO `integrantes` VALUES (66, 8385744, '0016', 'DORELIS DEL VALLE', 'GOMEZ GONZALEZ', '1961-05-07', 'SAN PEDRO DE COCHE', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '1995-03-01', '0', 'SECTOR CRUZ DEL PASTEL MUNICIPIO GARCIA', '', '', '', '1', 1, 'EMPLEADOS', '1', '74');
INSERT INTO `integrantes` VALUES (67, 11855143, '0078', 'MELVIS JOSE', 'FUENTES DIAZ', '1973-08-14', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'T.S.U.INFORMATICA', 'UNIVERSITARIO', '', '1996-02-01', '0', 'CALLE SAN JOSE VALLE PEDRO GONZALEZ', '', '', '', '1', 1, 'EMPLEADOS', '1', '75');
INSERT INTO `integrantes` VALUES (68, 8566093, '0075', 'NELSON CARLOS', 'MARTINI HERNANDEZ', '1963-02-03', 'GUARICO', 'MASCULINO', 'SOLTERO', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '1993-06-01', '0', 'AV. BOLIVAR PLAYA EL ANGEL ', '', '', '', '1', 1, 'EMPLEADOS', '1', '76');
INSERT INTO `integrantes` VALUES (69, 4422887, '0029', 'ALICIA COROMOTO', 'GARCIA RUIZ', '1956-09-25', '', 'MASCULINO', 'SOLTERO', '11', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '77');
INSERT INTO `integrantes` VALUES (70, 5482594, '0105', 'MILAGROS WISTREMUNDA', 'GARCIA DE MARTINEZ', '1961-02-16', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ARQUITECTO', 'UNIVERSITARIO', 'DIRECTORA DE LA UNIDAD DE ATEN', '2000-03-16', '0', 'AV. PRINCIPAL, LA FUNETE FRENTE AL BOULEVARD', 'UNIDAD DE ATENCION CIUDADANA Y CONTROL COMUNITARIA', '', '', '1', 1, 'DIRECTORES', '1', '78');
INSERT INTO `integrantes` VALUES (71, 11536888, '0116', 'AMERLIN ROSALBA', 'ROSAS VASQUEZ', '1974-03-01', 'Porlamar', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2000-04-03', '0', 'CALLE 24 DE JULIO, PARAGUACHI', '', '', '', '1', 1, 'EMPLEADOS', '1', '79');
INSERT INTO `integrantes` VALUES (72, 4656784, '', 'JESUS JOSE', 'ROJAS MILANO', '1959-01-07', '', 'Masculino', '2', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '80');
INSERT INTO `integrantes` VALUES (73, 11142532, '0109', 'LENYN GREGORIO', 'ROJAS RODRIGUEZ', '1970-03-09', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'DISEÃ‘ADOR DE OBRAS CIVILES', 'TECNICO SUPERIOR', '', '2000-03-17', '0', 'AV. JUAN BAUTISTA ARISMENDI AL LADO DE LA ALMACENADORA MARGARITA', '', '', '', '1', 1, 'EMPLEADOS', '1', '81');
INSERT INTO `integrantes` VALUES (74, 11852605, '0042', 'ALEXANDER JOSE', 'ROSAS JIMENEZ', '1972-03-07', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '1997-04-01', '0', 'URB. JOVITO VILLALBA PAMPATAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '82');
INSERT INTO `integrantes` VALUES (75, 5605331, '0005', 'OSIRIS COROMOTO', 'PATIÑO VALENZUELA', '1963-12-23', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO ', 'UNIVERSITARIO', '', '2000-02-22', '1', 'URB. EL PORTAL DE LOS ROBLES', 'ASESORIA DEL DESPACHO', '', '', '1', 1, 'DIRECTORES', '1', '83');
INSERT INTO `integrantes` VALUES (76, 13729622, '0123', 'PEDRO ENRIQUE', 'ARRIOJA MARCANO', '1978-06-12', 'CARUPANO', 'MASCULINO', 'SOLTERO', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', 'DIRECTOR DE ORGANIZACION Y SIS', '2000-07-03', '0', 'LA ASUNCION', 'DIRECCION DE ORGANIZACION Y SISTEMAS', '', '', '1', 1, 'DIRECTORES', '1', '84');
INSERT INTO `integrantes` VALUES (77, 4652451, '0024', 'LUIS RAMON', 'MARCANO MARIN', '1957-06-22', 'BOCA DEL RIO', 'MASCULINO', 'SOLTERO', 'ECONOMISTA', 'UNIVERSITARIO', '', '1999-05-16', '3', 'CALLE MARINA FRENTE AL CENTRO CULTURAL BOCA DEL RIO', '', '', '', '1', 1, 'EMPLEADOS', '1', '85');
INSERT INTO `integrantes` VALUES (78, 10214381, '', 'JUAN FRANCISCO', 'BELLORIN SALAZAR', '1972-04-17', '', 'Masculino', '1', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '86');
INSERT INTO `integrantes` VALUES (79, 4583844, '', 'GUSTAVO', 'LAFEE SANTANA', '1955-07-23', '', 'Masculino', '1', '7', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '87');
INSERT INTO `integrantes` VALUES (80, 14055011, '0122', 'MARICRUZ', 'TURKALI GUERRA', '1979-01-06', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', '', '2000-11-01', '0', 'CALLE LA NORIA LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', '88');
INSERT INTO `integrantes` VALUES (81, 5482007, '0119', 'MARINA DEL VALLE', 'FIGUEROA DELGADO', '1959-08-09', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '2000-08-01', '15', 'uRB. LA GUARINA, SEGUNDA CALLE', '', '', '', '1', 1, 'EMPLEADOS', '1', '89');
INSERT INTO `integrantes` VALUES (82, 8390397, '', 'ABEL JOSE', 'VELASQUEZ VELASQUEZ', '1963-12-05', 'CARAPACHO, SAN JUAN', 'Masculino', '*Concubina', 'LIC. ADMINISTRACION', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE MARCANO CARAPACHO SAN JUAN', '', '', '', '0', 0, 'EMPLEADOS', '', '90');
INSERT INTO `integrantes` VALUES (83, 3822286, '0011', 'JOSE DOMINGO', 'HERNANDEZ', '1947-02-03', '', 'MASCULINO', 'SOLTERO', '35', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', '91');
INSERT INTO `integrantes` VALUES (84, 2155158, '0020', 'RAFAEL', 'NORIEGA SALAZAR', '1941-01-01', '', 'MASCULINO', 'SOLTERO', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '93');
INSERT INTO `integrantes` VALUES (85, 2832725, '0071', 'VICTOR JULIO', 'SALAZAR MARCANO', '1944-07-21', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '94');
INSERT INTO `integrantes` VALUES (86, 2826195, '0022', 'LUIS ALBERTO', 'ALFONZO', '1945-04-08', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '95');
INSERT INTO `integrantes` VALUES (87, 4051700, '0019', 'ROSAURO JOSE', 'RIVAS SERRA', '1953-10-07', '', 'MASCULINO', 'SOLTERO', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '96');
INSERT INTO `integrantes` VALUES (88, 3488626, '0059', 'RAFAEL TOBIAS', 'MENDOZA ROSAS', '1947-12-06', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '97');
INSERT INTO `integrantes` VALUES (89, 3487152, '0049', 'LUIS RAFAEL', 'PEREIRA BEAUFOND', '1946-01-08', '', 'MASCULINO', 'SOLTERO', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '98');
INSERT INTO `integrantes` VALUES (90, 3489278, '', 'MANUEL RAFAEL', 'MARCANO ZABALA', '1950-01-06', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '99');
INSERT INTO `integrantes` VALUES (91, 5643691, '0125', 'AIYAMARA', 'SALINAS COLMENARES', '1958-12-07', 'SAN CRISTOBAL, EDO TACHIRA', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2001-06-18', '0', 'CONJUNTO RESIDENCIAL LA PORTADA, LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', '100');
INSERT INTO `integrantes` VALUES (92, 3488376, '0024', 'PEDRO LUIS', 'LOPEZ LOPEZ', '1947-09-09', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '101');
INSERT INTO `integrantes` VALUES (93, 2168112, '0026', 'CARMEN REMIGIA', 'SUAREZ DE GUERRA', '1940-10-01', '', 'MASCULINO', 'SOLTERO', '35', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '102');
INSERT INTO `integrantes` VALUES (94, 3045299, '0021', 'JOSE MERCEDES', 'MILLAN QUIJADA', '1949-07-24', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', '103');
INSERT INTO `integrantes` VALUES (95, 11143327, '', 'JIMMY', 'IMBRONDONE FERMIN', '1970-11-04', '', 'Masculino', '1', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '104');
INSERT INTO `integrantes` VALUES (96, 5885859, '', 'CARLOS ENRIQUE', 'GUDIÃ‘O BARRIOS', '1960-04-26', '', 'Masculino', '0', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '105');
INSERT INTO `integrantes` VALUES (97, 1748998, '', 'RAFAEL MIGUEL PASTOR', 'FELICE CASTILLO', '1942-09-15', '', 'Masculino', '2', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '106');
INSERT INTO `integrantes` VALUES (98, 7164093, '', 'ALFREDO JOSE', 'MENDOZA OVALLES', '1968-04-04', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '107');
INSERT INTO `integrantes` VALUES (99, 4656077, '', 'WOLFGANG LUIS', 'SALAZAR SALAZAR', '1958-03-11', '', 'Masculino', '1', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '108');
INSERT INTO `integrantes` VALUES (100, 879613, '', 'PEDRO CECILIO', 'SALGADO MOYA', '1934-12-04', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 0, 'EMPLEADOS', '', '109');
INSERT INTO `integrantes` VALUES (101, 1157385, '0006', 'JESUS MANUEL', 'MILLAN', '1935-10-15', '', 'MASCULINO', 'SOLTERO', '32', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', '110');
INSERT INTO `integrantes` VALUES (102, 11506606, '0130', 'ISNELLY JOSEFINA', 'BALZA SALINAS', '1975-02-21', 'SAN CRISTOBAL', 'MASCULINO', 'SOLTERO', 'LIC. RELACIONES INDUSTRIALES', 'UNIVERSITARIO', '', '2002-10-15', '0', 'CALLE MARIÃ‘O SECTOR LOMA DE GUERRA', '', '', '', '1', 1, 'EMPLEADOS', '1', '112');
INSERT INTO `integrantes` VALUES (103, 13668974, '0131', 'VANESSA DEL VALLE', 'RIVERA GARCIA', '1977-05-24', 'EL VALLE ESPIRITU SANTO', 'MASCULINO', 'SOLTERO', 'LIC.EN ESTUDIOS INTERNACIONALES', 'UNIVERSITARIO', '', '2002-10-15', '2', 'CONJUNTO RESEDENCIAL EL CAMINO,NÂº 6 CALLE JOSE MARIA SUAREZ URB.SABANA MAR', '', '', '', '1', 1, 'EMPLEADOS', '1', '113');
INSERT INTO `integrantes` VALUES (104, 14220083, '', 'ORLENIS DEL VALLE', 'RODRIGUEZ ROSAS', '1979-04-07', 'PORLAMAR', 'Femenino', 'Casado', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', '', '0000-00-00', '', 'SECTOR BELEN CASA S/N LOS ROBLES', '', '', '', '0', 0, 'EMPLEADOS', '', '114');
INSERT INTO `integrantes` VALUES (105, 9425982, '0132', 'MIRIAN JOSEFINA', 'NÚÑEZ ARTEAGA', '1968-11-13', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'PERIODISTA', 'UNIVERSITARIO', '', '2000-09-15', '6', 'SEGUNDA AV. GUATAMARE QTA. VIRGEN DEL VALLE LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', '115');
INSERT INTO `integrantes` VALUES (106, 12920483, '0136', 'PETRA DEL VALLE', 'NARVAEZ MARIN', '1976-07-06', 'BOCA DE RIO', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2004-02-02', '0', 'URB. VALLE VERDE', '', '', '', '1', 1, 'EMPLEADOS', '1', '116');
INSERT INTO `integrantes` VALUES (107, 5972426, '0135', 'MAÑANA', 'NOGUERA CARDENAS', '1962-09-16', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ECONOMISTA', 'UNIVERSITARIO', '', '2004-02-02', '0', 'AV. PRINCIPAL DE ARICAGUA ANTOLIN DEL CAMPO', '', '', '', '1', 1, 'EMPLEADOS', '1', '117');
INSERT INTO `integrantes` VALUES (108, 9429622, '0138', 'EUSTACIO DAVID', 'MARCANO MARCANO', '1969-08-31', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', 'DIRECTOR DE ENTIDADES DESCENTR', '2004-02-18', '9', 'AV.31 DE JULIO LA FUENTE ', 'DIRECCION DE ENTIDADES DESCENTRALIZADAS', '', '', '1', 1, 'DIRECTORES', '1', '118');
INSERT INTO `integrantes` VALUES (109, 12223561, '0138', 'MAIRYM JOSEFINA', 'BRUZUAL LAREZ', '1973-12-16', 'PUNTA DE PIEDRAS', 'MASCULINO', 'SOLTERO', 'T.S.U.TURISMO', 'TECNICO SUPERIOR', '', '2004-08-01', '3', 'URBANIZACIÃ“N CAMINO REAL ', '', '', '', '1', 1, 'EMPLEADOS', '1', '119');
INSERT INTO `integrantes` VALUES (110, 15423652, '0139', 'EUMARY CAROLINA', 'LOPEZ CARABALLO', '1982-08-06', 'ANTOLIN DEL CAMPO', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2005-01-17', '0', 'CALLE GOMEZ EL RINCON DE LA FUENTE, CASA NÂº 1', '', '', '', '1', 1, 'EMPLEADOS', '1', '120');
INSERT INTO `integrantes` VALUES (111, 10519925, '0140', 'FRANCISCO JOSE', 'FERNANDEZ RODRIGUEZ', '1968-02-15', 'CARACAS', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2005-01-17', '0', 'LA SIERRA QTA.ODELVA', '', '', '', '1', 1, 'EMPLEADOS', '1', '121');
INSERT INTO `integrantes` VALUES (113, 13190579, '0141', 'ROSELYS DEL VALLE', 'SALAZAR ZABALA', '1977-10-30', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '2005-02-16', '0', 'URB. LA GUARINA, LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', '123');
INSERT INTO `integrantes` VALUES (114, 13424082, '0142', 'CARLOS ALBERTO', 'AVILA PANFIL', '1978-09-19', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'LIC. INFORMATICA', 'UNIVERSITARIO', 'Programador II', '2005-02-16', '4', 'CALLE LA CEIBA, PARAGUACHI', 'Organizacion y Sistemas', '0295-2348602', '', '1', 1, 'EMPLEADOS', '1', '124');
INSERT INTO `integrantes` VALUES (115, 13848264, '', 'MARIA VICTORIA', 'MORENO MATA', '1978-10-30', 'PORLAMAR', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE BOLIVAR CASA NÂº 57 PEDRO GONZALEZ', '', '', '', '0', 0, 'EMPLEADOS', '', '125');
INSERT INTO `integrantes` VALUES (116, 14685167, '0144', 'TEODORO ALEJANDRO', 'COELLO GARCIA', '1980-05-25', 'CUMANA', 'MASCULINO', 'SOLTERO', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '2005-06-01', '0', 'LAS GILES SECTOR GUAYACAN', '', '', '', '1', 1, 'EMPLEADOS', '1', '126');
INSERT INTO `integrantes` VALUES (118, 6727828, '0147', 'NEREIDA ESTRELLA', 'DUGARTE VIELMA', '1966-01-06', 'CARACAS', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2006-01-01', '4', 'AV. PRINCIPAL SECTOR APOSTADERO', '', '', '', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (117, 14543612, '0146', 'VICTOR JOSE DEL VALLE', 'AVILA DOMINGUEZ', '1980-03-25', 'PORLAMAR', 'MASCULINO', 'CASADO', 'INGENIERO INDUSTRIAL', 'UNIVERSITARIO', '', '2006-01-01', '0', 'AV. JOVITO VILLALBA LOS ROBLES', '', '', '', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (119, 4983744, '0145', 'MARGOT ISABEL', 'RIVERO PEÃ‘A', '1957-03-11', 'CIUDAD BOLIVAR', 'MASCULINO', 'SOLTERO', 'BIBLIOTECOLOGA', 'UNIVERSITARIO', '', '2005-07-01', '23', 'CALLE MATASIETE, CONJUNTO RESIDENCIAL LA PORTADA, EDIF.C, APTO. 1, PB. LA ASUNCION', '', '', '', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (120, 1320383, '0004', 'GERARDO JOSE', 'MARIN HERNANDEZ', '1917-04-15', 'BOCA DE RIO', 'MASCULINO', 'SOLTERO', 'SUB- CONTRALOR', 'NO EXISTE DATO', '', '2007-10-01', '0', 'CALLE ARISMENDI CASA 780 SECTOR CARUJO, BOCA DE RIO', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (124, 3489021, '0011', 'GENARO', 'LISTA MARIN', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (125, 2834421, '0039', 'JESUS ENRIQUE', 'LAREZ FERMIN', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (126, 3488298, '0088', 'CAMILO', 'GUERRA GIL', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (127, 2825289, '0066', 'HUMBERTO', 'SUBERO', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (128, 4656965, '0067', 'CARLOS JESUS', 'VELASQUEZ', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (129, 2828055, '0001', 'CANDIDO', 'RAMOS', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (130, 478074, '0002', 'AUGUSTO ', 'MARIN', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (131, 1320451, '0005', 'ROBERTO', 'SALAZAR', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (132, 2829046, '0007', 'JOSE', 'MARCANO', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (133, 1153450, '0009', 'JESUS JOSE', 'VICENT', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (134, 3035967, '0010', 'JOSE FRANCISCO ', 'FERRER', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (135, 2831342, '0012', 'MIGUEL', 'RAMOS', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (136, 2831702, '0013', 'MANUEL ANTONIO', 'HERNANDEZ', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (137, 2831573, '0014', 'EDGAR JOSE', 'WETTEL', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (138, 2829727, '0015', 'DANIEL', 'ROMERO BRITO', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (139, 3488815, '0016', 'CRUZ BAUTISTA', 'RODRIGUEZ', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (140, 4045550, '0017', 'JESUS', 'MATA', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (141, 2829520, '0018', 'HECTOR LUIS', 'MILLAN', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (142, 4047382, '0023', 'ARACELYS', 'DE VALERIO', '0000-00-00', '', 'FEMENINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (143, 3823341, '0002', 'MIREYA', 'DE FANEITY', '0000-00-00', '', 'FEMENINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (144, 2162209, '0003', 'NIMIA', 'DE BELLORIN', '0000-00-00', '', 'FEMENINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (145, 8384048, '0004', 'ASUNCION', 'DE GOMEZ', '0000-00-00', '', 'FEMENINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (146, 2832775, '0005', 'MIGDALIA', 'MARCANO', '0000-00-00', '', 'FEMENINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (147, 2827764, '0007', 'HILARIA', 'DE GONZALEZ', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (148, 2825543, '0027', 'JUVENAL', 'VALERIO', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (149, 2834521, '0008', 'LUISA', 'PEREZ DE ROJAS', '0000-00-00', '', 'FEMENINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (150, 3203431, '0009', 'NELLYS', 'CORTEZ DE VALERY', '0000-00-00', '', 'FEMENINO', 'VIUDO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (151, 1631741, '0010', 'PETRA', 'DE GONZALEZ', '0000-00-00', '', 'MASCULINO', 'VIUDO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (152, 879418, '0003', 'ISMAEL', 'PATIÑO', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (153, 3329244, '0006', 'ORLANDO', 'PEÑA GAMBOA', '0000-00-00', '', 'MASCULINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (154, 1324354, '0012', 'PETRA', 'LABORI DE ACOSTA', '0000-00-00', '', 'FEMENINO', 'VIUDO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (155, 4647730, '0013', 'EMERITA', 'MARCANO DE MARCANO', '0000-00-00', '', 'FEMENINO', 'VIUDO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (156, 2168184, '0014', 'ROSALIDA', 'MILLAN DE VILLARROAL', '0000-00-00', '', 'FEMENINO', 'VIUDO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'PENSIONADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (157, 645319, '0008', 'NANCY COROMOTO', 'MARCANO', '0000-00-00', '', 'FEMENINO', 'CASADO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (158, 2834661, '0025', 'NICASIO', 'RODRIGUEZ', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (159, 4045579, '0077', 'FRANCISCO RAMON', 'AGUILERA', '0000-00-00', '', 'MASCULINO', 'SOLTERO', '', '', '', '0000-00-00', '', '', '', '', '', '1', 0, 'JUBILADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (160, 3826253, '0148', 'FÉLIX JUSTINIANO', 'ORDÁZ MARÍN', '1951-03-30', 'PORLAMAR', 'MASCULINO', 'CASADO', '', 'BACHILLER', '', '2007-06-04', '0', 'PEDRO GONZALEZ, SECTOR LAS GAMBOAS, CASA SAN PEDRO', '', '0295-2570410', '', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (161, 12673593, '0151', 'NAYJAMA DEL VALLE', 'GUILARTE DE PINEDA', '1978-02-16', 'PORLAMAR', 'FEMENINO', 'CASADO', 'ABOGADO', 'UNIVERSITARIO', '', '2008-02-16', '0', 'URB. VILLA ROSA, C/3, CASA # 6', '', '0295-2962979', '0414-7916001', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (162, 13541970, '0152', 'ANAMARIA DEL VALLE', 'MORGADO ROJAS', '1978-06-10', 'PORLAMAR', 'FEMENINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', '', '2008-02-16', '0', 'URB. LAS VILLARROELES, CALLE PRINCIPAL, CASA NRO 157', '', '0295-2590245', '0424-8140481', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (163, 15422391, '0150', 'INGRID CAROLINA', 'MEDINA BRICEÃ‘O', '1983-03-13', 'PORLAMAR', 'FEMENINO', 'SOLTERO', 'CONTADOR', 'UNIVERSITARIO', '', '2008-02-16', '0', 'EL SALADO, AMTOLIN DEL CAMPO', '', '0295-4162796', '0416-3991118', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (164, 15896190, '0153', 'ARQUIMENES RAFAEL', 'CARABALLO GIL', '1981-08-04', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '2008-03-04', '0', 'SECTOR EL SALADO, MUNICIPIO ANTONLIN DEL CAMPO', '', '0424-8498210', '0426-9866262', '1', 1, 'EMPLEADOS', '1', NULL);
INSERT INTO `integrantes` VALUES (165, 12506760, '0149', 'GERALDO JOSE', 'MARCANO LOPEZ', '1975-07-04', 'CUMANA', 'MASCULINO', 'SOLTERO', 'LICENCIADO EN INFORMATICA', 'UNIVERSITARIO', '', '2007-10-01', '0', 'CALLE SAN PATRICIO, SECTOR EL TUEY, SAN JUAN BAUTISTA, MUNICIPIO DIAS', '', '0295-4168614', '0416-1979424', '1', 1, 'EMPLEADOS', '1', NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_banco`
-- 

CREATE TABLE `integrantes_banco` (
  `numero_cuenta` varchar(30) NOT NULL default '',
  `tipo` varchar(30) default NULL,
  `banco` varchar(50) NOT NULL,
  `cedula` int(10) unsigned NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `uso` varchar(30) default NULL COMMENT 'el tipo de uso de la cuenta (nomina, fideicomiso)',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `numero_cuenta` (`numero_cuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_banco`
-- 

INSERT INTO `integrantes_banco` VALUES ('5300040731', 'CORRIENTE', 'BANCARIBE', 13424082, 2, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300034065', 'CORRIENTE', 'BANCARIBE', 6966895, 3, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300033859', 'CORRIENTE', 'BANCARIBE', 4650716, 4, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300035886', 'CORRIENTE', 'BANCARIBE', 6177583, 5, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300031392', 'CORRIENTE', 'BANCARIBE', 6122659, 6, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300036742', 'CORRIENTE', 'BANCARIBE', 13023459, 7, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300033948', 'CORRIENTE', 'BANCARIBE', 5482594, 8, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301197944', 'AHORROS', 'BANCARIBE', 5605331, 9, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300036858', 'CORRIENTE', 'BANCARIBE', 13729622, 10, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300039385', 'CORRIENTE', 'BANCARIBE', 9429622, 11, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5310057217', 'CORRIENTE', 'BANCARIBE', 3946767, 12, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301184109', 'AHORROS', 'BANCARIBE', 5477294, 13, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5310051499', 'CORRIENTE', 'BANCARIBE', 12661621, 14, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301177048', 'AHORROS', 'BANCARIBE', 2166981, 15, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301129949', 'AHORROS', 'BANCARIBE', 8385761, 16, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300030469', 'CORRIENTE', 'BANCARIBE', 8470624, 17, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175169', 'AHORROS', 'BANCARIBE', 3045299, 18, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301190966', 'AHORROS', 'BANCARIBE', 4652451, 19, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5309000678', 'CORRIENTE', 'BANCARIBE', 4651478, 20, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175363', 'AHORROS', 'BANCARIBE', 5477905, 21, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301191024', 'AHORROS', 'BANCARIBE', 4647928, 22, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175061', 'CORRIENTE', 'BANCARIBE', 4653768, 23, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5321030949', 'AHORROS', 'BANCARIBE', 5473836, 24, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5321067060', 'AHORROS', 'BANCARIBE', 12506912, 25, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175096', 'AHORROS', 'BANCARIBE', 12224570, 26, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301181223', 'AHORROS', 'BANCARIBE', 12669638, 27, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301189593', 'AHORROS', 'BANCARIBE', 8398597, 28, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300029797', 'AHORROS', 'BANCARIBE', 9308955, 29, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5311109911', 'AHORROS', 'BANCARIBE', 11852605, 30, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175835', 'AHORROS', 'BANCARIBE', 5721970, 31, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301140071', 'AHORROS', 'BANCARIBE', 11144676, 32, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301069687', 'AHORROS', 'BANCARIBE', 5482703, 33, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301181215', 'AHORROS', 'BANCARIBE', 3487152, 34, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301061821', 'AHORROS', 'BANCARIBE', 3670594, 35, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301140608', 'AHORROS', 'BANCARIBE', 8442192, 36, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5321000721', 'AHORROS', 'BANCARIBE', 4649004, 37, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301176939', 'AHORROS', 'BANCARIBE', 8378076, 38, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301176882', 'AHORROS', 'BANCARIBE', 3486366, 39, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301129566', 'AHORROS', 'BANCARIBE', 4051711, 40, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175223', 'AHORROS', 'BANCARIBE', 11855143, 41, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301176068', 'AHORROS', 'BANCARIBE', 1633192, 42, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175150', 'AHORROS', 'BANCARIBE', 4647270, 43, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175266', 'AHORROS', 'BANCARIBE', 4189050, 44, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300030655', 'CORRIENTE', 'BANCARIBE', 4654397, 45, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300030396', 'CORRIENTE', 'BANCARIBE', 8926627, 46, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301181355', 'AHORROS', 'BANCARIBE', 13669573, 47, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301187825', 'AHORROS', 'BANCARIBE', 12225307, 48, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175177', 'AHORROS', 'BANCARIBE', 8392072, 49, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301177552', 'AHORROS', 'BANCARIBE', 4018459, 50, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301167891', 'AHORROS', 'BANCARIBE', 11829028, 51, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301126190', 'AHORROS', 'BANCARIBE', 1320383, 52, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301164345', 'AHORROS', 'BANCARIBE', 4051700, 53, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301097222', 'AHORROS', 'BANCARIBE', 2155158, 54, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301247330', 'AHORROS', 'BANCARIBE', 2826195, 55, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5321020986', 'AHORROS', 'BANCARIBE', 1157385, 56, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301197995', 'AHORROS', 'BANCARIBE', 12222156, 57, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301068818', 'AHORROS', 'BANCARIBE', 5476102, 58, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301194643', 'AHORROS', 'BANCARIBE', 8388339, 59, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300039067', 'CORRIENTE', 'BANCARIBE', 9303416, 60, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301198142', 'AHORROS', 'BANCARIBE', 5482954, 61, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301198169', 'AHORROS', 'BANCARIBE', 11142532, 62, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301198290', 'AHORROS', 'BANCARIBE', 4512285, 63, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300034499', 'CORRIENTE', 'BANCARIBE', 11536888, 64, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301200392', 'AHORROS', 'BANCARIBE', 8392561, 65, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301162350', 'AHORROS', 'BANCARIBE', 11142484, 66, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301049988', 'AHORROS', 'BANCARIBE', 3488626, 67, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175355', 'AHORROS', 'BANCARIBE', 2832725, 68, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301197200', 'AHORROS', 'BANCARIBE', 2168112, 69, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301197928', 'AHORROS', 'BANCARIBE', 8396643, 70, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175290', 'AHORROS', 'BANCARIBE', 4648525, 71, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300038982', 'CORRIENTE', 'BANCARIBE', 14055011, 72, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301203553', 'AHORROS', 'BANCARIBE', 4271638, 73, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301206170', 'AHORROS', 'BANCARIBE', 5643691, 74, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301206692', 'AHORROS', 'BANCARIBE', 5589301, 75, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301242338', 'AHORROS', 'BANCARIBE', 6428161, 76, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301183773', 'AHORROS', 'BANCARIBE', 4654821, 77, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301211149', 'AHORROS', 'BANCARIBE', 13541356, 78, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300039644', 'AHORROS', 'BANCARIBE', 11506606, 79, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301214830', 'AHORROS', 'BANCARIBE', 13668974, 80, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301187833', 'AHORROS', 'BANCARIBE', 1882215, 81, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300030353', 'AHORROS', 'BANCARIBE', 8385744, 82, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301200562', 'AHORROS', 'BANCARIBE', 5482007, 83, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300030337', 'CORRIENTE', 'BANCARIBE', 8566093, 84, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301215578', 'AHORROS', 'BANCARIBE', 3822286, 85, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300038770', 'CORRIENTE', 'BANCARIBE', 9425982, 86, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301216027', 'AHORROS', 'BANCARIBE', 8381570, 87, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301181827', 'AHORROS', 'BANCARIBE', 3488376, 88, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301227290', 'AHORROS', 'BANCARIBE', 5972426, 89, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301227312', 'AHORROS', 'BANCARIBE', 12920483, 90, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301198606', 'AHORROS', 'BANCARIBE', 4422887, 91, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300039687', 'CORRIENTE', 'BANCARIBE', 12223561, 92, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300040650', 'CORRIENTE', 'BANCARIBE', 10519925, 93, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301234785', 'AHORROS', 'BANCARIBE', 15423652, 94, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301235315', 'AHORROS', 'BANCARIBE', 13190579, 95, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301237857', 'AHORROS', 'BANCARIBE', 14685167, 96, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301240424', 'AHORROS', 'BANCARIBE', 4983744, 97, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301240432', 'AHORROS', 'BANCARIBE', 14543612, 98, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301240386', 'AHORROS', 'BANCARIBE', 6727828, 99, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301182548', 'AHORROS', 'BANCARIBE', 3489021, 100, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5309000546', 'CORRIENTE', 'BANCARIBE', 2834421, 101, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175339', 'AHORROS', 'BANCARIBE', 3488298, 102, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175622', 'AHORROS', 'BANCARIBE', 2825289, 103, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175193', 'AHORROS', 'BANCARIBE', 4656965, 104, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5311125852', 'AHORROS', 'BANCARIBE', 2828055, 105, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301184850', 'AHORROS', 'BANCARIBE', 478074, 106, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185288', 'AHORROS', 'BANCARIBE', 1320451, 107, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185865', 'AHORROS', 'BANCARIBE', 2829046, 108, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185008', 'AHORROS', 'BANCARIBE', 1153450, 109, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301167662', 'AHORROS', 'BANCARIBE', 3035967, 110, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301184818', 'AHORROS', 'BANCARIBE', 2831342, 111, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301177064', 'AHORROS', 'BANCARIBE', 2831702, 112, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185660', 'AHORROS', 'BANCARIBE', 2831573, 113, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175304', 'AHORROS', 'BANCARIBE', 2829727, 114, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301191776', 'AHORROS', 'BANCARIBE', 3488815, 115, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5311113560', 'AHORROS', 'BANCARIBE', 4045550, 116, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301175452', 'AHORROS', 'BANCARIBE', 2829520, 117, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301192020', 'AHORROS', 'BANCARIBE', 4047382, 118, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185563', 'AHORROS', 'BANCARIBE', 3823341, 119, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301186055', 'AHORROS', 'BANCARIBE', 2162209, 120, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301185156', 'AHORROS', 'BANCARIBE', 8384048, 121, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301200490', 'AHORROS', 'BANCARIBE', 2832775, 122, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5311119224', 'AHORROS', 'BANCARIBE', 2827764, 123, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301197081', 'AHORROS', 'BANCARIBE', 2825543, 124, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301196182', 'AHORROS', 'BANCARIBE', 2834521, 125, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301212730', 'AHORROS', 'BANCARIBE', 3203431, 126, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5251092712', 'AHORROS', 'BANCARIBE', 1631741, 127, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300043307', 'CORRIENTE', 'BANCARIBE', 879418, 128, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301190672', 'AHORROS', 'BANCARIBE', 3329244, 129, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301243423', 'AHORROS', 'BANCARIBE', 1324354, 130, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301244268', 'AHORROS', 'BANCARIBE', 4647730, 131, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301246376', 'AHORROS', 'BANCARIBE', 2168184, 132, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301248263', 'AHORROS', 'BANCARIBE', 12673593, 133, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5300046772', 'CORRIENTE', 'BANCARIBE', 13541970, 134, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301248220', 'AHORROS', 'BANCARIBE', 15422391, 135, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301248409', 'AHORROS', 'BANCARIBE', 15896190, 136, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301248042', 'AHORROS', 'BANCARIBE', 3826253, 137, 'NOMINA');
INSERT INTO `integrantes_banco` VALUES ('5301248026', 'AHORROS', 'BANCARIBE', 12506760, 138, 'NOMINA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_cargo`
-- 

CREATE TABLE `integrantes_cargo` (
  `status` varchar(10) NOT NULL,
  `denominacion` varchar(100) NOT NULL default '',
  `nivel` char(15) NOT NULL,
  `condicion` varchar(20) NOT NULL default '',
  `decreto_contrato` varchar(10) NOT NULL default '',
  `fecha_ini` date NOT NULL default '0000-00-00',
  `fecha_fin` date NOT NULL default '0000-00-00',
  `lugar_trabajo` varchar(100) NOT NULL default '',
  `cod_direccion` varchar(10) NOT NULL,
  `cod_rac` varchar(10) NOT NULL default '',
  `fecha_elab` date NOT NULL default '0000-00-00',
  `sueldo_basico` float NOT NULL default '0',
  `asignaciones` float NOT NULL default '0',
  `causa_egreso` varchar(200) NOT NULL default '',
  `fecha_egreso` date default NULL,
  `fecha_ingreso` date NOT NULL default '0000-00-00',
  `observaciones` text NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) unsigned NOT NULL default '0',
  `paso` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_cargo`
-- 

INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 14, 4051711, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 15, 4512285, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 16, 8385761, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'CONDUCTOR', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 17, 3670594, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 18, 5477294, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 21, 4654397, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE PRESUPUESTO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 20, 9303416, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE PRESUPUESTO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 22, 12222156, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 23, 4018459, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 24, 9308955, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 25, 5477905, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 26, 8442192, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 27, 8926627, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE PRESUPUESTO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 28, 8388339, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 29, 8378076, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'SECRETARIA I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 30, 12224570, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 31, 8392072, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 32, 8381570, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ARCHIVISTA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 33, 12225307, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 34, 4649004, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 35, 5473836, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'PROGRAMADOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 36, 11144676, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'SECRETARIA I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 37, 6428161, 2);
INSERT INTO `integrantes_cargo` VALUES ('', 'SECRETARIA III', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 38, 8396643, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'SECRETARIA III', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 39, 11142484, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE PRESUPUESTO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 40, 5476102, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ASISTENTE ADMINISTRATIVO', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 41, 12506912, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'CONDUCTOR', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 42, 8392561, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'CONDUCTOR', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 43, 4271638, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'SECRETARIA II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1008', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 44, 5589301, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'RECEPCIONISTA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 45, 8398597, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'RECEPCIONISTA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 46, 12669638, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ASISTENTE DE PERSONAL', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 48, 5721970, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'OPERADOR DE FOTOCOPOADORA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 49, 13541356, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR ASISTENTE', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 50, 3946767, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 60, 6966895, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR COORDINADOR', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 59, 8470624, 4);
INSERT INTO `integrantes_cargo` VALUES ('', 'CONTRALOR DEL ESTADO', '90', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 61, 4650716, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 62, 6177583, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 63, 12661621, 4);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1008', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 109, 6122659, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 65, 4647928, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1008', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 115, 13541970, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1008', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 114, 12673593, 1);
INSERT INTO `integrantes_cargo` VALUES ('', 'INSPECTOR DE OBRAS I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 113, 14543612, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 112, 4652451, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR ASISTENTE', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 111, 5605331, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'PROGRAMADOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 84, 11855143, 4);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR COORDINADOR', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 110, 8385744, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 86, 4651478, 4);
INSERT INTO `integrantes_cargo` VALUES ('', 'INSPECTOR DE OBRAS III', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 87, 5482954, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 88, 13023459, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 108, 5482703, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'INSPECTOR COORDINADOR', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 92, 8566093, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 93, 5482594, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR COORDINADOR', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 94, 11536888, 6);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIBUJANTE', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 95, 11142532, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 96, 11852605, 5);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 97, 13729622, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'COORDINADOR DE INFORMATICA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 98, 14055011, 6);
INSERT INTO `integrantes_cargo` VALUES ('', 'ABOGADO COORDINADOR', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 99, 5482007, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 100, 5643691, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE ORGANIZACION Y SISTEMAS II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 101, 13668974, 5);
INSERT INTO `integrantes_cargo` VALUES ('', 'ANALISTA DE PERSONAL III', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1002', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 102, 11506606, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1007', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 103, 1157385, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'COORDINADOR COMUNICACIONAL', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 104, 9425982, 5);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 105, 12920483, 3);
INSERT INTO `integrantes_cargo` VALUES ('', 'COORDINADOR DE ADMINISTRACION', '50', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 106, 5972426, 5);
INSERT INTO `integrantes_cargo` VALUES ('', 'INSPECTOR DE OBRAS I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 107, 14685167, 1);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 116, 15422391, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 117, 15896190, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUXILIAR DE OFICINA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 118, 3826253, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'PROGRAMADOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 119, 12506760, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'ARCHIVISTA', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1003', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 120, 4983744, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'DIRECTOR', '70', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 121, 9429622, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'GUIA PROTOCOLAR', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1004', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 122, 12223561, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 123, 15423652, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 124, 10519925, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'INSPECTOR DE OBRAS I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1005', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 125, 13190579, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'PROGRAMADOR II', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1001', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 126, 13424082, 0);
INSERT INTO `integrantes_cargo` VALUES ('', 'AUDITOR I', '30', 'FIJO', '', '0000-00-00', '0000-00-00', '', '1006', '', '0000-00-00', 0, 0, '', '0000-00-00', '0000-00-00', '', 127, 6727828, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_conceptos`
-- 

CREATE TABLE `integrantes_conceptos` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) unsigned NOT NULL default '0',
  `cod_concepto` varchar(4) NOT NULL default '',
  PRIMARY KEY  (`cedula`,`cod_concepto`),
  UNIQUE KEY `id` (`id`),
  KEY `cod_concepto` (`cod_concepto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=829 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_conceptos`
-- 

INSERT INTO `integrantes_conceptos` VALUES (7, 6966895, '0003');
INSERT INTO `integrantes_conceptos` VALUES (8, 6966895, '0004');
INSERT INTO `integrantes_conceptos` VALUES (9, 6966895, '0001');
INSERT INTO `integrantes_conceptos` VALUES (10, 6966895, '0005');
INSERT INTO `integrantes_conceptos` VALUES (457, 5482594, '0014');
INSERT INTO `integrantes_conceptos` VALUES (15, 5605331, '0001');
INSERT INTO `integrantes_conceptos` VALUES (16, 5605331, '0004');
INSERT INTO `integrantes_conceptos` VALUES (456, 13023459, '0014');
INSERT INTO `integrantes_conceptos` VALUES (18, 5605331, '0005');
INSERT INTO `integrantes_conceptos` VALUES (19, 6122659, '0001');
INSERT INTO `integrantes_conceptos` VALUES (20, 6122659, '0003');
INSERT INTO `integrantes_conceptos` VALUES (21, 6122659, '0004');
INSERT INTO `integrantes_conceptos` VALUES (768, 2834521, '1000');
INSERT INTO `integrantes_conceptos` VALUES (23, 6122659, '0005');
INSERT INTO `integrantes_conceptos` VALUES (767, 2827764, '0004');
INSERT INTO `integrantes_conceptos` VALUES (25, 13023459, '0001');
INSERT INTO `integrantes_conceptos` VALUES (26, 13023459, '0003');
INSERT INTO `integrantes_conceptos` VALUES (27, 13023459, '0004');
INSERT INTO `integrantes_conceptos` VALUES (454, 6122659, '0014');
INSERT INTO `integrantes_conceptos` VALUES (29, 13023459, '0005');
INSERT INTO `integrantes_conceptos` VALUES (766, 2827764, '1000');
INSERT INTO `integrantes_conceptos` VALUES (31, 4650716, '0003');
INSERT INTO `integrantes_conceptos` VALUES (32, 4650716, '0004');
INSERT INTO `integrantes_conceptos` VALUES (765, 2832775, '0002');
INSERT INTO `integrantes_conceptos` VALUES (34, 4650716, '0005');
INSERT INTO `integrantes_conceptos` VALUES (453, 5605331, '0014');
INSERT INTO `integrantes_conceptos` VALUES (36, 5605331, '0008');
INSERT INTO `integrantes_conceptos` VALUES (37, 5605331, '1000');
INSERT INTO `integrantes_conceptos` VALUES (38, 5605331, '0003');
INSERT INTO `integrantes_conceptos` VALUES (764, 2832775, '0004');
INSERT INTO `integrantes_conceptos` VALUES (40, 5605331, '0002');
INSERT INTO `integrantes_conceptos` VALUES (763, 2832775, '1000');
INSERT INTO `integrantes_conceptos` VALUES (762, 8384048, '1000');
INSERT INTO `integrantes_conceptos` VALUES (761, 2162209, '0004');
INSERT INTO `integrantes_conceptos` VALUES (760, 2162209, '1000');
INSERT INTO `integrantes_conceptos` VALUES (759, 3823341, '1000');
INSERT INTO `integrantes_conceptos` VALUES (758, 4656965, '1000');
INSERT INTO `integrantes_conceptos` VALUES (757, 3822286, '0002');
INSERT INTO `integrantes_conceptos` VALUES (756, 3822286, '0004');
INSERT INTO `integrantes_conceptos` VALUES (754, 1882215, '0004');
INSERT INTO `integrantes_conceptos` VALUES (50, 4051711, '0003');
INSERT INTO `integrantes_conceptos` VALUES (51, 4512285, '0003');
INSERT INTO `integrantes_conceptos` VALUES (52, 8385761, '0003');
INSERT INTO `integrantes_conceptos` VALUES (53, 3670594, '0003');
INSERT INTO `integrantes_conceptos` VALUES (54, 5477294, '0003');
INSERT INTO `integrantes_conceptos` VALUES (55, 9303416, '0003');
INSERT INTO `integrantes_conceptos` VALUES (56, 4654397, '0003');
INSERT INTO `integrantes_conceptos` VALUES (57, 11829028, '0003');
INSERT INTO `integrantes_conceptos` VALUES (58, 12222156, '0003');
INSERT INTO `integrantes_conceptos` VALUES (59, 4018459, '0003');
INSERT INTO `integrantes_conceptos` VALUES (60, 9308955, '0003');
INSERT INTO `integrantes_conceptos` VALUES (61, 5477905, '0003');
INSERT INTO `integrantes_conceptos` VALUES (62, 8442192, '0003');
INSERT INTO `integrantes_conceptos` VALUES (63, 8926627, '0003');
INSERT INTO `integrantes_conceptos` VALUES (64, 8388339, '0003');
INSERT INTO `integrantes_conceptos` VALUES (65, 8378076, '0003');
INSERT INTO `integrantes_conceptos` VALUES (66, 12224570, '0003');
INSERT INTO `integrantes_conceptos` VALUES (67, 8392072, '0003');
INSERT INTO `integrantes_conceptos` VALUES (68, 8381570, '0003');
INSERT INTO `integrantes_conceptos` VALUES (69, 13669573, '0003');
INSERT INTO `integrantes_conceptos` VALUES (70, 12225307, '0003');
INSERT INTO `integrantes_conceptos` VALUES (71, 5482703, '0003');
INSERT INTO `integrantes_conceptos` VALUES (72, 4649004, '0003');
INSERT INTO `integrantes_conceptos` VALUES (73, 5473836, '0003');
INSERT INTO `integrantes_conceptos` VALUES (74, 11144676, '0003');
INSERT INTO `integrantes_conceptos` VALUES (75, 6428161, '0003');
INSERT INTO `integrantes_conceptos` VALUES (76, 8396643, '0003');
INSERT INTO `integrantes_conceptos` VALUES (77, 11142484, '0003');
INSERT INTO `integrantes_conceptos` VALUES (78, 5476102, '0003');
INSERT INTO `integrantes_conceptos` VALUES (79, 12506912, '0003');
INSERT INTO `integrantes_conceptos` VALUES (80, 8392561, '0003');
INSERT INTO `integrantes_conceptos` VALUES (81, 4271638, '0003');
INSERT INTO `integrantes_conceptos` VALUES (82, 5589301, '0003');
INSERT INTO `integrantes_conceptos` VALUES (83, 8398597, '0003');
INSERT INTO `integrantes_conceptos` VALUES (84, 12669638, '0003');
INSERT INTO `integrantes_conceptos` VALUES (85, 5721970, '0003');
INSERT INTO `integrantes_conceptos` VALUES (86, 13541356, '0003');
INSERT INTO `integrantes_conceptos` VALUES (87, 3946767, '0003');
INSERT INTO `integrantes_conceptos` VALUES (88, 8470624, '0003');
INSERT INTO `integrantes_conceptos` VALUES (89, 6177583, '0003');
INSERT INTO `integrantes_conceptos` VALUES (90, 12661621, '0003');
INSERT INTO `integrantes_conceptos` VALUES (91, 4647928, '0003');
INSERT INTO `integrantes_conceptos` VALUES (92, 4651478, '0003');
INSERT INTO `integrantes_conceptos` VALUES (93, 5482954, '0003');
INSERT INTO `integrantes_conceptos` VALUES (94, 8385744, '0003');
INSERT INTO `integrantes_conceptos` VALUES (95, 11855143, '0003');
INSERT INTO `integrantes_conceptos` VALUES (96, 8566093, '0003');
INSERT INTO `integrantes_conceptos` VALUES (97, 5482594, '0003');
INSERT INTO `integrantes_conceptos` VALUES (98, 11536888, '0003');
INSERT INTO `integrantes_conceptos` VALUES (99, 11142532, '0003');
INSERT INTO `integrantes_conceptos` VALUES (100, 11852605, '0003');
INSERT INTO `integrantes_conceptos` VALUES (101, 13729622, '0003');
INSERT INTO `integrantes_conceptos` VALUES (102, 4652451, '0003');
INSERT INTO `integrantes_conceptos` VALUES (103, 14055011, '0003');
INSERT INTO `integrantes_conceptos` VALUES (104, 5482007, '0003');
INSERT INTO `integrantes_conceptos` VALUES (105, 8390397, '0003');
INSERT INTO `integrantes_conceptos` VALUES (107, 5643691, '0003');
INSERT INTO `integrantes_conceptos` VALUES (108, 7164093, '0003');
INSERT INTO `integrantes_conceptos` VALUES (109, 11506606, '0003');
INSERT INTO `integrantes_conceptos` VALUES (110, 13668974, '0003');
INSERT INTO `integrantes_conceptos` VALUES (111, 9425982, '0003');
INSERT INTO `integrantes_conceptos` VALUES (112, 12920483, '0003');
INSERT INTO `integrantes_conceptos` VALUES (113, 5972426, '0003');
INSERT INTO `integrantes_conceptos` VALUES (114, 9429622, '0003');
INSERT INTO `integrantes_conceptos` VALUES (115, 12223561, '0003');
INSERT INTO `integrantes_conceptos` VALUES (116, 15423652, '0003');
INSERT INTO `integrantes_conceptos` VALUES (117, 10519925, '0003');
INSERT INTO `integrantes_conceptos` VALUES (118, 13190579, '0003');
INSERT INTO `integrantes_conceptos` VALUES (119, 13424082, '0003');
INSERT INTO `integrantes_conceptos` VALUES (120, 14685167, '0003');
INSERT INTO `integrantes_conceptos` VALUES (121, 6727828, '0003');
INSERT INTO `integrantes_conceptos` VALUES (122, 14543612, '0003');
INSERT INTO `integrantes_conceptos` VALUES (123, 4983744, '0003');
INSERT INTO `integrantes_conceptos` VALUES (124, 3946767, '0004');
INSERT INTO `integrantes_conceptos` VALUES (125, 5482594, '0004');
INSERT INTO `integrantes_conceptos` VALUES (126, 13729622, '0004');
INSERT INTO `integrantes_conceptos` VALUES (753, 1882215, '0002');
INSERT INTO `integrantes_conceptos` VALUES (128, 13729622, '0001');
INSERT INTO `integrantes_conceptos` VALUES (129, 3946767, '0001');
INSERT INTO `integrantes_conceptos` VALUES (130, 9429622, '0001');
INSERT INTO `integrantes_conceptos` VALUES (131, 5482594, '0001');
INSERT INTO `integrantes_conceptos` VALUES (132, 6177583, '0001');
INSERT INTO `integrantes_conceptos` VALUES (133, 4051711, '0005');
INSERT INTO `integrantes_conceptos` VALUES (134, 4512285, '0005');
INSERT INTO `integrantes_conceptos` VALUES (135, 8385761, '0005');
INSERT INTO `integrantes_conceptos` VALUES (136, 3670594, '0005');
INSERT INTO `integrantes_conceptos` VALUES (137, 5477294, '0005');
INSERT INTO `integrantes_conceptos` VALUES (138, 9303416, '0005');
INSERT INTO `integrantes_conceptos` VALUES (139, 4654397, '0005');
INSERT INTO `integrantes_conceptos` VALUES (140, 10204661, '0005');
INSERT INTO `integrantes_conceptos` VALUES (141, 11829028, '0005');
INSERT INTO `integrantes_conceptos` VALUES (142, 12222156, '0005');
INSERT INTO `integrantes_conceptos` VALUES (143, 4018459, '0005');
INSERT INTO `integrantes_conceptos` VALUES (144, 9308955, '0005');
INSERT INTO `integrantes_conceptos` VALUES (145, 5477905, '0005');
INSERT INTO `integrantes_conceptos` VALUES (146, 8442192, '0005');
INSERT INTO `integrantes_conceptos` VALUES (147, 8926627, '0005');
INSERT INTO `integrantes_conceptos` VALUES (148, 8388339, '0005');
INSERT INTO `integrantes_conceptos` VALUES (149, 8378076, '0005');
INSERT INTO `integrantes_conceptos` VALUES (150, 12224570, '0005');
INSERT INTO `integrantes_conceptos` VALUES (151, 8392072, '0005');
INSERT INTO `integrantes_conceptos` VALUES (152, 8381570, '0005');
INSERT INTO `integrantes_conceptos` VALUES (153, 13669573, '0005');
INSERT INTO `integrantes_conceptos` VALUES (154, 12225307, '0005');
INSERT INTO `integrantes_conceptos` VALUES (155, 5482703, '0005');
INSERT INTO `integrantes_conceptos` VALUES (156, 4649004, '0005');
INSERT INTO `integrantes_conceptos` VALUES (157, 8382049, '0005');
INSERT INTO `integrantes_conceptos` VALUES (158, 5473836, '0005');
INSERT INTO `integrantes_conceptos` VALUES (159, 4654821, '0005');
INSERT INTO `integrantes_conceptos` VALUES (160, 5480903, '0005');
INSERT INTO `integrantes_conceptos` VALUES (161, 4648525, '0005');
INSERT INTO `integrantes_conceptos` VALUES (162, 4653768, '0005');
INSERT INTO `integrantes_conceptos` VALUES (163, 4189050, '0005');
INSERT INTO `integrantes_conceptos` VALUES (164, 11144676, '0005');
INSERT INTO `integrantes_conceptos` VALUES (165, 6428161, '0005');
INSERT INTO `integrantes_conceptos` VALUES (166, 8396643, '0005');
INSERT INTO `integrantes_conceptos` VALUES (167, 11142484, '0005');
INSERT INTO `integrantes_conceptos` VALUES (168, 5476102, '0005');
INSERT INTO `integrantes_conceptos` VALUES (169, 12506912, '0005');
INSERT INTO `integrantes_conceptos` VALUES (170, 8392561, '0005');
INSERT INTO `integrantes_conceptos` VALUES (171, 4271638, '0005');
INSERT INTO `integrantes_conceptos` VALUES (172, 5589301, '0005');
INSERT INTO `integrantes_conceptos` VALUES (173, 8398597, '0005');
INSERT INTO `integrantes_conceptos` VALUES (174, 12669638, '0005');
INSERT INTO `integrantes_conceptos` VALUES (175, 5721970, '0005');
INSERT INTO `integrantes_conceptos` VALUES (176, 13541356, '0005');
INSERT INTO `integrantes_conceptos` VALUES (177, 4647270, '0005');
INSERT INTO `integrantes_conceptos` VALUES (178, 3946767, '0005');
INSERT INTO `integrantes_conceptos` VALUES (179, 3824167, '0005');
INSERT INTO `integrantes_conceptos` VALUES (180, 8470624, '0005');
INSERT INTO `integrantes_conceptos` VALUES (181, 6177583, '0005');
INSERT INTO `integrantes_conceptos` VALUES (182, 12661621, '0005');
INSERT INTO `integrantes_conceptos` VALUES (183, 4647928, '0005');
INSERT INTO `integrantes_conceptos` VALUES (184, 4651478, '0005');
INSERT INTO `integrantes_conceptos` VALUES (185, 5482954, '0005');
INSERT INTO `integrantes_conceptos` VALUES (186, 8385744, '0005');
INSERT INTO `integrantes_conceptos` VALUES (187, 11855143, '0005');
INSERT INTO `integrantes_conceptos` VALUES (188, 8566093, '0005');
INSERT INTO `integrantes_conceptos` VALUES (189, 4422887, '0005');
INSERT INTO `integrantes_conceptos` VALUES (190, 5482594, '0005');
INSERT INTO `integrantes_conceptos` VALUES (191, 11536888, '0005');
INSERT INTO `integrantes_conceptos` VALUES (192, 4656784, '0005');
INSERT INTO `integrantes_conceptos` VALUES (193, 11142532, '0005');
INSERT INTO `integrantes_conceptos` VALUES (194, 11852605, '0005');
INSERT INTO `integrantes_conceptos` VALUES (195, 13729622, '0005');
INSERT INTO `integrantes_conceptos` VALUES (196, 4652451, '0005');
INSERT INTO `integrantes_conceptos` VALUES (197, 10214381, '0005');
INSERT INTO `integrantes_conceptos` VALUES (198, 4583844, '0005');
INSERT INTO `integrantes_conceptos` VALUES (199, 14055011, '0005');
INSERT INTO `integrantes_conceptos` VALUES (200, 5482007, '0005');
INSERT INTO `integrantes_conceptos` VALUES (201, 8390397, '0005');
INSERT INTO `integrantes_conceptos` VALUES (203, 5643691, '0005');
INSERT INTO `integrantes_conceptos` VALUES (204, 11143327, '0005');
INSERT INTO `integrantes_conceptos` VALUES (205, 5885859, '0005');
INSERT INTO `integrantes_conceptos` VALUES (206, 7164093, '0005');
INSERT INTO `integrantes_conceptos` VALUES (207, 4656077, '0005');
INSERT INTO `integrantes_conceptos` VALUES (208, 11506606, '0005');
INSERT INTO `integrantes_conceptos` VALUES (209, 13668974, '0005');
INSERT INTO `integrantes_conceptos` VALUES (210, 14220083, '0005');
INSERT INTO `integrantes_conceptos` VALUES (211, 9425982, '0005');
INSERT INTO `integrantes_conceptos` VALUES (212, 12920483, '0005');
INSERT INTO `integrantes_conceptos` VALUES (213, 5972426, '0005');
INSERT INTO `integrantes_conceptos` VALUES (214, 9429622, '0005');
INSERT INTO `integrantes_conceptos` VALUES (215, 12223561, '0005');
INSERT INTO `integrantes_conceptos` VALUES (216, 15423652, '0005');
INSERT INTO `integrantes_conceptos` VALUES (217, 10519925, '0005');
INSERT INTO `integrantes_conceptos` VALUES (218, 13848164, '0005');
INSERT INTO `integrantes_conceptos` VALUES (219, 13190579, '0005');
INSERT INTO `integrantes_conceptos` VALUES (220, 13424082, '0005');
INSERT INTO `integrantes_conceptos` VALUES (221, 13848264, '0005');
INSERT INTO `integrantes_conceptos` VALUES (222, 14685167, '0005');
INSERT INTO `integrantes_conceptos` VALUES (223, 6727828, '0005');
INSERT INTO `integrantes_conceptos` VALUES (224, 14543612, '0005');
INSERT INTO `integrantes_conceptos` VALUES (225, 4983744, '0005');
INSERT INTO `integrantes_conceptos` VALUES (226, 222222222, '0005');
INSERT INTO `integrantes_conceptos` VALUES (452, 6177583, '0014');
INSERT INTO `integrantes_conceptos` VALUES (451, 6966895, '0014');
INSERT INTO `integrantes_conceptos` VALUES (450, 9429622, '0014');
INSERT INTO `integrantes_conceptos` VALUES (449, 13729622, '0014');
INSERT INTO `integrantes_conceptos` VALUES (231, 6122659, '0002');
INSERT INTO `integrantes_conceptos` VALUES (232, 3946767, '0002');
INSERT INTO `integrantes_conceptos` VALUES (233, 13023459, '0002');
INSERT INTO `integrantes_conceptos` VALUES (234, 5482594, '0002');
INSERT INTO `integrantes_conceptos` VALUES (769, 2834521, '0004');
INSERT INTO `integrantes_conceptos` VALUES (236, 6966895, '0002');
INSERT INTO `integrantes_conceptos` VALUES (237, 13729622, '0002');
INSERT INTO `integrantes_conceptos` VALUES (459, 4051711, '1000');
INSERT INTO `integrantes_conceptos` VALUES (239, 4512285, '1000');
INSERT INTO `integrantes_conceptos` VALUES (240, 8385761, '1000');
INSERT INTO `integrantes_conceptos` VALUES (241, 3670594, '1000');
INSERT INTO `integrantes_conceptos` VALUES (242, 5477294, '1000');
INSERT INTO `integrantes_conceptos` VALUES (243, 9303416, '1000');
INSERT INTO `integrantes_conceptos` VALUES (244, 4654397, '1000');
INSERT INTO `integrantes_conceptos` VALUES (245, 10204661, '1000');
INSERT INTO `integrantes_conceptos` VALUES (246, 11829028, '1000');
INSERT INTO `integrantes_conceptos` VALUES (247, 12222156, '1000');
INSERT INTO `integrantes_conceptos` VALUES (248, 2803086, '1000');
INSERT INTO `integrantes_conceptos` VALUES (249, 4018459, '1000');
INSERT INTO `integrantes_conceptos` VALUES (250, 9308955, '1000');
INSERT INTO `integrantes_conceptos` VALUES (251, 5477905, '1000');
INSERT INTO `integrantes_conceptos` VALUES (252, 8442192, '1000');
INSERT INTO `integrantes_conceptos` VALUES (253, 8926627, '1000');
INSERT INTO `integrantes_conceptos` VALUES (254, 8388339, '1000');
INSERT INTO `integrantes_conceptos` VALUES (255, 8378076, '1000');
INSERT INTO `integrantes_conceptos` VALUES (256, 12224570, '1000');
INSERT INTO `integrantes_conceptos` VALUES (257, 8392072, '1000');
INSERT INTO `integrantes_conceptos` VALUES (258, 8381570, '1000');
INSERT INTO `integrantes_conceptos` VALUES (259, 1157385, '1000');
INSERT INTO `integrantes_conceptos` VALUES (260, 13669573, '1000');
INSERT INTO `integrantes_conceptos` VALUES (261, 12225307, '1000');
INSERT INTO `integrantes_conceptos` VALUES (262, 5482703, '1000');
INSERT INTO `integrantes_conceptos` VALUES (263, 4649004, '1000');
INSERT INTO `integrantes_conceptos` VALUES (264, 1633192, '1000');
INSERT INTO `integrantes_conceptos` VALUES (265, 8382049, '1000');
INSERT INTO `integrantes_conceptos` VALUES (266, 5473836, '1000');
INSERT INTO `integrantes_conceptos` VALUES (267, 4654821, '1000');
INSERT INTO `integrantes_conceptos` VALUES (268, 3486366, '1000');
INSERT INTO `integrantes_conceptos` VALUES (269, 5480903, '1000');
INSERT INTO `integrantes_conceptos` VALUES (270, 4648525, '1000');
INSERT INTO `integrantes_conceptos` VALUES (271, 4653768, '1000');
INSERT INTO `integrantes_conceptos` VALUES (272, 4189050, '1000');
INSERT INTO `integrantes_conceptos` VALUES (273, 11144676, '1000');
INSERT INTO `integrantes_conceptos` VALUES (274, 6428161, '1000');
INSERT INTO `integrantes_conceptos` VALUES (275, 8396643, '1000');
INSERT INTO `integrantes_conceptos` VALUES (276, 11142484, '1000');
INSERT INTO `integrantes_conceptos` VALUES (277, 5476102, '1000');
INSERT INTO `integrantes_conceptos` VALUES (278, 12506912, '1000');
INSERT INTO `integrantes_conceptos` VALUES (279, 8392561, '1000');
INSERT INTO `integrantes_conceptos` VALUES (280, 4271638, '1000');
INSERT INTO `integrantes_conceptos` VALUES (281, 5589301, '1000');
INSERT INTO `integrantes_conceptos` VALUES (282, 8398597, '1000');
INSERT INTO `integrantes_conceptos` VALUES (283, 12669638, '1000');
INSERT INTO `integrantes_conceptos` VALUES (284, 5721970, '1000');
INSERT INTO `integrantes_conceptos` VALUES (285, 13541356, '1000');
INSERT INTO `integrantes_conceptos` VALUES (286, 4647270, '1000');
INSERT INTO `integrantes_conceptos` VALUES (287, 3946767, '1000');
INSERT INTO `integrantes_conceptos` VALUES (288, 3824167, '1000');
INSERT INTO `integrantes_conceptos` VALUES (289, 8470624, '1000');
INSERT INTO `integrantes_conceptos` VALUES (290, 6966895, '1000');
INSERT INTO `integrantes_conceptos` VALUES (291, 4650716, '1000');
INSERT INTO `integrantes_conceptos` VALUES (292, 6177583, '1000');
INSERT INTO `integrantes_conceptos` VALUES (293, 1882215, '1000');
INSERT INTO `integrantes_conceptos` VALUES (294, 12661621, '1000');
INSERT INTO `integrantes_conceptos` VALUES (295, 6122659, '1000');
INSERT INTO `integrantes_conceptos` VALUES (296, 4647928, '1000');
INSERT INTO `integrantes_conceptos` VALUES (297, 4651478, '1000');
INSERT INTO `integrantes_conceptos` VALUES (298, 5482954, '1000');
INSERT INTO `integrantes_conceptos` VALUES (299, 13023459, '1000');
INSERT INTO `integrantes_conceptos` VALUES (300, 8385744, '1000');
INSERT INTO `integrantes_conceptos` VALUES (301, 11855143, '1000');
INSERT INTO `integrantes_conceptos` VALUES (302, 8566093, '1000');
INSERT INTO `integrantes_conceptos` VALUES (303, 4422887, '1000');
INSERT INTO `integrantes_conceptos` VALUES (304, 5482594, '1000');
INSERT INTO `integrantes_conceptos` VALUES (305, 11536888, '1000');
INSERT INTO `integrantes_conceptos` VALUES (306, 4656784, '1000');
INSERT INTO `integrantes_conceptos` VALUES (307, 11142532, '1000');
INSERT INTO `integrantes_conceptos` VALUES (308, 11852605, '1000');
INSERT INTO `integrantes_conceptos` VALUES (309, 13729622, '1000');
INSERT INTO `integrantes_conceptos` VALUES (310, 4652451, '1000');
INSERT INTO `integrantes_conceptos` VALUES (311, 10214381, '1000');
INSERT INTO `integrantes_conceptos` VALUES (312, 4583844, '1000');
INSERT INTO `integrantes_conceptos` VALUES (313, 14055011, '1000');
INSERT INTO `integrantes_conceptos` VALUES (314, 5482007, '1000');
INSERT INTO `integrantes_conceptos` VALUES (315, 8390397, '1000');
INSERT INTO `integrantes_conceptos` VALUES (316, 3822286, '1000');
INSERT INTO `integrantes_conceptos` VALUES (317, 1320383, '1000');
INSERT INTO `integrantes_conceptos` VALUES (318, 2832725, '1000');
INSERT INTO `integrantes_conceptos` VALUES (319, 2826195, '1000');
INSERT INTO `integrantes_conceptos` VALUES (320, 4051700, '1000');
INSERT INTO `integrantes_conceptos` VALUES (321, 3488626, '1000');
INSERT INTO `integrantes_conceptos` VALUES (322, 3487152, '1000');
INSERT INTO `integrantes_conceptos` VALUES (323, 3489278, '1000');
INSERT INTO `integrantes_conceptos` VALUES (324, 5643691, '1000');
INSERT INTO `integrantes_conceptos` VALUES (325, 3488376, '1000');
INSERT INTO `integrantes_conceptos` VALUES (326, 879613, '1000');
INSERT INTO `integrantes_conceptos` VALUES (327, 3045299, '1000');
INSERT INTO `integrantes_conceptos` VALUES (328, 11143327, '1000');
INSERT INTO `integrantes_conceptos` VALUES (329, 5885859, '1000');
INSERT INTO `integrantes_conceptos` VALUES (330, 1748998, '1000');
INSERT INTO `integrantes_conceptos` VALUES (331, 7164093, '1000');
INSERT INTO `integrantes_conceptos` VALUES (332, 4656077, '1000');
INSERT INTO `integrantes_conceptos` VALUES (333, 2168112, '1000');
INSERT INTO `integrantes_conceptos` VALUES (334, 2166981, '1000');
INSERT INTO `integrantes_conceptos` VALUES (335, 11506606, '1000');
INSERT INTO `integrantes_conceptos` VALUES (336, 13668974, '1000');
INSERT INTO `integrantes_conceptos` VALUES (337, 14220083, '1000');
INSERT INTO `integrantes_conceptos` VALUES (338, 9425982, '1000');
INSERT INTO `integrantes_conceptos` VALUES (339, 12920483, '1000');
INSERT INTO `integrantes_conceptos` VALUES (340, 5972426, '1000');
INSERT INTO `integrantes_conceptos` VALUES (341, 9429622, '1000');
INSERT INTO `integrantes_conceptos` VALUES (342, 12223561, '1000');
INSERT INTO `integrantes_conceptos` VALUES (343, 15423652, '1000');
INSERT INTO `integrantes_conceptos` VALUES (344, 10519925, '1000');
INSERT INTO `integrantes_conceptos` VALUES (345, 13848164, '1000');
INSERT INTO `integrantes_conceptos` VALUES (346, 13190579, '1000');
INSERT INTO `integrantes_conceptos` VALUES (347, 13424082, '1000');
INSERT INTO `integrantes_conceptos` VALUES (348, 13848264, '1000');
INSERT INTO `integrantes_conceptos` VALUES (349, 14685167, '1000');
INSERT INTO `integrantes_conceptos` VALUES (350, 6727828, '1000');
INSERT INTO `integrantes_conceptos` VALUES (351, 14543612, '1000');
INSERT INTO `integrantes_conceptos` VALUES (352, 4983744, '1000');
INSERT INTO `integrantes_conceptos` VALUES (353, 2155158, '1000');
INSERT INTO `integrantes_conceptos` VALUES (354, 222222222, '1000');
INSERT INTO `integrantes_conceptos` VALUES (355, 13729622, '0008');
INSERT INTO `integrantes_conceptos` VALUES (462, 4051711, '0001');
INSERT INTO `integrantes_conceptos` VALUES (357, 4512285, '0008');
INSERT INTO `integrantes_conceptos` VALUES (701, 8470624, '0006');
INSERT INTO `integrantes_conceptos` VALUES (622, 3670594, '0007');
INSERT INTO `integrantes_conceptos` VALUES (360, 5477294, '0008');
INSERT INTO `integrantes_conceptos` VALUES (711, 9303416, '0002');
INSERT INTO `integrantes_conceptos` VALUES (362, 4654397, '0008');
INSERT INTO `integrantes_conceptos` VALUES (363, 11829028, '0008');
INSERT INTO `integrantes_conceptos` VALUES (364, 12222156, '0008');
INSERT INTO `integrantes_conceptos` VALUES (644, 4051711, '0002');
INSERT INTO `integrantes_conceptos` VALUES (366, 9308955, '0008');
INSERT INTO `integrantes_conceptos` VALUES (367, 5477905, '0008');
INSERT INTO `integrantes_conceptos` VALUES (633, 8442192, '0002');
INSERT INTO `integrantes_conceptos` VALUES (369, 8926627, '0008');
INSERT INTO `integrantes_conceptos` VALUES (370, 8388339, '0008');
INSERT INTO `integrantes_conceptos` VALUES (371, 8378076, '0008');
INSERT INTO `integrantes_conceptos` VALUES (615, 12224570, '0002');
INSERT INTO `integrantes_conceptos` VALUES (373, 8392072, '0008');
INSERT INTO `integrantes_conceptos` VALUES (663, 8381570, '0004');
INSERT INTO `integrantes_conceptos` VALUES (375, 13669573, '0008');
INSERT INTO `integrantes_conceptos` VALUES (376, 12225307, '0008');
INSERT INTO `integrantes_conceptos` VALUES (620, 5482703, '0010');
INSERT INTO `integrantes_conceptos` VALUES (639, 4018459, '0002');
INSERT INTO `integrantes_conceptos` VALUES (379, 8382049, '0008');
INSERT INTO `integrantes_conceptos` VALUES (380, 5473836, '0008');
INSERT INTO `integrantes_conceptos` VALUES (381, 4654821, '0008');
INSERT INTO `integrantes_conceptos` VALUES (382, 11144676, '0008');
INSERT INTO `integrantes_conceptos` VALUES (383, 6428161, '0008');
INSERT INTO `integrantes_conceptos` VALUES (384, 8396643, '0008');
INSERT INTO `integrantes_conceptos` VALUES (385, 11142484, '0008');
INSERT INTO `integrantes_conceptos` VALUES (386, 5476102, '0008');
INSERT INTO `integrantes_conceptos` VALUES (387, 12506912, '0008');
INSERT INTO `integrantes_conceptos` VALUES (585, 8392561, '0009');
INSERT INTO `integrantes_conceptos` VALUES (659, 8381570, '0001');
INSERT INTO `integrantes_conceptos` VALUES (687, 5589301, '0002');
INSERT INTO `integrantes_conceptos` VALUES (391, 8398597, '0008');
INSERT INTO `integrantes_conceptos` VALUES (392, 12669638, '0008');
INSERT INTO `integrantes_conceptos` VALUES (393, 5721970, '0008');
INSERT INTO `integrantes_conceptos` VALUES (592, 13541356, '0007');
INSERT INTO `integrantes_conceptos` VALUES (395, 4647270, '0008');
INSERT INTO `integrantes_conceptos` VALUES (396, 3946767, '0008');
INSERT INTO `integrantes_conceptos` VALUES (397, 8470624, '0008');
INSERT INTO `integrantes_conceptos` VALUES (398, 6966895, '0008');
INSERT INTO `integrantes_conceptos` VALUES (399, 4650716, '0008');
INSERT INTO `integrantes_conceptos` VALUES (400, 6177583, '0008');
INSERT INTO `integrantes_conceptos` VALUES (401, 12661621, '0008');
INSERT INTO `integrantes_conceptos` VALUES (402, 6122659, '0008');
INSERT INTO `integrantes_conceptos` VALUES (403, 4647928, '0008');
INSERT INTO `integrantes_conceptos` VALUES (404, 4651478, '0008');
INSERT INTO `integrantes_conceptos` VALUES (405, 5482954, '0008');
INSERT INTO `integrantes_conceptos` VALUES (406, 13023459, '0008');
INSERT INTO `integrantes_conceptos` VALUES (407, 8385744, '0008');
INSERT INTO `integrantes_conceptos` VALUES (408, 11855143, '0008');
INSERT INTO `integrantes_conceptos` VALUES (409, 8566093, '0008');
INSERT INTO `integrantes_conceptos` VALUES (410, 5482594, '0008');
INSERT INTO `integrantes_conceptos` VALUES (411, 11536888, '0008');
INSERT INTO `integrantes_conceptos` VALUES (412, 4656784, '0008');
INSERT INTO `integrantes_conceptos` VALUES (413, 11142532, '0008');
INSERT INTO `integrantes_conceptos` VALUES (414, 11852605, '0008');
INSERT INTO `integrantes_conceptos` VALUES (415, 4652451, '0008');
INSERT INTO `integrantes_conceptos` VALUES (416, 14055011, '0008');
INSERT INTO `integrantes_conceptos` VALUES (417, 5482007, '0008');
INSERT INTO `integrantes_conceptos` VALUES (418, 8390397, '0008');
INSERT INTO `integrantes_conceptos` VALUES (828, 4051700, '2021');
INSERT INTO `integrantes_conceptos` VALUES (420, 5643691, '0008');
INSERT INTO `integrantes_conceptos` VALUES (421, 7164093, '0008');
INSERT INTO `integrantes_conceptos` VALUES (422, 4656077, '0008');
INSERT INTO `integrantes_conceptos` VALUES (423, 11506606, '0008');
INSERT INTO `integrantes_conceptos` VALUES (424, 13668974, '0008');
INSERT INTO `integrantes_conceptos` VALUES (425, 9425982, '0008');
INSERT INTO `integrantes_conceptos` VALUES (426, 12920483, '0008');
INSERT INTO `integrantes_conceptos` VALUES (427, 5972426, '0008');
INSERT INTO `integrantes_conceptos` VALUES (428, 9429622, '0008');
INSERT INTO `integrantes_conceptos` VALUES (429, 12223561, '0008');
INSERT INTO `integrantes_conceptos` VALUES (430, 15423652, '0008');
INSERT INTO `integrantes_conceptos` VALUES (431, 10519925, '0008');
INSERT INTO `integrantes_conceptos` VALUES (432, 13190579, '0008');
INSERT INTO `integrantes_conceptos` VALUES (433, 13424082, '0008');
INSERT INTO `integrantes_conceptos` VALUES (434, 14685167, '0008');
INSERT INTO `integrantes_conceptos` VALUES (435, 6727828, '0008');
INSERT INTO `integrantes_conceptos` VALUES (436, 14543612, '0008');
INSERT INTO `integrantes_conceptos` VALUES (437, 4983744, '0008');
INSERT INTO `integrantes_conceptos` VALUES (438, 6122659, '0009');
INSERT INTO `integrantes_conceptos` VALUES (439, 13023459, '0010');
INSERT INTO `integrantes_conceptos` VALUES (700, 8385761, '0006');
INSERT INTO `integrantes_conceptos` VALUES (441, 5482594, '0010');
INSERT INTO `integrantes_conceptos` VALUES (699, 8385761, '0004');
INSERT INTO `integrantes_conceptos` VALUES (443, 4650716, '0001');
INSERT INTO `integrantes_conceptos` VALUES (444, 4650716, '0012');
INSERT INTO `integrantes_conceptos` VALUES (445, 4650716, '0013');
INSERT INTO `integrantes_conceptos` VALUES (446, 4650716, '0010');
INSERT INTO `integrantes_conceptos` VALUES (447, 6966895, '0010');
INSERT INTO `integrantes_conceptos` VALUES (702, 8470624, '0001');
INSERT INTO `integrantes_conceptos` VALUES (458, 4650716, '0014');
INSERT INTO `integrantes_conceptos` VALUES (463, 3946767, '0010');
INSERT INTO `integrantes_conceptos` VALUES (698, 8385761, '0002');
INSERT INTO `integrantes_conceptos` VALUES (697, 8385761, '0001');
INSERT INTO `integrantes_conceptos` VALUES (696, 8385761, '0007');
INSERT INTO `integrantes_conceptos` VALUES (695, 5477294, '0010');
INSERT INTO `integrantes_conceptos` VALUES (694, 5477294, '0007');
INSERT INTO `integrantes_conceptos` VALUES (693, 5477294, '0006');
INSERT INTO `integrantes_conceptos` VALUES (692, 5477294, '0001');
INSERT INTO `integrantes_conceptos` VALUES (691, 5589301, '0007');
INSERT INTO `integrantes_conceptos` VALUES (690, 5589301, '0001');
INSERT INTO `integrantes_conceptos` VALUES (689, 5589301, '0006');
INSERT INTO `integrantes_conceptos` VALUES (688, 5589301, '0004');
INSERT INTO `integrantes_conceptos` VALUES (686, 11852605, '0006');
INSERT INTO `integrantes_conceptos` VALUES (685, 11852605, '0007');
INSERT INTO `integrantes_conceptos` VALUES (684, 11852605, '0004');
INSERT INTO `integrantes_conceptos` VALUES (683, 11852605, '0002');
INSERT INTO `integrantes_conceptos` VALUES (682, 11852605, '0001');
INSERT INTO `integrantes_conceptos` VALUES (681, 12661621, '0004');
INSERT INTO `integrantes_conceptos` VALUES (680, 12661621, '0006');
INSERT INTO `integrantes_conceptos` VALUES (679, 12661621, '0002');
INSERT INTO `integrantes_conceptos` VALUES (678, 12661621, '0001');
INSERT INTO `integrantes_conceptos` VALUES (677, 12661621, '0007');
INSERT INTO `integrantes_conceptos` VALUES (676, 3826253, '1000');
INSERT INTO `integrantes_conceptos` VALUES (675, 3826253, '0003');
INSERT INTO `integrantes_conceptos` VALUES (674, 3826253, '0006');
INSERT INTO `integrantes_conceptos` VALUES (673, 3826253, '0004');
INSERT INTO `integrantes_conceptos` VALUES (671, 4983744, '0006');
INSERT INTO `integrantes_conceptos` VALUES (672, 3826253, '0005');
INSERT INTO `integrantes_conceptos` VALUES (669, 4983744, '0002');
INSERT INTO `integrantes_conceptos` VALUES (668, 4983744, '0004');
INSERT INTO `integrantes_conceptos` VALUES (667, 5972426, '0006');
INSERT INTO `integrantes_conceptos` VALUES (666, 5972426, '0004');
INSERT INTO `integrantes_conceptos` VALUES (665, 5972426, '0001');
INSERT INTO `integrantes_conceptos` VALUES (664, 5972426, '0002');
INSERT INTO `integrantes_conceptos` VALUES (662, 8381570, '0006');
INSERT INTO `integrantes_conceptos` VALUES (661, 8381570, '0007');
INSERT INTO `integrantes_conceptos` VALUES (660, 8381570, '0002');
INSERT INTO `integrantes_conceptos` VALUES (658, 4271638, '0104');
INSERT INTO `integrantes_conceptos` VALUES (657, 4271638, '0006');
INSERT INTO `integrantes_conceptos` VALUES (577, 6122659, '0010');
INSERT INTO `integrantes_conceptos` VALUES (576, 6177583, '0004');
INSERT INTO `integrantes_conceptos` VALUES (656, 4271638, '0007');
INSERT INTO `integrantes_conceptos` VALUES (655, 4271638, '0004');
INSERT INTO `integrantes_conceptos` VALUES (654, 4271638, '0002');
INSERT INTO `integrantes_conceptos` VALUES (653, 4271638, '0001');
INSERT INTO `integrantes_conceptos` VALUES (652, 12225307, '0006');
INSERT INTO `integrantes_conceptos` VALUES (651, 12225307, '0007');
INSERT INTO `integrantes_conceptos` VALUES (650, 12225307, '0004');
INSERT INTO `integrantes_conceptos` VALUES (649, 12225307, '0002');
INSERT INTO `integrantes_conceptos` VALUES (648, 12225307, '0001');
INSERT INTO `integrantes_conceptos` VALUES (579, 9429622, '0010');
INSERT INTO `integrantes_conceptos` VALUES (647, 4051711, '0004');
INSERT INTO `integrantes_conceptos` VALUES (646, 4051711, '0006');
INSERT INTO `integrantes_conceptos` VALUES (645, 4051711, '0007');
INSERT INTO `integrantes_conceptos` VALUES (643, 4018459, '0004');
INSERT INTO `integrantes_conceptos` VALUES (642, 4018459, '0006');
INSERT INTO `integrantes_conceptos` VALUES (641, 4018459, '0007');
INSERT INTO `integrantes_conceptos` VALUES (640, 4018459, '0001');
INSERT INTO `integrantes_conceptos` VALUES (638, 4649004, '0006');
INSERT INTO `integrantes_conceptos` VALUES (637, 4649004, '0004');
INSERT INTO `integrantes_conceptos` VALUES (636, 4649004, '0007');
INSERT INTO `integrantes_conceptos` VALUES (635, 4649004, '0001');
INSERT INTO `integrantes_conceptos` VALUES (634, 4649004, '0002');
INSERT INTO `integrantes_conceptos` VALUES (632, 8442192, '0004');
INSERT INTO `integrantes_conceptos` VALUES (631, 8442192, '0006');
INSERT INTO `integrantes_conceptos` VALUES (630, 8442192, '0001');
INSERT INTO `integrantes_conceptos` VALUES (629, 8442192, '0007');
INSERT INTO `integrantes_conceptos` VALUES (628, 3670594, '0010');
INSERT INTO `integrantes_conceptos` VALUES (627, 3670594, '0002');
INSERT INTO `integrantes_conceptos` VALUES (626, 3670594, '0104');
INSERT INTO `integrantes_conceptos` VALUES (625, 3670594, '0004');
INSERT INTO `integrantes_conceptos` VALUES (624, 3670594, '0001');
INSERT INTO `integrantes_conceptos` VALUES (623, 3670594, '0006');
INSERT INTO `integrantes_conceptos` VALUES (621, 5482703, '0004');
INSERT INTO `integrantes_conceptos` VALUES (619, 5482703, '0006');
INSERT INTO `integrantes_conceptos` VALUES (618, 5482703, '0002');
INSERT INTO `integrantes_conceptos` VALUES (617, 5482703, '0007');
INSERT INTO `integrantes_conceptos` VALUES (616, 5482703, '0001');
INSERT INTO `integrantes_conceptos` VALUES (614, 12224570, '0007');
INSERT INTO `integrantes_conceptos` VALUES (613, 12224570, '0006');
INSERT INTO `integrantes_conceptos` VALUES (612, 12224570, '0004');
INSERT INTO `integrantes_conceptos` VALUES (611, 12224570, '0001');
INSERT INTO `integrantes_conceptos` VALUES (610, 12222156, '0007');
INSERT INTO `integrantes_conceptos` VALUES (609, 12222156, '0004');
INSERT INTO `integrantes_conceptos` VALUES (608, 12222156, '0006');
INSERT INTO `integrantes_conceptos` VALUES (607, 12222156, '0001');
INSERT INTO `integrantes_conceptos` VALUES (606, 12223561, '0001');
INSERT INTO `integrantes_conceptos` VALUES (605, 12223561, '0004');
INSERT INTO `integrantes_conceptos` VALUES (604, 12223561, '0006');
INSERT INTO `integrantes_conceptos` VALUES (603, 12223561, '0002');
INSERT INTO `integrantes_conceptos` VALUES (602, 9425982, '0002');
INSERT INTO `integrantes_conceptos` VALUES (601, 9425982, '0004');
INSERT INTO `integrantes_conceptos` VALUES (600, 9425982, '0006');
INSERT INTO `integrantes_conceptos` VALUES (599, 9425982, '0001');
INSERT INTO `integrantes_conceptos` VALUES (598, 13541356, '0104');
INSERT INTO `integrantes_conceptos` VALUES (597, 13541356, '0009');
INSERT INTO `integrantes_conceptos` VALUES (596, 13541356, '0001');
INSERT INTO `integrantes_conceptos` VALUES (595, 13541356, '0004');
INSERT INTO `integrantes_conceptos` VALUES (594, 13541356, '0006');
INSERT INTO `integrantes_conceptos` VALUES (593, 13541356, '0002');
INSERT INTO `integrantes_conceptos` VALUES (591, 8392561, '0002');
INSERT INTO `integrantes_conceptos` VALUES (590, 8392561, '0004');
INSERT INTO `integrantes_conceptos` VALUES (589, 8392561, '0007');
INSERT INTO `integrantes_conceptos` VALUES (588, 8392561, '0006');
INSERT INTO `integrantes_conceptos` VALUES (587, 8392561, '0001');
INSERT INTO `integrantes_conceptos` VALUES (586, 8392561, '0104');
INSERT INTO `integrantes_conceptos` VALUES (584, 8396643, '0002');
INSERT INTO `integrantes_conceptos` VALUES (583, 8396643, '0006');
INSERT INTO `integrantes_conceptos` VALUES (582, 8396643, '0004');
INSERT INTO `integrantes_conceptos` VALUES (581, 8396643, '0104');
INSERT INTO `integrantes_conceptos` VALUES (580, 8396643, '0001');
INSERT INTO `integrantes_conceptos` VALUES (703, 8470624, '0007');
INSERT INTO `integrantes_conceptos` VALUES (704, 8566093, '0001');
INSERT INTO `integrantes_conceptos` VALUES (705, 8566093, '0002');
INSERT INTO `integrantes_conceptos` VALUES (706, 8566093, '0007');
INSERT INTO `integrantes_conceptos` VALUES (708, 8566093, '0014');
INSERT INTO `integrantes_conceptos` VALUES (709, 8566093, '0009');
INSERT INTO `integrantes_conceptos` VALUES (710, 8566093, '0004');
INSERT INTO `integrantes_conceptos` VALUES (712, 9303416, '0001');
INSERT INTO `integrantes_conceptos` VALUES (713, 9303416, '0004');
INSERT INTO `integrantes_conceptos` VALUES (714, 9303416, '0006');
INSERT INTO `integrantes_conceptos` VALUES (715, 9303416, '0007');
INSERT INTO `integrantes_conceptos` VALUES (716, 9303416, '0008');
INSERT INTO `integrantes_conceptos` VALUES (717, 4652451, '0006');
INSERT INTO `integrantes_conceptos` VALUES (718, 13424082, '0006');
INSERT INTO `integrantes_conceptos` VALUES (719, 15423652, '0006');
INSERT INTO `integrantes_conceptos` VALUES (720, 14685167, '0006');
INSERT INTO `integrantes_conceptos` VALUES (721, 14543612, '0006');
INSERT INTO `integrantes_conceptos` VALUES (722, 13190579, '0006');
INSERT INTO `integrantes_conceptos` VALUES (723, 12669638, '0006');
INSERT INTO `integrantes_conceptos` VALUES (724, 11855143, '0006');
INSERT INTO `integrantes_conceptos` VALUES (725, 12920483, '0006');
INSERT INTO `integrantes_conceptos` VALUES (726, 11144676, '0006');
INSERT INTO `integrantes_conceptos` VALUES (727, 11142484, '0006');
INSERT INTO `integrantes_conceptos` VALUES (728, 11506606, '0006');
INSERT INTO `integrantes_conceptos` VALUES (729, 9308955, '0006');
INSERT INTO `integrantes_conceptos` VALUES (730, 12506912, '0006');
INSERT INTO `integrantes_conceptos` VALUES (731, 8926627, '0006');
INSERT INTO `integrantes_conceptos` VALUES (732, 8398597, '0006');
INSERT INTO `integrantes_conceptos` VALUES (733, 5643691, '0006');
INSERT INTO `integrantes_conceptos` VALUES (734, 8378076, '0006');
INSERT INTO `integrantes_conceptos` VALUES (735, 8388339, '0006');
INSERT INTO `integrantes_conceptos` VALUES (736, 6727828, '0006');
INSERT INTO `integrantes_conceptos` VALUES (737, 13424082, '0004');
INSERT INTO `integrantes_conceptos` VALUES (738, 13424082, '0001');
INSERT INTO `integrantes_conceptos` VALUES (739, 8392072, '0006');
INSERT INTO `integrantes_conceptos` VALUES (740, 11142532, '0006');
INSERT INTO `integrantes_conceptos` VALUES (741, 6428161, '0006');
INSERT INTO `integrantes_conceptos` VALUES (742, 5721970, '0006');
INSERT INTO `integrantes_conceptos` VALUES (743, 4651478, '0006');
INSERT INTO `integrantes_conceptos` VALUES (744, 4512285, '0006');
INSERT INTO `integrantes_conceptos` VALUES (745, 4647928, '0006');
INSERT INTO `integrantes_conceptos` VALUES (746, 5482954, '0006');
INSERT INTO `integrantes_conceptos` VALUES (747, 5477905, '0006');
INSERT INTO `integrantes_conceptos` VALUES (748, 5476102, '0006');
INSERT INTO `integrantes_conceptos` VALUES (749, 5473836, '0006');
INSERT INTO `integrantes_conceptos` VALUES (750, 13668974, '0006');
INSERT INTO `integrantes_conceptos` VALUES (751, 4654397, '0006');
INSERT INTO `integrantes_conceptos` VALUES (770, 2834521, '0002');
INSERT INTO `integrantes_conceptos` VALUES (771, 3203431, '1000');
INSERT INTO `integrantes_conceptos` VALUES (772, 3203431, '0004');
INSERT INTO `integrantes_conceptos` VALUES (773, 1631741, '1000');
INSERT INTO `integrantes_conceptos` VALUES (774, 1324354, '1000');
INSERT INTO `integrantes_conceptos` VALUES (775, 1324354, '0004');
INSERT INTO `integrantes_conceptos` VALUES (776, 4647730, '1000');
INSERT INTO `integrantes_conceptos` VALUES (777, 4647730, '0004');
INSERT INTO `integrantes_conceptos` VALUES (778, 4647730, '0002');
INSERT INTO `integrantes_conceptos` VALUES (779, 2168184, '1000');
INSERT INTO `integrantes_conceptos` VALUES (780, 2168184, '0004');
INSERT INTO `integrantes_conceptos` VALUES (781, 2828055, '1000');
INSERT INTO `integrantes_conceptos` VALUES (782, 2828055, '0004');
INSERT INTO `integrantes_conceptos` VALUES (783, 2828055, '0010');
INSERT INTO `integrantes_conceptos` VALUES (784, 478074, '1000');
INSERT INTO `integrantes_conceptos` VALUES (785, 478074, '0004');
INSERT INTO `integrantes_conceptos` VALUES (786, 879418, '1000');
INSERT INTO `integrantes_conceptos` VALUES (787, 879418, '0004');
INSERT INTO `integrantes_conceptos` VALUES (788, 1320383, '0004');
INSERT INTO `integrantes_conceptos` VALUES (789, 1320451, '1000');
INSERT INTO `integrantes_conceptos` VALUES (790, 1320451, '0004');
INSERT INTO `integrantes_conceptos` VALUES (791, 1320451, '0010');
INSERT INTO `integrantes_conceptos` VALUES (792, 3329244, '1000');
INSERT INTO `integrantes_conceptos` VALUES (793, 3329244, '0004');
INSERT INTO `integrantes_conceptos` VALUES (794, 3329244, '0002');
INSERT INTO `integrantes_conceptos` VALUES (795, 2829046, '1000');
INSERT INTO `integrantes_conceptos` VALUES (796, 2829046, '0004');
INSERT INTO `integrantes_conceptos` VALUES (797, 2829046, '0002');
INSERT INTO `integrantes_conceptos` VALUES (798, 645319, '1000');
INSERT INTO `integrantes_conceptos` VALUES (803, 645319, '0002');
INSERT INTO `integrantes_conceptos` VALUES (801, 645319, '0004');
INSERT INTO `integrantes_conceptos` VALUES (804, 1153450, '1000');
INSERT INTO `integrantes_conceptos` VALUES (805, 3035967, '1000');
INSERT INTO `integrantes_conceptos` VALUES (806, 3035967, '0002');
INSERT INTO `integrantes_conceptos` VALUES (807, 3035967, '0004');
INSERT INTO `integrantes_conceptos` VALUES (808, 3035967, '0010');
INSERT INTO `integrantes_conceptos` VALUES (809, 3489021, '1000');
INSERT INTO `integrantes_conceptos` VALUES (810, 2831342, '1000');
INSERT INTO `integrantes_conceptos` VALUES (811, 2831342, '0004');
INSERT INTO `integrantes_conceptos` VALUES (812, 2831342, '0002');
INSERT INTO `integrantes_conceptos` VALUES (813, 2831342, '0010');
INSERT INTO `integrantes_conceptos` VALUES (814, 2831702, '1000');
INSERT INTO `integrantes_conceptos` VALUES (815, 2831702, '0002');
INSERT INTO `integrantes_conceptos` VALUES (816, 2831702, '0004');
INSERT INTO `integrantes_conceptos` VALUES (817, 2831573, '1000');
INSERT INTO `integrantes_conceptos` VALUES (818, 2829727, '1000');
INSERT INTO `integrantes_conceptos` VALUES (819, 2829727, '0002');
INSERT INTO `integrantes_conceptos` VALUES (820, 2829727, '0004');
INSERT INTO `integrantes_conceptos` VALUES (821, 3488815, '1000');
INSERT INTO `integrantes_conceptos` VALUES (822, 3488815, '0004');
INSERT INTO `integrantes_conceptos` VALUES (823, 3488815, '0010');
INSERT INTO `integrantes_conceptos` VALUES (824, 4045550, '1000');
INSERT INTO `integrantes_conceptos` VALUES (825, 2829520, '1000');
INSERT INTO `integrantes_conceptos` VALUES (826, 2829520, '0004');
INSERT INTO `integrantes_conceptos` VALUES (827, 2829520, '0010');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_constantes`
-- 

CREATE TABLE `integrantes_constantes` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) unsigned NOT NULL default '0' COMMENT 'cedula',
  `cod_constantes` varchar(4) NOT NULL default '' COMMENT 'codigo de la constante asignada',
  `monto` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cedula` (`cedula`,`cod_constantes`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=442 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_constantes`
-- 

INSERT INTO `integrantes_constantes` VALUES (45, 8926627, '1021', 855.97);
INSERT INTO `integrantes_constantes` VALUES (41, 4018459, '1021', 673.58);
INSERT INTO `integrantes_constantes` VALUES (43, 5477905, '1021', 645.98);
INSERT INTO `integrantes_constantes` VALUES (44, 8442192, '1021', 830.23);
INSERT INTO `integrantes_constantes` VALUES (42, 9308955, '1021', 1484.28);
INSERT INTO `integrantes_constantes` VALUES (32, 4051711, '1021', 847.73);
INSERT INTO `integrantes_constantes` VALUES (33, 4512285, '1021', 935.47);
INSERT INTO `integrantes_constantes` VALUES (34, 8385761, '1021', 1078.63);
INSERT INTO `integrantes_constantes` VALUES (35, 3670594, '1021', 922.57);
INSERT INTO `integrantes_constantes` VALUES (36, 5477294, '1021', 1724.91);
INSERT INTO `integrantes_constantes` VALUES (37, 9303416, '1021', 1027.80);
INSERT INTO `integrantes_constantes` VALUES (38, 4654397, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (39, 11829028, '1021', 635.95);
INSERT INTO `integrantes_constantes` VALUES (40, 12222156, '1021', 1027.80);
INSERT INTO `integrantes_constantes` VALUES (46, 8388339, '1021', 1027.80);
INSERT INTO `integrantes_constantes` VALUES (47, 8378076, '1021', 1489.21);
INSERT INTO `integrantes_constantes` VALUES (48, 12224570, '1021', 766.82);
INSERT INTO `integrantes_constantes` VALUES (49, 8392072, '1021', 672.90);
INSERT INTO `integrantes_constantes` VALUES (50, 8381570, '1021', 680.19);
INSERT INTO `integrantes_constantes` VALUES (51, 13669573, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (52, 12225307, '1021', 674.17);
INSERT INTO `integrantes_constantes` VALUES (53, 5482703, '1021', 1087.40);
INSERT INTO `integrantes_constantes` VALUES (54, 4649004, '1021', 651.85);
INSERT INTO `integrantes_constantes` VALUES (55, 5473836, '1021', 742.95);
INSERT INTO `integrantes_constantes` VALUES (56, 11144676, '1021', 1362.90);
INSERT INTO `integrantes_constantes` VALUES (57, 6428161, '1021', 696.09);
INSERT INTO `integrantes_constantes` VALUES (58, 8396643, '1021', 1548.06);
INSERT INTO `integrantes_constantes` VALUES (59, 11142484, '1021', 889.69);
INSERT INTO `integrantes_constantes` VALUES (60, 5476102, '1021', 1027.80);
INSERT INTO `integrantes_constantes` VALUES (61, 12506912, '1021', 796.32);
INSERT INTO `integrantes_constantes` VALUES (62, 8392561, '1021', 969.28);
INSERT INTO `integrantes_constantes` VALUES (63, 4271638, '1021', 991.98);
INSERT INTO `integrantes_constantes` VALUES (64, 5589301, '1021', 742.22);
INSERT INTO `integrantes_constantes` VALUES (65, 8398597, '1021', 830.23);
INSERT INTO `integrantes_constantes` VALUES (66, 12669638, '1021', 748.85);
INSERT INTO `integrantes_constantes` VALUES (67, 5721970, '1021', 1359.69);
INSERT INTO `integrantes_constantes` VALUES (68, 13541356, '1021', 921.25);
INSERT INTO `integrantes_constantes` VALUES (69, 3946767, '1021', 3927.12);
INSERT INTO `integrantes_constantes` VALUES (70, 8470624, '1021', 2552.33);
INSERT INTO `integrantes_constantes` VALUES (71, 6966895, '1021', 5094.14);
INSERT INTO `integrantes_constantes` VALUES (72, 4650716, '1021', 6542.68);
INSERT INTO `integrantes_constantes` VALUES (73, 6177583, '1021', 4908.88);
INSERT INTO `integrantes_constantes` VALUES (74, 12661621, '1021', 1814.21);
INSERT INTO `integrantes_constantes` VALUES (75, 6122659, '1021', 5509.82);
INSERT INTO `integrantes_constantes` VALUES (76, 4647928, '1021', 1606.97);
INSERT INTO `integrantes_constantes` VALUES (77, 4651478, '1021', 1713.03);
INSERT INTO `integrantes_constantes` VALUES (78, 5482954, '1021', 1861.54);
INSERT INTO `integrantes_constantes` VALUES (79, 13023459, '1021', 5094.14);
INSERT INTO `integrantes_constantes` VALUES (80, 8385744, '1021', 2402.12);
INSERT INTO `integrantes_constantes` VALUES (81, 11855143, '1021', 1348.81);
INSERT INTO `integrantes_constantes` VALUES (82, 8566093, '1021', 2855.35);
INSERT INTO `integrantes_constantes` VALUES (83, 5482594, '1021', 5309.44);
INSERT INTO `integrantes_constantes` VALUES (84, 11536888, '1021', 2619.49);
INSERT INTO `integrantes_constantes` VALUES (85, 11142532, '1021', 1281.39);
INSERT INTO `integrantes_constantes` VALUES (86, 11852605, '1021', 1826.54);
INSERT INTO `integrantes_constantes` VALUES (87, 4652451, '1021', 1592.75);
INSERT INTO `integrantes_constantes` VALUES (88, 14055011, '1021', 2597.11);
INSERT INTO `integrantes_constantes` VALUES (89, 5482007, '1021', 2073.24);
INSERT INTO `integrantes_constantes` VALUES (90, 8390397, '1021', 1446.96);
INSERT INTO `integrantes_constantes` VALUES (91, 5643691, '1021', 1562.90);
INSERT INTO `integrantes_constantes` VALUES (92, 11506606, '1021', 2022.66);
INSERT INTO `integrantes_constantes` VALUES (93, 9425982, '1021', 2390.80);
INSERT INTO `integrantes_constantes` VALUES (94, 12920483, '1021', 1576.98);
INSERT INTO `integrantes_constantes` VALUES (95, 5972426, '1021', 2529.94);
INSERT INTO `integrantes_constantes` VALUES (96, 9429622, '1021', 5297.90);
INSERT INTO `integrantes_constantes` VALUES (97, 12223561, '1021', 1215.98);
INSERT INTO `integrantes_constantes` VALUES (98, 15423652, '1021', 1261.58);
INSERT INTO `integrantes_constantes` VALUES (99, 10519925, '1021', 1446.96);
INSERT INTO `integrantes_constantes` VALUES (100, 13190579, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (101, 13424082, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (102, 14685167, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (103, 14543612, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (104, 6727828, '1021', 1434.16);
INSERT INTO `integrantes_constantes` VALUES (105, 4983744, '1021', 1236.40);
INSERT INTO `integrantes_constantes` VALUES (107, 6966895, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (108, 6966895, '0003', 148.76);
INSERT INTO `integrantes_constantes` VALUES (334, 8392561, '0007', 350.00);
INSERT INTO `integrantes_constantes` VALUES (183, 6177583, '9000', 1.17);
INSERT INTO `integrantes_constantes` VALUES (184, 8566093, '9000', 1.44);
INSERT INTO `integrantes_constantes` VALUES (182, 6122659, '9000', 3.86);
INSERT INTO `integrantes_constantes` VALUES (180, 4650716, '9000', 6.55);
INSERT INTO `integrantes_constantes` VALUES (179, 3946767, '9000', 0.00);
INSERT INTO `integrantes_constantes` VALUES (178, 6966895, '9000', 3.68);
INSERT INTO `integrantes_constantes` VALUES (181, 5482594, '9000', 3.63);
INSERT INTO `integrantes_constantes` VALUES (177, 9429622, '9000', 1.20);
INSERT INTO `integrantes_constantes` VALUES (176, 11536888, '9000', 1.73);
INSERT INTO `integrantes_constantes` VALUES (175, 13023459, '9000', 3.29);
INSERT INTO `integrantes_constantes` VALUES (174, 13729622, '9000', 4.71);
INSERT INTO `integrantes_constantes` VALUES (194, 5605331, '1021', 5001.50);
INSERT INTO `integrantes_constantes` VALUES (173, 5605331, '1002', 348.74);
INSERT INTO `integrantes_constantes` VALUES (172, 5605331, '0005', 140.00);
INSERT INTO `integrantes_constantes` VALUES (329, 9429622, '0003', 338.78);
INSERT INTO `integrantes_constantes` VALUES (196, 13729622, '1002', 769.48);
INSERT INTO `integrantes_constantes` VALUES (185, 8385744, '9000', 0.95);
INSERT INTO `integrantes_constantes` VALUES (186, 5605331, '9000', 3.19);
INSERT INTO `integrantes_constantes` VALUES (187, 6122659, '1002', 847.08);
INSERT INTO `integrantes_constantes` VALUES (188, 6122659, '0007', 250.00);
INSERT INTO `integrantes_constantes` VALUES (189, 6122659, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (190, 13023459, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (191, 13023459, '1002', 911.16);
INSERT INTO `integrantes_constantes` VALUES (192, 4650716, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (328, 6122659, '0003', 148.76);
INSERT INTO `integrantes_constantes` VALUES (197, 6966895, '1002', 696.42);
INSERT INTO `integrantes_constantes` VALUES (198, 5482594, '1002', 811.28);
INSERT INTO `integrantes_constantes` VALUES (199, 13023459, '0003', 148.76);
INSERT INTO `integrantes_constantes` VALUES (200, 13023459, '0017', 12.82);
INSERT INTO `integrantes_constantes` VALUES (201, 4650716, '0006', 350.00);
INSERT INTO `integrantes_constantes` VALUES (202, 4650716, '0008', 500.00);
INSERT INTO `integrantes_constantes` VALUES (203, 4650716, '0003', 216.32);
INSERT INTO `integrantes_constantes` VALUES (204, 6966895, '0017', 12.82);
INSERT INTO `integrantes_constantes` VALUES (205, 13729622, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (206, 13729622, '1021', 5509.82);
INSERT INTO `integrantes_constantes` VALUES (207, 6177583, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (208, 5482594, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (209, 5482594, '0003', 216.32);
INSERT INTO `integrantes_constantes` VALUES (210, 5482594, '0017', 229.07);
INSERT INTO `integrantes_constantes` VALUES (211, 9429622, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (212, 3946767, '0003', 108.44);
INSERT INTO `integrantes_constantes` VALUES (213, 3946767, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (214, 3946767, '1002', 259.86);
INSERT INTO `integrantes_constantes` VALUES (333, 8396643, '1002', 207.32);
INSERT INTO `integrantes_constantes` VALUES (379, 13424082, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (378, 9303416, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (377, 9303416, '1002', 226.76);
INSERT INTO `integrantes_constantes` VALUES (376, 8566093, '1002', 358.42);
INSERT INTO `integrantes_constantes` VALUES (375, 8566093, '0007', 270.00);
INSERT INTO `integrantes_constantes` VALUES (374, 8566093, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (373, 8470624, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (372, 8385761, '1002', 431.60);
INSERT INTO `integrantes_constantes` VALUES (371, 5477294, '0003', 196.14);
INSERT INTO `integrantes_constantes` VALUES (370, 5477294, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (369, 5589301, '1002', 51.92);
INSERT INTO `integrantes_constantes` VALUES (367, 11852605, '1002', 624.08);
INSERT INTO `integrantes_constantes` VALUES (366, 11852605, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (365, 12661621, '1002', 45.46);
INSERT INTO `integrantes_constantes` VALUES (364, 12661621, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (363, 3826253, '1021', 700.00);
INSERT INTO `integrantes_constantes` VALUES (362, 4983744, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (361, 4983744, '1002', 180.56);
INSERT INTO `integrantes_constantes` VALUES (360, 5972426, '1002', 586.96);
INSERT INTO `integrantes_constantes` VALUES (359, 5972426, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (358, 8381570, '1002', 269.18);
INSERT INTO `integrantes_constantes` VALUES (357, 4271638, '0004', 200.00);
INSERT INTO `integrantes_constantes` VALUES (356, 4271638, '1002', 176.68);
INSERT INTO `integrantes_constantes` VALUES (355, 12225307, '1002', 183.88);
INSERT INTO `integrantes_constantes` VALUES (354, 4051711, '1002', 41.68);
INSERT INTO `integrantes_constantes` VALUES (353, 4018459, '1002', 28.40);
INSERT INTO `integrantes_constantes` VALUES (352, 4649004, '1002', 169.38);
INSERT INTO `integrantes_constantes` VALUES (351, 8442192, '1002', 255.14);
INSERT INTO `integrantes_constantes` VALUES (350, 3670594, '0004', 100.00);
INSERT INTO `integrantes_constantes` VALUES (349, 3670594, '0003', 97.06);
INSERT INTO `integrantes_constantes` VALUES (348, 3670594, '1002', 78.90);
INSERT INTO `integrantes_constantes` VALUES (347, 5482703, '0003', 97.06);
INSERT INTO `integrantes_constantes` VALUES (346, 5482703, '1002', 162.00);
INSERT INTO `integrantes_constantes` VALUES (345, 12224570, '1002', 223.20);
INSERT INTO `integrantes_constantes` VALUES (344, 12222156, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (343, 12223561, '1002', 259.32);
INSERT INTO `integrantes_constantes` VALUES (342, 12223561, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (341, 9425982, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (340, 9425982, '1002', 404.12);
INSERT INTO `integrantes_constantes` VALUES (339, 13541356, '0004', 150.00);
INSERT INTO `integrantes_constantes` VALUES (338, 13541356, '0007', 150.00);
INSERT INTO `integrantes_constantes` VALUES (337, 13541356, '1002', 171.78);
INSERT INTO `integrantes_constantes` VALUES (336, 8392561, '1002', 277.22);
INSERT INTO `integrantes_constantes` VALUES (335, 8392561, '0004', 350.00);
INSERT INTO `integrantes_constantes` VALUES (332, 8396643, '0004', 250.00);
INSERT INTO `integrantes_constantes` VALUES (331, 8396643, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (330, 9429622, '0017', 554.08);
INSERT INTO `integrantes_constantes` VALUES (382, 1882215, '1021', 0.00);
INSERT INTO `integrantes_constantes` VALUES (387, 3822286, '1021', 741.30);
INSERT INTO `integrantes_constantes` VALUES (384, 1882215, '1002', 0.00);
INSERT INTO `integrantes_constantes` VALUES (386, 2166981, '1021', 1132.00);
INSERT INTO `integrantes_constantes` VALUES (388, 3822286, '1002', 102.40);
INSERT INTO `integrantes_constantes` VALUES (389, 1157385, '1021', 782.90);
INSERT INTO `integrantes_constantes` VALUES (392, 4656965, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (393, 3823341, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (394, 2162209, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (395, 8384048, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (396, 2832775, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (397, 2832775, '1002', 187.76);
INSERT INTO `integrantes_constantes` VALUES (398, 2827764, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (399, 2834521, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (400, 2834521, '1002', 29.14);
INSERT INTO `integrantes_constantes` VALUES (401, 3203431, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (402, 1631741, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (403, 1324354, '1021', 1402.10);
INSERT INTO `integrantes_constantes` VALUES (404, 4647730, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (405, 4647730, '1002', 68.96);
INSERT INTO `integrantes_constantes` VALUES (406, 2168184, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (407, 2828055, '1021', 2439.40);
INSERT INTO `integrantes_constantes` VALUES (408, 2828055, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (409, 478074, '1021', 812.10);
INSERT INTO `integrantes_constantes` VALUES (410, 879418, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (411, 1320383, '1021', 1869.30);
INSERT INTO `integrantes_constantes` VALUES (412, 1320451, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (413, 1320451, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (414, 3329244, '1021', 681.70);
INSERT INTO `integrantes_constantes` VALUES (415, 3329244, '1002', 171.80);
INSERT INTO `integrantes_constantes` VALUES (416, 2829046, '1021', 1331.00);
INSERT INTO `integrantes_constantes` VALUES (417, 2829046, '1002', 125.18);
INSERT INTO `integrantes_constantes` VALUES (418, 645319, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (420, 645319, '1002', 380.40);
INSERT INTO `integrantes_constantes` VALUES (421, 1153450, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (422, 3035967, '1021', 769.90);
INSERT INTO `integrantes_constantes` VALUES (423, 3035967, '1002', 86.86);
INSERT INTO `integrantes_constantes` VALUES (424, 3035967, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (425, 3489021, '1021', 1464.70);
INSERT INTO `integrantes_constantes` VALUES (426, 2831342, '1021', 1111.40);
INSERT INTO `integrantes_constantes` VALUES (427, 2831342, '1002', 111.74);
INSERT INTO `integrantes_constantes` VALUES (428, 2831342, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (429, 2831702, '1021', 1524.60);
INSERT INTO `integrantes_constantes` VALUES (430, 2831702, '1002', 219.04);
INSERT INTO `integrantes_constantes` VALUES (431, 2831573, '1021', 982.10);
INSERT INTO `integrantes_constantes` VALUES (432, 2829727, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (433, 2829727, '1002', 219.60);
INSERT INTO `integrantes_constantes` VALUES (434, 3488815, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (435, 3488815, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (436, 4045550, '1021', 676.30);
INSERT INTO `integrantes_constantes` VALUES (437, 2829520, '1021', 747.00);
INSERT INTO `integrantes_constantes` VALUES (438, 2829520, '0003', 108.40);
INSERT INTO `integrantes_constantes` VALUES (441, 4051700, '1021', 1178.30);
INSERT INTO `integrantes_constantes` VALUES (440, 4051700, '2021', 70.00);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_direcciones`
-- 

CREATE TABLE `integrantes_direcciones` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(11) NOT NULL,
  `cod_direccion` varchar(10) NOT NULL,
  `fecha_vigencia` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_direcciones`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `nivel`
-- 

CREATE TABLE `nivel` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(30) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `nivel`
-- 

INSERT INTO `nivel` VALUES (1, 'DIRECTOR', '70');
INSERT INTO `nivel` VALUES (2, 'COORDINADOR', '50');
INSERT INTO `nivel` VALUES (3, 'FUNCIONARIO', '30');
INSERT INTO `nivel` VALUES (4, 'PASANTE', '10');
INSERT INTO `nivel` VALUES (5, 'CONTRALOR', '90');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `nomina`
-- 

CREATE TABLE `nomina` (
  `cod` varchar(5) NOT NULL default '' COMMENT 'codigo de la nomina',
  `cedula` int(10) unsigned NOT NULL default '0',
  `cod_incidencia` varchar(4) NOT NULL COMMENT 'codigo de la incidencia (constante o concepto)',
  `descripcion` varchar(50) NOT NULL,
  `monto_incidencia` decimal(10,2) NOT NULL COMMENT 'monto',
  `tipo` varchar(10) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `tipo_nomina` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=697 ;

-- 
-- Volcar la base de datos para la tabla `nomina`
-- 

INSERT INTO `nomina` VALUES ('0010', 4051711, '0001', 'Bono de Antiguedad', 126.00, 'CREDITO', 74, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '1000', 'Sueldo Quincenal', 423.86, 'CREDITO', 75, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '7001', 'Total Asignaciones', 549.86, 'ASIGNACION', 76, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0002', 'Prestamos', 20.84, 'DEBITO', 77, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0003', 'Fondo de Jubilacion y Pension', 12.71, 'DEBITO', 78, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0004', 'CACOENE', 84.77, 'DEBITO', 79, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0005', 'Ley de Vivienda y Habitat', 5.49, 'DEBITO', 80, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0006', 'S.S.O. y Reg. Prest. Empleo', 22.00, 'DEBITO', 81, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '0007', 'Sindicato', 1.69, 'DEBITO', 82, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '7002', 'Total Deducciones', 147.50, 'DEDUCCION', 83, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4051711, '7003', 'Total Neto', 402.36, 'NETO', 84, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 85, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '1000', 'Sueldo Quincenal', 467.73, 'CREDITO', 86, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '7001', 'Total Asignaciones', 467.73, 'ASIGNACION', 87, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '0003', 'Fondo de Jubilacion y Pension', 14.03, 'DEBITO', 88, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '0005', 'Ley de Vivienda y Habitat', 4.67, 'DEBITO', 89, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '0006', 'S.S.O. y Reg. Prest. Empleo', 24.28, 'DEBITO', 90, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '7002', 'Total Deducciones', 42.98, 'DEDUCCION', 91, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4512285, '7003', 'Total Neto', 424.75, 'NETO', 92, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0001', 'Bono de Antiguedad', 78.00, 'CREDITO', 93, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '1000', 'Sueldo Quincenal', 539.30, 'CREDITO', 94, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '7001', 'Total Asignaciones', 617.30, 'ASIGNACION', 95, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0002', 'Prestamos', 215.80, 'DEBITO', 96, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0003', 'Fondo de Jubilacion y Pension', 16.17, 'DEBITO', 97, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0004', 'CACOENE', 107.86, 'DEBITO', 98, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0005', 'Ley de Vivienda y Habitat', 6.17, 'DEBITO', 99, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0006', 'S.S.O. y Reg. Prest. Empleo', 28.00, 'DEBITO', 100, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '0007', 'Sindicato', 2.15, 'DEBITO', 101, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '7002', 'Total Deducciones', 376.15, 'DEDUCCION', 102, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385761, '7003', 'Total Neto', 241.15, 'NETO', 103, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0001', 'Bono de Antiguedad', 132.00, 'CREDITO', 104, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0104', 'Prima por Eficiencia', 50.00, 'CREDITO', 105, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '1000', 'Sueldo Quincenal', 461.28, 'CREDITO', 106, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '7001', 'Total Asignaciones', 643.28, 'ASIGNACION', 107, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0002', 'Prestamos', 39.45, 'DEBITO', 108, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0003', 'Fondo de Jubilacion y Pension', 13.83, 'DEBITO', 109, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0004', 'CACOENE', 92.25, 'DEBITO', 110, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0005', 'Ley de Vivienda y Habitat', 6.43, 'DEBITO', 111, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0006', 'S.S.O. y Reg. Prest. Empleo', 23.95, 'DEBITO', 112, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0007', 'Sindicato', 1.84, 'DEBITO', 113, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '0010', 'Poliza HCM', 48.53, 'DEBITO', 114, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '7002', 'Total Deducciones', 226.28, 'DEDUCCION', 115, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3670594, '7003', 'Total Neto', 417.00, 'NETO', 116, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0001', 'Bono de Antiguedad', 150.00, 'CREDITO', 117, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 118, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '1000', 'Sueldo Quincenal', 862.45, 'CREDITO', 119, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '7001', 'Total Asignaciones', 1072.45, 'ASIGNACION', 120, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0003', 'Fondo de Jubilacion y Pension', 25.87, 'DEBITO', 121, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0005', 'Ley de Vivienda y Habitat', 10.72, 'DEBITO', 122, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0006', 'S.S.O. y Reg. Prest. Empleo', 44.78, 'DEBITO', 123, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0007', 'Sindicato', 3.44, 'DEBITO', 124, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '0010', 'Poliza HCM', 98.07, 'DEBITO', 125, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '7002', 'Total Deducciones', 182.88, 'DEDUCCION', 126, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477294, '7003', 'Total Neto', 889.57, 'NETO', 127, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 128, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 129, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '1000', 'Sueldo Quincenal', 513.90, 'CREDITO', 130, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '7001', 'Total Asignaciones', 621.90, 'ASIGNACION', 131, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0002', 'Prestamos', 113.38, 'DEBITO', 132, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0003', 'Fondo de Jubilacion y Pension', 15.41, 'DEBITO', 133, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0004', 'CACOENE', 102.78, 'DEBITO', 134, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0005', 'Ley de Vivienda y Habitat', 6.21, 'DEBITO', 135, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0006', 'S.S.O. y Reg. Prest. Empleo', 26.68, 'DEBITO', 136, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '0007', 'Sindicato', 2.04, 'DEBITO', 137, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '7002', 'Total Deducciones', 266.51, 'DEDUCCION', 138, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9303416, '7003', 'Total Neto', 355.39, 'NETO', 139, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 140, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 141, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '7001', 'Total Asignaciones', 618.20, 'ASIGNACION', 142, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 143, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '0005', 'Ley de Vivienda y Habitat', 6.18, 'DEBITO', 144, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 145, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '7002', 'Total Deducciones', 56.81, 'DEDUCCION', 146, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4654397, '7003', 'Total Neto', 561.39, 'NETO', 147, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 148, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 149, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '1000', 'Sueldo Quincenal', 513.90, 'CREDITO', 150, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '7001', 'Total Asignaciones', 621.90, 'ASIGNACION', 151, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0003', 'Fondo de Jubilacion y Pension', 15.41, 'DEBITO', 152, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0004', 'CACOENE', 102.78, 'DEBITO', 153, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0005', 'Ley de Vivienda y Habitat', 6.21, 'DEBITO', 154, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0006', 'S.S.O. y Reg. Prest. Empleo', 26.68, 'DEBITO', 155, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '0007', 'Sindicato', 2.04, 'DEBITO', 156, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '7002', 'Total Deducciones', 153.13, 'DEDUCCION', 157, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12222156, '7003', 'Total Neto', 468.77, 'NETO', 158, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0001', 'Bono de Antiguedad', 60.00, 'CREDITO', 159, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '1000', 'Sueldo Quincenal', 336.79, 'CREDITO', 160, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '7001', 'Total Asignaciones', 396.79, 'ASIGNACION', 161, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0002', 'Prestamos', 14.20, 'DEBITO', 162, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0003', 'Fondo de Jubilacion y Pension', 10.10, 'DEBITO', 163, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0004', 'CACOENE', 67.34, 'DEBITO', 164, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0005', 'Ley de Vivienda y Habitat', 3.96, 'DEBITO', 165, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0006', 'S.S.O. y Reg. Prest. Empleo', 17.48, 'DEBITO', 166, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '0007', 'Sindicato', 1.34, 'DEBITO', 167, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '7002', 'Total Deducciones', 114.43, 'DEDUCCION', 168, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4018459, '7003', 'Total Neto', 282.36, 'NETO', 169, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 170, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '1000', 'Sueldo Quincenal', 742.14, 'CREDITO', 171, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '7001', 'Total Asignaciones', 742.14, 'ASIGNACION', 172, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '0003', 'Fondo de Jubilacion y Pension', 22.26, 'DEBITO', 173, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '0005', 'Ley de Vivienda y Habitat', 7.42, 'DEBITO', 174, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '0006', 'S.S.O. y Reg. Prest. Empleo', 38.53, 'DEBITO', 175, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '7002', 'Total Deducciones', 68.21, 'DEDUCCION', 176, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9308955, '7003', 'Total Neto', 673.93, 'NETO', 177, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 178, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '1000', 'Sueldo Quincenal', 322.99, 'CREDITO', 179, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '7001', 'Total Asignaciones', 322.99, 'ASIGNACION', 180, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '0003', 'Fondo de Jubilacion y Pension', 9.68, 'DEBITO', 181, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '0005', 'Ley de Vivienda y Habitat', 3.22, 'DEBITO', 182, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '0006', 'S.S.O. y Reg. Prest. Empleo', 16.77, 'DEBITO', 183, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '7002', 'Total Deducciones', 29.67, 'DEDUCCION', 184, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5477905, '7003', 'Total Neto', 293.32, 'NETO', 185, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0001', 'Bono de Antiguedad', 114.00, 'CREDITO', 186, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '1000', 'Sueldo Quincenal', 415.11, 'CREDITO', 187, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '7001', 'Total Asignaciones', 529.11, 'ASIGNACION', 188, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0002', 'Prestamos', 127.57, 'DEBITO', 189, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0003', 'Fondo de Jubilacion y Pension', 12.45, 'DEBITO', 190, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0004', 'CACOENE', 83.02, 'DEBITO', 191, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0005', 'Ley de Vivienda y Habitat', 5.29, 'DEBITO', 192, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0006', 'S.S.O. y Reg. Prest. Empleo', 21.55, 'DEBITO', 193, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '0007', 'Sindicato', 1.66, 'DEBITO', 194, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '7002', 'Total Deducciones', 251.53, 'DEDUCCION', 195, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8442192, '7003', 'Total Neto', 277.57, 'NETO', 196, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 197, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '1000', 'Sueldo Quincenal', 427.98, 'CREDITO', 198, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '7001', 'Total Asignaciones', 427.98, 'ASIGNACION', 199, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '0003', 'Fondo de Jubilacion y Pension', 12.83, 'DEBITO', 200, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '0005', 'Ley de Vivienda y Habitat', 4.26, 'DEBITO', 201, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '0006', 'S.S.O. y Reg. Prest. Empleo', 22.22, 'DEBITO', 202, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '7002', 'Total Deducciones', 39.32, 'DEDUCCION', 203, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8926627, '7003', 'Total Neto', 388.66, 'NETO', 204, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 205, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '1000', 'Sueldo Quincenal', 513.90, 'CREDITO', 206, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '7001', 'Total Asignaciones', 513.90, 'ASIGNACION', 207, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '0003', 'Fondo de Jubilacion y Pension', 15.41, 'DEBITO', 208, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '0005', 'Ley de Vivienda y Habitat', 5.13, 'DEBITO', 209, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '0006', 'S.S.O. y Reg. Prest. Empleo', 26.68, 'DEBITO', 210, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '7002', 'Total Deducciones', 47.22, 'DEDUCCION', 211, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8388339, '7003', 'Total Neto', 466.67, 'NETO', 212, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 213, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '1000', 'Sueldo Quincenal', 744.60, 'CREDITO', 214, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '7001', 'Total Asignaciones', 744.60, 'ASIGNACION', 215, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '0003', 'Fondo de Jubilacion y Pension', 22.33, 'DEBITO', 216, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '0005', 'Ley de Vivienda y Habitat', 7.44, 'DEBITO', 217, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '0006', 'S.S.O. y Reg. Prest. Empleo', 38.65, 'DEBITO', 218, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '7002', 'Total Deducciones', 68.42, 'DEDUCCION', 219, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8378076, '7003', 'Total Neto', 676.17, 'NETO', 220, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0001', 'Bono de Antiguedad', 66.00, 'CREDITO', 221, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '1000', 'Sueldo Quincenal', 383.41, 'CREDITO', 222, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '7001', 'Total Asignaciones', 449.41, 'ASIGNACION', 223, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0002', 'Prestamos', 111.60, 'DEBITO', 224, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0003', 'Fondo de Jubilacion y Pension', 11.50, 'DEBITO', 225, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0004', 'CACOENE', 76.68, 'DEBITO', 226, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0005', 'Ley de Vivienda y Habitat', 4.49, 'DEBITO', 227, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0006', 'S.S.O. y Reg. Prest. Empleo', 19.89, 'DEBITO', 228, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '0007', 'Sindicato', 1.53, 'DEBITO', 229, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '7002', 'Total Deducciones', 225.70, 'DEDUCCION', 230, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12224570, '7003', 'Total Neto', 223.71, 'NETO', 231, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 232, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '1000', 'Sueldo Quincenal', 336.45, 'CREDITO', 233, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '7001', 'Total Asignaciones', 336.45, 'ASIGNACION', 234, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '0003', 'Fondo de Jubilacion y Pension', 10.09, 'DEBITO', 235, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '0005', 'Ley de Vivienda y Habitat', 3.36, 'DEBITO', 236, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '0006', 'S.S.O. y Reg. Prest. Empleo', 17.46, 'DEBITO', 237, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '7002', 'Total Deducciones', 30.91, 'DEDUCCION', 238, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392072, '7003', 'Total Neto', 305.53, 'NETO', 239, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0001', 'Bono de Antiguedad', 132.00, 'CREDITO', 240, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '1000', 'Sueldo Quincenal', 340.09, 'CREDITO', 241, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '7001', 'Total Asignaciones', 472.09, 'ASIGNACION', 242, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0002', 'Prestamos', 134.59, 'DEBITO', 243, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0003', 'Fondo de Jubilacion y Pension', 10.19, 'DEBITO', 244, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0004', 'CACOENE', 68.01, 'DEBITO', 245, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0005', 'Ley de Vivienda y Habitat', 4.72, 'DEBITO', 246, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0006', 'S.S.O. y Reg. Prest. Empleo', 17.64, 'DEBITO', 247, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '0007', 'Sindicato', 1.36, 'DEBITO', 248, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '7002', 'Total Deducciones', 236.53, 'DEDUCCION', 249, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8381570, '7003', 'Total Neto', 235.55, 'NETO', 250, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0001', 'Bono de Antiguedad', 60.00, 'CREDITO', 251, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 252, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '1000', 'Sueldo Quincenal', 337.08, 'CREDITO', 253, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '7001', 'Total Asignaciones', 397.08, 'ASIGNACION', 254, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0002', 'Prestamos', 91.94, 'DEBITO', 255, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0003', 'Fondo de Jubilacion y Pension', 10.11, 'DEBITO', 256, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0004', 'CACOENE', 67.41, 'DEBITO', 257, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0005', 'Ley de Vivienda y Habitat', 3.97, 'DEBITO', 258, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0006', 'S.S.O. y Reg. Prest. Empleo', 17.50, 'DEBITO', 259, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '0007', 'Sindicato', 1.34, 'DEBITO', 260, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '7002', 'Total Deducciones', 192.27, 'DEDUCCION', 261, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12225307, '7003', 'Total Neto', 204.81, 'NETO', 262, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0001', 'Bono de Antiguedad', 138.00, 'CREDITO', 263, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '1000', 'Sueldo Quincenal', 543.70, 'CREDITO', 264, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '7001', 'Total Asignaciones', 681.70, 'ASIGNACION', 265, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0002', 'Prestamos', 81.00, 'DEBITO', 266, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0003', 'Fondo de Jubilacion y Pension', 16.30, 'DEBITO', 267, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0004', 'CACOENE', 108.74, 'DEBITO', 268, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0005', 'Ley de Vivienda y Habitat', 6.81, 'DEBITO', 269, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0006', 'S.S.O. y Reg. Prest. Empleo', 28.23, 'DEBITO', 270, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0007', 'Sindicato', 2.17, 'DEBITO', 271, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '0010', 'Poliza HCM', 48.53, 'DEBITO', 272, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '7002', 'Total Deducciones', 291.78, 'DEDUCCION', 273, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482703, '7003', 'Total Neto', 389.91, 'NETO', 274, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0001', 'Bono de Antiguedad', 90.00, 'CREDITO', 275, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '1000', 'Sueldo Quincenal', 325.92, 'CREDITO', 276, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '7001', 'Total Asignaciones', 415.92, 'ASIGNACION', 277, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0002', 'Prestamos', 84.69, 'DEBITO', 278, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0003', 'Fondo de Jubilacion y Pension', 9.77, 'DEBITO', 279, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0004', 'CACOENE', 65.18, 'DEBITO', 280, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0005', 'Ley de Vivienda y Habitat', 4.15, 'DEBITO', 281, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0006', 'S.S.O. y Reg. Prest. Empleo', 16.92, 'DEBITO', 282, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '0007', 'Sindicato', 1.30, 'DEBITO', 283, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '7002', 'Total Deducciones', 182.01, 'DEDUCCION', 284, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4649004, '7003', 'Total Neto', 233.91, 'NETO', 285, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 286, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '1000', 'Sueldo Quincenal', 371.47, 'CREDITO', 287, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '7001', 'Total Asignaciones', 371.47, 'ASIGNACION', 288, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '0003', 'Fondo de Jubilacion y Pension', 11.14, 'DEBITO', 289, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '0005', 'Ley de Vivienda y Habitat', 3.71, 'DEBITO', 290, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '0006', 'S.S.O. y Reg. Prest. Empleo', 19.28, 'DEBITO', 291, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '7002', 'Total Deducciones', 34.13, 'DEDUCCION', 292, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5473836, '7003', 'Total Neto', 337.34, 'NETO', 293, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 294, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '1000', 'Sueldo Quincenal', 681.45, 'CREDITO', 295, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '7001', 'Total Asignaciones', 681.45, 'ASIGNACION', 296, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '0003', 'Fondo de Jubilacion y Pension', 20.44, 'DEBITO', 297, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '0005', 'Ley de Vivienda y Habitat', 6.81, 'DEBITO', 298, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '0006', 'S.S.O. y Reg. Prest. Empleo', 35.38, 'DEBITO', 299, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '7002', 'Total Deducciones', 62.63, 'DEDUCCION', 300, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11144676, '7003', 'Total Neto', 618.82, 'NETO', 301, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 302, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '1000', 'Sueldo Quincenal', 348.04, 'CREDITO', 303, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '7001', 'Total Asignaciones', 348.04, 'ASIGNACION', 304, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '0003', 'Fondo de Jubilacion y Pension', 10.44, 'DEBITO', 305, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '0005', 'Ley de Vivienda y Habitat', 3.48, 'DEBITO', 306, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '0006', 'S.S.O. y Reg. Prest. Empleo', 18.07, 'DEBITO', 307, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '7002', 'Total Deducciones', 31.99, 'DEDUCCION', 308, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6428161, '7003', 'Total Neto', 316.05, 'NETO', 309, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0001', 'Bono de Antiguedad', 78.00, 'CREDITO', 310, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 311, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0104', 'Prima por Eficiencia', 125.00, 'CREDITO', 312, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '1000', 'Sueldo Quincenal', 774.03, 'CREDITO', 313, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '7001', 'Total Asignaciones', 1037.03, 'ASIGNACION', 314, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0002', 'Prestamos', 103.66, 'DEBITO', 315, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0003', 'Fondo de Jubilacion y Pension', 23.22, 'DEBITO', 316, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0004', 'CACOENE', 154.80, 'DEBITO', 317, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0005', 'Ley de Vivienda y Habitat', 10.37, 'DEBITO', 318, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '0006', 'S.S.O. y Reg. Prest. Empleo', 40.19, 'DEBITO', 319, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '7002', 'Total Deducciones', 332.24, 'DEDUCCION', 320, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8396643, '7003', 'Total Neto', 704.79, 'NETO', 321, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 322, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '1000', 'Sueldo Quincenal', 444.84, 'CREDITO', 323, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '7001', 'Total Asignaciones', 444.84, 'ASIGNACION', 324, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '0003', 'Fondo de Jubilacion y Pension', 13.34, 'DEBITO', 325, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '0005', 'Ley de Vivienda y Habitat', 4.44, 'DEBITO', 326, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '0006', 'S.S.O. y Reg. Prest. Empleo', 23.09, 'DEBITO', 327, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '7002', 'Total Deducciones', 40.87, 'DEDUCCION', 328, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142484, '7003', 'Total Neto', 403.97, 'NETO', 329, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 330, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '1000', 'Sueldo Quincenal', 513.90, 'CREDITO', 331, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '7001', 'Total Asignaciones', 513.90, 'ASIGNACION', 332, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '0003', 'Fondo de Jubilacion y Pension', 15.41, 'DEBITO', 333, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '0005', 'Ley de Vivienda y Habitat', 5.13, 'DEBITO', 334, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '0006', 'S.S.O. y Reg. Prest. Empleo', 26.68, 'DEBITO', 335, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '7002', 'Total Deducciones', 47.22, 'DEDUCCION', 336, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5476102, '7003', 'Total Neto', 466.67, 'NETO', 337, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 338, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '1000', 'Sueldo Quincenal', 398.16, 'CREDITO', 339, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '7001', 'Total Asignaciones', 398.16, 'ASIGNACION', 340, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '0003', 'Fondo de Jubilacion y Pension', 11.94, 'DEBITO', 341, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '0005', 'Ley de Vivienda y Habitat', 3.98, 'DEBITO', 342, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '0006', 'S.S.O. y Reg. Prest. Empleo', 20.67, 'DEBITO', 343, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '7002', 'Total Deducciones', 36.59, 'DEDUCCION', 344, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506912, '7003', 'Total Neto', 361.57, 'NETO', 345, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 346, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0009', 'Prima de Responsabilidad', 175.00, 'CREDITO', 347, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0104', 'Prima por Eficiencia', 175.00, 'CREDITO', 348, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '1000', 'Sueldo Quincenal', 484.64, 'CREDITO', 349, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '7001', 'Total Asignaciones', 882.64, 'ASIGNACION', 350, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0002', 'Prestamos', 138.61, 'DEBITO', 351, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0003', 'Fondo de Jubilacion y Pension', 14.53, 'DEBITO', 352, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0004', 'CACOENE', 96.92, 'DEBITO', 353, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0005', 'Ley de Vivienda y Habitat', 8.82, 'DEBITO', 354, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0006', 'S.S.O. y Reg. Prest. Empleo', 25.16, 'DEBITO', 355, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '0007', 'Sindicato', 1.93, 'DEBITO', 356, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '7002', 'Total Deducciones', 285.97, 'DEDUCCION', 357, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8392561, '7003', 'Total Neto', 596.66, 'NETO', 358, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0001', 'Bono de Antiguedad', 42.00, 'CREDITO', 359, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0104', 'Prima por Eficiencia', 100.00, 'CREDITO', 360, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '1000', 'Sueldo Quincenal', 495.99, 'CREDITO', 361, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '7001', 'Total Asignaciones', 637.99, 'ASIGNACION', 362, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0002', 'Prestamos', 88.34, 'DEBITO', 363, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0003', 'Fondo de Jubilacion y Pension', 14.87, 'DEBITO', 364, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0004', 'CACOENE', 99.19, 'DEBITO', 365, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0005', 'Ley de Vivienda y Habitat', 6.37, 'DEBITO', 366, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0006', 'S.S.O. y Reg. Prest. Empleo', 25.75, 'DEBITO', 367, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '0007', 'Sindicato', 1.98, 'DEBITO', 368, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '7002', 'Total Deducciones', 236.50, 'DEDUCCION', 369, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4271638, '7003', 'Total Neto', 401.49, 'NETO', 370, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0001', 'Bono de Antiguedad', 54.00, 'CREDITO', 371, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '1000', 'Sueldo Quincenal', 371.11, 'CREDITO', 372, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '7001', 'Total Asignaciones', 425.11, 'ASIGNACION', 373, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0002', 'Prestamos', 25.96, 'DEBITO', 374, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0003', 'Fondo de Jubilacion y Pension', 11.13, 'DEBITO', 375, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0004', 'CACOENE', 74.22, 'DEBITO', 376, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0005', 'Ley de Vivienda y Habitat', 4.25, 'DEBITO', 377, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0006', 'S.S.O. y Reg. Prest. Empleo', 19.26, 'DEBITO', 378, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '0007', 'Sindicato', 1.48, 'DEBITO', 379, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '7002', 'Total Deducciones', 136.29, 'DEDUCCION', 380, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5589301, '7003', 'Total Neto', 288.81, 'NETO', 381, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 382, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '1000', 'Sueldo Quincenal', 415.11, 'CREDITO', 383, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '7001', 'Total Asignaciones', 415.11, 'ASIGNACION', 384, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '0003', 'Fondo de Jubilacion y Pension', 12.45, 'DEBITO', 385, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '0005', 'Ley de Vivienda y Habitat', 4.15, 'DEBITO', 386, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '0006', 'S.S.O. y Reg. Prest. Empleo', 21.55, 'DEBITO', 387, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '7002', 'Total Deducciones', 38.15, 'DEDUCCION', 388, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8398597, '7003', 'Total Neto', 376.96, 'NETO', 389, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 390, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '1000', 'Sueldo Quincenal', 374.42, 'CREDITO', 391, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '7001', 'Total Asignaciones', 374.42, 'ASIGNACION', 392, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '0003', 'Fondo de Jubilacion y Pension', 11.23, 'DEBITO', 393, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '0005', 'Ley de Vivienda y Habitat', 3.74, 'DEBITO', 394, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '0006', 'S.S.O. y Reg. Prest. Empleo', 19.44, 'DEBITO', 395, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '7002', 'Total Deducciones', 34.41, 'DEDUCCION', 396, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12669638, '7003', 'Total Neto', 340.01, 'NETO', 397, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 398, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '1000', 'Sueldo Quincenal', 679.84, 'CREDITO', 399, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '7001', 'Total Asignaciones', 679.84, 'ASIGNACION', 400, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '0003', 'Fondo de Jubilacion y Pension', 20.39, 'DEBITO', 401, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '0005', 'Ley de Vivienda y Habitat', 6.79, 'DEBITO', 402, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '0006', 'S.S.O. y Reg. Prest. Empleo', 35.29, 'DEBITO', 403, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '7002', 'Total Deducciones', 62.47, 'DEDUCCION', 404, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5721970, '7003', 'Total Neto', 617.37, 'NETO', 405, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0001', 'Bono de Antiguedad', 36.00, 'CREDITO', 406, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0009', 'Prima de Responsabilidad', 75.00, 'CREDITO', 407, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0104', 'Prima por Eficiencia', 75.00, 'CREDITO', 408, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '1000', 'Sueldo Quincenal', 460.62, 'CREDITO', 409, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '7001', 'Total Asignaciones', 646.62, 'ASIGNACION', 410, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0002', 'Prestamos', 85.89, 'DEBITO', 411, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0003', 'Fondo de Jubilacion y Pension', 13.81, 'DEBITO', 412, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0004', 'CACOENE', 92.12, 'DEBITO', 413, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0005', 'Ley de Vivienda y Habitat', 6.46, 'DEBITO', 414, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0006', 'S.S.O. y Reg. Prest. Empleo', 23.91, 'DEBITO', 415, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '0007', 'Sindicato', 1.84, 'DEBITO', 416, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '7002', 'Total Deducciones', 224.03, 'DEDUCCION', 417, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541356, '7003', 'Total Neto', 422.59, 'NETO', 418, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0001', 'Bono de Antiguedad', 78.00, 'CREDITO', 419, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 420, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '1000', 'Sueldo Quincenal', 1276.16, 'CREDITO', 421, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '7001', 'Total Asignaciones', 1414.16, 'ASIGNACION', 422, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0003', 'Fondo de Jubilacion y Pension', 38.28, 'DEBITO', 423, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0005', 'Ley de Vivienda y Habitat', 14.14, 'DEBITO', 424, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0006', 'S.S.O. y Reg. Prest. Empleo', 66.26, 'DEBITO', 425, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '0007', 'Sindicato', 5.09, 'DEBITO', 426, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '7002', 'Total Deducciones', 123.78, 'DEDUCCION', 427, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8470624, '7003', 'Total Neto', 1290.38, 'NETO', 428, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0001', 'Bono de Antiguedad', 54.00, 'CREDITO', 429, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 430, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '1000', 'Sueldo Quincenal', 907.10, 'CREDITO', 431, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '7001', 'Total Asignaciones', 1021.10, 'ASIGNACION', 432, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0002', 'Prestamos', 22.73, 'DEBITO', 433, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0003', 'Fondo de Jubilacion y Pension', 27.21, 'DEBITO', 434, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0004', 'CACOENE', 181.42, 'DEBITO', 435, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0005', 'Ley de Vivienda y Habitat', 10.21, 'DEBITO', 436, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0006', 'S.S.O. y Reg. Prest. Empleo', 47.09, 'DEBITO', 437, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '0007', 'Sindicato', 3.62, 'DEBITO', 438, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '7002', 'Total Deducciones', 292.27, 'DEDUCCION', 439, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12661621, '7003', 'Total Neto', 728.82, 'NETO', 440, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 441, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '1000', 'Sueldo Quincenal', 803.48, 'CREDITO', 442, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '7001', 'Total Asignaciones', 803.48, 'ASIGNACION', 443, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '0003', 'Fondo de Jubilacion y Pension', 24.10, 'DEBITO', 444, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '0005', 'Ley de Vivienda y Habitat', 8.02, 'DEBITO', 445, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '0006', 'S.S.O. y Reg. Prest. Empleo', 41.71, 'DEBITO', 446, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '7002', 'Total Deducciones', 73.84, 'DEDUCCION', 447, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4647928, '7003', 'Total Neto', 729.64, 'NETO', 448, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 449, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '1000', 'Sueldo Quincenal', 856.51, 'CREDITO', 450, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '7001', 'Total Asignaciones', 856.51, 'ASIGNACION', 451, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '0003', 'Fondo de Jubilacion y Pension', 25.69, 'DEBITO', 452, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '0005', 'Ley de Vivienda y Habitat', 8.56, 'DEBITO', 453, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '0006', 'S.S.O. y Reg. Prest. Empleo', 44.47, 'DEBITO', 454, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '7002', 'Total Deducciones', 78.72, 'DEDUCCION', 455, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4651478, '7003', 'Total Neto', 777.79, 'NETO', 456, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 457, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '1000', 'Sueldo Quincenal', 930.77, 'CREDITO', 458, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '7001', 'Total Asignaciones', 930.77, 'ASIGNACION', 459, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '0003', 'Fondo de Jubilacion y Pension', 27.92, 'DEBITO', 460, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '0005', 'Ley de Vivienda y Habitat', 9.30, 'DEBITO', 461, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '0006', 'S.S.O. y Reg. Prest. Empleo', 48.32, 'DEBITO', 462, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '7002', 'Total Deducciones', 85.54, 'DEDUCCION', 463, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482954, '7003', 'Total Neto', 845.23, 'NETO', 464, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 465, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '1000', 'Sueldo Quincenal', 1201.06, 'CREDITO', 466, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '7001', 'Total Asignaciones', 1201.06, 'ASIGNACION', 467, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '0003', 'Fondo de Jubilacion y Pension', 36.03, 'DEBITO', 468, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '0005', 'Ley de Vivienda y Habitat', 12.01, 'DEBITO', 469, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '7002', 'Total Deducciones', 48.04, 'DEDUCCION', 470, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8385744, '7003', 'Total Neto', 1153.02, 'NETO', 471, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 472, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '1000', 'Sueldo Quincenal', 674.40, 'CREDITO', 473, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '7001', 'Total Asignaciones', 674.40, 'ASIGNACION', 474, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '0003', 'Fondo de Jubilacion y Pension', 20.23, 'DEBITO', 475, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '0005', 'Ley de Vivienda y Habitat', 6.74, 'DEBITO', 476, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '0006', 'S.S.O. y Reg. Prest. Empleo', 35.01, 'DEBITO', 477, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '7002', 'Total Deducciones', 61.98, 'DEDUCCION', 478, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11855143, '7003', 'Total Neto', 612.41, 'NETO', 479, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0001', 'Bono de Antiguedad', 90.00, 'CREDITO', 480, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 481, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0009', 'Prima de Responsabilidad', 135.00, 'CREDITO', 482, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '1000', 'Sueldo Quincenal', 1427.67, 'CREDITO', 483, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '7001', 'Total Asignaciones', 1712.67, 'ASIGNACION', 484, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0002', 'Prestamos', 179.21, 'DEBITO', 485, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0003', 'Fondo de Jubilacion y Pension', 42.83, 'DEBITO', 486, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0004', 'CACOENE', 285.52, 'DEBITO', 487, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0005', 'Ley de Vivienda y Habitat', 17.12, 'DEBITO', 488, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0007', 'Sindicato', 5.71, 'DEBITO', 489, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 490, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '7002', 'Total Deducciones', 590.85, 'DEDUCCION', 491, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 8566093, '7003', 'Total Neto', 1121.82, 'NETO', 492, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 493, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '1000', 'Sueldo Quincenal', 1309.74, 'CREDITO', 494, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '7001', 'Total Asignaciones', 1309.74, 'ASIGNACION', 495, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '0003', 'Fondo de Jubilacion y Pension', 39.29, 'DEBITO', 496, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '0005', 'Ley de Vivienda y Habitat', 13.09, 'DEBITO', 497, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '7002', 'Total Deducciones', 52.38, 'DEDUCCION', 498, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11536888, '7003', 'Total Neto', 1257.36, 'NETO', 499, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 500, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '1000', 'Sueldo Quincenal', 640.69, 'CREDITO', 501, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '7001', 'Total Asignaciones', 640.69, 'ASIGNACION', 502, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '0003', 'Fondo de Jubilacion y Pension', 19.22, 'DEBITO', 503, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '0005', 'Ley de Vivienda y Habitat', 6.40, 'DEBITO', 504, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '0006', 'S.S.O. y Reg. Prest. Empleo', 33.26, 'DEBITO', 505, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '7002', 'Total Deducciones', 58.88, 'DEDUCCION', 506, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11142532, '7003', 'Total Neto', 581.81, 'NETO', 507, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0001', 'Bono de Antiguedad', 66.00, 'CREDITO', 508, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 509, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '1000', 'Sueldo Quincenal', 913.27, 'CREDITO', 510, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '7001', 'Total Asignaciones', 1039.27, 'ASIGNACION', 511, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0002', 'Prestamos', 312.04, 'DEBITO', 512, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0003', 'Fondo de Jubilacion y Pension', 27.39, 'DEBITO', 513, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0004', 'CACOENE', 182.65, 'DEBITO', 514, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0005', 'Ley de Vivienda y Habitat', 10.39, 'DEBITO', 515, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0006', 'S.S.O. y Reg. Prest. Empleo', 47.41, 'DEBITO', 516, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '0007', 'Sindicato', 3.65, 'DEBITO', 517, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '7002', 'Total Deducciones', 583.53, 'DEDUCCION', 518, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11852605, '7003', 'Total Neto', 455.74, 'NETO', 519, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 520, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '1000', 'Sueldo Quincenal', 796.37, 'CREDITO', 521, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '7001', 'Total Asignaciones', 796.37, 'ASIGNACION', 522, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '0003', 'Fondo de Jubilacion y Pension', 23.89, 'DEBITO', 523, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '0005', 'Ley de Vivienda y Habitat', 7.96, 'DEBITO', 524, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '0006', 'S.S.O. y Reg. Prest. Empleo', 41.35, 'DEBITO', 525, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '7002', 'Total Deducciones', 73.20, 'DEDUCCION', 526, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4652451, '7003', 'Total Neto', 723.17, 'NETO', 527, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 528, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '1000', 'Sueldo Quincenal', 1298.55, 'CREDITO', 529, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '7001', 'Total Asignaciones', 1298.55, 'ASIGNACION', 530, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '0003', 'Fondo de Jubilacion y Pension', 38.95, 'DEBITO', 531, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '0005', 'Ley de Vivienda y Habitat', 12.98, 'DEBITO', 532, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '7002', 'Total Deducciones', 51.93, 'DEDUCCION', 533, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14055011, '7003', 'Total Neto', 1246.61, 'NETO', 534, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 535, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '1000', 'Sueldo Quincenal', 1036.60, 'CREDITO', 536, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '7001', 'Total Asignaciones', 1036.60, 'ASIGNACION', 537, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '0003', 'Fondo de Jubilacion y Pension', 31.09, 'DEBITO', 538, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '0005', 'Ley de Vivienda y Habitat', 10.36, 'DEBITO', 539, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '7002', 'Total Deducciones', 41.45, 'DEDUCCION', 540, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5482007, '7003', 'Total Neto', 995.15, 'NETO', 541, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 542, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '1000', 'Sueldo Quincenal', 781.45, 'CREDITO', 543, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '7001', 'Total Asignaciones', 781.45, 'ASIGNACION', 544, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '0003', 'Fondo de Jubilacion y Pension', 23.44, 'DEBITO', 545, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '0005', 'Ley de Vivienda y Habitat', 7.81, 'DEBITO', 546, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '0006', 'S.S.O. y Reg. Prest. Empleo', 40.57, 'DEBITO', 547, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '7002', 'Total Deducciones', 71.81, 'DEDUCCION', 548, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5643691, '7003', 'Total Neto', 709.63, 'NETO', 549, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 550, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '1000', 'Sueldo Quincenal', 1011.33, 'CREDITO', 551, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '7001', 'Total Asignaciones', 1011.33, 'ASIGNACION', 552, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '0003', 'Fondo de Jubilacion y Pension', 30.33, 'DEBITO', 553, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '0005', 'Ley de Vivienda y Habitat', 10.11, 'DEBITO', 554, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '0006', 'S.S.O. y Reg. Prest. Empleo', 52.51, 'DEBITO', 555, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '7002', 'Total Deducciones', 92.94, 'DEDUCCION', 556, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 11506606, '7003', 'Total Neto', 918.38, 'NETO', 557, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 558, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '1000', 'Sueldo Quincenal', 0.00, 'CREDITO', 559, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 560, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '0003', 'Fondo de Jubilacion y Pension', 0.00, 'DEBITO', 561, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '0005', 'Ley de Vivienda y Habitat', 0.00, 'DEBITO', 562, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '0006', 'S.S.O. y Reg. Prest. Empleo', 0.00, 'DEBITO', 563, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 564, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13668974, '7003', 'Total Neto', 0.00, 'NETO', 565, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0001', 'Bono de Antiguedad', 78.00, 'CREDITO', 566, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 567, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '1000', 'Sueldo Quincenal', 1195.40, 'CREDITO', 568, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '7001', 'Total Asignaciones', 1333.40, 'ASIGNACION', 569, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0002', 'Prestamos', 202.06, 'DEBITO', 570, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0003', 'Fondo de Jubilacion y Pension', 35.86, 'DEBITO', 571, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0004', 'CACOENE', 239.08, 'DEBITO', 572, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0005', 'Ley de Vivienda y Habitat', 13.33, 'DEBITO', 573, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '0006', 'S.S.O. y Reg. Prest. Empleo', 62.06, 'DEBITO', 574, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '7002', 'Total Deducciones', 552.39, 'DEDUCCION', 575, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 9425982, '7003', 'Total Neto', 781.01, 'NETO', 576, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 577, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '1000', 'Sueldo Quincenal', 788.49, 'CREDITO', 578, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '7001', 'Total Asignaciones', 788.49, 'ASIGNACION', 579, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '0003', 'Fondo de Jubilacion y Pension', 23.65, 'DEBITO', 580, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '0005', 'Ley de Vivienda y Habitat', 7.88, 'DEBITO', 581, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '0006', 'S.S.O. y Reg. Prest. Empleo', 40.94, 'DEBITO', 582, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '7002', 'Total Deducciones', 72.47, 'DEDUCCION', 583, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12920483, '7003', 'Total Neto', 716.02, 'NETO', 584, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0001', 'Bono de Antiguedad', 24.00, 'CREDITO', 585, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 586, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '1000', 'Sueldo Quincenal', 1264.97, 'CREDITO', 587, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '7001', 'Total Asignaciones', 1348.97, 'ASIGNACION', 588, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0002', 'Prestamos', 293.48, 'DEBITO', 589, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0003', 'Fondo de Jubilacion y Pension', 37.94, 'DEBITO', 590, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0004', 'CACOENE', 252.99, 'DEBITO', 591, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0005', 'Ley de Vivienda y Habitat', 13.48, 'DEBITO', 592, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '0006', 'S.S.O. y Reg. Prest. Empleo', 65.68, 'DEBITO', 593, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '7002', 'Total Deducciones', 663.57, 'DEDUCCION', 594, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 5972426, '7003', 'Total Neto', 685.39, 'NETO', 595, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0001', 'Bono de Antiguedad', 36.00, 'CREDITO', 596, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 597, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '1000', 'Sueldo Quincenal', 607.99, 'CREDITO', 598, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '7001', 'Total Asignaciones', 703.99, 'ASIGNACION', 599, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0002', 'Prestamos', 129.66, 'DEBITO', 600, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0003', 'Fondo de Jubilacion y Pension', 18.23, 'DEBITO', 601, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0004', 'CACOENE', 121.59, 'DEBITO', 602, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0005', 'Ley de Vivienda y Habitat', 7.03, 'DEBITO', 603, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '0006', 'S.S.O. y Reg. Prest. Empleo', 31.56, 'DEBITO', 604, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '7002', 'Total Deducciones', 308.07, 'DEDUCCION', 605, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12223561, '7003', 'Total Neto', 395.92, 'NETO', 606, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 607, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '1000', 'Sueldo Quincenal', 630.79, 'CREDITO', 608, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '7001', 'Total Asignaciones', 630.79, 'ASIGNACION', 609, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '0003', 'Fondo de Jubilacion y Pension', 18.92, 'DEBITO', 610, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '0005', 'Ley de Vivienda y Habitat', 6.30, 'DEBITO', 611, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.75, 'DEBITO', 612, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '7002', 'Total Deducciones', 57.97, 'DEDUCCION', 613, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15423652, '7003', 'Total Neto', 572.81, 'NETO', 614, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 615, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '1000', 'Sueldo Quincenal', 723.48, 'CREDITO', 616, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '7001', 'Total Asignaciones', 723.48, 'ASIGNACION', 617, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '0003', 'Fondo de Jubilacion y Pension', 21.70, 'DEBITO', 618, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '0005', 'Ley de Vivienda y Habitat', 7.23, 'DEBITO', 619, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '7002', 'Total Deducciones', 28.93, 'DEDUCCION', 620, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 10519925, '7003', 'Total Neto', 694.55, 'NETO', 621, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 622, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 623, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '7001', 'Total Asignaciones', 618.20, 'ASIGNACION', 624, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 625, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '0005', 'Ley de Vivienda y Habitat', 6.18, 'DEBITO', 626, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 627, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '7002', 'Total Deducciones', 56.81, 'DEDUCCION', 628, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13190579, '7003', 'Total Neto', 561.39, 'NETO', 629, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0001', 'Bono de Antiguedad', 42.00, 'CREDITO', 630, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 631, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 632, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '7001', 'Total Asignaciones', 720.20, 'ASIGNACION', 633, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 634, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0004', 'CACOENE', 123.64, 'DEBITO', 635, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0005', 'Ley de Vivienda y Habitat', 7.20, 'DEBITO', 636, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 637, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '7002', 'Total Deducciones', 181.47, 'DEDUCCION', 638, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13424082, '7003', 'Total Neto', 538.73, 'NETO', 639, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 640, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 641, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '7001', 'Total Asignaciones', 618.20, 'ASIGNACION', 642, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 643, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '0005', 'Ley de Vivienda y Habitat', 6.18, 'DEBITO', 644, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 645, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '7002', 'Total Deducciones', 56.81, 'DEDUCCION', 646, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14685167, '7003', 'Total Neto', 561.39, 'NETO', 647, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 648, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '1000', 'Sueldo Quincenal', 717.08, 'CREDITO', 649, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '7001', 'Total Asignaciones', 717.08, 'ASIGNACION', 650, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '0003', 'Fondo de Jubilacion y Pension', 21.51, 'DEBITO', 651, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '0005', 'Ley de Vivienda y Habitat', 7.17, 'DEBITO', 652, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '0006', 'S.S.O. y Reg. Prest. Empleo', 37.22, 'DEBITO', 653, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '7002', 'Total Deducciones', 65.91, 'DEDUCCION', 654, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 6727828, '7003', 'Total Neto', 651.17, 'NETO', 655, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '0008', 'Prima Profesionales', 0.00, 'CREDITO', 656, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 657, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '7001', 'Total Asignaciones', 618.20, 'ASIGNACION', 658, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 659, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '0005', 'Ley de Vivienda y Habitat', 6.18, 'DEBITO', 660, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 661, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '7002', 'Total Deducciones', 56.81, 'DEDUCCION', 662, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 14543612, '7003', 'Total Neto', 561.39, 'NETO', 663, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 664, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '1000', 'Sueldo Quincenal', 618.20, 'CREDITO', 665, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '7001', 'Total Asignaciones', 678.20, 'ASIGNACION', 666, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0002', 'Prestamos', 90.28, 'DEBITO', 667, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0003', 'Fondo de Jubilacion y Pension', 18.54, 'DEBITO', 668, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0004', 'CACOENE', 123.64, 'DEBITO', 669, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0005', 'Ley de Vivienda y Habitat', 6.78, 'DEBITO', 670, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '0006', 'S.S.O. y Reg. Prest. Empleo', 32.09, 'DEBITO', 671, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '7002', 'Total Deducciones', 271.33, 'DEDUCCION', 672, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 4983744, '7003', 'Total Neto', 406.87, 'NETO', 673, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '1000', 'Sueldo Quincenal', 350.00, 'CREDITO', 674, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '7001', 'Total Asignaciones', 350.00, 'ASIGNACION', 675, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '0003', 'Fondo de Jubilacion y Pension', 10.50, 'DEBITO', 676, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '0004', 'CACOENE', 70.00, 'DEBITO', 677, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '0005', 'Ley de Vivienda y Habitat', 3.50, 'DEBITO', 678, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '0006', 'S.S.O. y Reg. Prest. Empleo', 18.17, 'DEBITO', 679, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '7002', 'Total Deducciones', 102.17, 'DEDUCCION', 680, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 3826253, '7003', 'Total Neto', 247.83, 'NETO', 681, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12673593, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 682, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12673593, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 683, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12673593, '7003', 'Total Neto', 0.00, 'NETO', 684, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541970, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 685, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541970, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 686, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 13541970, '7003', 'Total Neto', 0.00, 'NETO', 687, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15422391, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 688, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15422391, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 689, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15422391, '7003', 'Total Neto', 0.00, 'NETO', 690, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15896190, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 691, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15896190, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 692, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 15896190, '7003', 'Total Neto', 0.00, 'NETO', 693, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506760, '7001', 'Total Asignaciones', 0.00, 'ASIGNACION', 694, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506760, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 695, 'EMPLEADOS');
INSERT INTO `nomina` VALUES ('0010', 12506760, '7003', 'Total Neto', 0.00, 'NETO', 696, 'EMPLEADOS');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `nomina_actual`
-- 

CREATE TABLE `nomina_actual` (
  `cod` varchar(5) NOT NULL,
  `periodo` varchar(2) NOT NULL,
  `f_ini` date NOT NULL,
  `f_fin` date NOT NULL,
  `f_elab` date NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cod` (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene los datos de la nomina activa' AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `nomina_actual`
-- 

INSERT INTO `nomina_actual` VALUES ('0001', '1', '2007-01-31', '2008-01-31', '2007-08-13', 1, 'Nomina del Mes de Enero', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0002', '6', '2008-03-01', '2008-03-15', '2008-05-15', 6, 'Nomina del Mes de abril (2da quincena)', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0003', '6', '2008-03-01', '2008-03-15', '2008-05-15', 7, 'Nomina del Mes de abril (2da quincena)', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0004', '6', '2008-03-01', '2008-03-15', '2008-05-15', 8, 'Nomina del Mes de abril (2da quincena)', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0010', '12', '2008-06-16', '2008-06-30', '2008-06-30', 9, 'Nomina del Mes de Junio (2da quincena)', 'ACTIVA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `nomina_historial`
-- 

CREATE TABLE `nomina_historial` (
  `cod` varchar(5) NOT NULL default '' COMMENT 'codigo de la nomina',
  `cedula` int(10) unsigned NOT NULL default '0',
  `cod_incidencia` varchar(4) NOT NULL COMMENT 'codigo de la incidencia (constante o concepto)',
  `descripcion` varchar(50) NOT NULL,
  `monto_incidencia` decimal(10,2) NOT NULL COMMENT 'monto',
  `tipo` varchar(10) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `tipo_nomina` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=189 ;

-- 
-- Volcar la base de datos para la tabla `nomina_historial`
-- 

INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 1, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 2, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '1000', 'Sueldo Quincenal', 1963.56, 'CREDITO', 3, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '7001', 'Total Asignaciones', 2071.56, 'ASIGNACION', 4, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0002', 'Prestamos', 129.93, 'DEBITO', 5, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0003', 'Fondo de Jubilacion y Pension', 58.90, 'DEBITO', 6, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0004', 'CACOENE', 392.71, 'DEBITO', 7, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0005', 'Ley de Vivienda y Habitat', 20.71, 'DEBITO', 8, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '0010', 'Poliza HCM', 54.22, 'DEBITO', 9, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '7002', 'Total Deducciones', 656.47, 'DEDUCCION', 10, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 3946767, '7003', 'Total Neto', 1415.09, 'NETO', 11, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0001', 'Bono de Antiguedad', 42.00, 'CREDITO', 12, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 13, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '1000', 'Sueldo Quincenal', 2547.07, 'CREDITO', 14, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '7001', 'Total Asignaciones', 2649.07, 'ASIGNACION', 15, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0002', 'Prestamos', 348.21, 'DEBITO', 16, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0003', 'Fondo de Jubilacion y Pension', 76.41, 'DEBITO', 17, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0004', 'CACOENE', 509.41, 'DEBITO', 18, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0005', 'Ley de Vivienda y Habitat', 26.49, 'DEBITO', 19, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0010', 'Poliza HCM', 74.38, 'DEBITO', 20, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 21, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '7002', 'Total Deducciones', 1095.35, 'DEDUCCION', 22, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6966895, '7003', 'Total Neto', 1553.72, 'NETO', 23, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0001', 'Bono de Antiguedad', 144.00, 'CREDITO', 24, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 25, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0012', 'Prima Jerarquia y Responsabilidad', 175.00, 'CREDITO', 26, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0013', 'Comp. Gastos Repres.', 250.00, 'CREDITO', 27, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '1000', 'Sueldo Quincenal', 3271.34, 'CREDITO', 28, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '7001', 'Total Asignaciones', 3900.34, 'ASIGNACION', 29, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0003', 'Fondo de Jubilacion y Pension', 98.14, 'DEBITO', 30, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0004', 'CACOENE', 654.26, 'DEBITO', 31, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0005', 'Ley de Vivienda y Habitat', 39.00, 'DEBITO', 32, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0010', 'Poliza HCM', 108.16, 'DEBITO', 33, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 34, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '7002', 'Total Deducciones', 960.01, 'DEDUCCION', 35, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 4650716, '7003', 'Total Neto', 2940.33, 'NETO', 36, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0001', 'Bono de Antiguedad', 90.00, 'CREDITO', 37, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 38, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '1000', 'Sueldo Quincenal', 2454.44, 'CREDITO', 39, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '7001', 'Total Asignaciones', 2604.44, 'ASIGNACION', 40, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0003', 'Fondo de Jubilacion y Pension', 73.63, 'DEBITO', 41, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0004', 'CACOENE', 490.88, 'DEBITO', 42, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0005', 'Ley de Vivienda y Habitat', 26.04, 'DEBITO', 43, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 44, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '7002', 'Total Deducciones', 651.00, 'DEDUCCION', 45, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6177583, '7003', 'Total Neto', 1953.44, 'NETO', 46, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0001', 'Bono de Antiguedad', 60.00, 'CREDITO', 47, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 48, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0009', 'Prima de Responsabilidad', 125.00, 'CREDITO', 49, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '1000', 'Sueldo Quincenal', 2754.91, 'CREDITO', 50, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '7001', 'Total Asignaciones', 2999.91, 'ASIGNACION', 51, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0002', 'Prestamos', 423.54, 'DEBITO', 52, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0003', 'Fondo de Jubilacion y Pension', 82.64, 'DEBITO', 53, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0004', 'CACOENE', 550.98, 'DEBITO', 54, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0005', 'Ley de Vivienda y Habitat', 29.99, 'DEBITO', 55, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0010', 'Poliza HCM', 74.38, 'DEBITO', 56, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 57, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '7002', 'Total Deducciones', 1221.98, 'DEDUCCION', 58, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 6122659, '7003', 'Total Neto', 1777.92, 'NETO', 59, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 60, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 61, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '1000', 'Sueldo Quincenal', 2547.07, 'CREDITO', 62, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '7001', 'Total Asignaciones', 2655.07, 'ASIGNACION', 63, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0002', 'Prestamos', 455.58, 'DEBITO', 64, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0003', 'Fondo de Jubilacion y Pension', 76.41, 'DEBITO', 65, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0004', 'CACOENE', 509.41, 'DEBITO', 66, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0005', 'Ley de Vivienda y Habitat', 26.55, 'DEBITO', 67, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0010', 'Poliza HCM', 74.38, 'DEBITO', 68, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 69, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '7002', 'Total Deducciones', 1202.78, 'DEDUCCION', 70, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13023459, '7003', 'Total Neto', 1452.29, 'NETO', 71, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0001', 'Bono de Antiguedad', 48.00, 'CREDITO', 72, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 73, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '1000', 'Sueldo Quincenal', 2654.72, 'CREDITO', 74, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '7001', 'Total Asignaciones', 2762.72, 'ASIGNACION', 75, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0002', 'Prestamos', 405.64, 'DEBITO', 76, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0003', 'Fondo de Jubilacion y Pension', 79.64, 'DEBITO', 77, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0004', 'CACOENE', 530.94, 'DEBITO', 78, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0005', 'Ley de Vivienda y Habitat', 27.62, 'DEBITO', 79, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0010', 'Poliza HCM', 108.16, 'DEBITO', 80, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 81, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '7002', 'Total Deducciones', 1212.45, 'DEDUCCION', 82, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5482594, '7003', 'Total Neto', 1550.26, 'NETO', 83, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0001', 'Bono de Antiguedad', 54.00, 'CREDITO', 84, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0008', 'Prima Profesionales', 70.00, 'CREDITO', 85, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '1000', 'Sueldo Quincenal', 2500.75, 'CREDITO', 86, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '7001', 'Total Asignaciones', 2624.75, 'ASIGNACION', 87, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0002', 'Prestamos', 174.37, 'DEBITO', 88, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0003', 'Fondo de Jubilacion y Pension', 75.02, 'DEBITO', 89, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0004', 'CACOENE', 500.15, 'DEBITO', 90, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0005', 'Ley de Vivienda y Habitat', 26.24, 'DEBITO', 91, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 92, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '7002', 'Total Deducciones', 836.23, 'DEDUCCION', 93, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 5605331, '7003', 'Total Neto', 1788.52, 'NETO', 94, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0001', 'Bono de Antiguedad', 42.00, 'CREDITO', 95, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 96, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '1000', 'Sueldo Quincenal', 2754.91, 'CREDITO', 97, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '7001', 'Total Asignaciones', 2856.91, 'ASIGNACION', 98, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0002', 'Prestamos', 384.74, 'DEBITO', 99, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0003', 'Fondo de Jubilacion y Pension', 82.64, 'DEBITO', 100, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0004', 'CACOENE', 550.98, 'DEBITO', 101, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0005', 'Ley de Vivienda y Habitat', 28.56, 'DEBITO', 102, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 103, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '7002', 'Total Deducciones', 1107.37, 'DEDUCCION', 104, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 13729622, '7003', 'Total Neto', 1749.53, 'NETO', 105, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0001', 'Bono de Antiguedad', 78.00, 'CREDITO', 106, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0008', 'Prima Profesionales', 60.00, 'CREDITO', 107, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '1000', 'Sueldo Quincenal', 2648.95, 'CREDITO', 108, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '7001', 'Total Asignaciones', 2786.95, 'ASIGNACION', 109, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0003', 'Fondo de Jubilacion y Pension', 79.45, 'DEBITO', 110, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0005', 'Ley de Vivienda y Habitat', 27.86, 'DEBITO', 111, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0010', 'Poliza HCM', 169.39, 'DEBITO', 112, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '0014', ' S.S.O. y Reg. Prest. Empleo 2', 60.45, 'DEBITO', 113, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '7002', 'Total Deducciones', 337.16, 'DEDUCCION', 114, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 9429622, '7003', 'Total Neto', 2449.79, 'NETO', 115, 'DIRECTORES');
INSERT INTO `nomina_historial` VALUES ('0010', 2166981, '1000', 'Sueldo Quincenal', 566.00, 'CREDITO', 116, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2166981, '7001', 'Total Asignaciones', 566.00, 'ASIGNACION', 117, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2166981, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 118, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2166981, '7003', 'Total Neto', 566.00, 'NETO', 119, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '1000', 'Sueldo Quincenal', 370.65, 'CREDITO', 120, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '7001', 'Total Asignaciones', 370.65, 'ASIGNACION', 121, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '0002', 'Prestamos', 51.20, 'DEBITO', 122, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '0004', 'CACOENE', 74.13, 'DEBITO', 123, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '7002', 'Total Deducciones', 125.33, 'DEDUCCION', 124, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3822286, '7003', 'Total Neto', 245.32, 'NETO', 125, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1157385, '1000', 'Sueldo Quincenal', 391.45, 'CREDITO', 126, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1157385, '7001', 'Total Asignaciones', 391.45, 'ASIGNACION', 127, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1157385, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 128, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1157385, '7003', 'Total Neto', 391.45, 'NETO', 129, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4656965, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 130, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4656965, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 131, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4656965, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 132, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4656965, '7003', 'Total Neto', 338.15, 'NETO', 133, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3823341, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 134, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3823341, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 135, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3823341, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 136, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3823341, '7003', 'Total Neto', 338.15, 'NETO', 137, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2162209, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 138, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2162209, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 139, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2162209, '0004', 'CACOENE', 67.63, 'DEBITO', 140, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2162209, '7002', 'Total Deducciones', 67.63, 'DEDUCCION', 141, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2162209, '7003', 'Total Neto', 270.52, 'NETO', 142, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 8384048, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 143, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 8384048, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 144, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 8384048, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 145, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 8384048, '7003', 'Total Neto', 338.15, 'NETO', 146, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 147, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 148, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '0002', 'Prestamos', 93.88, 'DEBITO', 149, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '0004', 'CACOENE', 67.63, 'DEBITO', 150, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '7002', 'Total Deducciones', 161.51, 'DEDUCCION', 151, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2832775, '7003', 'Total Neto', 176.64, 'NETO', 152, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2827764, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 153, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2827764, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 154, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2827764, '0004', 'CACOENE', 67.63, 'DEBITO', 155, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2827764, '7002', 'Total Deducciones', 67.63, 'DEDUCCION', 156, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2827764, '7003', 'Total Neto', 270.52, 'NETO', 157, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 158, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 159, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '0002', 'Prestamos', 14.57, 'DEBITO', 160, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '0004', 'CACOENE', 67.63, 'DEBITO', 161, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '7002', 'Total Deducciones', 82.19, 'DEDUCCION', 162, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2834521, '7003', 'Total Neto', 255.95, 'NETO', 163, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3203431, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 164, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3203431, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 165, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3203431, '0004', 'CACOENE', 67.63, 'DEBITO', 166, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3203431, '7002', 'Total Deducciones', 67.63, 'DEDUCCION', 167, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 3203431, '7003', 'Total Neto', 270.52, 'NETO', 168, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1631741, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 169, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1631741, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 170, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1631741, '7002', 'Total Deducciones', 0.00, 'DEDUCCION', 171, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1631741, '7003', 'Total Neto', 338.15, 'NETO', 172, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1324354, '1000', 'Sueldo Quincenal', 701.05, 'CREDITO', 173, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1324354, '7001', 'Total Asignaciones', 701.05, 'ASIGNACION', 174, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1324354, '0004', 'CACOENE', 140.21, 'DEBITO', 175, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1324354, '7002', 'Total Deducciones', 140.21, 'DEDUCCION', 176, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 1324354, '7003', 'Total Neto', 560.83, 'NETO', 177, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 178, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 179, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '0002', 'Prestamos', 34.47, 'DEBITO', 180, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '0004', 'CACOENE', 67.63, 'DEBITO', 181, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '7002', 'Total Deducciones', 102.10, 'DEDUCCION', 182, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 4647730, '7003', 'Total Neto', 236.05, 'NETO', 183, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2168184, '1000', 'Sueldo Quincenal', 338.15, 'CREDITO', 184, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2168184, '7001', 'Total Asignaciones', 338.15, 'ASIGNACION', 185, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2168184, '0004', 'CACOENE', 67.63, 'DEBITO', 186, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2168184, '7002', 'Total Deducciones', 67.63, 'DEDUCCION', 187, 'PENSIONADOS');
INSERT INTO `nomina_historial` VALUES ('0010', 2168184, '7003', 'Total Neto', 270.52, 'NETO', 188, 'PENSIONADOS');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagos_especiales`
-- 

CREATE TABLE `pagos_especiales` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(11) NOT NULL,
  `cod_incidencia` varchar(4) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `pagos_especiales`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `privilegios` varchar(1) NOT NULL,
  UNIQUE KEY `login` (`login`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 'capepo', 'capepo', '1');
INSERT INTO `usuarios` VALUES (3, 'alexis', 'alexis', '2');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `variables`
-- 

CREATE TABLE `variables` (
  `id` int(11) NOT NULL auto_increment,
  `cod` varchar(4) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL,
  UNIQUE KEY `codigo` (`cod`),
  UNIQUE KEY `var` (`abreviatura`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `variables`
-- 

INSERT INTO `variables` VALUES (2, '1000', 'map', 'Monto Antiguedad Previa', '12');
INSERT INTO `variables` VALUES (3, '1001', 'mas', 'Monto Antiguedad Actual', '12');
INSERT INTO `variables` VALUES (4, '1002', 'sum', 'Sueldo Minimo', '799.23');
