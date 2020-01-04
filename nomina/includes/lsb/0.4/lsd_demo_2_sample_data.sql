-- phpMyAdmin SQL Dump
-- version 2.9.0.2
-- http://www.phpmyadmin.net
-- 
-- Σύστημα: localhost
-- Χρόνος δημιουργίας: 22 Δεκ 2006, στις 11:41 AM
-- Έκδοση Διακομιστή: 4.1.21
-- Έκδοση PHP: 4.4.2
-- 
-- Βάση: 'salixgr_appdata'
-- 

-- --------------------------------------------------------

-- 
-- Δομή Πίνακα για τον Πίνακα 'lsd_demo_2'
-- 

CREATE TABLE lsd_demo_2 (
  rec_id int(11) NOT NULL auto_increment,
  parent_id int(11) NOT NULL default '0',
  descr varchar(50) collate latin1_bin NOT NULL default '',
  PRIMARY KEY  (rec_id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- 
-- 'Αδειασμα δεδομένων του πίνακα 'lsd_demo_2'
-- 

INSERT INTO lsd_demo_2 VALUES (1, 0, 'Item 1');
INSERT INTO lsd_demo_2 VALUES (2, 0, 'Item 2');
INSERT INTO lsd_demo_2 VALUES (3, 0, 'Item 3');
INSERT INTO lsd_demo_2 VALUES (4, 0, 'Item 4');
INSERT INTO lsd_demo_2 VALUES (5, 1, 'Item 1-1');
INSERT INTO lsd_demo_2 VALUES (6, 1, 'Item 1-2');
INSERT INTO lsd_demo_2 VALUES (7, 1, 'Item 1-3');
INSERT INTO lsd_demo_2 VALUES (8, 1, 'Item 1-4');
INSERT INTO lsd_demo_2 VALUES (9, 2, 'Item 2-1');
INSERT INTO lsd_demo_2 VALUES (10, 2, 'Item 2-2');
INSERT INTO lsd_demo_2 VALUES (11, 2, 'Item 2-3');
INSERT INTO lsd_demo_2 VALUES (12, 2, 'Item 2-4');
INSERT INTO lsd_demo_2 VALUES (13, 3, 'Item 3-1');
INSERT INTO lsd_demo_2 VALUES (14, 3, 'Item 3-2');
INSERT INTO lsd_demo_2 VALUES (15, 3, 'Item 3-3');
INSERT INTO lsd_demo_2 VALUES (16, 3, 'Item 3-4');
INSERT INTO lsd_demo_2 VALUES (17, 4, 'Item 4-1');
INSERT INTO lsd_demo_2 VALUES (18, 4, 'Item 4-2');
INSERT INTO lsd_demo_2 VALUES (19, 4, 'Item 4-3');
INSERT INTO lsd_demo_2 VALUES (20, 4, 'Item 4-4');
INSERT INTO lsd_demo_2 VALUES (21, 5, 'Item 1-1-1');
INSERT INTO lsd_demo_2 VALUES (22, 5, 'Item 1-1-2');
INSERT INTO lsd_demo_2 VALUES (23, 5, 'Item 1-1-3');
INSERT INTO lsd_demo_2 VALUES (24, 5, 'Item 1-1-4');
INSERT INTO lsd_demo_2 VALUES (25, 6, 'Item 1-2-1');
INSERT INTO lsd_demo_2 VALUES (26, 6, 'Item 1-2-2');
INSERT INTO lsd_demo_2 VALUES (27, 6, 'Item 1-2-3');
INSERT INTO lsd_demo_2 VALUES (28, 6, 'Item 1-2-4');
INSERT INTO lsd_demo_2 VALUES (29, 7, 'Item 1-3-1');
INSERT INTO lsd_demo_2 VALUES (30, 7, 'Item 1-3-2');
INSERT INTO lsd_demo_2 VALUES (31, 7, 'Item 1-3-3');
INSERT INTO lsd_demo_2 VALUES (32, 7, 'Item 1-3-4');
INSERT INTO lsd_demo_2 VALUES (33, 8, 'Item 1-4-1');
INSERT INTO lsd_demo_2 VALUES (34, 8, 'Item 1-4-2');
INSERT INTO lsd_demo_2 VALUES (35, 8, 'Item 1-4-3');
INSERT INTO lsd_demo_2 VALUES (36, 8, 'Item 1-4-4');
INSERT INTO lsd_demo_2 VALUES (37, 9, 'Item 2-1-1');
INSERT INTO lsd_demo_2 VALUES (38, 9, 'Item 2-1-2');
INSERT INTO lsd_demo_2 VALUES (39, 9, 'Item 2-1-3');
INSERT INTO lsd_demo_2 VALUES (40, 9, 'Item 2-1-4');
INSERT INTO lsd_demo_2 VALUES (41, 10, 'Item 2-2-1');
INSERT INTO lsd_demo_2 VALUES (42, 10, 'Item 2-2-2');
INSERT INTO lsd_demo_2 VALUES (43, 10, 'Item 2-2-3');
INSERT INTO lsd_demo_2 VALUES (44, 10, 'Item 2-2-4');
INSERT INTO lsd_demo_2 VALUES (45, 11, 'Item 2-3-1');
INSERT INTO lsd_demo_2 VALUES (46, 11, 'Item 2-3-2');
INSERT INTO lsd_demo_2 VALUES (47, 11, 'Item 2-3-3');
INSERT INTO lsd_demo_2 VALUES (48, 11, 'Item 2-3-4');
INSERT INTO lsd_demo_2 VALUES (49, 12, 'Item 2-4-1');
INSERT INTO lsd_demo_2 VALUES (50, 12, 'Item 2-4-2');
INSERT INTO lsd_demo_2 VALUES (51, 12, 'Item 2-4-3');
INSERT INTO lsd_demo_2 VALUES (52, 12, 'Item 2-4-4');
INSERT INTO lsd_demo_2 VALUES (53, 13, 'Item 3-1-1');
INSERT INTO lsd_demo_2 VALUES (54, 13, 'Item 3-1-2');
INSERT INTO lsd_demo_2 VALUES (55, 13, 'Item 3-1-3');
INSERT INTO lsd_demo_2 VALUES (56, 13, 'Item 3-1-4');
INSERT INTO lsd_demo_2 VALUES (57, 14, 'Item 3-2-1');
INSERT INTO lsd_demo_2 VALUES (58, 14, 'Item 3-2-2');
INSERT INTO lsd_demo_2 VALUES (59, 14, 'Item 3-2-3');
INSERT INTO lsd_demo_2 VALUES (60, 14, 'Item 3-2-4');
INSERT INTO lsd_demo_2 VALUES (61, 15, 'Item 3-3-1');
INSERT INTO lsd_demo_2 VALUES (62, 15, 'Item 3-3-2');
INSERT INTO lsd_demo_2 VALUES (63, 15, 'Item 3-3-3');
INSERT INTO lsd_demo_2 VALUES (64, 15, 'Item 3-3-4');
INSERT INTO lsd_demo_2 VALUES (65, 16, 'Item 3-4-1');
INSERT INTO lsd_demo_2 VALUES (66, 16, 'Item 3-4-2');
INSERT INTO lsd_demo_2 VALUES (67, 16, 'Item 3-4-3');
INSERT INTO lsd_demo_2 VALUES (68, 16, 'Item 3-4-4');
INSERT INTO lsd_demo_2 VALUES (69, 17, 'Item 4-1-1');
INSERT INTO lsd_demo_2 VALUES (70, 17, 'Item 4-1-2');
INSERT INTO lsd_demo_2 VALUES (71, 17, 'Item 4-1-3');
INSERT INTO lsd_demo_2 VALUES (72, 17, 'Item 4-1-4');
INSERT INTO lsd_demo_2 VALUES (73, 18, 'Item 4-2-1');
INSERT INTO lsd_demo_2 VALUES (74, 18, 'Item 4-2-2');
INSERT INTO lsd_demo_2 VALUES (75, 18, 'Item 4-2-3');
INSERT INTO lsd_demo_2 VALUES (76, 18, 'Item 4-2-4');
INSERT INTO lsd_demo_2 VALUES (77, 19, 'Item 4-3-1');
INSERT INTO lsd_demo_2 VALUES (78, 19, 'Item 4-3-2');
INSERT INTO lsd_demo_2 VALUES (79, 19, 'Item 4-3-3');
INSERT INTO lsd_demo_2 VALUES (80, 19, 'Item 4-3-4');
INSERT INTO lsd_demo_2 VALUES (81, 20, 'Item 4-4-1');
INSERT INTO lsd_demo_2 VALUES (82, 20, 'Item 4-4-2');
INSERT INTO lsd_demo_2 VALUES (83, 20, 'Item 4-4-3');
INSERT INTO lsd_demo_2 VALUES (84, 20, 'Item 4-4-4');
