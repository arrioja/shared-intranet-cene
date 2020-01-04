-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 16-05-2008 a las 10:35:46
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=752 ;

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
INSERT INTO `integrantes_conceptos` VALUES (455, 3946767, '0014');
INSERT INTO `integrantes_conceptos` VALUES (23, 6122659, '0005');
INSERT INTO `integrantes_conceptos` VALUES (24, 6122659, '9001');
INSERT INTO `integrantes_conceptos` VALUES (25, 13023459, '0001');
INSERT INTO `integrantes_conceptos` VALUES (26, 13023459, '0003');
INSERT INTO `integrantes_conceptos` VALUES (27, 13023459, '0004');
INSERT INTO `integrantes_conceptos` VALUES (454, 6122659, '0014');
INSERT INTO `integrantes_conceptos` VALUES (29, 13023459, '0005');
INSERT INTO `integrantes_conceptos` VALUES (30, 13023459, '9001');
INSERT INTO `integrantes_conceptos` VALUES (31, 4650716, '0003');
INSERT INTO `integrantes_conceptos` VALUES (32, 4650716, '0004');
INSERT INTO `integrantes_conceptos` VALUES (33, 4650716, '9001');
INSERT INTO `integrantes_conceptos` VALUES (34, 4650716, '0005');
INSERT INTO `integrantes_conceptos` VALUES (453, 5605331, '0014');
INSERT INTO `integrantes_conceptos` VALUES (36, 5605331, '0008');
INSERT INTO `integrantes_conceptos` VALUES (37, 5605331, '1000');
INSERT INTO `integrantes_conceptos` VALUES (38, 5605331, '0003');
INSERT INTO `integrantes_conceptos` VALUES (39, 5605331, '9001');
INSERT INTO `integrantes_conceptos` VALUES (40, 5605331, '0002');
INSERT INTO `integrantes_conceptos` VALUES (41, 13729622, '9001');
INSERT INTO `integrantes_conceptos` VALUES (42, 6966895, '9001');
INSERT INTO `integrantes_conceptos` VALUES (43, 5482594, '9001');
INSERT INTO `integrantes_conceptos` VALUES (44, 8385744, '9001');
INSERT INTO `integrantes_conceptos` VALUES (45, 9429622, '9001');
INSERT INTO `integrantes_conceptos` VALUES (46, 8566093, '9001');
INSERT INTO `integrantes_conceptos` VALUES (47, 3946767, '9001');
INSERT INTO `integrantes_conceptos` VALUES (48, 6177583, '9001');
INSERT INTO `integrantes_conceptos` VALUES (49, 11536888, '9001');
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
INSERT INTO `integrantes_conceptos` VALUES (106, 4051700, '0003');
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
INSERT INTO `integrantes_conceptos` VALUES (578, 9429622, '0011');
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
INSERT INTO `integrantes_conceptos` VALUES (202, 4051700, '0005');
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
INSERT INTO `integrantes_conceptos` VALUES (235, 9429622, '0002');
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
INSERT INTO `integrantes_conceptos` VALUES (419, 4051700, '0008');
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=380 ;

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
INSERT INTO `integrantes_constantes` VALUES (69, 3946767, '1021', 3570.10);
INSERT INTO `integrantes_constantes` VALUES (70, 8470624, '1021', 2552.33);
INSERT INTO `integrantes_constantes` VALUES (71, 6966895, '1021', 4631.04);
INSERT INTO `integrantes_constantes` VALUES (72, 4650716, '1021', 5947.90);
INSERT INTO `integrantes_constantes` VALUES (73, 6177583, '1021', 4462.62);
INSERT INTO `integrantes_constantes` VALUES (74, 12661621, '1021', 1814.21);
INSERT INTO `integrantes_constantes` VALUES (75, 6122659, '1021', 5008.92);
INSERT INTO `integrantes_constantes` VALUES (76, 4647928, '1021', 1606.97);
INSERT INTO `integrantes_constantes` VALUES (77, 4651478, '1021', 1713.03);
INSERT INTO `integrantes_constantes` VALUES (78, 5482954, '1021', 1861.54);
INSERT INTO `integrantes_constantes` VALUES (79, 13023459, '1021', 4631.04);
INSERT INTO `integrantes_constantes` VALUES (80, 8385744, '1021', 2402.12);
INSERT INTO `integrantes_constantes` VALUES (81, 11855143, '1021', 1348.81);
INSERT INTO `integrantes_constantes` VALUES (82, 8566093, '1021', 2855.35);
INSERT INTO `integrantes_constantes` VALUES (83, 5482594, '1021', 4826.76);
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
INSERT INTO `integrantes_constantes` VALUES (96, 9429622, '1021', 4816.28);
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
INSERT INTO `integrantes_constantes` VALUES (108, 6966895, '0003', 133.14);
INSERT INTO `integrantes_constantes` VALUES (334, 8392561, '0007', 350.00);
INSERT INTO `integrantes_constantes` VALUES (183, 6177583, '9000', 1.17);
INSERT INTO `integrantes_constantes` VALUES (184, 8566093, '9000', 1.44);
INSERT INTO `integrantes_constantes` VALUES (182, 6122659, '9000', 3.86);
INSERT INTO `integrantes_constantes` VALUES (180, 4650716, '9000', 6.55);
INSERT INTO `integrantes_constantes` VALUES (179, 3946767, '9000', 1.67);
INSERT INTO `integrantes_constantes` VALUES (178, 6966895, '9000', 3.68);
INSERT INTO `integrantes_constantes` VALUES (181, 5482594, '9000', 3.63);
INSERT INTO `integrantes_constantes` VALUES (177, 9429622, '9000', 1.20);
INSERT INTO `integrantes_constantes` VALUES (176, 11536888, '9000', 1.73);
INSERT INTO `integrantes_constantes` VALUES (175, 13023459, '9000', 3.29);
INSERT INTO `integrantes_constantes` VALUES (174, 13729622, '9000', 4.71);
INSERT INTO `integrantes_constantes` VALUES (194, 5605331, '1021', 4546.82);
INSERT INTO `integrantes_constantes` VALUES (173, 5605331, '1002', 348.74);
INSERT INTO `integrantes_constantes` VALUES (172, 5605331, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (329, 9429622, '0003', 651.40);
INSERT INTO `integrantes_constantes` VALUES (196, 13729622, '1002', 769.48);
INSERT INTO `integrantes_constantes` VALUES (185, 8385744, '9000', 0.95);
INSERT INTO `integrantes_constantes` VALUES (186, 5605331, '9000', 3.19);
INSERT INTO `integrantes_constantes` VALUES (187, 6122659, '1002', 847.08);
INSERT INTO `integrantes_constantes` VALUES (188, 6122659, '0007', 200.00);
INSERT INTO `integrantes_constantes` VALUES (189, 6122659, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (190, 13023459, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (191, 13023459, '1002', 911.16);
INSERT INTO `integrantes_constantes` VALUES (192, 4650716, '0005', 120.00);
INSERT INTO `integrantes_constantes` VALUES (328, 6122659, '0003', 133.14);
INSERT INTO `integrantes_constantes` VALUES (197, 6966895, '1002', 696.21);
INSERT INTO `integrantes_constantes` VALUES (198, 5482594, '1002', 811.28);
INSERT INTO `integrantes_constantes` VALUES (199, 13023459, '0003', 133.14);
INSERT INTO `integrantes_constantes` VALUES (200, 13023459, '0017', 12.82);
INSERT INTO `integrantes_constantes` VALUES (201, 4650716, '0006', 250.00);
INSERT INTO `integrantes_constantes` VALUES (202, 4650716, '0008', 350.00);
INSERT INTO `integrantes_constantes` VALUES (203, 4650716, '0003', 196.14);
INSERT INTO `integrantes_constantes` VALUES (204, 6966895, '0017', 12.82);
INSERT INTO `integrantes_constantes` VALUES (205, 13729622, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (206, 13729622, '1021', 5008.92);
INSERT INTO `integrantes_constantes` VALUES (207, 6177583, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (208, 5482594, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (209, 5482594, '0003', 196.14);
INSERT INTO `integrantes_constantes` VALUES (210, 5482594, '0017', 229.07);
INSERT INTO `integrantes_constantes` VALUES (211, 9429622, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (212, 3946767, '0003', 97.06);
INSERT INTO `integrantes_constantes` VALUES (213, 3946767, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (214, 3946767, '1002', 259.86);
INSERT INTO `integrantes_constantes` VALUES (333, 8396643, '1002', 207.32);
INSERT INTO `integrantes_constantes` VALUES (379, 13424082, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (378, 9303416, '0005', 75.00);
INSERT INTO `integrantes_constantes` VALUES (377, 9303416, '1002', 226.76);
INSERT INTO `integrantes_constantes` VALUES (376, 8566093, '1002', 358.42);
INSERT INTO `integrantes_constantes` VALUES (375, 8566093, '0007', 270.00);
INSERT INTO `integrantes_constantes` VALUES (374, 8566093, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (373, 8470624, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (372, 8385761, '1002', 431.60);
INSERT INTO `integrantes_constantes` VALUES (371, 5477294, '0003', 196.14);
INSERT INTO `integrantes_constantes` VALUES (370, 5477294, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (369, 5589301, '1002', 51.92);
INSERT INTO `integrantes_constantes` VALUES (367, 11852605, '1002', 624.08);
INSERT INTO `integrantes_constantes` VALUES (366, 11852605, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (365, 12661621, '1002', 45.46);
INSERT INTO `integrantes_constantes` VALUES (364, 12661621, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (363, 3826253, '1021', 700.00);
INSERT INTO `integrantes_constantes` VALUES (362, 4983744, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (361, 4983744, '1002', 180.56);
INSERT INTO `integrantes_constantes` VALUES (360, 5972426, '1002', 586.96);
INSERT INTO `integrantes_constantes` VALUES (359, 5972426, '0005', 100.00);
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
INSERT INTO `integrantes_constantes` VALUES (344, 12222156, '0005', 75.00);
INSERT INTO `integrantes_constantes` VALUES (343, 12223561, '1002', 259.32);
INSERT INTO `integrantes_constantes` VALUES (342, 12223561, '0005', 75.00);
INSERT INTO `integrantes_constantes` VALUES (341, 9425982, '0005', 100.00);
INSERT INTO `integrantes_constantes` VALUES (340, 9425982, '1002', 404.12);
INSERT INTO `integrantes_constantes` VALUES (339, 13541356, '0004', 150.00);
INSERT INTO `integrantes_constantes` VALUES (338, 13541356, '0007', 150.00);
INSERT INTO `integrantes_constantes` VALUES (337, 13541356, '1002', 171.78);
INSERT INTO `integrantes_constantes` VALUES (336, 8392561, '1002', 277.22);
INSERT INTO `integrantes_constantes` VALUES (335, 8392561, '0004', 350.00);
INSERT INTO `integrantes_constantes` VALUES (332, 8396643, '0004', 250.00);
INSERT INTO `integrantes_constantes` VALUES (331, 8396643, '0005', 75.00);
INSERT INTO `integrantes_constantes` VALUES (330, 9429622, '0017', 554.08);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `nomina`
-- 


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene los datos de la nomina activa' AUTO_INCREMENT=9 ;

-- 
-- Volcar la base de datos para la tabla `nomina_actual`
-- 

INSERT INTO `nomina_actual` VALUES ('0001', '1', '2007-01-31', '2008-01-31', '2007-08-13', 1, 'Nomina del Mes de Enero', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0002', '6', '2008-03-01', '2008-03-15', '2008-05-15', 6, 'Nomina del Mes de abril (2da quincena)', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0003', '6', '2008-03-01', '2008-03-15', '2008-05-15', 7, 'Nomina del Mes de abril (2da quincena)', 'INACTIVA');
INSERT INTO `nomina_actual` VALUES ('0004', '6', '2008-03-01', '2008-03-15', '2008-05-15', 8, 'Nomina del Mes de abril (2da quincena)', 'ACTIVA');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `nomina_historial`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `variables`
-- 

INSERT INTO `variables` VALUES (2, '1000', 'map', 'Monto Antiguedad Previa', '10');
INSERT INTO `variables` VALUES (3, '1001', 'mas', 'Monto Antiguedad Actual', '10');
