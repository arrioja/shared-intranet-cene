create database testdb;

use testdb;

CREATE TABLE `tblcategories` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) collate latin1_general_ci NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- 
-- Dumping data for table `tblcategories`
-- 
INSERT INTO `tblcategories` VALUES (1, 'Hardware', 0);
INSERT INTO `tblcategories` VALUES (2, 'Software', 0);
INSERT INTO `tblcategories` VALUES (3, 'Movies', 0);
INSERT INTO `tblcategories` VALUES (4, 'Mouse', 1);
INSERT INTO `tblcategories` VALUES (5, 'Keyboard', 1);
INSERT INTO `tblcategories` VALUES (6, 'Monitor', 1);
INSERT INTO `tblcategories` VALUES (7, 'Harddisk', 1);
INSERT INTO `tblcategories` VALUES (8, 'CD ROM', 1);
INSERT INTO `tblcategories` VALUES (9, 'CD Writer', 1);
INSERT INTO `tblcategories` VALUES (9, 'DVD', 1);
INSERT INTO `tblcategories` VALUES (10, 'Desktop', 2);
INSERT INTO `tblcategories` VALUES (11, 'Web Application', 2);
INSERT INTO `tblcategories` VALUES (12, 'Mobile Application', 2);
INSERT INTO `tblcategories` VALUES (13, 'Hindi', 3);
INSERT INTO `tblcategories` VALUES (14, 'English', 3);
INSERT INTO `tblcategories` VALUES (15, 'Punjabi', 3);
INSERT INTO `tblcategories` VALUES (16, 'French', 3);


