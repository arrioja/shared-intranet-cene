-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 26-11-2007 a las 15:34:30
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `personal`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `banco`
-- 

CREATE TABLE `banco` (
  `cod` varchar(4) NOT NULL default '',
  `descripcion` varchar(50) default NULL,
  `numero` varchar(30) NOT NULL default '',
  `tipo` varchar(30) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cod`,`numero`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `banco`
-- 

INSERT INTO `banco` VALUES ('0040', 'cuenta de nomina', '00102231214', 'AHORROS', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `conceptos`
-- 

CREATE TABLE `conceptos` (
  `cod` varchar(4) NOT NULL,
  `descripcion` varchar(100) default NULL,
  `tipo` varchar(100) default NULL,
  `formula` varchar(100) default NULL,
  `general` char(1) default NULL,
  `frecuencia` varchar(100) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cod`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- 
-- Volcar la base de datos para la tabla `conceptos`
-- 

INSERT INTO `conceptos` VALUES ('0003', 'Fondo de Jubilacion y Pension', 'DEBITO', 'y(sm)=(sm*0.03)/2', '1', 'QUINCENAL', 20);
INSERT INTO `conceptos` VALUES ('0004', 'CACOENE', 'DEBITO', 'y(sm)=((sm*0.2)/2)', '1', 'QUINCENAL', 19);
INSERT INTO `conceptos` VALUES ('0001', 'Bono de Antiguedad', 'CREDITO', 'y(aap,map,as,mas)=((aap*map)+(as*mas))/2', '1', 'QUINCENAL', 55);
INSERT INTO `conceptos` VALUES ('0005', 'Ley de Vivienda y Habitat', 'DEBITO', 'y(sm)=((sm*0.01)/2)', '1', 'QUINCENAL', 56);
INSERT INTO `conceptos` VALUES ('0006', 'S.S.O. y Reg. Prest. Empleo', 'DEBITO', 'y(sm)=(sm*12/52)*0.045*4/2', '1', 'QUINCENAL', 57);
INSERT INTO `conceptos` VALUES ('0007', 'Sindicato', 'DEBITO', 'y(sm)=(sm*0.004)/2', '1', 'QUINCENAL', 58);
INSERT INTO `conceptos` VALUES ('9001', 'R.I.S.L.R.', 'DEBITO', 'y(sm,pct)=(sm*(pct/100)/2)', '0', 'QUINCENAL', 67);
INSERT INTO `conceptos` VALUES ('0002', 'Prestamos', 'DEBITO', 'y(pre)=pre/2', '0', 'QUINCENAL', 69);
INSERT INTO `conceptos` VALUES ('1000', 'Sueldo Quincenal', 'CREDITO', 'y(sm)=sm/2', '1', 'QUINCENAL', 68);
INSERT INTO `conceptos` VALUES ('0008', 'Prima Profesionales', 'CREDITO', 'y(pp)=pp/2', '0', 'QUINCENAL', 70);
INSERT INTO `conceptos` VALUES ('0009', 'Prima de Responsabilidad', 'CREDITO', 'y(pr)=pr/2', '0', 'QUINCENAL', 71);
INSERT INTO `conceptos` VALUES ('0010', 'Poliza HCM', 'CREDITO', 'y(hcm)=hcm/2', '0', 'QUINCENAL', 72);
INSERT INTO `conceptos` VALUES ('0011', 'Ajuste poliza HCM', 'CREDITO', 'y(ahc)=ahc/2', '0', 'QUINCENAL', 73);
INSERT INTO `conceptos` VALUES ('0012', 'Prima Jerarquia y Responsabilidad', 'CREDITO', 'y(pj)=pj/2', '0', 'QUINCENAL', 74);
INSERT INTO `conceptos` VALUES ('0013', 'Comp. Gastos Repres.', 'CREDITO', 'y(cgr)=cgr/2', '0', 'QUINCENAL', 75);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `constantes`
-- 

CREATE TABLE `constantes` (
  `cod` varchar(4) NOT NULL default '',
  `descripcion` varchar(100) default NULL,
  `abreviatura` varchar(20) NOT NULL,
  `tipo` varchar(30) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cod` (`cod`),
  UNIQUE KEY `abreviatura` (`abreviatura`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Volcar la base de datos para la tabla `constantes`
-- 

INSERT INTO `constantes` VALUES ('1021', 'Sueldo Mensual', 'sm', 'OTRO', 22, '2007-06-06');
INSERT INTO `constantes` VALUES ('0005', 'Prima de Profesionales', 'pp', 'CREDITO', 2, '2007-03-28');
INSERT INTO `constantes` VALUES ('2001', 'AÃ±os Antiguedad Previa', 'aap', 'OTRO', 29, '2007-10-03');
INSERT INTO `constantes` VALUES ('0001', 'INAVI', 'ina', 'DEBITO', 32, '2007-10-05');
INSERT INTO `constantes` VALUES ('0007', 'Prima de Responsabilidad', 'pr', 'CREDITO', 19, '2007-05-21');
INSERT INTO `constantes` VALUES ('4444', 'Sueldo Integral', 'si', 'OTRO', 24, '2007-08-01');
INSERT INTO `constantes` VALUES ('0002', 'R.I.S.L.R.', 'islr', 'DEBITO', 33, '2007-10-05');
INSERT INTO `constantes` VALUES ('0003', 'POLIZA HCM', 'hcm', 'DEBITO', 34, '2007-10-05');
INSERT INTO `constantes` VALUES ('0004', 'Prima por Eficiencia', 'pe', 'CREDITO', 35, '2007-10-05');
INSERT INTO `constantes` VALUES ('0006', 'Prima de Jerarquia y Responsabilidad', 'pj', 'CREDITO', 42, '2007-11-26');
INSERT INTO `constantes` VALUES ('1002', 'PRESTAMOS', 'pre', 'DEBITO', 39, '2007-11-19');
INSERT INTO `constantes` VALUES ('9000', 'Porcentaje RISLR', 'pct', 'OTRO', 40, '2007-11-19');
INSERT INTO `constantes` VALUES ('0017', 'Ajuste Poliza HCM', 'ahc', 'DEBITO', 41, '2007-11-22');
INSERT INTO `constantes` VALUES ('0008', 'Comp. Gastos Repres.', 'cgr', 'CREDITO', 43, '2007-11-26');

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
  `tipo_nomina` varchar(20) default NULL,
  `pago_banco` varchar(1) default NULL,
  `codigo` varchar(5) default NULL,
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_funcionario` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

-- 
-- Volcar la base de datos para la tabla `integrantes`
-- 

INSERT INTO `integrantes` VALUES (1, 4051711, '', 'JONNY JOSE', 'ACOSTA REYES', '1952-09-14', 'PAMPATAR', 'Masculino', 'Casado', '8V. SEMESTRE CONTADURIA PUBLICA', 'BACHILLER', '', '0000-00-00', '', 'CALLE JUAN MANUEL GUERRA, SAN LORENZO', '', '', '', '1', 'EMPLEADOS', '', '1');
INSERT INTO `integrantes` VALUES (2, 4512285, '', 'JUVENCIO RAMON', 'AMPARAN', '1949-06-01', 'CARANTOÃ‘A M. GOMEZ', 'Masculino', 'Casado', 'TOPOGRAFO', '3AÃ‘O BACHILLERATO', '', '0000-00-00', '', 'CALLE PRINCIPAL ENTRADA AL CERCADO', '', '', '', '1', 'EMPLEADOS', '', '2');
INSERT INTO `integrantes` VALUES (3, 8385761, '', 'DERQUI JESUS', 'BRITO MARTINEZ', '1960-10-18', 'LOS ROBLES', 'Masculino', 'Casado', '12', 'BACHILLER', '', '0000-00-00', '', 'CALLE DON JESUS LOS ROBLES', '', '', '', '1', 'EMPLEADOS', '', '3');
INSERT INTO `integrantes` VALUES (4, 3670594, '', 'CARLOS JESUS', 'BRITO', '1950-01-30', 'PUERTO FERMIN', 'Masculino', 'Casado', 'CONTABILISTA', 'BACHILLER', '', '0000-00-00', '', 'CALLE FIGUEROA EL TIRANO', '', '', '', '1', 'EMPLEADOS', '', '4');
INSERT INTO `integrantes` VALUES (5, 5477294, '', 'CATALINO ANTONIO', 'CORDOVA MARIN', '1959-08-16', 'EL MACO', 'Masculino', 'Casado', 'ABOGADO ', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE SAN ANTONIO EL MACO', '', '', '', '1', 'EMPLEADOS', '', '5');
INSERT INTO `integrantes` VALUES (6, 9303416, '', 'FELIPE JOSE', 'FERNANDEZ FERMIN', '1965-02-07', '', 'Masculino', '2', '10', '', '', '0000-00-00', '', '', '', '', '', '1', 'EMPLEADOS', '', '6');
INSERT INTO `integrantes` VALUES (7, 4654397, '', 'ALEXIS JOSE', 'FERNANDEZ HERNANDEZ', '1958-04-27', 'MONAGAS', 'Masculino', '*Concubina', 'ABOGADO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE SALGADO LA CRUZ DEL PASTEL', '', '', '', '1', 'EMPLEADOS', '', '7');
INSERT INTO `integrantes` VALUES (8, 10204661, '', 'REGULO JOSE', 'FERNANDEZ QUIJADA', '1971-12-27', '', 'Masculino', '0', 'MARATONISTA', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '8');
INSERT INTO `integrantes` VALUES (9, 11829028, '', 'LENIN JOSE', 'FLORES', '1974-07-23', 'CUMANA', 'Masculino', '*Concubina', 'ADMINISTRACION INDUSTRIALES', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'ISLETA II, CASA NÂº 84-66, MUNICIPIO GARCIA', '', '', '', '1', 'EMPLEADOS', '', '9');
INSERT INTO `integrantes` VALUES (10, 12222156, '', 'KATIUSKA DEL CARMEN', 'GARCIA BRITO', '1975-07-16', 'PORLAMAR', 'Femenino', 'Divorciado', 'T.S.U.ADMINISTRACION ADUANERA', 'UNIVERSITARIO', '', '0000-00-00', '', 'URB. VILLA ROSA, VEREDA 75, SECTOR G.', '', '', '', '1', 'EMPLEADOS', '', '10');
INSERT INTO `integrantes` VALUES (11, 2803086, '', 'FIDEL ANTONIO', 'GUEVARA', '1948-04-24', '', 'Masculino', '0', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'PENSIONADOS', '', '11');
INSERT INTO `integrantes` VALUES (12, 4018459, '', 'ARLENY DEL VALLE', 'HENRIQUEZ ZABALA', '1954-08-29', 'CABIMAS', 'Femenino', 'Soltero', '', 'BACHILLER', '', '0000-00-00', '', 'CALLE NARVAEZ, PORLAMAR', '', '', '', '1', 'EMPLEADOS', '', '12');
INSERT INTO `integrantes` VALUES (13, 9308955, '', 'FELICIA DEL CARMEN', 'HENRIQUEZ DE FUENTES', '1967-06-09', 'PORLAMAR', 'Femenino', 'Divorciado', 'ABOGADO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE LAS FLORES, LA GUARDIA', '', '', '', '1', 'EMPLEADOS', '', '13');
INSERT INTO `integrantes` VALUES (14, 5477905, '', 'JUAN LUIS', 'LEANDRO', '1956-05-16', 'PUNTA DE PIEDRAS', 'Masculino', 'Casado', 'OFICINISTA', 'BACHILLER', '', '0000-00-00', '', 'CALLE COLON PUNTA DE PIEDRAS', '', '', '', '1', 'EMPLEADOS', '', '15');
INSERT INTO `integrantes` VALUES (15, 8442192, '', 'REGULO JOSE', 'MENESES', '1961-04-19', 'SUCRE', 'Masculino', 'Soltero', '', 'BACHILLER', '', '0000-00-00', '', 'URB. VISTA ALEGRE, CASA S/N MUNICIPIO DIAZ', '', '', '', '1', 'EMPLEADOS', '', '16');
INSERT INTO `integrantes` VALUES (16, 8926627, '', 'JOSE MARIA', 'MILLAN MARQUEZ', '1963-08-11', '', 'Masculino', '1', '12', '', '', '0000-00-00', '', '', '', '', '', '1', 'EMPLEADOS', '', '17');
INSERT INTO `integrantes` VALUES (17, 8388339, '', 'WILFREDO JOSE', 'NUÃ‘EZ', '1960-08-21', 'PANPATAR', 'Masculino', 'Casado', 'T.S.U.ADMINISTRACION ', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'CALLE JUAN ACOSTA PAMPATAR', '', '', '', '1', 'EMPLEADOS', '', '18');
INSERT INTO `integrantes` VALUES (18, 8378076, '', 'PEDRO JOSE', 'PALMARES', '1962-04-27', 'MATURIN', 'Masculino', 'Casado', '', 'BACHILLER', '', '0000-00-00', '', 'CALLE GOMEZ NÂº 61 SECTOR ACHIPANO', '', '', '', '1', 'EMPLEADOS', '', '19');
INSERT INTO `integrantes` VALUES (19, 12224570, '', 'EVELINDA DEL VALLE', 'PEREZ DE CARRASCO', '1974-03-03', 'LA SIERRA', 'Femenino', 'Casado', '12', 'BACHILLER', '', '0000-00-00', '', 'GUATAMARE', '', '', '', '1', 'EMPLEADOS', '', '20');
INSERT INTO `integrantes` VALUES (20, 8392072, '', 'ROBERTO SALVADOR', 'RAMOS GARCIA', '1962-04-16', 'PORLAMAR', 'Masculino', '*Concubina', '', 'PRIMER AÃ‘O', '', '0000-00-00', '', 'CALLE PAEZ,CERCA DEL LICEO NUEVA ESPARTA, MUNICIPIO MARIÃ‘O', '', '', '', '1', 'EMPLEADOS', '', '21');
INSERT INTO `integrantes` VALUES (21, 8381570, '', 'ERNESTO LUIS', 'RODRIGUEZ GONZALEZ', '1961-03-11', 'PORLAMAR', 'Masculino', '*Concubina', '', 'SEGUNDO AÃ‘O', '', '0000-00-00', '', 'CALLEJON BOLIVAR DEL VALLE DE PEDRO GONZALEZ', '', '', '', '1', 'EMPLEADOS', '', '22');
INSERT INTO `integrantes` VALUES (22, 2166981, '', 'ANGEL JOS', 'RODRIGUEZ SALAZAR', '1942-01-25', '', 'Masculino', '0', '12', '', '', '0000-00-00', '', '', '', '', '', '3', 'PENSIONADOS', '', '23');
INSERT INTO `integrantes` VALUES (23, 13669573, '', 'HAROLDS LUIS', 'ROJAS AGUILERA', '1979-10-25', 'PORLAMAR', 'Masculino', 'Casado', 'ABOGADO ', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE ANTONIO DIAZ,PAMPATAR', '', '', '', '1', 'EMPLEADOS', '', '24');
INSERT INTO `integrantes` VALUES (24, 12225307, '', 'ANDRES EMILIO', 'ROJAS PEREZ', '1971-09-19', 'PORLAMAR', 'Masculino', 'Soltero', '', 'BACHILLER', '', '0000-00-00', '', 'ISLA DE COCHE LOS CERRITOS', '', '', '', '1', 'EMPLEADOS', '', '25');
INSERT INTO `integrantes` VALUES (25, 5482703, '', 'JOSE LUIS', 'SUAREZ', '1959-12-09', 'AGUA DE VACA', 'Masculino', 'Casado', 'CONTABILISTA', '2DO AÃ‘O BACHILLERATO', '', '0000-00-00', '', 'CALLE PRINCIPAL DEL CASERIO GUERRA, AGUA DE VACA', '', '', '', '1', 'EMPLEADOS', '', '26');
INSERT INTO `integrantes` VALUES (26, 4649004, '', 'NISCAMBRIO RAMON', 'SILVA CARREÃ‘O', '1955-05-30', 'ISLA DE COCHE', 'Masculino', 'Casado', '', '2DO AÃ‘O BACHILLERATO', '', '0000-00-00', '', 'CALLE PRINCIPAL, MACHO MUERTO', '', '', '', '1', 'EMPLEADOS', '', '27');
INSERT INTO `integrantes` VALUES (27, 1882215, '', 'OCTAVIO ELIAS', 'TEJERA PI?ERO', '1938-03-12', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '28');
INSERT INTO `integrantes` VALUES (28, 8382049, '', 'LUZ ELENA', 'TORTABU GONZALEZ', '1961-07-03', '', 'Masculino', '1', '10', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '29');
INSERT INTO `integrantes` VALUES (29, 5473836, '', 'MARIA DEL VALLE', 'SANCHEZ HERNANDEZ', '1957-09-08', 'CHAMARIAPA. SUCRE', 'Femenino', 'Viudo', 'SECRETARIA ', 'BACHILLER', '', '0000-00-00', '', 'CALLA SAN ANTONIO CASANÂº 04-44 LOS COCOS PORLAMAR', '', '', '', '1', 'EMPLEADOS', '', '31');
INSERT INTO `integrantes` VALUES (30, 4654821, '', 'AGUSTIN JOSE', 'MARCANO GOMEZ', '1950-08-30', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '32');
INSERT INTO `integrantes` VALUES (31, 3486366, '', 'CARLOS ALBERTO', 'LEON AGUILERA', '1948-11-01', '', 'Masculino', '2', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '33');
INSERT INTO `integrantes` VALUES (32, 5480903, '', 'GUILLERMO ANTONIO', 'SERRA MAGO', '1959-09-11', '', 'Masculino', '2', '9', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '34');
INSERT INTO `integrantes` VALUES (33, 4648525, '', 'ROGEL JOSE', 'MORENO MATA', '1949-08-06', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '35');
INSERT INTO `integrantes` VALUES (34, 4653768, '', 'NANCY ESTERBINA', 'SANCHEZ HERNANDEZ', '1955-12-26', '', 'Masculino', '2', '35', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '36');
INSERT INTO `integrantes` VALUES (35, 4189050, '', 'ARMANDO JOSE', 'RODRIGUEZ RODRIGUEZ', '1951-08-27', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '37');
INSERT INTO `integrantes` VALUES (36, 11144676, '', 'ALEXIS JAVIER', 'GUERRA SUAREZ', '1971-04-02', 'PORLAMAR', 'Masculino', 'Casado', 'T.S.U. EN INFORMATICA', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'CALLE PRINCIPAL. AGUA DE VACA', '', '', '', '1', 'EMPLEADOS', '', '38');
INSERT INTO `integrantes` VALUES (37, 6428161, '', 'MERCEDES MARIA', 'PEPIN ANDRADE', '1961-09-24', 'CARACAS', 'Femenino', 'Divorciado', '', 'BACHILLER', '', '0000-00-00', '', 'CALLE 1,CASA I-03 URB. LA ARBOLEDA', '', '', '', '1', 'EMPLEADOS', '', '39');
INSERT INTO `integrantes` VALUES (38, 8396643, '', 'ANGELES ZENAIDA', 'ALCALA MATA', '1964-04-24', 'JUANGRIEGO', 'Femenino', 'Casado', 'T.S.U. RELACIONES INDUSTRIALES', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'CALLE PRINCIPAL DE PEDREGALES', '', '', '', '1', 'EMPLEADOS', '', '41');
INSERT INTO `integrantes` VALUES (39, 11142484, '', 'NELLYS TERESA', 'BERBIN SILVA', '1971-11-28', 'PORLAMAR', 'Femenino', 'Casado', '12', 'BACHILLER', '', '0000-00-00', '', 'CALLE LA CEIBA, LA ASUNCION', '', '', '', '1', 'EMPLEADOS', '', '42');
INSERT INTO `integrantes` VALUES (40, 5476102, '', 'CARMEN JOSEFINA', 'CARRASCO REYES', '1958-11-10', 'PORLAMAR', 'Femenino', 'Soltero', 'T.S.U. ADMINISTRACION TRIBUTARIA', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'SECTOR EL CIMARRON PTO.FERMIN', '', '', '', '1', 'EMPLEADOS', '', '43');
INSERT INTO `integrantes` VALUES (41, 12506912, '', 'YAQUELINE GREGORIA', 'GONZALEZ SUAREZ', '1975-03-12', 'PORLAMAR', 'Femenino', 'Casado', 'ASISTENTE ADMINISTRATIVO', 'BACHILLER', '', '0000-00-00', '', 'CALLE PORLAMAR LOS COCOS', '', '', '', '1', 'EMPLEADOS', '', '44');
INSERT INTO `integrantes` VALUES (42, 8392561, '', 'EDGAR RAMON', 'MARTINEZ', '1962-05-05', 'PORLAMAR', 'Masculino', 'Soltero', '', '4TO. AÃ‘O', '', '0000-00-00', '', 'CALLE EL LIMON, CASA S/N EL SALADO', '', '', '', '1', 'EMPLEADOS', '', '47');
INSERT INTO `integrantes` VALUES (43, 4271638, '', 'DANIEL ORLANDO', 'AGUERO', '1953-01-03', 'BARQUISIMETO', 'Masculino', 'Soltero', '32', '4TO. AÃ‘O', '', '0000-00-00', '', 'EL SALADO SECTOR APECURERO', '', '', '', '1', 'EMPLEADOS', '', '48');
INSERT INTO `integrantes` VALUES (44, 5589301, '', 'NORA ELENA', 'CALDERA GOMEZ', '1959-06-28', 'CARACAS', 'Femenino', 'Casado', 'SECRETARIA ', 'BACHILLER', '', '0000-00-00', '', 'CALLE SAN JOSE LA VECINDAD', '', '', '', '1', 'EMPLEADOS', '', '50');
INSERT INTO `integrantes` VALUES (45, 8398597, '', 'YANET FRANCISCA', 'HEREDIA BELLO', '1964-06-02', 'PORLAMAR', 'Femenino', '0', 'RECEPCIONISTA', 'BACHILLER', '', '0000-00-00', '', 'URB. VICUÃ‘A LOS MILLANES', '', '', '', '1', 'EMPLEADOS', '', '51');
INSERT INTO `integrantes` VALUES (46, 12669638, '', 'MARIA GABRIELA', 'LEON SOLEDAD', '1974-09-14', 'CARACAS', 'Femenino', 'Casado', '', 'BACHILLER', '', '0000-00-00', '', 'CALLE MARGARITA CEDEÃ‘O, CASA S/N, LAS MARITAS', '', '', '', '1', 'EMPLEADOS', '', '52');
INSERT INTO `integrantes` VALUES (48, 5721970, '', 'ROMER ANTONIO', 'SALAZAR BRITO', '1959-06-15', 'LAGUNILLA EDO.ZULIA', 'Masculino', 'Casado', 'OFICINISTA', 'BACHILLER', '', '0000-00-00', '', 'CALLE PRINCIPAL DE SAN ANTONIO A 300 MTS DE LA ENTRADA  CASA S/N', '', '', '', '1', 'EMPLEADOS', '', '54');
INSERT INTO `integrantes` VALUES (49, 13541356, '', 'FERNANDO JOSE', 'MARTINEZ BRITO', '1977-08-09', 'PORLAMAR', 'Masculino', '*Concubina', '', 'BACHILLER', '', '0000-00-00', '', 'AV. 31 DE JULIO EL SALADO CASA S/N', '', '', '', '1', 'EMPLEADOS', '', '55');
INSERT INTO `integrantes` VALUES (50, 4647270, '', 'PEDRO RAMON', 'ARISMENDI DIAZ', '1952-08-04', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '56');
INSERT INTO `integrantes` VALUES (51, 3946767, '', 'THAIS JOSEFINA', 'MERCHAN PADILLA', '1950-12-07', 'CARUPANO', 'Femenino', 'Divorciado', 'ADMINISTRACION COMERCIAL', 'UNIVERSITARIO', '', '0000-00-00', '', 'RINCON LA CEIBA, ATAMO SUR', '', '', '', '1', 'EMPLEADOS', '', '58');
INSERT INTO `integrantes` VALUES (52, 3824167, '', 'ORLANDO RAFAEL', 'MORENO MATA', '1954-05-30', '', 'Masculino', '2', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '59');
INSERT INTO `integrantes` VALUES (54, 8470624, '', 'ALIDA EMILIA', 'MOYA DE GUEVARA', '1964-07-05', 'PARAGUACHI', 'Femenino', 'Casado', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'SECTOR LOS CHACOS, VILLA COLONIAL, LOS ROBLES', '', '', '', '1', 'EMPLEADOS', '', '61');
INSERT INTO `integrantes` VALUES (55, 6966895, '', 'JOSE GREGORIO', 'FLORES', '1968-04-12', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ADMINISTRADOR', 'UNIVERSITARIO', 'DIRECTOR DE CONTROL DE LA ADMI', '2000-09-05', '0', 'AV. 31 DE JULIO TEJA ROJA, CASA NÂº 111, SECTOR LOMA DE GUERRA', 'DIRECCION DE CONTROL DE LA ADMINISTRACION ESTADAL', '', '', '1', 'DIRECTORES', '1', '62');
INSERT INTO `integrantes` VALUES (56, 4650716, '', 'JOSE FRANCISCO', 'SALAZAR SERRANO', '1956-12-02', 'EL SALADO. MUNICIPIO ANTOLIN DEL CAMPO', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'CONTRALOR DEL ESTADO', '2000-02-14', '16', 'URB. JORGE COLL CONJUNTO RESIDENCIAL VALLE AZUL , TOWNHOUSE NÂº 8 PAMPATAR', 'CONTRALOR DEL ESTADO', '', '', '1', 'DIRECTORES', '1', '63');
INSERT INTO `integrantes` VALUES (57, 6177583, '', 'ALBA NATALIE', 'OCHOA TORRES', '1966-09-23', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'DIRECTORA DE RECURSOS HUMANOS', '2001-06-18', '8', 'URB. BAHIA DE PLATA ,NÂº 10 ALTAGRACIA, MUNICIPIO GOMEZ', 'DIRECCION DE RECURSOS HUMANOS', '', '', '1', 'DIRECTORES', '1', '65');
INSERT INTO `integrantes` VALUES (58, 1633192, '', 'ABELARDO', 'VIZCAINO NARVAEZ', '1937-11-22', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '66');
INSERT INTO `integrantes` VALUES (59, 12661621, '', 'ANAMARIA', 'GOMEZ COVA', '1975-01-15', 'CARACAS', 'Femenino', 'Soltero', 'ABOGADO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE QUILARTE RESIDENCIAS MUCURAPARO, PORLAMAR', '', '', '', '1', 'EMPLEADOS', '', '67');
INSERT INTO `integrantes` VALUES (60, 6122659, '', 'GRETTY DIVILEY', 'ATELLA BRAVO', '1965-05-28', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO', 'UNIVERSITARIO', 'DIRECTORA DE LA DIRECCION DE D', '1998-04-16', '0', 'AV. FRANCISCO FAJARDO SECTOR CONEJERO', 'DIRECCION DE DETERMINACION DE RESPONSABILIDADES', '', '', '1', 'DIRECTORES', '1', '68');
INSERT INTO `integrantes` VALUES (61, 4647928, '', 'LUIS ALBERTO', 'CARREÃ‘O', '1952-11-14', 'PORLAMAR', 'Masculino', 'Casado', 'LIC. ADMINISTRACION', 'UNIVERSITARIO', '', '0000-00-00', '', 'URBANIZACIÃ“N LA  GUARINA', '', '', '', '1', 'EMPLEADOS', '', '69');
INSERT INTO `integrantes` VALUES (62, 4651478, '', 'PEDRO LUIS', 'VALDERRAMA MONASTERIOS', '1957-11-08', 'PORLAMAR', 'Masculino', '*Concubina', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'PROLONGACION CALLE SAN JOSE CASA S/N DETRAS DEL JARDINN DE INFANCIA DE PARAGUACHI', '', '', '', '1', 'EMPLEADOS', '', '70');
INSERT INTO `integrantes` VALUES (63, 5482954, '', 'CARMEN JOSEFINA', 'ANDARA SILVA', '1961-07-15', 'PORLAMAR', 'Femenino', 'Casado', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '0000-00-00', '', 'URB. PLAYA EL ANGEL ', '', '', '', '1', 'EMPLEADOS', '', '71');
INSERT INTO `integrantes` VALUES (64, 13023459, '', 'JANETH DEL CARMEN', 'COLL FERMIN', '1977-04-06', 'CABIMAS', 'MASCULINO', 'SOLTERO', 'LIC. ADMINISTRACIÃ“N', 'UNIVERSITARIO', 'DIRECTORA DE ADMINISTRACION Y ', '2000-03-16', '0', 'AV. 31 DE JULIO EL SALADO', 'DIRECCION DE ADMINISTRACION Y PRESUPUESTO', '', '', '1', 'DIRECTORES', '1', '72');
INSERT INTO `integrantes` VALUES (66, 8385744, '', 'DORELIS DEL VALLE', 'GOMEZ GONZALEZ', '1961-05-07', 'SAN PEDRO DE COCHE', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'SECTOR CRUZ DEL PASTEL MUNICIPIO GARCIA', '', '', '', '1', 'EMPLEADOS', '', '74');
INSERT INTO `integrantes` VALUES (67, 11855143, '', 'MELVIS JOSE', 'FUENTES DIAZ', '1973-08-14', 'PORLAMAR', 'Masculino', 'Casado', 'T.S.U.INFORMATICA', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE SAN JOSE VALLE PEDRO GONZALEZ', '', '', '', '1', 'EMPLEADOS', '', '75');
INSERT INTO `integrantes` VALUES (68, 8566093, '', 'NELSON CARLOS', 'MARTINI HERNANDEZ', '1963-02-03', 'GUARICO', 'Masculino', 'Casado', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '0000-00-00', '', 'AV. BOLIVAR PLAYA EL ANGEL ', '', '', '', '1', 'EMPLEADOS', '', '76');
INSERT INTO `integrantes` VALUES (69, 4422887, '', 'ALICIA COROMOTO', 'GARCIA RUIZ', '1956-09-25', '', 'Femenino', '1', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '77');
INSERT INTO `integrantes` VALUES (70, 5482594, '', 'MILAGROS WISTREMUNDA', 'GARCIA DE MARTINEZ', '1961-02-16', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'ARQUITECTO', 'UNIVERSITARIO', 'DIRECTORA DE LA UNIDAD DE ATEN', '2000-03-16', '0', 'AV. PRINCIPAL, LA FUNETE FRENTE AL BOULEVARD', 'UNIDAD DE ATENCION CIUDADANA Y CONTROL COMUNITARIA', '', '', '1', 'DIRECTORES', '1', '78');
INSERT INTO `integrantes` VALUES (71, 11536888, '', 'AMERLIN ROSALBA', 'ROSAS VASQUEZ', '1974-03-01', 'Porlamar', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE 24 DE JULIO, PARAGUACHI', '', '', '', '1', 'EMPLEADOS', '', '79');
INSERT INTO `integrantes` VALUES (72, 4656784, '', 'JESUS JOSE', 'ROJAS MILANO', '1959-01-07', '', 'Masculino', '2', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '80');
INSERT INTO `integrantes` VALUES (73, 11142532, '', 'LENYN GREGORIO', 'ROJAS RODRIGUEZ', '1970-03-09', 'PORLAMAR', 'Masculino', 'Soltero', 'DISEÃ‘ADOR DE OBRAS CIVILES', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'AV. JUAN BAUTISTA ARISMENDI AL LADO DE LA ALMACENADORA MARGARITA', '', '', '', '1', 'EMPLEADOS', '', '81');
INSERT INTO `integrantes` VALUES (74, 11852605, '', 'ALEXANDER JOSE', 'ROSAS JIMENEZ', '1972-03-07', 'PORLAMAR', 'Masculino', 'Soltero', 'ABOGADO', 'UNIVERSITARIO', '', '0000-00-00', '', 'URB. JOVITO VILLALBA PAMPATAR', '', '', '', '1', 'EMPLEADOS', '', '82');
INSERT INTO `integrantes` VALUES (75, 5605331, '', 'OSIRIS COROMOTO', 'PATIÃ‘O VALENZUELA', '1963-12-23', 'CARACAS', 'MASCULINO', 'SOLTERO', 'ABOGADO ', 'UNIVERSITARIO', 'DIRECTORA ASESORA AL DESPACHO', '2000-02-22', '1', 'URB. EL PORTAL DE LOS ROBLES', 'ASESORIA DEL DESPACHO', '', '', '1', 'DIRECTORES', '1', '83');
INSERT INTO `integrantes` VALUES (76, 13729622, '', 'PEDRO ENRIQUE', 'ARRIOJA MARCANO', '1978-06-12', 'CARUPANO', 'MASCULINO', 'SOLTERO', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', 'DIRECTOR DE ORGANIZACION Y SIS', '2000-07-03', '0', 'LA ASUNCION', 'DIRECCION DE ORGANIZACION Y SISTEMAS', '', '', '1', 'DIRECTORES', '1', '84');
INSERT INTO `integrantes` VALUES (77, 4652451, '', 'LUIS RAMON', 'MARCANO MARIN', '1957-06-22', 'BOCA DEL RIO', 'Masculino', '*Concubina', 'ECONOMISTA', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE MARINA FRENTE AL CENTRO CULTURAL BOCA DEL RIO', '', '', '', '1', 'EMPLEADOS', '', '85');
INSERT INTO `integrantes` VALUES (78, 10214381, '', 'JUAN FRANCISCO', 'BELLORIN SALAZAR', '1972-04-17', '', 'Masculino', '1', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '86');
INSERT INTO `integrantes` VALUES (79, 4583844, '', 'GUSTAVO', 'LAFEE SANTANA', '1955-07-23', '', 'Masculino', '1', '7', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '87');
INSERT INTO `integrantes` VALUES (80, 14055011, '', 'MARICRUZ', 'TURKALI GUERRA', '1979-01-06', 'PORLAMAR', 'Femenino', 'Casado', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE LA NORIA LA ASUNCION', '', '', '', '1', 'EMPLEADOS', '', '88');
INSERT INTO `integrantes` VALUES (81, 5482007, '', 'MARINA DEL VALLE', 'FIGUEROA DELGADO', '1959-08-09', 'PORLAMAR', 'Femenino', 'Casado', 'ABOGADO', 'UNIVERSITARIO', '', '0000-00-00', '', 'uRB. LA GUARINA, SEGUNDA CALLE', '', '', '', '1', 'EMPLEADOS', '', '89');
INSERT INTO `integrantes` VALUES (82, 8390397, '', 'ABEL JOSE', 'VELASQUEZ VELASQUEZ', '1963-12-05', 'CARAPACHO, SAN JUAN', 'Masculino', '*Concubina', 'LIC. ADMINISTRACION', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE MARCANO CARAPACHO SAN JUAN', '', '', '', '1', 'EMPLEADOS', '', '90');
INSERT INTO `integrantes` VALUES (83, 3822286, '', 'JOSE DOMINGO', 'HERNANDEZ', '1947-02-03', '', 'Masculino', '2', '35', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '91');
INSERT INTO `integrantes` VALUES (84, 2155158, '', 'RAFAEL', 'NORIEGA SALAZAR', '1941-01-01', '', 'Masculino', '2', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '93');
INSERT INTO `integrantes` VALUES (85, 2832725, '', 'VICTOR JULIO', 'SALAZAR MARCANO', '1944-07-21', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '94');
INSERT INTO `integrantes` VALUES (86, 2826195, '', 'LUIS ALBERTO', 'ALFONZO', '1945-04-08', '', 'Masculino', '1', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '95');
INSERT INTO `integrantes` VALUES (87, 4051700, '', 'ROSAURO JOSE', 'RIVAS SERRA', '1953-10-07', '', 'Masculino', '2', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '96');
INSERT INTO `integrantes` VALUES (88, 3488626, '', 'RAFAEL TOBIAS', 'MENDOZA ROSAS', '1947-12-06', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '97');
INSERT INTO `integrantes` VALUES (89, 3487152, '', 'LUIS RAFAEL', 'PEREIRA BEAUFOND', '1946-01-08', '', 'Masculino', '2', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '98');
INSERT INTO `integrantes` VALUES (90, 3489278, '', 'MANUEL RAFAEL', 'MARCANO ZABALA', '1950-01-06', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '99');
INSERT INTO `integrantes` VALUES (91, 5643691, '', 'AIYAMARA', 'SALINAS COLMENARES', '1958-12-07', 'SAN CRISTOBAL, EDO TACHIRA', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CONJUNTO RESIDENCIAL LA PORTADA, LA ASUNCION', '', '', '', '1', 'EMPLEADOS', '', '100');
INSERT INTO `integrantes` VALUES (92, 3488376, '', 'PEDRO LUIS', 'LOPEZ LOPEZ', '1947-09-09', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '101');
INSERT INTO `integrantes` VALUES (93, 2168112, '', 'CARMEN REMIGIA', 'SUAREZ DE GUERRA', '1940-10-01', '', 'Femenino', '2', '35', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '102');
INSERT INTO `integrantes` VALUES (94, 3045299, '', 'JOSE MERCEDES', 'MILLAN QUIJADA', '1949-07-24', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '103');
INSERT INTO `integrantes` VALUES (95, 11143327, '', 'JIMMY', 'IMBRONDONE FERMIN', '1970-11-04', '', 'Masculino', '1', '11', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '104');
INSERT INTO `integrantes` VALUES (96, 5885859, '', 'CARLOS ENRIQUE', 'GUDIÃ‘O BARRIOS', '1960-04-26', '', 'Masculino', '0', '12', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '105');
INSERT INTO `integrantes` VALUES (97, 1748998, '', 'RAFAEL MIGUEL PASTOR', 'FELICE CASTILLO', '1942-09-15', '', 'Masculino', '2', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '106');
INSERT INTO `integrantes` VALUES (98, 7164093, '', 'ALFREDO JOSE', 'MENDOZA OVALLES', '1968-04-04', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '107');
INSERT INTO `integrantes` VALUES (99, 4656077, '', 'WOLFGANG LUIS', 'SALAZAR SALAZAR', '1958-03-11', '', 'Masculino', '1', '37', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '108');
INSERT INTO `integrantes` VALUES (100, 879613, '', 'PEDRO CECILIO', 'SALGADO MOYA', '1934-12-04', '', 'Masculino', '2', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '109');
INSERT INTO `integrantes` VALUES (101, 1157385, '', 'JESUS MANUEL', 'MILLAN', '1935-10-15', '', 'Masculino', '5', '32', '', '', '0000-00-00', '', '', '', '', '', '0', 'EMPLEADOS', '', '110');
INSERT INTO `integrantes` VALUES (102, 11506606, '', 'ISNELLY JOSEFINA', 'BALZA SALINAS', '1975-02-21', 'SAN CRISTOBAL', 'Femenino', 'Soltero', 'LIC. RELACIONES INDUSTRIALES', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE MARIÃ‘O SECTOR LOMA DE GUERRA', '', '', '', '1', 'EMPLEADOS', '', '112');
INSERT INTO `integrantes` VALUES (103, 13668974, '', 'VANESSA DEL VALLE', 'RIVERA GARCIA', '1977-05-24', 'EL VALLE ESPIRITU SANTO', 'Femenino', 'Casado', 'LIC.EN ESTUDIOS INTERNACIONALES', 'UNIVERSITARIO', '', '0000-00-00', '', 'CONJUNTO RESEDENCIAL EL CAMINO,NÂº 6 CALLE JOSE MARIA SUAREZ URB.SABANA MAR', '', '', '', '1', 'EMPLEADOS', '', '113');
INSERT INTO `integrantes` VALUES (104, 14220083, '', 'ORLENIS DEL VALLE', 'RODRIGUEZ ROSAS', '1979-04-07', 'PORLAMAR', 'Femenino', 'Casado', 'INGENIERO EN SISTEMAS', 'UNIVERSITARIO', '', '0000-00-00', '', 'SECTOR BELEN CASA S/N LOS ROBLES', '', '', '', '0', 'EMPLEADOS', '', '114');
INSERT INTO `integrantes` VALUES (105, 9425982, '', 'MIRIAN JOSEFINA', 'NUÃ‘EZ ARTEAGA', '1968-11-13', 'PORLAMAR', 'Femenino', 'Divorciado', 'PERIODISTA', 'UNIVERSITARIO', '', '0000-00-00', '', 'SEGUNDA AV. GUATAMARE QTA. VIRGEN DEL VALLE LA ASUNCION', '', '', '', '1', 'EMPLEADOS', '', '115');
INSERT INTO `integrantes` VALUES (106, 12920483, '', 'PETRA DEL VALLE', 'NARVAEZ MARIN', '1976-07-06', 'BOCA DE RIO', 'Femenino', '*Concubina', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'URB. VALLE VERDE', '', '', '', '1', 'EMPLEADOS', '', '116');
INSERT INTO `integrantes` VALUES (107, 5972426, '', 'MAÃ‘ANA', 'NOGUERA CARDENAS', '1962-09-16', 'CARACAS', 'Femenino', 'Divorciado', 'ECONOMISTA', 'UNIVERSITARIO', '', '0000-00-00', '', 'AV. PRINCIPAL DE ARICAGUA ANTOLIN DEL CAMPO', '', '', '', '1', 'EMPLEADOS', '', '117');
INSERT INTO `integrantes` VALUES (108, 9429622, '', 'EUSTACIO DAVID', 'MARCANO MARCANO', '1969-08-31', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'CONTADOR PUBLICO', 'UNIVERSITARIO', 'DIRECTOR DE ENTIDADES DESCENTR', '2004-02-18', '9', 'AV.31 DE JULIO LA FUENTE ', 'DIRECCION DE ENTIDADES DESCENTRALIZADAS', '', '', '1', 'DIRECTORES', '1', '118');
INSERT INTO `integrantes` VALUES (109, 12223561, '', 'MAIRYM JOSEFINA', 'BRUZUAL LAREZ', '1973-12-16', 'PUNTA DE PIEDRAS', 'Femenino', 'Casado', 'T.S.U.TURISMO', 'TECNICO SUPERIOR', '', '0000-00-00', '', 'URBANIZACIÃ“N CAMINO REAL ', '', '', '', '1', 'EMPLEADOS', '', '119');
INSERT INTO `integrantes` VALUES (110, 15423652, '', 'EUMARY CAROLINA', 'LOPEZ CARABALLO', '1982-08-06', 'ANTOLIN DEL CAMPO', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE GOMEZ EL RINCON DE LA FUENTE, CASA NÂº 1', '', '', '', '1', 'EMPLEADOS', '', '120');
INSERT INTO `integrantes` VALUES (111, 10519925, '', 'FRANCISCO JOSE', 'FERNANDEZ RODRIGUEZ', '1968-02-15', 'CARACAS', 'Masculino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'LA SIERRA QTA.ODELVA', '', '', '', '1', 'EMPLEADOS', '', '121');
INSERT INTO `integrantes` VALUES (112, 13848164, '', 'MARIA VICTORIA', 'MORENO MATA', '1978-10-30', 'PORLAMAR', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE BOLIVAR CASA NÂº 57 PEDRO GONZALEZ', '', '', '', '0', 'EMPLEADOS', '', '122');
INSERT INTO `integrantes` VALUES (113, 13190579, '', 'ROSELYS DEL VALLE', 'SALAZAR ZABALA', '1977-10-30', 'PORLAMAR', 'Femenino', 'Soltero', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '0000-00-00', '', 'URB. LA GUARINA, LA ASUNCION', '', '', '', '1', 'EMPLEADOS', '', '123');
INSERT INTO `integrantes` VALUES (114, 13424082, '', 'CARLOS ALBERTO', 'AVILA PANFIL', '1978-09-19', 'PORLAMAR', 'MASCULINO', 'SOLTERO', 'LIC. INFORMATICA', 'UNIVERSITARIO', 'Programador II', '2005-02-16', '3', 'CALLE LA CEIBA, PARAGUACHI', 'Organizacion y Sistemas', '0295-2348602', '', '1', 'EMPLEADOS', '1', '124');
INSERT INTO `integrantes` VALUES (115, 13848264, '', 'MARIA VICTORIA', 'MORENO MATA', '1978-10-30', 'PORLAMAR', 'Femenino', 'Soltero', 'CONTADOR PUBLICO', 'UNIVERSITARIO', '', '0000-00-00', '', 'CALLE BOLIVAR CASA NÂº 57 PEDRO GONZALEZ', '', '', '', '0', 'EMPLEADOS', '', '125');
INSERT INTO `integrantes` VALUES (116, 14685167, '', 'TEODORO ALEJANDRO', 'COELLO GARCIA', '1980-05-25', 'CUMANA', 'Masculino', 'Soltero', 'INGENIERO CIVIL', 'UNIVERSITARIO', '', '0000-00-00', '', 'LAS GILES SECTOR GUAYACAN', '', '', '', '1', 'EMPLEADOS', '', '126');
INSERT INTO `integrantes` VALUES (118, 6727828, '', 'NEREIDA ESTRELLA', 'DUGARTE VIELMA', '1966-01-06', 'CARACAS', 'Femenino', 'Casado', 'CONTADOR PUBLICO', 'UNIVERSITARIO', NULL, '0000-00-00', '', 'AV. PRINCIPAL SECTOR APOSTADERO', NULL, '', '', '1', 'EMPLEADOS', NULL, NULL);
INSERT INTO `integrantes` VALUES (117, 14543612, '', 'VICTOR JOSE DEL VALLE', 'AVILA DOMINGUEZ', '1980-03-25', 'PORLAMAR', 'Masculino', 'Casado', 'INGENIERO INDUSTRIAL', 'UNIVERSITARIO', NULL, '0000-00-00', '', 'AV. JOVITO VILLALBA LOS ROBLES', NULL, '', '', '1', 'EMPLEADOS', NULL, NULL);
INSERT INTO `integrantes` VALUES (119, 4983744, '', 'MARGOT ISABEL', 'RIVERO PEÃ‘A', '1957-03-11', 'CIUDAD BOLIVAR', 'Femenino', 'Divorciado', 'BIBLIOTECOLOGA', 'UNIVERSITARIO', NULL, '0000-00-00', '', 'CALLE MATASIETE, CONJUNTO RESIDENCIAL LA PORTADA, EDIF.C, APTO. 1, PB. LA ASUNCION', NULL, '', '', '1', 'EMPLEADOS', NULL, NULL);
INSERT INTO `integrantes` VALUES (120, 1320383, '', 'GERARDO JOSE', 'MARIN HERNANDEZ', '1917-04-15', 'BOCA DE RIO', 'Masculino', 'Casado', 'SUB- CONTRALOR', 'NO EXISTE DATO', NULL, '0000-00-00', '', 'CALLE ARISMENDI CASA 780 SECTOR CARUJO, BOCA DE RIO', NULL, '', '', '3', 'EMPLEADOS', NULL, NULL);
INSERT INTO `integrantes` VALUES (123, 222222222, '', 'zzzzzzzzzz', '222222', '2007-11-08', '222qqqqqq', 'MASCULINO', 'SOLTERO', 'zzzz', 'zzzzzzzzzzz', 'zzzzzz', '2007-11-07', '2', '', 'zzzzzzzzz', '0295-2348602', '0146-6555555', '1', 'EMPLEADOS', '1', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_banco`
-- 

INSERT INTO `integrantes_banco` VALUES ('55555', 'CORRIENTE', 'yo', 4051711, 1, 'NOMINA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_cargo`
-- 

CREATE TABLE `integrantes_cargo` (
  `denominacion` varchar(100) NOT NULL default '',
  `condicion` varchar(20) NOT NULL default '',
  `decreto_contrato` varchar(10) NOT NULL default '',
  `fecha_ini` date NOT NULL default '0000-00-00',
  `fecha_fin` date NOT NULL default '0000-00-00',
  `lugar_trabajo` varchar(100) NOT NULL default '',
  `direccion` varchar(100) NOT NULL default '',
  `cod_nomina` varchar(4) NOT NULL default '',
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_cargo`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=449 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_conceptos`
-- 

INSERT INTO `integrantes_conceptos` VALUES (7, 6966895, '0003');
INSERT INTO `integrantes_conceptos` VALUES (8, 6966895, '0004');
INSERT INTO `integrantes_conceptos` VALUES (9, 6966895, '0001');
INSERT INTO `integrantes_conceptos` VALUES (10, 6966895, '0005');
INSERT INTO `integrantes_conceptos` VALUES (11, 6966895, '0006');
INSERT INTO `integrantes_conceptos` VALUES (15, 5605331, '0001');
INSERT INTO `integrantes_conceptos` VALUES (16, 5605331, '0004');
INSERT INTO `integrantes_conceptos` VALUES (17, 5605331, '0006');
INSERT INTO `integrantes_conceptos` VALUES (18, 5605331, '0005');
INSERT INTO `integrantes_conceptos` VALUES (19, 6122659, '0001');
INSERT INTO `integrantes_conceptos` VALUES (20, 6122659, '0003');
INSERT INTO `integrantes_conceptos` VALUES (21, 6122659, '0004');
INSERT INTO `integrantes_conceptos` VALUES (22, 6122659, '0006');
INSERT INTO `integrantes_conceptos` VALUES (23, 6122659, '0005');
INSERT INTO `integrantes_conceptos` VALUES (24, 6122659, '9001');
INSERT INTO `integrantes_conceptos` VALUES (25, 13023459, '0001');
INSERT INTO `integrantes_conceptos` VALUES (26, 13023459, '0003');
INSERT INTO `integrantes_conceptos` VALUES (27, 13023459, '0004');
INSERT INTO `integrantes_conceptos` VALUES (28, 13023459, '0006');
INSERT INTO `integrantes_conceptos` VALUES (29, 13023459, '0005');
INSERT INTO `integrantes_conceptos` VALUES (30, 13023459, '9001');
INSERT INTO `integrantes_conceptos` VALUES (31, 4650716, '0003');
INSERT INTO `integrantes_conceptos` VALUES (32, 4650716, '0004');
INSERT INTO `integrantes_conceptos` VALUES (33, 4650716, '9001');
INSERT INTO `integrantes_conceptos` VALUES (34, 4650716, '0005');
INSERT INTO `integrantes_conceptos` VALUES (35, 4650716, '0006');
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
INSERT INTO `integrantes_conceptos` VALUES (127, 9429622, '0004');
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
INSERT INTO `integrantes_conceptos` VALUES (227, 5482594, '0006');
INSERT INTO `integrantes_conceptos` VALUES (228, 13729622, '0006');
INSERT INTO `integrantes_conceptos` VALUES (229, 6177583, '0006');
INSERT INTO `integrantes_conceptos` VALUES (230, 9429622, '0006');
INSERT INTO `integrantes_conceptos` VALUES (231, 6122659, '0002');
INSERT INTO `integrantes_conceptos` VALUES (232, 3946767, '0002');
INSERT INTO `integrantes_conceptos` VALUES (233, 13023459, '0002');
INSERT INTO `integrantes_conceptos` VALUES (234, 5482594, '0002');
INSERT INTO `integrantes_conceptos` VALUES (235, 9429622, '0002');
INSERT INTO `integrantes_conceptos` VALUES (236, 6966895, '0002');
INSERT INTO `integrantes_conceptos` VALUES (237, 13729622, '0002');
INSERT INTO `integrantes_conceptos` VALUES (238, 4051711, '1000');
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
INSERT INTO `integrantes_conceptos` VALUES (356, 4051711, '0008');
INSERT INTO `integrantes_conceptos` VALUES (357, 4512285, '0008');
INSERT INTO `integrantes_conceptos` VALUES (358, 8385761, '0008');
INSERT INTO `integrantes_conceptos` VALUES (359, 3670594, '0008');
INSERT INTO `integrantes_conceptos` VALUES (360, 5477294, '0008');
INSERT INTO `integrantes_conceptos` VALUES (361, 9303416, '0008');
INSERT INTO `integrantes_conceptos` VALUES (362, 4654397, '0008');
INSERT INTO `integrantes_conceptos` VALUES (363, 11829028, '0008');
INSERT INTO `integrantes_conceptos` VALUES (364, 12222156, '0008');
INSERT INTO `integrantes_conceptos` VALUES (365, 4018459, '0008');
INSERT INTO `integrantes_conceptos` VALUES (366, 9308955, '0008');
INSERT INTO `integrantes_conceptos` VALUES (367, 5477905, '0008');
INSERT INTO `integrantes_conceptos` VALUES (368, 8442192, '0008');
INSERT INTO `integrantes_conceptos` VALUES (369, 8926627, '0008');
INSERT INTO `integrantes_conceptos` VALUES (370, 8388339, '0008');
INSERT INTO `integrantes_conceptos` VALUES (371, 8378076, '0008');
INSERT INTO `integrantes_conceptos` VALUES (372, 12224570, '0008');
INSERT INTO `integrantes_conceptos` VALUES (373, 8392072, '0008');
INSERT INTO `integrantes_conceptos` VALUES (374, 8381570, '0008');
INSERT INTO `integrantes_conceptos` VALUES (375, 13669573, '0008');
INSERT INTO `integrantes_conceptos` VALUES (376, 12225307, '0008');
INSERT INTO `integrantes_conceptos` VALUES (377, 5482703, '0008');
INSERT INTO `integrantes_conceptos` VALUES (378, 4649004, '0008');
INSERT INTO `integrantes_conceptos` VALUES (379, 8382049, '0008');
INSERT INTO `integrantes_conceptos` VALUES (380, 5473836, '0008');
INSERT INTO `integrantes_conceptos` VALUES (381, 4654821, '0008');
INSERT INTO `integrantes_conceptos` VALUES (382, 11144676, '0008');
INSERT INTO `integrantes_conceptos` VALUES (383, 6428161, '0008');
INSERT INTO `integrantes_conceptos` VALUES (384, 8396643, '0008');
INSERT INTO `integrantes_conceptos` VALUES (385, 11142484, '0008');
INSERT INTO `integrantes_conceptos` VALUES (386, 5476102, '0008');
INSERT INTO `integrantes_conceptos` VALUES (387, 12506912, '0008');
INSERT INTO `integrantes_conceptos` VALUES (388, 8392561, '0008');
INSERT INTO `integrantes_conceptos` VALUES (389, 4271638, '0008');
INSERT INTO `integrantes_conceptos` VALUES (390, 5589301, '0008');
INSERT INTO `integrantes_conceptos` VALUES (391, 8398597, '0008');
INSERT INTO `integrantes_conceptos` VALUES (392, 12669638, '0008');
INSERT INTO `integrantes_conceptos` VALUES (393, 5721970, '0008');
INSERT INTO `integrantes_conceptos` VALUES (394, 13541356, '0008');
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
INSERT INTO `integrantes_conceptos` VALUES (440, 13023459, '0011');
INSERT INTO `integrantes_conceptos` VALUES (441, 5482594, '0010');
INSERT INTO `integrantes_conceptos` VALUES (442, 5482594, '0011');
INSERT INTO `integrantes_conceptos` VALUES (443, 4650716, '0001');
INSERT INTO `integrantes_conceptos` VALUES (444, 4650716, '0012');
INSERT INTO `integrantes_conceptos` VALUES (445, 4650716, '0013');
INSERT INTO `integrantes_conceptos` VALUES (446, 4650716, '0010');
INSERT INTO `integrantes_conceptos` VALUES (447, 6966895, '0010');
INSERT INTO `integrantes_conceptos` VALUES (448, 6966895, '0011');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `integrantes_constantes`
-- 

CREATE TABLE `integrantes_constantes` (
  `id` int(11) NOT NULL auto_increment,
  `cedula` int(10) unsigned NOT NULL default '0' COMMENT 'cedula',
  `cod_constantes` varchar(4) NOT NULL default '' COMMENT 'codigo de la constante asignada',
  `monto` double NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cedula` (`cedula`,`cod_constantes`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

-- 
-- Volcar la base de datos para la tabla `integrantes_constantes`
-- 

INSERT INTO `integrantes_constantes` VALUES (45, 8926627, '1021', 855970.43);
INSERT INTO `integrantes_constantes` VALUES (41, 4018459, '1021', 673576.73);
INSERT INTO `integrantes_constantes` VALUES (43, 5477905, '1021', 645975.95);
INSERT INTO `integrantes_constantes` VALUES (44, 8442192, '1021', 830225.86);
INSERT INTO `integrantes_constantes` VALUES (42, 9308955, '1021', 1484278.97);
INSERT INTO `integrantes_constantes` VALUES (32, 4051711, '1021', 847729.21);
INSERT INTO `integrantes_constantes` VALUES (33, 4512285, '1021', 935461.36);
INSERT INTO `integrantes_constantes` VALUES (34, 8385761, '1021', 1078626.54);
INSERT INTO `integrantes_constantes` VALUES (35, 3670594, '1021', 922565.01);
INSERT INTO `integrantes_constantes` VALUES (36, 5477294, '1021', 1724910.68);
INSERT INTO `integrantes_constantes` VALUES (37, 9303416, '1021', 1027796);
INSERT INTO `integrantes_constantes` VALUES (38, 4654397, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (39, 11829028, '1021', 635943.75);
INSERT INTO `integrantes_constantes` VALUES (40, 12222156, '1021', 1027796);
INSERT INTO `integrantes_constantes` VALUES (46, 8388339, '1021', 1027796);
INSERT INTO `integrantes_constantes` VALUES (47, 8378076, '1021', 1489201.96);
INSERT INTO `integrantes_constantes` VALUES (48, 12224570, '1021', 766819.09);
INSERT INTO `integrantes_constantes` VALUES (49, 8392072, '1021', 672891.58);
INSERT INTO `integrantes_constantes` VALUES (50, 8381570, '1021', 680183.28);
INSERT INTO `integrantes_constantes` VALUES (51, 13669573, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (52, 12225307, '1021', 674163.97);
INSERT INTO `integrantes_constantes` VALUES (53, 5482703, '1021', 1087394.04);
INSERT INTO `integrantes_constantes` VALUES (54, 4649004, '1021', 651848.43);
INSERT INTO `integrantes_constantes` VALUES (55, 5473836, '1021', 742948.88);
INSERT INTO `integrantes_constantes` VALUES (56, 11144676, '1021', 1362897.67);
INSERT INTO `integrantes_constantes` VALUES (57, 6428161, '1021', 696088.02);
INSERT INTO `integrantes_constantes` VALUES (58, 8396643, '1021', 1548044.81);
INSERT INTO `integrantes_constantes` VALUES (59, 11142484, '1021', 889685.37);
INSERT INTO `integrantes_constantes` VALUES (60, 5476102, '1021', 1027796);
INSERT INTO `integrantes_constantes` VALUES (61, 12506912, '1021', 796312.15);
INSERT INTO `integrantes_constantes` VALUES (62, 8392561, '1021', 969272.63);
INSERT INTO `integrantes_constantes` VALUES (63, 4271638, '1021', 991977.93);
INSERT INTO `integrantes_constantes` VALUES (64, 5589301, '1021', 742219.81);
INSERT INTO `integrantes_constantes` VALUES (65, 8398597, '1021', 830225.86);
INSERT INTO `integrantes_constantes` VALUES (66, 12669638, '1021', 748846.76);
INSERT INTO `integrantes_constantes` VALUES (67, 5721970, '1021', 1359683.01);
INSERT INTO `integrantes_constantes` VALUES (68, 13541356, '1021', 921243.99);
INSERT INTO `integrantes_constantes` VALUES (69, 3946767, '1021', 3570096.57);
INSERT INTO `integrantes_constantes` VALUES (70, 8470624, '1021', 2552323.4);
INSERT INTO `integrantes_constantes` VALUES (71, 6966895, '1021', 4631021.52);
INSERT INTO `integrantes_constantes` VALUES (72, 4650716, '1021', 5947906.25);
INSERT INTO `integrantes_constantes` VALUES (73, 6177583, '1021', 4462620.73);
INSERT INTO `integrantes_constantes` VALUES (74, 12661621, '1021', 1814208.86);
INSERT INTO `integrantes_constantes` VALUES (75, 6122659, '1021', 5008912.88);
INSERT INTO `integrantes_constantes` VALUES (76, 4647928, '1021', 1606962.81);
INSERT INTO `integrantes_constantes` VALUES (77, 4651478, '1021', 1713022.34);
INSERT INTO `integrantes_constantes` VALUES (78, 5482954, '1021', 1861532.22);
INSERT INTO `integrantes_constantes` VALUES (79, 13023459, '1021', 4631021.52);
INSERT INTO `integrantes_constantes` VALUES (80, 8385744, '1021', 2402120.82);
INSERT INTO `integrantes_constantes` VALUES (81, 11855143, '1021', 1348802.51);
INSERT INTO `integrantes_constantes` VALUES (82, 8566093, '1021', 2855342.27);
INSERT INTO `integrantes_constantes` VALUES (83, 5482594, '1021', 4826770.59);
INSERT INTO `integrantes_constantes` VALUES (84, 11536888, '1021', 2619489.82);
INSERT INTO `integrantes_constantes` VALUES (85, 11142532, '1021', 1281385.45);
INSERT INTO `integrantes_constantes` VALUES (86, 11852605, '1021', 1826533.65);
INSERT INTO `integrantes_constantes` VALUES (87, 4652451, '1021', 1592741.9);
INSERT INTO `integrantes_constantes` VALUES (88, 14055011, '1021', 2597101.01);
INSERT INTO `integrantes_constantes` VALUES (89, 5482007, '1021', 2073236);
INSERT INTO `integrantes_constantes` VALUES (90, 8390397, '1021', 1446958.9);
INSERT INTO `integrantes_constantes` VALUES (91, 5643691, '1021', 1562892.96);
INSERT INTO `integrantes_constantes` VALUES (92, 11506606, '1021', 2022655.51);
INSERT INTO `integrantes_constantes` VALUES (93, 9425982, '1021', 2620804.22);
INSERT INTO `integrantes_constantes` VALUES (94, 12920483, '1021', 1576973.07);
INSERT INTO `integrantes_constantes` VALUES (95, 5972426, '1021', 2529934.59);
INSERT INTO `integrantes_constantes` VALUES (96, 9429622, '1021', 4816262.37);
INSERT INTO `integrantes_constantes` VALUES (97, 12223561, '1021', 1215975.2);
INSERT INTO `integrantes_constantes` VALUES (98, 15423652, '1021', 1261578.45);
INSERT INTO `integrantes_constantes` VALUES (99, 10519925, '1021', 1446958.9);
INSERT INTO `integrantes_constantes` VALUES (100, 13190579, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (101, 13424082, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (102, 14685167, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (103, 14543612, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (104, 6727828, '1021', 1434153.95);
INSERT INTO `integrantes_constantes` VALUES (105, 4983744, '1021', 1236400);
INSERT INTO `integrantes_constantes` VALUES (107, 6966895, '0005', 120000);
INSERT INTO `integrantes_constantes` VALUES (108, 6966895, '0003', 157814.2);
INSERT INTO `integrantes_constantes` VALUES (109, 6966895, '0002', 82921.57);
INSERT INTO `integrantes_constantes` VALUES (183, 6177583, '9000', 2.96);
INSERT INTO `integrantes_constantes` VALUES (184, 8566093, '9000', 2);
INSERT INTO `integrantes_constantes` VALUES (182, 6122659, '9000', 4.92);
INSERT INTO `integrantes_constantes` VALUES (180, 4650716, '9000', 8.42);
INSERT INTO `integrantes_constantes` VALUES (179, 3946767, '9000', 2.62);
INSERT INTO `integrantes_constantes` VALUES (178, 6966895, '9000', 3.44);
INSERT INTO `integrantes_constantes` VALUES (181, 5482594, '9000', 3.97);
INSERT INTO `integrantes_constantes` VALUES (177, 9429622, '9000', 4.3);
INSERT INTO `integrantes_constantes` VALUES (176, 11536888, '9000', 0.08);
INSERT INTO `integrantes_constantes` VALUES (175, 13023459, '9000', 3.99);
INSERT INTO `integrantes_constantes` VALUES (174, 13729622, '9000', 5.45);
INSERT INTO `integrantes_constantes` VALUES (194, 5605331, '1021', 4546821.12);
INSERT INTO `integrantes_constantes` VALUES (173, 5605331, '1002', 348748);
INSERT INTO `integrantes_constantes` VALUES (172, 5605331, '0005', 120000);
INSERT INTO `integrantes_constantes` VALUES (195, 9429622, '1002', 846688);
INSERT INTO `integrantes_constantes` VALUES (196, 13729622, '1002', 769464);
INSERT INTO `integrantes_constantes` VALUES (185, 8385744, '9000', 0.95);
INSERT INTO `integrantes_constantes` VALUES (186, 5605331, '9000', 4.31);
INSERT INTO `integrantes_constantes` VALUES (187, 6122659, '1002', 815762);
INSERT INTO `integrantes_constantes` VALUES (188, 6122659, '0007', 200000);
INSERT INTO `integrantes_constantes` VALUES (189, 6122659, '0005', 100000);
INSERT INTO `integrantes_constantes` VALUES (190, 13023459, '0005', 50000);
INSERT INTO `integrantes_constantes` VALUES (191, 13023459, '1002', 911142);
INSERT INTO `integrantes_constantes` VALUES (192, 4650716, '0005', 120000);
INSERT INTO `integrantes_constantes` VALUES (193, 4650716, '0007', 125000);
INSERT INTO `integrantes_constantes` VALUES (197, 6966895, '1002', 611346);
INSERT INTO `integrantes_constantes` VALUES (198, 5482594, '1002', 811272);
INSERT INTO `integrantes_constantes` VALUES (199, 13023459, '0003', 157814.2);
INSERT INTO `integrantes_constantes` VALUES (200, 13023459, '0017', 12817.78);
INSERT INTO `integrantes_constantes` VALUES (201, 4650716, '0006', 250000);
INSERT INTO `integrantes_constantes` VALUES (202, 4650716, '0008', 350000);
INSERT INTO `integrantes_constantes` VALUES (203, 4650716, '0003', 546535.48);
INSERT INTO `integrantes_constantes` VALUES (204, 6966895, '0017', 12817.78);
INSERT INTO `integrantes_constantes` VALUES (205, 13729622, '0005', 100000);
INSERT INTO `integrantes_constantes` VALUES (206, 13729622, '1021', 5008912.88);
INSERT INTO `integrantes_constantes` VALUES (207, 6177583, '0005', 100000);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `nomina`
-- 

CREATE TABLE `nomina` (
  `cod` varchar(5) NOT NULL default '' COMMENT 'codigo de la nomina',
  `cedula` int(10) unsigned NOT NULL default '0',
  `cod_incidencia` varchar(4) NOT NULL COMMENT 'codigo de la incidencia (constante o concepto)',
  `descripcion` varchar(50) NOT NULL,
  `monto_incidencia` double NOT NULL COMMENT 'monto',
  `tipo` varchar(10) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `tipo_nomina` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=439 ;

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
  `f_elab` date default NULL,
  `num_periodos` varchar(100) NOT NULL,
  `ano_curso` year(4) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='tabla que contiene los datos de la nomina activa' AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `nomina_actual`
-- 

INSERT INTO `nomina_actual` VALUES ('0001', '3', '2007-11-13', '2007-11-15', '2007-08-13', '24', 2006, 1, 'Nomina del mes de marzo', 'ACTIVA');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `variables`
-- 

INSERT INTO `variables` VALUES (2, '1000', 'map', 'Monto Antiguedad Previa', '10000');
INSERT INTO `variables` VALUES (3, '1001', 'mas', 'Monto Antiguedad Actual', '10000');
