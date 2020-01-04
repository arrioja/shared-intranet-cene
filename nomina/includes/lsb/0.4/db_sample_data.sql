-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Σύστημα: localhost:3306
-- Χρόνος δημιουργίας: 23 Νοε 2006, στις 10:42 AM
-- Έκδοση Διακομιστή: 4.0.21
-- Έκδοση PHP: 4.3.9
-- 
-- Βάση: `salix`
-- 

-- --------------------------------------------------------

-- 
-- Δομή Πίνακα για τον Πίνακα `sc_page_types`
-- 

CREATE TABLE `sc_page_types` (
  `page_type` varchar(10) NOT NULL default '',
  `type_descr` varchar(50) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- 'Αδειασμα δεδομένων του πίνακα `sc_page_types`
-- 

INSERT INTO `sc_page_types` VALUES ('t1', 'type1'),
('t2', 'type2'),
('t3', 'type3'),
('t4', 'type4');

-- --------------------------------------------------------

-- 
-- Δομή Πίνακα για τον Πίνακα `sc_page_types_sub`
-- 

CREATE TABLE `sc_page_types_sub` (
  `page_type` varchar(10) NOT NULL default '',
  `sub_type` varchar(10) NOT NULL default '',
  `type_descr` varchar(30) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- 'Αδειασμα δεδομένων του πίνακα `sc_page_types_sub`
-- 

INSERT INTO `sc_page_types_sub` VALUES ('t1', 'st11', 'type11'),
('t1', 'st12', 'type12'),
('t1', 'st13', 'type13'),
('t1', 'st14', 'type14'),
('t2', 'st21', 'type21'),
('t2', 'st22', 'type22'),
('t2', 'st23', 'type23'),
('t3', 'st31', 'type31'),
('t3', 'st32', 'type32'),
('t3', 'st33', 'type33'),
('t3', 'st34', 'type34'),
('t3', 'st35', 'type35');

-- --------------------------------------------------------

-- 
-- Δομή Πίνακα για τον Πίνακα `sc_page_types_sub_sub`
-- 

CREATE TABLE `sc_page_types_sub_sub` (
  `page_type` varchar(10) NOT NULL default '',
  `sub_type` varchar(10) NOT NULL default '',
  `type_descr` varchar(30) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- 'Αδειασμα δεδομένων του πίνακα `sc_page_types_sub_sub`
-- 

INSERT INTO `sc_page_types_sub_sub` VALUES ('st11', 'st11', 'type11'),
('st12', 'st12', 'type12'),
('st13', 'st13', 'type13'),
('st14', 'st14', 'type14'),
('st21', 'st21', 'type21'),
('st22', 'st22', 'type22'),
('st23', 'st23', 'type23'),
('st31', 'st31', 'type31'),
('st32', 'st32', 'type32'),
('st33', 'st33', 'type33'),
('st34', 'st34', 'type34'),
('st35', 'st35', 'type35');
